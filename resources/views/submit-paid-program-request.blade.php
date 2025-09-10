@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Submit Paid Program Application</h3>
                </div>
                <div class="card-body">
                    @if($paidProgram)
                    <div class="mb-4">
                        <h5>Program Details</h5>
                        <p><strong>Program Name:</strong> {{ $paidProgram->name }}</p>
                        <p><strong>University:</strong> {{ $paidProgram->university->name ?? 'Not specified' }}</p>
                        <p><strong>Type:</strong> {{ $paidProgram->type }}</p>
                        <p><strong>Country:</strong> {{ $paidProgram->country }}</p>
                        <p><strong>Cost:</strong> ${{ number_format($paidProgram->cost, 2) }}</p>
                    </div>
                    @endif

                    <form action="{{ route('submitPaidProgramRequest.store') }}" method="POST">
                        @csrf
                        
                        @if($paidProgram)
                            <input type="hidden" name="paid_program_id" value="{{ $paidProgram->id }}">
                        @else
                            <div class="mb-3">
                                <label for="paid_program_id" class="form-label">Select Paid Program</label>
                                <select class="form-control" id="paid_program_id" name="paid_program_id" required>
                                    <option value="">Choose a program...</option>
                                    @foreach(App\Models\Paidprograms::all() as $program)
                                        <option value="{{ $program->id }}">{{ $program->name }} - {{ $program->university->name ?? 'Unknown' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <input type="hidden" name="student_id" value="{{ auth('student')->id() }}">

                        <div class="mb-3">
                            <label for="type" class="form-label">Program Type</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="">Select type...</option>
                                <option value="master" {{ ($paidProgram && $paidProgram->type == 'master') ? 'selected' : '' }}>Master</option>
                                <option value="university" {{ ($paidProgram && $paidProgram->type == 'university') ? 'selected' : '' }}>University</option>
                                <option value="phd" {{ ($paidProgram && $paidProgram->type == 'phd') ? 'selected' : '' }}>PhD</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the terms and conditions
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Submit Application</button>
                            <a href="{{ route('paidprograms.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@endsection