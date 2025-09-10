@extends('support.support_master')

@section('support')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <h3>Reply to Message from {{ $message->first_name }} {{ $message->last_name }}</h3>
        
        <div class="message-content">
            <h5>Message Content</h5>
            <p>{{ $message->comments }}</p>
        </div>
        
        <form method="POST" action="{{ route('support.email.replymessage', $message->id) }}">
            @csrf
            <div class="form-group">
                <label for="reply">Your Reply</label>
                <textarea name="reply" class="form-control" id="reply" rows="4">{{ old('reply') }}</textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Send Reply">
        </form>
        </section>
    </div>
</div>

@endsection
