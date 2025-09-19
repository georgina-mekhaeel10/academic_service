<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Auth;
class AdminController extends Controller
{
    //
    public function Logout(){
    	Auth::logout();
    	return Redirect()->route('admin.login');

    }


    
     // الدالة الخاصة بملف التعريف
     public function editProfile()
     {  
         return view('admin.account.editprofile');  // تأكد من أن لديك ملف editprofile.blade.php في المسار الصحيح
     }

    public function updateProfile(Request $request)
    {
         // التحقق من البيانات المدخلة
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255' , // تحقق من البريد الإلكتروني باستثناء الحساب الحالي
            'password' => 'nullable|min:8|confirmed',  // كلمة المرور الجديدة (اختياري)
        ]);
    

        // جلب المسؤول الحالي
        $admin = Auth::guard('admin')->user();
  
        // تحديث بيانات المسؤول
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // إذا تم تقديم كلمة مرور جديدة، نقوم بتحديثها بعد تشفيرها
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
            $admin->save();
        }

        return redirect()->route('admin.login')->with('success', 'Profile updated successfully.');
}

    public function changePassword(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'current_password' => 'required|string|min:8', // كلمة المرور الحالية
            'new_password' => 'required|string|min:8|confirmed', // كلمة المرور الجديدة مع تأكيد
        ]);

        $admin = auth()->user(); // جلب المستخدم الحالي

        // التحقق من صحة كلمة المرور الحالية باستخدام bcrypt
        if (!password_verify($request->current_password, $admin->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        // تحديث كلمة المرور الجديدة باستخدام bcrypt
        $admin->update([
            'password' => bcrypt($request->new_password), // تشفير كلمة المرور الجديدة
        ]);

        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}
