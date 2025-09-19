<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\ASupport;
class AdminAuthController extends Controller
{
    //
    public function index()
    {// تحقق من تسجيل دخول admin
        if (!Auth::guard('admin')->check()) {
            return Redirect()->route('admin.login');
            
        }
 
        return view('admin.index'); // عرض صفحة لوحة التحكم
    }

    public function showLoginForm()
    {
        return view('auth.admin.login'); // عرض صفحة تسجيل الدخول
    }

    public function login(Request $request)
    {
        // 1. التحقق من صحة المدخلات
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required'    => 'البريد الإلكتروني مطلوب.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min'      => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف.',
        ]);
    
        // 2. تجهيز بيانات الاعتماد (credentials)
        $credentials = $request->only('email', 'password');
    
        // 3. محاولة تسجيل الدخول باستخدام guard admin
        if (Auth::guard('admin')->attempt($credentials)) {
            // 4. جلب المستخدم الحالي
            $user = Auth::guard('admin')->user();
            // 5. إعادة التوجيه للداشبورد
            return redirect()->route('admin.dashboard')
                             ->with('success', 'wellcome' . $user->name);
        }
    
        // 6. في حال فشل تسجيل الدخول
        return back()->withErrors(['error' => 'بيانات الدخول غير صحيحة'])->withInput();
    }
    
    

    public function Logout(){
    	Auth::logout();
    	return Redirect()->route('admin.login');

    }



    
}
