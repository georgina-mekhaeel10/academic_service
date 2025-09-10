@extends('layout')
@section('login')
    

<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content"  >
          <div class="modal-header tit-up">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Student Login</h4>
          </div>
          <div class="modal-body customer-box" id="lana">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs">
                  
                  <li><a class="active" href="#Login" data-toggle="tab">Login</a></li>
                  <li><a href="#Registration" data-toggle="tab">Registration</a></li>
              </ul>
          
              <!-- Tab panes -->
              <div class="tab-content" id=lana>
                  <div class="tab-pane active" id="Login">
                      <form role="form" class="form-horizontal"  method="POST" action="{{ route('students.login')}}">
                          @csrf <!-- حماية ضد CSRF -->

                          <div class="form-group">
                              <div class="col-sm-12">
                                  <input class="form-control" id="email1" name="email" placeholder="email" type="email">
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-12">
                                  <input class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" type="password">
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-10">
                                  <input type="submit" class="btn btn-light btn-radius btn-brd grd1" value="Submit">
                                      
                                  
                                  
                              </div>
                          </div>
                      </form>
                      
                  </div>
                  <div class="tab-pane" id="Registration">
                      <form role="form" class="form-horizontal" method="POST" action="{{ route('students.register') }}">
                          @csrf <!-- حماية ضد CSRF -->
                  
                          <!-- اسم الطالب -->
                          <div class="form-group">
                              <div class="col-sm-12">
                                  <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
                              </div>
                          </div>
                  
                          <!-- البريد الإلكتروني -->
                          <div class="form-group">
                              <div class="col-sm-12">
                                  <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
                              </div>
                          </div>
                  <!-- كلمة المرور -->
                  <div class="form-group">
                      <div class="col-sm-12">
                          <input class="form-control" id="password" name="password" placeholder="Password" type="password" required>
                      </div>
                  </div>
                          
                          
                  
                          <!-- العمر -->
                          <div class="form-group">
                              <div class="col-sm-12">
                                  <input class="form-control" id="age" name="age" placeholder="Age" type="number" required>
                              </div>
                          </div>
                          <!-- الهاتف -->
                          <div class="form-group">
                              <div class="col-sm-12">
                                  <input class="form-control" id="phone" name="phone" placeholder="Phone" type="text" required>
                              </div>
                          </div>
                  
                  
                          <!-- الجنس -->
                          <div class="form-group">
                              <div class="col-sm-12">
                                  <select class="form-control" id="gender" name="gender" required>
                                      <option value="">Select Gender</option>
                                      <option value="male">Male</option>
                                      <option value="female">Female</option>
                                  </select>
                              </div>
                          </div>
                  
                          <!-- إرسال وإلغاء -->
                          <div class="row">
                              <div class="col-sm-10">
                                  <input type="submit" class="btn btn-light btn-radius btn-brd grd1" value="Submit">
                                  <input type="reset" class="btn btn-light btn-radius btn-brd grd1" value="Cancel">
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
@endsection