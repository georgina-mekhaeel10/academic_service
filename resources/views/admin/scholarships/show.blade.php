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
            <h1>Scholarship Details</h1>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $scholarship->name }}</h3>
                </div>
                <div class="card-body">
                    <ul>
                        <li><strong>Scholarship Name:</strong> {{ $scholarship->name }}</li>
                        <li><strong>Description:</strong> {{ $scholarship->description }}</li>
                        <li><strong>University:</strong> {{ $scholarship->university->name }}</li>
                        <li><strong>Start Date:</strong> {{ $scholarship->start_date }}</li>
                        <li><strong>End Date:</strong> {{ $scholarship->end_date }}</li>
                        <li><strong>Cost:</strong> {{ $scholarship->cost }}</li>
                        <li><strong>Type:</strong> {{ $scholarship->type }}</li>
                        <li><strong>Funding Type:</strong> {{ $scholarship->funding_type }}</li>
                        <li><strong>Country:</strong> {{ $scholarship->country }}</li>
                        <li><strong>Application URL:</strong> <a href="{{ $scholarship->application_url }}" target="_blank">{{ $scholarship->application_url }}</a></li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.scholarships.index') }}" class="btn btn-secondary">Back to Scholarships</a>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
