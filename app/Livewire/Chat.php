<?php

namespace App\Livewire;

use Livewire\Component;

class Chat extends Component
{
    public $conversation;
    public $message;
    public $student_id;
    public $support_id;

    public function mount($conversationId)
    {
        // تحميل المحادثة باستخدام المعرف
        $this->conversation = Conversation::findOrFail($conversationId);
        $this->student_id = Auth::id(); // تأكيد الطالب المتصل
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string|max:255',
        ]);

        // تخزين الرسالة في قاعدة البيانات
        Message::create([
            'conversation_id' => $this->conversation->id,
            'student_id' => $this->student_id,
            'support_id' => $this->conversation->support_id, // في حالة كانت الرسالة من الدعم
            'message' => $this->message,
        ]);

        // مسح النص المدخل بعد الإرسال
        $this->message = '';
    }

    public function render()
    {
        // عرض الرسائل المرتبطة بالمحادثة
        $messages = $this->conversation->messages()->latest()->get();

        return view('livewire.chat', ['messages' => $messages]);
    }
}
