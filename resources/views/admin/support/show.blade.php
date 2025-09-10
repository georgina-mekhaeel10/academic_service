@extends('admin.admin_master')

@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            @if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<!-- عرض رسالة النجاح -->
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
            <h1>Support Details</h1>

            <div class="form-group">
                <strong>Name:</strong> {{ $support->name }}
            </div>

            <div class="form-group">
                <strong>Email:</strong> {{ $support->email }}
            </div>

            <div class="form-group">
                <strong>Admin:</strong> {{ $support->admin ? $support->admin->name : 'N/A' }}
            </div>

            <a href="{{ route('admin.support.index') }}" class="btn btn-secondary">Back</a>
        </section>
    </div>
</div>
@endsection
