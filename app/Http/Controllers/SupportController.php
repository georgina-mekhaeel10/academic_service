<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\Message;
use App\Models\ASupports;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class SupportController extends Controller
{
    public function index()
    {
        // جلب رسالة معينة، على سبيل المثال، الرسالة التي تحمل ID = 1
        $message = ContactMessage::find(1);

        // تمرير البيانات إلى العرض
        return view('support.index', compact('message'));
    }
    //
     // عرض جميع الرسائل
     public function showMessages()
     {
         $messages = ContactMessage::where('is_reply', 0)->get();  // جلب جميع الرسائل من قاعدة البيانات
         return view('support.email.show', compact('messages'));  // عرض الرسائل في لوحة التحكم
     }
 
    /* public function showchat()
     {
         $messages = Message::where('support_id', 1)->get();  // جلب جميع الرسائل من قاعدة البيانات
         return view('support.chat.show', compact('messages'));  // عرض الرسائل في لوحة التحكم
     }*/
     // عرض نموذج الرد على الرسالة
     public function showReplyForm($id)
     {
         $message = ContactMessage::findOrFail($id);  // جلب الرسالة بناءً على الـ ID
         return view('support.email.reply', compact('message'));  // عرض نموذج الرد
     }
 
     // إرسال الرد عبر البريد الإلكتروني
     public function sendReply(Request $request, $id)
     { $message = ContactMessage::find($id);

        if (!$message) {
            return redirect()->route('support.dashboard')->with('error', 'Message not found');
        }
    
        // حفظ الرد في قاعدة البيانات
        $message->reply = $request->input('reply');
        $message->save();
    
        // إرسال الرد عبر البريد الإلكتروني إذا لزم الأمر
        // Mail::to($message->email)->send(new MessageReply($request->reply));
    
        return redirect()->route('support.dashboard')->with('success', 'Reply sent successfully');
    
     }
     public function reply(Request $request, $id)
     {
         // العثور على الرسالة بناءً على الـ id
    $message = ContactMessage::find($id);

    if (!$message) {
        return redirect()->route('support.dashboard')->with('error', 'Message not found');
    }

    // عرض صفحة الرد مع الرسالة
    return view('support.email.reply', compact('message')); // تمرير البيانات إلى الـ view
     }

     public function replymessage(Request $request, $id)
     {
        // العثور على الرسالة بناءً على الـ id
    $message = ContactMessage::find($id);

    if (!$message) {
        return redirect()->route('support.dashboard')->with('error', 'Message not found');
    }

    // إذا كان الطلب هو إرسال رد
    if ($request->isMethod('post')) {
        $message->reply = $request->input('reply'); // حفظ الرد
        $message->is_reply = true; // تعيين أن الرسالة تم الرد عليها
        $message->save(); // حفظ التغييرات في قاعدة البيانات
        
        // إرسال الرد عبر البريد أو أي إجراء آخر
        return redirect()->route('support.dashboard')->with('success', 'Reply sent successfully');
    }

    // عرض صفحة الرد مع الرسالة
    return view('support.email.show', compact('message'));
     }

    // عرض الملف الشخصي
    public function profile()
    {
        $support = Auth::guard('support')->user();
        
        if (!$support) {
            return redirect()->route('support.login')->with('error', 'يجب تسجيل الدخول أولاً');
        }
        
        return view('support.profile.show', compact('support'));
    }

    // عرض صفحة تعديل الملف الشخصي
    public function editProfile()
    {
        $support = Auth::guard('support')->user();
        
        if (!$support) {
            return redirect()->route('support.login')->with('error', 'يجب تسجيل الدخول أولاً');
        }
        
        return view('support.profile.edit', compact('support'));
    }

    // تحديث الملف الشخصي
    public function updateProfile(Request $request)
    {
        $support = Auth::guard('support')->user();
        
        if (!$support) {
            return redirect()->route('support.login')->with('error', 'يجب تسجيل الدخول أولاً');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:a_supports,email,' . $support->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $support->name = $request->name;
        $support->email = $request->email;
        
        if ($request->filled('password')) {
            $support->password = Hash::make($request->password);
        }
        
        $support->save();
        
        return redirect()->route('support.profile')->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }

}
