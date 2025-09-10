<?php

namespace App\Livewire;

use Livewire\Component;

class Test extends Component
{
    public $messageId;

    public function mount($messageId)
    {
        $this->messageId = $messageId;
    }

    public function render()
    {
        // تغيير الـ layout هنا
        return view('livewire.test')
            ->with('messageId', $this->messageId)
            ->layout('support.support_master'); // هنا تحدد الـ layout الجديد
    }
}
