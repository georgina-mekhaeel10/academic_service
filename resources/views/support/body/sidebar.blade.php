

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
            <span>Manage Email</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('support.email.show')}}"><i class="ti-more"></i>Show Email</a></li>
            @if(isset($messages) && $messages->isNotEmpty())
    @foreach($messages as $message)
        <li><a href="{{ route('support.email.reply', ['id' => $message->id]) }}"><i class="ti-more"></i>Reply Email</a></li>
    @endforeach
@else
<li><span>No messages available at the moment.</span></li>
@endif
          
         
          </ul>
        </li> 
       
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="grid"></i> <span>Manage chat</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li><a href="{{route('support.chat.show')}}"><i class="ti-more"></i>Show chat</a></li>
            @if(isset($message) && $message->count() > 0) <!-- تحقق من وجود رسائل -->
            <li>find message
              <a href="{{ route('supports.chat.reply', $message->id) }}"><i class="ti-more"></i>Reply chat</a>
            </li>
              
             
            @else
                <li>No messages available</li>
            @endif
        </ul>
        
        
            
          
          
        
        
            
          
        </li>

        <li class="">
          <a href="{{ route('support.profile') }}">
            <i data-feather="user"></i>
            <span>Profile</span>
          </a>
        </li>

  
    </section>
	
	<div class="sidebar-footer">
    	<!-- item-->
		<a href="javascript:void(0)" onclick="alert('PDF Report feature is not supported on Heroku Servers due to write permissions, 500 Error will occur.')" class="link" data-toggle="Notice" title="Production of PDF Reports is not supported on Heroku Servers, 500 Error will occur." data-original-title="Settings" aria-describedby="tooltip92529">  <i class="nav-link-icon mdi mdi-alert"></i></a>
  </div>
  </aside>