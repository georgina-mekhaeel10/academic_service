<?php

namespace App\Http\Controllers;

use App\Models\ASupports;
use App\Models\Admin;
use Illuminate\Http\Request;

class ASupportController extends Controller
{
    // عرض جميع الدعم (Support)
    public function index()
    {
        // جلب جميع الدعم مع الإداري المرتبط به
        $supports = ASupports::with('admin')->get();

        // عرض البيانات في الـ View
        return view('admin.support.index', compact('supports'));
    }

    // عرض نموذج إنشاء دعم جديد
    public function create()
    {
        // جلب جميع الإداريين
        $admins = Admin::all();

        // عرض صفحة إضافة دعم جديد مع قائمة الإداريين
        return view('admin.support.create', compact('admins'));
    }

    // تخزين الدعم الجديد في قاعدة البيانات
    public function store(Request $request)
    { 
        // التحقق من البيانات المدخلة
        $request->validate([
           
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:a_supports,email',
            'password' => 'required|string|min:8', // تحقق من كلمة المرور
            'admin_id' => 'required|exists:admins,id',
        ]);
        
        // إنشاء دعم جديد مع كلمة مرور مشفرة
        ASupports::create([
            
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // تشفير كلمة المرور قبل تخزينها
            'admin_id' => $request->admin_id,
        ]);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('admin.support.index')->with('success', 'Support created successfully.');
    }

    // عرض نموذج تعديل دعم موجود
    public function edit($id)
    {
        // جلب الدعم الذي سيتم تعديله
        $support = ASupports::findOrFail($id);

        // جلب جميع الإداريين
        $admins = Admin::all();

        // عرض صفحة تعديل الدعم
        return view('admin.support.edit', compact('support', 'admins'));
    }

    // تحديث دعم موجود
    public function update(Request $request, $id)
    {
        // التحقق من البيانات المدخلة
        $request->validate([
           
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:a_supports,email,' . $id,
            'password' => 'nullable|string|min:8', // إذا كانت كلمة المرور موجودة فقط
            'admin_id' => 'required|exists:admins,id',
        ]);

        // جلب الدعم الذي سيتم تحديثه
        $support = ASupports::findOrFail($id);

        // إذا كانت كلمة المرور جديدة، نقوم بتحديثها
        if ($request->filled('password')) {
            $support->password = bcrypt($request->password); // تشفير كلمة المرور
        }

        // تحديث باقي البيانات
        $support->update([
          
            'name' => $request->name,
            'email' => $request->email,
            'admin_id' => $request->admin_id,
        ]);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('admin.support.index')->with('success', 'Support updated successfully.');
    }

    // حذف دعم
    public function destroy($id)
    {
        // جلب الدعم الذي سيتم حذفه
        $support = ASupports::findOrFail($id);

        // حذف الدعم
        $support->delete();

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('admin.support.index')->with('success', 'Support deleted successfully.');
    }
    public function show($id)
    {
        $support = ASupports::findOrFail($id); // جلب السجل باستخدام المعرف
        return view('admin.support.show', compact('support'));
    }

}
