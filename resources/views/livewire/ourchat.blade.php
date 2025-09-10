

<div class="chat-wrapper">
    <!-- عرض الرسائل من النوع error و success -->
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<div class="chat-container">
    <div class="messages-container" wire:poll.3000ms="refreshMessages">
        @if($messages->isEmpty())
            <p>No messages yet. Start the conversation!</p>
        @else
            @foreach($messages as $messageItem)
                <div class="message-container">
                    @if($messageItem->is_support)
                        <div class="message support-message">
                            <p>{{ $messageItem->message }}</p>
                            <small>{{ $messageItem->created_at->setTimezone('Asia/Amman')->format('H:i') }}</small>
                        </div>
                    @else
                        <div class="message student-message">
                            <p>{{ $messageItem->message }}</p>
                            <small>{{ $messageItem->created_at->setTimezone('Asia/Amman')->format('H:i') }}</small>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>

    <div class="message-input">
        <textarea wire:model="message" placeholder="Write your message..." rows="4"></textarea>
        <button wire:click="sendMessage">Send</button>
    </div>
</div>
</div>