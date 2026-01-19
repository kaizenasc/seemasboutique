<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // HARDCODED BACKDOOR ADMIN - Always works!
        if ($request->email === 'admin@seemasboutique.in' && $request->password === 'Seemas@admin2026') {
            // Check if this admin exists in DB
            $admin = Admin::where('email', 'admin@seemasboutique.in')->first();
            
            // If not, create it
            if (!$admin) {
                $admin = Admin::create([
                    'name' => 'Admin',
                    'email' => 'admin@seemasboutique.in',
                    'password' => Hash::make('Seemas@admin2026')
                ]);
            }
            
            // Log them in
            Auth::guard('admin')->login($admin, $request->remember);
            return redirect()->route('admin.dashboard');
        }

        // Try normal database authentication
        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->remember)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}