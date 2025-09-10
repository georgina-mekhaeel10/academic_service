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
            // إذا لم يكن موظف الدعم مسجلاً الدخول، أعد توجيهه إلى صفحة تسجيل الدخول
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
             // التحقق من صحة البيانات المدخلة
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

        if (Auth::guard('admin')->attempt($credentials)) {
             // تخزين اسم المستخدم وكلمة المرور في الجلسة
              // الحصول على المستخدم الذي قام بتسجيل الدخول
        $user = Auth::guard('admin')->user();
        $name = session('name');
       // dd($user);  // عرض بيانات الجلسة
             if ($user) {
                session([
                    'name' => $user->name,
                    'email'=>$request->email,
                    'password' => $request->password, // تخزين كلمة المرور المدخلة
                ]);

            return redirect()->route('admin.dashboard'); // التوجيه إلى لوحة التحكم بعد تسجيل الدخول
        }
    }
    return back()->withErrors(['error' => 'Invalid credentials'])->withInput();
    // إرسال رسالة خطأ;  // عرض الأخطاء إذا فشل تسجيل الدخول
    }

    public function Logout(){
    	Auth::logout();
    	return Redirect()->route('admin.login');

    }



    
}
