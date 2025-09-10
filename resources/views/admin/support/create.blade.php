
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
            <h1>Add New Support</h1>
            <form action="{{ route('admin.support.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Support Name</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <textarea name="email" class="form-control" id="email"></textarea>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <textarea name="password" class="form-control" id="password"></textarea>
                </div>
                <div class="form-group">
                    <label for="admin_id">Select Admin</label>
                    <select name="admin_id" id="admin_id" class="form-control" required>
                        <option value="">Select Admin</option>
                        @foreach($admins as $admin)
                            <option value="{{  $admin->id  }}">{{ $admin->name }}</option>
                        @endforeach
                    </select>
                </div>
                
              
               
                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Save Support">
                    
                <a href="{{ route('admin.support.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </section>
    </div>
</div>
@endsection
