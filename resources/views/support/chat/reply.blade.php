


  


@extends('support.support_master')
@section('support')
  <div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
            <livewire:message-reply :messageId="$message->id" />

	
		</section>
		<!-- /.content -->
	  </div>
  </div>

  @endsection