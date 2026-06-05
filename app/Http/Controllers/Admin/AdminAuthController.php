<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'يرجى إدخال اسم المستخدم.',
            'password.required' => 'يرجى إدخال كلمة المرور.',
        ]);

        $adminUsername = env('ADMIN_USERNAME', 'admin');
        $adminPassword = env('ADMIN_PASSWORD', '123456');

        if ($request->username === $adminUsername && $request->password === $adminPassword) {
            session([
                'admin_logged_in' => true,
                'admin_username' => $request->username,
            ]);

            return redirect()->route('admin.dashboard');
        }

        return back()
            ->withErrors(['login_error' => 'اسم المستخدم أو كلمة المرور غير صحيحة.'])
            ->withInput();
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_username']);

        return redirect()->route('admin.login');
    }
}