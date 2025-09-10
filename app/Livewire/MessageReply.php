<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use Auth;

class MessageReply extends Component
{
    public $message;
   public $messageId;
   public $messageData;
   public $conversationId;
   public $messages = [];
    public function mount($messageId)
    {
        
       // العثور على الرسالة الأصلية وتعيين conversation_id
       $message = Message::find($messageId);
       
       $this->messageId = $messageId;
        $this->messageData = $message;
     
       // $this->messages = $messages;  // تخزين مجموعة الرسائل
       if ($message) {
          
          // $this->messageId = $messageId;
           //$this->message = $message;
           $this->conversationId = $message->conversation_id; // تعيين conversation_id من الرسالة
           $this->messages = Message::where('conversation_id',  $this->conversationId )->get();
       } else {
           session()->flash('error', 'Message not found.');
           return redirect()->route('support.dashboard');
       }
     
       
      
      
    }
  


 
    public function sendReply()
{
    if (empty($this->message)) {
        session()->flash('error', 'Please enter a reply.');
        return;
    }
    $message = Message::find($this->messageId);
    // استرجاع الرسالة الأصلية باستخدام $messageId
    $originalMessage = Message::find($this->messageId);

    $supportId = Auth::guard('support')->user()->id; // الحصول على الـ support_id من خلال الـ Auth

    // إرسال الرد من موظف الدعم
    Message::create([
        'conversation_id' => $message->conversation_id, // استخدام conversation_id المرسل من الأب
        'student_id' => $message->student_id, // لا حاجة لـ student_id لأن الرد من الموظف
        'support_id' => $supportId,
        'reply_to_message_id' => $originalMessage->id, // تحديد الرسالة الأصلية التي يتم الرد عليها
        'message' => $this->message ,
        'is_support' => true, // الرد من موظف الدعم
    ]);
     $this->conversation_id = $message->conversation_id;
    // إعادة تعيين الرسالة بعد إرسالها
    $this->message = '';
    session()->flash('success', 'Your reply has been sent!');
   // return redirect()->route('support.chat.show');
}

public function refreshMessages()
{
    $this->messages = Message::where('conversation_id', $this->conversationId)
        ->orderBy('created_at', 'asc')
        ->get();
}
        
    

    public function render()
    {
        return view('livewire.message-reply')
        ->with('message', $this->messageData)  // إرسال الرسالة الأصلية إلى العرض
            ->with('messageId', $this->messageId)
        ->layout('support.support_master'); // هنا تحدد الـ layout الجديد
    }



}
