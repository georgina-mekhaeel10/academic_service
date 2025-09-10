<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function showContactForm()
    {
        return view('contact');
    }

    public function storeMessage(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'comments' => 'required|string|max:1000',
        ]);

        // حفظ البيانات في قاعدة البيانات
        ContactMessage::create($request->all());

        // الرد على المستخدم بعد الحفظ
        return back()->with('success', 'Your message has been sent successfully!');
    }
}
