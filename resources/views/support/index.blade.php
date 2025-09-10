@extends('support.support_master')
@section('support')
  <div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">
			<div class="col-xl-12 col-12">
					<div class="box overflow-hidden pull-up">
	<div class="box-body">							
		<div>
			<p class="text-mute mt-20 mb-0 font-size-16 text-center">Welcome To EduPathway Dashboard</p>
		</div>
	</div>
</div>
</div>	
			</div>
			<div class="row">
				<div class="col-xl-3 col-6">
					<div class="box overflow-hidden pull-up">
	<div class="box-body">							
		<div class="icon bg-primary-light rounded w-60 h-60">
			<i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
		</div>
		<div>
			<a href="{{route('support.email.show')}}"><p class="text-mute mt-20 mb-0 font-size-16">Manage Email</p></a>
			<h3 class="text-white mb-0 font-weight-500"> <small class="text-success"><i class="fa fa-caret-up"></i> </small></h3>
		</div>
	</div>
</div>
</div>
<div class="col-xl-3 col-6">
<div class="box overflow-hidden pull-up">
	<div class="box-body">							
		<div class="icon bg-warning-light rounded w-60 h-60">
			<i class="text-warning mr-0 font-size-24 mdi mdi-account-plus"></i>
		</div>
		<div>
			<a href="{{route('support.chat.show')}}"><p class="text-mute mt-20 mb-0 font-size-16">Manage Chatting</p></a>
			<h3 class="text-white mb-0 font-weight-500"> <small class="text-success"><i class="fa fa-caret-up"></i> </small></h3>
		</div>
	</div>
</div>
</div>

 
 
 
 
<div class="col-12">
<div class="box">

</div>  
				</div>
			</div>
		</section>
		<!-- /.content -->
	  </div>
  </div>

  @endsection