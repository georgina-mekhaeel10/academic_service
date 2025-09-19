@extends('layout')
@section('login')


<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header tit-up">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="loginModalLabel">Student Portal</h4>
            </div>

            <!-- Body -->
            <div class="modal-body customer-box">
                <!-- Tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#LoginTab" data-toggle="tab">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#RegistrationTab" data-toggle="tab">Registration</a>
                    </li>
                </ul>

                <!-- Tabs content -->
                <div class="tab-content mt-3">

                    <!-- Login -->
                    <div class="tab-pane active" id="LoginTab">
                        <form method="POST" action="{{ route('students.login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="loginEmail">Email</label>
                                <input id="loginEmail" name="email" type="email" class="form-control"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="loginPassword">Password</label>
                                <input id="loginPassword" name="password" type="password" class="form-control"
                                    required autocomplete="current-password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-light btn-radius btn-brd grd1">Login</button>
                        </form>
                    </div>

                    <!-- Registration -->
                    <div class="tab-pane" id="RegistrationTab">
                        <form method="POST" action="{{ route('students.register') }}">
                            @csrf

                            <div class="form-group">
                                <label for="regName">Name</label>
                                <input id="regName" name="name" type="text" class="form-control"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="regEmail">Email</label>
                                <input id="regEmail" name="email" type="email" class="form-control"
                                    value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="regPassword">Password</label>
                                <input id="regPassword" name="password" type="password" class="form-control"
                                    required autocomplete="new-password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="regAge">Age</label>
                                <input id="regAge" name="age" type="number" class="form-control"
                                    value="{{ old('age') }}" required min="16">
                                @error('age')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="regPhone">Phone</label>
                                <input id="regPhone" name="phone" type="text" class="form-control"
                                    value="{{ old('phone') }}" required>
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="regGender">Gender</label>
                                <select id="regGender" name="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-light btn-radius btn-brd grd1">Register</button>
                            <button type="reset" class="btn btn-light btn-radius btn-brd grd1">Cancel</button>
                        </form>
                    </div>

                </div> <!-- /tab-content -->
            </div> <!-- /modal-body -->
        </div> <!-- /modal-content -->
    </div>
</div>
@endsection
