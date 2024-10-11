<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    // Lấy danh sách tất cả các coupons với tìm kiếm và phân trang
    public function index(Request $request)
    {
        // Lấy giá trị tìm kiếm và phân trang từ query parameters
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10); // Mặc định là 10 coupon mỗi trang

        // Xây dựng query để tìm kiếm và phân trang
        $query = Coupon::query();

        if ($search) {
            $query->where('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $coupons = $query->paginate($perPage);

        return response()->json($coupons);
    }

    // Tạo coupon mới
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code',
            'description' => 'nullable|string',
            'value' => 'required|numeric',
            'quantity' => 'required|integer',
            'expiry_date' => 'required|date|after_or_equal:today',
        ]);

        // Tạo mới coupon
        $coupon = Coupon::create($validatedData);

        return response()->json($coupon, 201);
    }

    // Lấy thông tin một coupon cụ thể
    public function show($id)
    {
        $coupon = Coupon::find($id);
        if (!$coupon) {
            return response()->json(['error' => 'Coupon not found'], 404);
        }
        return response()->json($coupon);
    }

    // Cập nhật thông tin coupon
    public function update(Request $request, $id)
    {
        // Tìm coupon theo ID
        $coupon = Coupon::find($id);
        if (!$coupon) {
            return response()->json(['error' => 'Coupon not found'], 404);
        }

        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code,' . $id,
            'description' => 'nullable|string',
            'value' => 'required|numeric',
            'quantity' => 'required|integer',
            'expiry_date' => 'required|date|after_or_equal:today',
        ]);

        // Cập nhật coupon
        $coupon->update($validatedData);

        return response()->json($coupon);
    }

    // Xóa coupon
    public function destroy(Coupon $coupon)
    {
        // Xóa coupon
        $coupon->delete();
        return response()->json(['message' => 'success'], 200);
    }
}
