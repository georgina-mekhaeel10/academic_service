
  <header class="main-header">
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top pl-30">
      <!-- Sidebar toggle button-->
	  <div>
		  <ul class="nav">
			<li class="btn-group nav-item">
				<a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon" data-toggle="push-menu" role="button">
					<i class="nav-link-icon mdi mdi-menu"></i>
			    </a>
			</li>
			<li class="btn-group nav-item">
				<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link rounded svg-bt-icon" title="Full Screen">
					<i class="nav-link-icon mdi mdi-crop-free"></i>
			    </a>
			</li>			
		  </ul>
	  </div>
		
      <div class="navbar-custom-menu r-side">
        <ul class="nav navbar-nav">
		  <!-- full Screen -->		
		  <!-- Notifications -->
		  
	  
	      <!-- User Account-->
          <li class="dropdown user user-menu">	
			<a href="#" class="waves-effect waves-light rounded dropdown-toggle p-0" data-toggle="dropdown" title="User">
				{{ $user->name ?? 'Admin Account' }} <!-- عرض اسم المستخدم أو نص افتراضي -->
			</a>
			<ul class="dropdown-menu animated flipInX">
			  <li class="user-body">
	 <a class="dropdown-item" href="{{route('admin.account.editprofile')}}"><i class="ti-user text-muted mr-2"></i> Profile</a>
				 <div class="dropdown-divider"></div>
				 <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					<i class="ti-lock text-muted mr-2"></i> Logout
				</a>
				
				<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			  </li>
			</ul>
          </li>				
        </ul>
      </div>
    </nav>
  </header>