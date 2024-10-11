<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Lấy danh sách tất cả các Users với tìm kiếm và phân trang
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10); // Mặc định là 10 customer mỗi trang

        // Xây dựng query để tìm kiếm và phân trang
        $query = User::where('role_id', 3)
            ->leftJoin('customers', 'users.id', '=', 'customers.user_id')
            ->select('users.*', 'customers.phone', 'customers.address', 'customers.name');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('users.email', 'like', "%{$search}%")
                ->orWhere('customers.name', 'like', "%{$search}%")
                ->orWhere('customers.phone', 'like', "%{$search}%")
                ->orWhere('customers.address', 'like', "%{$search}%");
            });
        }

        $customers = $query->paginate($perPage);

        return response()->json($customers);
    }

    // Lấy thông tin một User cụ thể
    public function show($id)
    {
        $User = User::with('customer')->find($id);
        if (!$User) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json($User);
    }

    public function profile()
    {
        $user = auth()->user();

        // Load the related customer or employee data
        $user->load(['customer', 'employee']);

        if ($user->customer) {
            return response()->json(['user' => $user, 'role' => 'customer']);
        } elseif ($user->employee) {
            return response()->json(['user' => $user, 'role' => 'employee']);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    // Cập nhật thông tin customer (có cả đổi mật khẩu)
    public function update(Request $request)
    {
        // Lấy user hiện tại
        $user = auth()->user();

        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:1' // nếu có đổi mật khẩu
        ]);

        // Cập nhật thông tin user
        $user->email = $validatedData['email'];

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        // Kiểm tra vai trò và cập nhật thông tin tương ứng
        if ($user->role_id == 3) { // Customer
            $customer = Customer::where('user_id', $user->id)->first();
            if ($customer) {
                $customer->name = $validatedData['name'];
                $customer->phone = $validatedData['phone'];
                $customer->address = $validatedData['address'];
                $customer->save();
            } else {
                return response()->json(['error' => 'Customer not found'], 404);
            }
        } else { // Employee
            $employee = Employee::where('user_id', $user->id)->first();
            if ($employee) {
                $employee->name = $validatedData['name'];
                $employee->phone = $validatedData['phone'];
                $employee->address = $validatedData['address'];
                $employee->save();
            } else {
                return response()->json(['error' => 'Employee not found'], 404);
            }
        }

        return response()->json(['user' => $user]);
    }

    // Cấm khách hàng (đổi status bằng 0)
    public function block($id)
    {
        if(auth()->user()->role_id == 3){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $User = User::find($id);
        if (!$User) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if(($User->role_id == 1) && auth()->user()->role_id == 2){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if($User->id == auth()->user()->id){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if($User->status == 0){
            $User->status = 1;
            $User->save();
            return response()->json(['user' => $User]);
        }else{
            $User->status = 0;
            $User->save();
            return response()->json(['user' => $User]);
        }
    }
}
