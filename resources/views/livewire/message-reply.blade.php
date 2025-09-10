<div class="chat-container">
    <div class="messages-container" wire:poll.3000ms="refreshMessages">
        @if($messages->isEmpty())
        <p>No messages yet. Start the conversation!</p>
        @else
            @foreach($messages as $messageItem)
                <div class="message {{ $messageItem->is_support ? 'support-message' : 'student-message' }}">
                    <p>{{ $messageItem->message }}</p>
                    <small>{{ $messageItem->created_at->setTimezone('Asia/Amman')->format('H:i') }}</small>
                </div>
            @endforeach
      
        @endif
    </div>



    <!-- نموذج إدخال الرد من موظف الدعم -->
    <div class="message-input">
        <input type="text" wire:model="message" placeholder="Type your reply..." />
        <button wire:click="sendReply">Send</button>
    </div>
</div>

