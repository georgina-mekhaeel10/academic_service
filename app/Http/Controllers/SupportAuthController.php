<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SupportAuthController extends Controller
{
    //
    public function index()
    {
      

       // تحقق من تسجيل دخول موظف الدعم
       if (!Auth::guard('support')->check()) {
        // إذا لم يكن موظف الدعم مسجلاً الدخول، أعد توجيهه إلى صفحة تسجيل الدخول
        return Redirect()->route('support.login');
    }
        return view('support.index'); // عرض صفحة لوحة التحكم
    }
    public function showLoginForm()
    {
        return view('auth.support.login');
    }

    public function login(Request $request)
    {   // التحقق من صحة البيانات المدخلة
        $request->validate([
            'email' => 'required|email', // تحقق من أن البريد الإلكتروني غير فارغ ويجب أن يكون بتنسيق صحيح
            'password' => 'required|min:8', // تحقق من أن كلمة المرور غير فارغة ويجب أن تكون على الأقل 6 أحرف
        ]
       ,[
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف.',
        ]  
    );
        $credentials = $request->only('email', 'password');

        if (Auth::guard('support')->attempt($credentials)) {
            return redirect()->route('support.dashboard');
        }

        return back()->withErrors(['error' => 'Invalid credentials'])->withInput();
    }
    public function Logout(){
    	Auth::guard('support')->logout();
        session()->flush(); // سيحذف كل بيانات الجلسة
    	return Redirect()->route('support.login');

    }

}