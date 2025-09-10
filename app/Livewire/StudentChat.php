<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class StudentChat extends Component
{
    public $conversationId;

    // يتم استدعاء هذه الدالة عند تحميل المكون
    public function mount($conversationId)
    {
        $this->conversationId = $conversationId;
    }

    public function render()
    {
        return view('livewire.student-chat');
    }

}
