

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">					 	
						  <img src="{{asset('backend/images/logo-dark.png')}}" alt="">
						  <h3>Education <b>ERP</b></h3>
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		<li class="" >
          <a href="">
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>  
		
    
        <li class=" treeview" >
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Manage Student</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.students.index') }}"><i class="ti-more"></i>View Student</a></li>
            <li><a href="{{route('admin.students.Block') }}"><i class="ti-more"></i>Block Student</a></li>
          </ul>
        </li> 
       
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="grid"></i> <span>Manage Account</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        <li><a href="{{ route('admin.account.editprofile') }}"><i class="ti-more"></i>Edit Profile</a></li>
        
            
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i data-feather="credit-card"></i> <span>Manage University</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        <li><a href="{{ route('admin.universities.create') }}"><i class="ti-more"></i>Add University</a></li>
        <li><a href="{{ route('admin.universities.index', ['view' => 'edit']) }}"><i class="ti-more"></i>Edit University</a></li>
        <li><a href="{{ route('admin.universities.index', ['view' => 'delete']) }}"><i class="ti-more"></i>Delete University</a></li>
        <li><a href="{{ route('admin.universities.index', ['view' => 'show']) }}"><i class="ti-more"></i>Show University</a></li>
        
            
          </ul>
        </li>

<li class="treeview">
          <a href="#">
            <i data-feather="credit-card"></i> <span>Manage Scholarships</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        <li><a href="{{ route('admin.scholarships.create') }}"><i class="ti-more"></i>Add Scholarships</a></li>
         <li><a href="{{ route('admin.scholarships.index', ['view' => 'edit']) }}"><i class="ti-more"></i>Edit Scholarships</a></li>
         <li><a href="{{ route('admin.scholarships.index', ['view' => 'delete'] )}}"><i class="ti-more"></i>Delete Scholarships</a></li>
         <li><a href="{{ route('admin.scholarships.index', ['view' => 'show'] )}}"><i class="ti-more"></i>Show Scholarships</a></li>

         
            
          </ul>
        </li>


<li class="treeview">
          <a href="#">
             <i data-feather="hard-drive"></i></i> <span>Manage Paid Programs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        <li><a href="{{ route('admin.paidprograms.create') }}"><i class="ti-more"></i>Add Paid Program</a></li>

        <li><a href="{{ route('admin.paidprograms.index', ['view' => 'edit'] ) }}"><i class="ti-more"></i>Edit Paid Program</a></li>
        <li><a href="{{ route('admin.paidprograms.index', ['view' => 'delete']) }}"><i class="ti-more"></i>Delete Paid Program </a></li>
        <li><a href="{{ route('admin.paidprograms.index', ['view' => 'show']) }}"><i class="ti-more"></i>Show Paid Program </a></li>

         
         
            
          </ul>
        </li>


<li class="treeview">
          <a href="#">
            <i data-feather="book-open"></i> <span>Manage Courses</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.courses.create') }}"><i class="ti-more"></i>Add Course</a></li>
            <li><a href="{{ route('admin.courses.index', ['view' => 'edit']) }}"><i class="ti-more"></i>Edit Course</a></li>
            <li><a href="{{ route('admin.courses.index', ['view' => 'delete']) }}"><i class="ti-more"></i>Delete Course</a></li>
            <li><a href="{{ route('admin.courses.index', ['view' => 'show']) }}"><i class="ti-more"></i>Show Course</a></li>
            <li><a href="{{ route('admin.courses.applications') }}"><i class="ti-more"></i>Course Applications</a></li>
          </ul>
        </li>


<li class="treeview">
          <a href="#">
            <i data-feather="package"></i> <span>Manage Support</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        

         <li><a href="{{route('admin.support.create')}}"><i class="ti-more"></i>Add Support</a></li>
         <li><a href="{{route('admin.support.index',['view' => 'edit'])}}"><i class="ti-more"></i>Edit Support</a></li>
          <li><a href="{{route('admin.support.index',['view' => 'delete'])}}"><i class="ti-more"></i>Delete Support</a></li>
          <li><a href="{{route('admin.support.index',['view' => 'show'])}}"><i class="ti-more"></i>Show Support</a></li>
            
          </ul>
        </li>

		 
        <li class="header nav-small-cap">Report Interface</li>
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="server"></i></i> <span> Reports Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        <li><a href="{{route('admin.reports.students')}}"><i class="ti-more"></i> Reports For Students</a></li> 

        <li><a href="{{route('admin.reports.scholarships')}}"><i class="ti-more"></i> Reports For Scholarships</a></li>

        <li><a href="{{route('admin.reports.paidprograms')}}"><i class="ti-more"></i> Reports For paidprograms</a></li>
        <li><a href="{{route('admin.reports.supports')}}"><i class="ti-more"></i> Reports For Support</a></li>
        <li><a href="{{route('admin.reports.courses')}}"><i class="ti-more"></i> Reports For Courses</a></li>
        

            
          </ul>
        </li>

		
		 
		  
		 
        
      </ul>
    </section>
	
	<div class="sidebar-footer">
    	<!-- item-->
		<a href="javascript:void(0)" onclick="alert('PDF Report feature is not supported on Heroku Servers due to write permissions, 500 Error will occur.')" class="link" data-toggle="Notice" title="Production of PDF Reports is not supported on Heroku Servers, 500 Error will occur." data-original-title="Settings" aria-describedby="tooltip92529">  <i class="nav-link-icon mdi mdi-alert"></i></a>
  </div>
  </aside>