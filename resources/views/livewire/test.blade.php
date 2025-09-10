<div>
    <h2>Reply to Message</h2>

   

   

    <form wire:submit.prevent="sendReply">
        <textarea wire:model="message" placeholder="Enter your reply..." required></textarea>
        <button type="submit">Send Reply</button>
    </form>
</div>
