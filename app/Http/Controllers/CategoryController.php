<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // Lấy danh sách tất cả các categories với tìm kiếm và phân trang
    public function index(Request $request)
    {
        // Lấy giá trị tìm kiếm và phân trang từ query parameters
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10); // Mặc định là 10 category mỗi trang

        // Xây dựng query để tìm kiếm và phân trang
        $query = Category::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
        }

        $categories = $query->paginate($perPage);

        return response()->json($categories);
    }

    // Tạo category mới
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Tạo mới category
        $category = Category::create($validatedData);

        return response()->json($category, 201);
    }

    // Lấy thông tin một category cụ thể
    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        return response()->json($category);
    }

    // Cập nhật thông tin category
    public function update(Request $request, $id)
    {
        // Tìm category theo ID
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug,' . $id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Xử lý file image nếu có
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Cập nhật category
        $category->update($validatedData);

        return response()->json($category);
    }

    // Xóa category
    public function destroy(Category $category)
    {
        // Xóa ảnh liên quan nếu có
        if ($category->image && Storage::exists('public/' . $category->image)) {
            Storage::delete('public/' . $category->image);
        }
        // Xóa category
        $category->delete();
        return response()->json(['message' => 'success'], 200);
    }
}
