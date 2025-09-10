@extends('admin.admin_master')

@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <!-- عرض رسالة الخطأ -->
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

            <h1>Paidprograms Details</h1>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $paidprograms->name }}</h3>
                </div>
                <div class="card-body">
                    <ul>
                        <li><strong>paidprograms Name:</strong> {{ $paidprograms->name }}</li>
                        <li><strong>Description:</strong> {{ $paidprograms->description }}</li>
                        <li><strong>University:</strong> {{ $paidprograms->university->name }}</li>
                        <li><strong>Start Date:</strong> {{ $paidprograms->start_date }}</li>
                        <li><strong>End Date:</strong> {{ $paidprograms->end_date }}</li>
                        <li><strong>Cost:</strong> {{ $paidprograms->cost }}</li>
                        <li><strong>Type:</strong> {{ $paidprograms->type }}</li>
                        <li><strong>Country:</strong> {{ $paidprograms->country }}</li>
                        <li><strong>Application URL:</strong> <a href="{{ $paidprograms->application_url }}" target="_blank">{{ $paidprograms->application_url }}</a></li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.paidprograms.index') }}" class="btn btn-secondary">Back to paidprograms</a>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
