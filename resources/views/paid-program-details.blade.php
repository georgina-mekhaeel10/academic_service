@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $paidProgram->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Program Information</h5>
                            <p><strong>University:</strong> {{ $paidProgram->university->name ?? 'Not specified' }}</p>
                            <p><strong>Type:</strong> {{ $paidProgram->type }}</p>
                            <p><strong>Country:</strong> {{ $paidProgram->country }}</p>
                            <p><strong>Cost:</strong> ${{ number_format($paidProgram->cost, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Important Dates</h5>
                            <p><strong>Start Date:</strong> {{ $paidProgram->start_date }}</p>
                            <p><strong>End Date:</strong> {{ $paidProgram->end_date }}</p>
                        </div>
                    </div>
                    
                    @if($paidProgram->description)
                    <div class="mt-4">
                        <h5>Description</h5>
                        <p>{{ $paidProgram->description }}</p>
                    </div>
                    @endif
                    
                    <div class="mt-4">
                        <a href="{{ route('submitPaidProgramRequest', ['paid_program_id' => $paidProgram->id]) }}" class="btn btn-primary">Submit Application</a>
                        <a href="{{ route('paidprograms.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection