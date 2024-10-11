<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Lấy danh sách tất cả các giỏ hàng của người dùng đã xác thực
    public function index()
    {
        $customer_id = auth()->user()->customer->id;
        
        $carts = Cart::with('detail_products.product')
            ->with('detail_products.size')
            ->with('border')
            ->with('topping')
            ->where('customer_id', $customer_id)
            ->get();

        return response()->json($carts);
    }

    // Tạo mục giỏ hàng mới
    public function store(Request $request)
    {
        $customer_id = auth()->user()->customer->id;
        
        $validatedData = $request->validate([
            'border_id' => 'nullable|exists:borders,id',
            'topping_id' => 'nullable|exists:toppings,id',
            'detail_product_id' => 'required|exists:detail_products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Thêm user_id vào dữ liệu đã xác thực
        $validatedData['customer_id'] = $customer_id;

        // Tạo mới mục giỏ hàng
        $cart = Cart::create($validatedData);

        return response()->json($cart, 201);
    }

    // Cập nhật thông tin mục giỏ hàng
    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);
        if (!$cart) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Cập nhật thông tin mục giỏ hàng
        $cart->update($validatedData);

        return response()->json($cart);
    }

    // Xóa mục giỏ hàng
    public function destroy($id)
    {
        $cart = Cart::find($id);
        if (!$cart) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        // Xóa mục giỏ hàng
        $cart->delete();
        return response()->json(['message' => 'Cart item deleted successfully']);
    }
}
