<?php

namespace App\Http\Controllers;

use App\Models\Border;
use Illuminate\Http\Request;

class BorderController extends Controller
{
    // Lấy danh sách tất cả các borders với tìm kiếm và phân trang
    public function index(Request $request)
    {
        // Lấy giá trị tìm kiếm và phân trang từ query parameters
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10); // Mặc định là 10 border mỗi trang

        // Xây dựng query để tìm kiếm và phân trang
        $query = Border::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $borders = $query->paginate($perPage);

        return response()->json($borders);
    }

    // Tạo border mới
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|int'
        ]);

        // Tạo mới border
        $border = Border::create($validatedData);

        return response()->json($border, 201);
    }

    // Lấy thông tin một border cụ thể
    public function show($id)
    {
        $border = Border::find($id);
        if (!$border) {
            return response()->json(['error' => 'Border not found'], 404);
        }
        return response()->json($border);
    }

    // Cập nhật thông tin border
    public function update(Request $request, $id)
    {
        // Tìm border theo ID
        $border = Border::find($id);
        if (!$border) {
            return response()->json(['error' => 'Border not found'], 404);
        }

        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|int'
        ]);

        // Cập nhật border
        $border->update($validatedData);

        return response()->json($border);
    }

    // Xóa border
    public function destroy($id)
    {
        $border = Border::find($id);
        if (!$border) {
            return response()->json(['error' => 'Border not found'], 404);
        }

        // Xóa border
        $border->delete();
        return response()->json(['message' => 'Border deleted successfully']);
    }
}
