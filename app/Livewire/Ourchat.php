<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
class Ourchat extends Component
{
    public $message;
    public $conversationId;
    public $messages = [];
    public function mount()
    {
        // استرجاع الرسائل من قاعدة البيانات
        $this->messages = Message::where('conversation_id', null)->get();

        // إذا كانت الرسائل فارغة، قم بتعيين مصفوفة فارغة
        if ($this->messages->isEmpty()) {
            $this->messages = collect();
        }
    }

    public function sendMessage()
    { 
         // التحقق من أن المستخدم مسجل الدخول
    if (!Auth::guard('student')->check())
     { // التحقق من تسجيل الدخول باستخدام حارس 'student'
        session()->flash('error', 'You need to log in to send a message.');
        return;
    } 

        // التحقق من أن الرسالة ليست فارغة
        if (empty($this->message)) {
            session()->flash('error', 'Please enter a message.');
            return;
        }
     
            $studentId = Auth::guard('student')->user()->id; // أو استخدم الحقل المناسب لـ student_id
            // تخزين student_id في الجلسة
            session(['student_id' => $studentId]);
        
          // $supportId = Auth::guard('support')->user()->id; // أو استخدم الحقل المناسب لـ student_id
            // تخزين student_id في الجلسة
           // $supportId = $support->id; // الحصول على ID الخاص بـ support
          // session(['support_id' => $supportId]);
        
        
        // التحقق إذا كانت المحادثة موجودة أو لا، وإذا لم تكن موجودة، يتم إنشاؤها
        if (!$this->conversationId) {
            // إذا لم تكن هناك محادثة موجودة، نقوم بإنشاء محادثة جديدة
            $conversation = Conversation::create([
                'student_id' => $studentId, // استخدام الـ student_id من الجلسة الحالية
                'subject' => 'Student Inquiry', // أو موضوع آخر حسب الطلب
            ]);
            $this->conversationId = $conversation->id;  // تخزين الـ conversation_id لاستخدامه في الرسائل
        }

       //$supportId = Auth::guard('support')->user()->id; // أو استخدم الحقل المناسب لـ student_id
        // تخزين student_id في الجلسة
       // session(['support_id' => $supportId]);
    
        // الآن نقوم بإضافة الرسالة في جدول `messages`
        Message::create([
            'conversation_id' => $this->conversationId,
            'student_id' =>$studentId, // student_id من الجلسة الحالية
            'support_id'=>null,
            'message' => $this->message,
            'is_support' => false, // الطالب هو من أرسل الرسالة
            
        ]);
      $this->message = '';
        // إعادة تعيين الرسالة بعد إرسالها
        $this->messages = Message::where('conversation_id', $this->conversationId)->get();

        // إظهار رسالة نجاح
        session()->flash('success', 'Your message has been sent successfully!');
    }

    public function refreshMessages()
{
    $this->messages = Message::where('conversation_id', $this->conversationId)
        ->orderBy('created_at', 'asc')
        ->get();
}

    public function render()
    {
           // استرجاع كافة الرسائل للمحادثة بناءً على conversation_id
    $messages = Message::where('conversation_id', $this->conversationId)
    ->orderBy('created_at', 'asc') // ترتيب الرسائل حسب الوقت
    ->get();
        return view('livewire.ourchat'); // التحديث كل 3 ثواني (3000 ملي ثانية);
    }
}
