<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\DetailOrder;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Lấy danh sách tất cả các orders với tìm kiếm và phân trang
    public function index(Request $request)
    {
        if(auth()->user()->role_id == 3){
            // Lấy giá trị tìm kiếm và phân trang từ query parameters
            $search = $request->query('search');
            $perPage = $request->query('per_page', 10); // Mặc định là 10 orders mỗi trang

            // Xây dựng query để tìm kiếm và phân trang
            $query = Order::with('coupon')
                ->where('customer_id', auth()->user()->customer->id)
                ->orderBy('id', 'desc'); 

            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('order_code', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
                });
            }

            $orders = $query->paginate($perPage);

            return response()->json($orders);
        }else{
            $search = $request->query('search');
            $perPage = $request->query('per_page', 10); // Mặc định là 10 orders mỗi trang

            // Xây dựng query để tìm kiếm và phân trang
            $query = Order::with('customer')
                ->with('employee')
                ->orderBy('id', 'desc'); 

            if (is_numeric($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('status', $search);
                });
            }else{
                $query->where(function($q) use ($search) {
                    $q->where('order_code', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
                });
            }

            $orders = $query->paginate($perPage);

            return response()->json($orders);
        }
    }

    // Tạo order mới
    public function store(Request $request)
    {
        $customer_id = auth()->user()->customer->id;

        $validatedData = $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'coupon' => 'nullable|exists:coupons,code'
        ]);

        $coupon = null;
        if (!empty($validatedData['coupon'])) {
            $coupon = Coupon::where('code', $validatedData['coupon'])
                            ->where('expiry_date', '>=', now())
                            ->first();
        }

        $carts = Cart::with('detail_products.product', 'detail_products.size', 'border', 'topping')
            ->where('customer_id', $customer_id)
            ->get();

        // Tính tổng giá trị dựa trên price của detail_products, border và topping
        $totalPrice = $carts->sum(function ($cart) {
            $productPrice = $cart->detail_products->price * $cart->quantity;
            $borderPrice = $cart->border ? $cart->border->price : 0;
            $toppingPrice = $cart->topping ? $cart->topping->price : 0;
            return $productPrice + $borderPrice + $toppingPrice;
        });

        // Nếu có mã giảm giá và hợp lệ, áp dụng giá trị giảm giá theo phần trăm
        if ($coupon) {
            $discountAmount = ($totalPrice * $coupon->value) / 100;
            $totalPrice -= $discountAmount;
        }

        $validatedData['total_amount'] = $totalPrice;
        $validatedData['customer_id'] = $customer_id;
        $validatedData['payment'] = 0;
        $validatedData['status'] = 1;
        $validatedData['coupon_id'] = $coupon ? $coupon->id : null;

        // Tạo mới order
        $order = Order::create($validatedData);

        // Thêm chi tiết đơn hàng
        foreach ($carts as $cart) {
            DetailOrder::create([
                'order_id' => $order->id,
                'detail_product_id' => $cart->detail_product_id,
                'border_id' => $cart->border_id,
                'topping_id' => $cart->topping_id,
                'quantity' => $cart->quantity,
            ]);
        }

        // Xóa toàn bộ cart với điều kiện customer_id
        Cart::where('customer_id', $customer_id)->delete();

        return response()->json($order, 201);
    }



    // Lấy thông tin một order cụ thể
    public function show($id)
    {
        $order = Order::with('customer')->with('coupon')->find($id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if((auth()->user()->role_id == 3) && ($order->customer_id != auth()->user()->customer->id)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        return response()->json($order);
    }

    // Hủy đơn hàng (cập nhật status = 0)
    public function cancel($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if((auth()->user()->role_id == 3) && ($order->customer_id != auth()->user()->customer->id)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if((auth()->user()->role_id != 3)){
            $employee_id = auth()->user()->employee->id;
            $order->employee_id = $employee_id;
        }
        
        $order->status = 0;
        $order->payment = -1;

        $order->save();

        return response()->json(['message' => 'Order cancelled successfully']);
    }

    public function status($id)
    {
        $employee_id = auth()->user()->employee->id;

        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if($order->id == 0){
            return response()->json(['error' => 'Unauthorized']);
        }

        $status = $order->status + 1;

        if($status >= 4){
            return response()->json(['error' => 'Unauthorized']);
        }

        $order->employee_id = $employee_id;
        $order->status = $status;

        $order->save();

        return response()->json(['status' => $status]);
    }

    // Xác nhận thanh toán đơn hàng (cập nhật payment = 1)
    public function pay($id)
    {   
        $employee_id = auth()->user()->employee->id;
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $status = $order->status;

        if($status != 3){
            $status = $status + 1;
        }

        $order->employee_id = $employee_id;
        $order->payment = 1;
        $order->status = $status;

        $order->save();

        return response()->json(['message' => 'Order paid successfully']);
    }
}
