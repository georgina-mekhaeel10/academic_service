@extends('admin.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <h2>Edit Profile</h2>
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <form action="{{ route('admin.account.updateprofile') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{session('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{session('email')}}" required>
                </div>
                
                <!-- إضافة الحقل لعرض وتحديث كلمة المرور -->
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter new password if you want to change it">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your new password">
                </div>

                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Update Profile">
            </form>
        </section>
    </div>
</div>
@endsection
