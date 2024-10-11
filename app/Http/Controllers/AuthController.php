<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Customer;


class AuthController extends Controller
{
    // Thời gian sống của access token (ví dụ: 15 phút)
    private $accessTokenTTL = 15; // minutes
    // Thời gian sống của refresh token (ví dụ: 7 ngày)
    private $refreshTokenTTL = 24 * 60 * 7; // 7 days

    // Đăng nhập và tạo access token và refresh token
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($user->status == 0) {
            return response()->json(['error' => 'Blocked'], 403);
        }

        // Tạo access token
        $accessToken = $this->createToken($user->id, $this->accessTokenTTL);

        // Tạo refresh token
        $refreshToken = $this->createToken($user->id, $this->refreshTokenTTL);

        return response()->json([
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'token_type' => 'Bearer',
            'expires_in' => $this->accessTokenTTL * 60 // thời gian hết hạn access token tính theo giây
        ]);
    }

    // Làm mới access token
    public function refresh(Request $request)
    {
        $refreshToken = $request->input('refresh_token');

        try {
            $decrypted = Crypt::decryptString($refreshToken);
            list($userId, $expiresAt) = explode('|', $decrypted);

            if (now()->timestamp > $expiresAt) {
                return response()->json(['error' => 'Refresh token expired'], 401);
            }

            $user = User::find($userId);
            if (!$user) {
                return response()->json(['error' => 'User not found'], 401);
            }

            $newAccessToken = $this->createToken($userId, $this->accessTokenTTL);

            return response()->json([
                'access_token' => $newAccessToken,
                'refresh_token' => $refreshToken,
                'token_type' => 'Bearer',
                'expires_in' => $this->accessTokenTTL * 60
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255'
        ]);

        // Tạo mới user
        $user = User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => 3, // Assuming role_id 3 is for customer
            'status' => 1 // Assuming 1 means active
        ]);

        // Tạo mới employee
        $employee = Customer::create(array_merge($validatedData, ['user_id' => $user->id]));

        return response()->json($employee, 201);
    }

    // Đăng xuất
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    // Tạo token với thời gian sống cụ thể
    private function createToken($userId, $ttl)
    {
        $expiresAt = now()->addMinutes($ttl)->timestamp;
        return Crypt::encryptString($userId . '|' . $expiresAt);
    }
    
}

