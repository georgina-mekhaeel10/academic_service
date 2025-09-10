@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">{{ $scholarship->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Description</h4>
                            <p class="text-muted">{{ $scholarship->description }}</p>
                            
                            <h4>Details</h4>
                            <ul class="list-unstyled">
                                <li><strong>University:</strong> {{ $scholarship->university->name ?? 'N/A' }}</li>
                                <li><strong>Country:</strong> {{ $scholarship->country }}</li>
                                <li><strong>Type:</strong> {{ ucfirst($scholarship->type) }}</li>
                                <li><strong>Funding Type:</strong> {{ $scholarship->funding_type }}</li>
                                @if($scholarship->funding_amount)
                                <li><strong>Funding Amount:</strong> ${{ number_format($scholarship->funding_amount, 2) }}</li>
                                @endif
                                <li><strong>Start Date:</strong> {{ date('M d, Y', strtotime($scholarship->start_date)) }}</li>
                                <li><strong>End Date:</strong> {{ date('M d, Y', strtotime($scholarship->end_date)) }}</li>
                                @if($scholarship->cost)
                                <li><strong>Cost:</strong> ${{ number_format($scholarship->cost, 2) }}</li>
                                @endif
                            </ul>
                            
                            @if($scholarship->eligibility_criteria)
                            <h4>Eligibility Criteria</h4>
                            <p class="text-muted">{{ $scholarship->eligibility_criteria }}</p>
                            @endif
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h5>Apply Now</h5>
                                    @if($scholarship->application_url)
                                    <a href="{{ $scholarship->application_url }}" target="_blank" class="btn btn-primary btn-lg mb-3">
                                        <i class="fa fa-external-link"></i> Apply Online
                                    </a>
                                    @endif
                                    
                                    @if(Auth::guard('student')->check())
                                    <form action="{{ route('submitScholarshipRequest') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="student_id" value="{{ Auth::guard('student')->user()->id }}">
                                        <input type="hidden" name="scholarship_id" value="{{ $scholarship->scholarships_ID }}">
                                        <input type="hidden" name="type" value="{{ $scholarship->type }}">
                                        <input type="hidden" name="funding_type" value="{{ $scholarship->funding_type }}">
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i class="fa fa-paper-plane"></i> Submit Request
                                        </button>
                                    </form>
                                    @else
                                    <p class="text-muted">Please <a href="{{ route('students.login') }}">login</a> to apply</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <a href="{{ route('scholarships.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back to Scholarships
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection