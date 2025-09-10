@extends('support.support_master')

@section('support')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <h1>All Message With Supports</h1>
             <!-- عرض رسالة نجاح عند الإضافة أو التعديل -->
             @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif
            
            
            <!-- جدول عرض المنح الدراسية -->
            <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; margin-top: 20px;">
                <thead>
                    <tr>
                        
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $message)
                        <tr>
                           
                            <td>{{ $message->first_name ."   ". $message->last_name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->phone }}</td>
                            <td>{{ $message->comments }}</td>
                           
                            <td>
                                <a href="{{ route('support.email.reply', $message->id) }}" class="btn btn-info">Reply</a>
                               
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
</div>
@endsection
