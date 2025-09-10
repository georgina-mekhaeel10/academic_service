@extends('support.support_master')

@section('support')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
    <h3 class="text-center">All Contact Messages</h3>
    
    @if ($messages->isEmpty())
        <p>No messages found.</p>
    @else
        @foreach($messages as $message)
            <div class="message-card">
                <h5>{{ $message->first_name }} {{ $message->last_name }}</h5>
                <p><strong>Email:</strong> {{ $message->email }}</p>
                <p><strong>Phone:</strong> {{ $message->phone }}</p>
                <p><strong>Message:</strong> {{ $message->comments }}</p> <!-- عرض نص الرسالة -->
                
                <!-- رابط للرد على الرسالة -->
                <a href="{{ route('support.email.reply', $message->id) }}" class="btn btn-primary">Reply</a>
            </div>
            <hr>
        @endforeach
    @endif
        </section>
</div>
</div>

@endsection
