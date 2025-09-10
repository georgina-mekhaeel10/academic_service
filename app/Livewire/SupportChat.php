<?php

    namespace App\Livewire;

    use Livewire\Component;
    use App\Models\Conversation;
    use App\Models\Message;
    use Illuminate\Support\Facades\Auth;
    
    class SupportChat extends Component
    {
        public $conversation;
        public $messages;
        public $newMessage;
    
        public function mount($conversationId)
        {
            $this->conversation = Conversation::findOrFail($conversationId);
            $this->messages = $this->conversation->messages()->orderBy('created_at')->get();
        }
    
        public function sendMessage()
        {
            $this->validate(['newMessage' => 'required']);
    
            $message = Message::create([
                'conversation_id' => $this->conversation->id,
                'support_id' => auth()->user()->id,
                'message' => $this->newMessage,
                'is_support' => true,
            ]);
    
            $this->messages->push($message);
            $this->newMessage = '';
        }
    
        public function render()
        {
            return view('livewire.support-chat');
        }
    }
    

