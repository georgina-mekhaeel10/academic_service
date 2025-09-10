<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Chat;

class MessageController extends Controller
{
    //
    public function replymessage1($messageId)
    {
        $message = Message::find($messageId); // إذا كنت تستخدم طريقة `find`
    
        // تحقق إذا كانت الرسالة موجودة
        if (!$message) {
            return redirect()->route('support.dashboard')->with('error', 'Message not found.');
        }
      
    
        return view('support.chat.reply', compact('message'));
       
    }
    public function show()
    {
        $message = Message::where('is_support',0)->get(); // أو أي طريقة أخرى للبحث
    
        if (!$message) {
            return redirect()->route('support.dashboard')->with('error', 'Message not found.');
        }
    
        return view('support.chat.show', compact('message'));
    }
    
    
}
