<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    // Lấy danh sách tất cả các nhân viên với tìm kiếm và phân trang
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10); // Mặc định là 10 nhân viên mỗi trang

        // Xây dựng query để tìm kiếm và phân trang
        $query = Employee::whereHas('user', function ($q) {
            $q->where('status', '!=', 0);
        })->with('user');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%")
                ->orWhere('position', 'like', "%{$search}%");
            });
        }

        $employees = $query->paginate($perPage);

        return response()->json($employees);
    }


    // Lấy thông tin một nhân viên cụ thể
    public function show($id)
    {
        $employee = Employee::with('user')->find($id);
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
        return response()->json($employee);
    }

    // Tạo nhân viên mới
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'id_card_number' => 'required|string|max:20',
            'start_date' => 'required|date',
            'salary' => 'required|numeric'
        ]);

        // Tạo mới user
        $user = User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => 2, // Assuming role_id 2 is for employees
            'status' => 1 // Assuming 1 means active
        ]);

        // Tạo mới employee
        $employee = Employee::create(array_merge($validatedData, ['user_id' => $user->id]));

        return response()->json($employee, 201);
    }

    // Cập nhật thông tin nhân viên
    public function update(Request $request, $id)
    {
        // Tìm nhân viên theo ID
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        // Tìm user liên kết
        $user = User::find($employee->user_id);

        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|nullable|string|min:4',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'id_card_number' => 'required|string|max:20',
            'start_date' => 'required|date',
            'salary' => 'required|numeric'
        ]);

        // Cập nhật thông tin user
        $user->update([
            'email' => $validatedData['email'],
            'password' => $request->filled('password') ? Hash::make($request->input('password')) : $user->password
        ]);

        // Cập nhật thông tin employee
        $employee->update($validatedData);

        return response()->json($employee);
    }

    // Xóa nhân viên
    public function destroy($id)
    {
        // Tìm nhân viên theo ID
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        // Tìm user liên kết và cập nhật status
        $user = User::find($employee->user_id);

        if ($user->id == auth()->user()->id) {
            return response()->json(['error' => 'You cannot delete your own account'], 403);
        }

        if ($user) {
            $user->status = 0;
            $user->save();
        }

        return response()->json(['message' => 'Employee deleted successfully'], 200);
    }

}
