<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;

class UniversityController extends Controller
{
   
    public function index()
    {
        $universities = University::all(); // جلب جميع السجلات من قاعدة البيانات
        return view('admin.universities.index', compact('universities'));
    }

   
    public function create()
    {
       
        return view('admin.universities.create'); // عرض صفحة نموذج الإضافة
    }

    public function store(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'established_year' => 'required|integer|between:1096,' . now()->year,
            'website' => 'nullable|url',
        ]);

        // إنشاء سجل جديد في الجدول
        University::create($request->all());

        return redirect()->route('admin.universities.index')->with('success', 'University created successfully.');
    }

   
    public function show($id)
    {
        $university = University::findOrFail($id); // جلب السجل باستخدام المعرف
        return view('admin.universities.show', compact('university'));
    }

  
    public function edit($id)
    {
        $university = University::findOrFail($id); // جلب السجل لتعديله
        return view('admin.universities.edit', compact('university'));
    }

    
    public function update(Request $request, $id)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'established_year' => 'required|integer|between:1096,' . now()->year,
            'website' => 'nullable|url',
        ]);

        $university = University::findOrFail($id); // جلب السجل المطلوب
        $university->update($request->all()); // تحديث البيانات

        return redirect()->route('admin.universities.index')->with('success', 'University updated successfully.');
    }

   
    public function destroy($id)
    {
        $university = University::findOrFail($id); // جلب السجل المطلوب
        $university->delete(); // حذف السجل

        return redirect()->route('admin.universities.index')->with('success', 'University deleted successfully.');
    }
        
}
