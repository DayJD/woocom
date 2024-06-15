<?php

namespace App\Http\Controllers;

use App\Services\WooCommerceService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login_admin()
    {
        return view('auth.login');
    }

 
    public function auth_login_admin(Request $request)
    {
        $woocommerceService = new WooCommerceService();
        $users = $woocommerceService->getAllUsers();

        $email = $request->email;
        $password = $request->password;

        foreach ($users as $userData) {
            $user = $userData['data'];
            $userRoles = $userData['roles'];
            if ($user['user_email'] === $email && Hash::check($password, $user['user_pass'])) {
                $userData = [
                    'id' => $user['ID'],
                    'email' => $user['user_email'],
                    'name' => $user['user_nicename'],
                    'roles' => $userData['roles'][0],
                ];

                Session::put('user', $userData);

                if ($userData['roles'] === 'shop_manager') {
                    return redirect('shop_manager/dashboard');
                } elseif ($userData['roles'] === 'administrator') {
                    return redirect('admin/dashboard');
                } elseif ($userData['roles'] === 'customer') {
                    return redirect('customer/dashboard');
                } else {
                    return redirect()->back()->with('error', 'ไม่มีผู้ใช้งานนี้');
                }
            }
        }

        return redirect()->back()->with('error', 'Invalid email or password.');
    }

    public function logout_admin()
    {
        Auth::logout();
        return redirect('auth/login');
    }
}
