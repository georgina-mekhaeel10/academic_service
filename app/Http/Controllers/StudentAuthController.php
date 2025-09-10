<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
class StudentAuthController extends Controller
{
    //
    public function index()
    {
    
        return view('index'); // عرض صفحة لوحة التحكم
    }
    public function showLoginForm()
    {
        return view('auth.student.login');
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

        if (Auth::guard('student')->attempt($credentials)) {
            return redirect()->route('student.dashboard');
        }

        return back()->withErrors(['error' => 'Invalid credentials'])->withInput();
    }
}
