<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    // Lấy danh sách tất cả các sizes với tìm kiếm và phân trang
    public function index(Request $request)
    {
        // Lấy giá trị tìm kiếm và phân trang từ query parameters
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10); // Mặc định là 10 size mỗi trang

        // Xây dựng query để tìm kiếm và phân trang
        $query = Size::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $sizes = $query->paginate($perPage);

        return response()->json($sizes);
    }

    // Tạo size mới
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        // Tạo mới size
        $size = Size::create($validatedData);

        return response()->json($size, 201);
    }

    // Lấy thông tin một size cụ thể
    public function show($id)
    {
        $size = Size::find($id);
        if (!$size) {
            return response()->json(['error' => 'Size not found'], 404);
        }
        return response()->json($size);
    }

    // Cập nhật thông tin size
    public function update(Request $request, $id)
    {
        // Tìm size theo ID
        $size = Size::find($id);
        if (!$size) {
            return response()->json(['error' => 'Size not found'], 404);
        }

        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        // Cập nhật size
        $size->update($validatedData);

        return response()->json($size);
    }

    // Xóa size
    public function destroy($id)
    {
        $size = Size::find($id);
        if (!$size) {
            return response()->json(['error' => 'Size not found'], 404);
        }

        // Xóa size
        $size->delete();
        return response()->json(['message' => 'Size deleted successfully']);
    }
}
