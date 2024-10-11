<?php

namespace App\Http\Controllers;

use App\Models\Topping;
use Illuminate\Http\Request;

class ToppingController extends Controller
{
    // Lấy danh sách tất cả các Topping với tìm kiếm và phân trang
    public function index(Request $request)
    {
        // Lấy giá trị tìm kiếm và phân trang từ query parameters
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10); // Mặc định là 10 Topping mỗi trang

        // Xây dựng query để tìm kiếm và phân trang
        $query = Topping::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $Topping = $query->paginate($perPage);

        return response()->json($Topping);
    }

    // Tạo Topping mới
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|int',
        ]);

        // Tạo mới Topping
        $Topping = Topping::create($validatedData);

        return response()->json($Topping, 201);
    }

    // Lấy thông tin một Topping cụ thể
    public function show($id)
    {
        $Topping = Topping::find($id);
        if (!$Topping) {
            return response()->json(['error' => 'Topping not found'], 404);
        }
        return response()->json($Topping);
    }

    // Cập nhật thông tin Topping
    public function update(Request $request, $id)
    {
        // Tìm Topping theo ID
        $Topping = Topping::find($id);
        if (!$Topping) {
            return response()->json(['error' => 'Topping not found'], 404);
        }

        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|int',
        ]);

        // Cập nhật Topping
        $Topping->update($validatedData);

        return response()->json($Topping);
    }

    // Xóa Topping
    public function destroy($id)
    {
        $Topping = Topping::find($id);
        if (!$Topping) {
            return response()->json(['error' => 'Topping not found'], 404);
        }

        // Xóa Topping
        $Topping->delete();
        return response()->json(['message' => 'Topping deleted successfully']);
    }
}
