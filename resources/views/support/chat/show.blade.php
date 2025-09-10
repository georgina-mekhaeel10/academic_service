@extends('support.support_master')

@section('support')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <h1>All chats With Supports</h1>
             <!-- عرض رسالة نجاح عند الإضافة أو التعديل -->
             @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif
            
            
            <!-- جدول عرض المنح الدراسية -->
            <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; margin-top: 20px;">
                <thead>
                    <tr>
                        
                        <th>Name Student</th>
                        <th>Message</th>
                        <th>ID Message</th>
                        <th>action</th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach($message as $message)
                        <tr>
                           
                            <td>{{ $message->Student->name }}</td>
                            <td>{{ $message->message }}</td>
                            <td>{{ $message->id }}</td>
                            <td>
                                <a href="{{ route('supports.chat.reply', $message->id) }}" class="btn btn-info">Reply</a>
                               
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
</div>

@endsection
