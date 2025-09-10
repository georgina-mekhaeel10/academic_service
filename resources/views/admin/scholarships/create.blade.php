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
            <h1>Add New Scholarship</h1>
            <form action="{{ route('admin.scholarships.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Scholarship Name</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description (optional)</label>
                    <textarea name="description" class="form-control" id="description"></textarea>
                </div>
            
                <div class="form-group">
                    <label for="university_ID">Select University</label>
                    <select name="university_ID" id="university_ID" class="form-control" required>
                        <option value="">Select a University</option>
                        @foreach($universities as $university)
                            <option value="{{ $university->id }}">{{ $university->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" class="form-control" id="start_date" required>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" class="form-control" id="end_date" required>
                </div>
                <div class="form-group">
                    <label for="cost">Cost (optional) </label>
                    <input type="number" name="cost" class="form-control" id="cost">
                </div>
                <div class="form-group">
                    <label for="type">Select Scholarships Type </label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="" selected>Select Scholarships Type </option>
                        <option value="master">Master</option>
                        <option value="university">University</option>
                        <option value="phd">PhD</option>
                    </select>
                </div>
                
          
                <div class="form-group">
                    <label for="funding_type">Funding Type</label>
                    <select name="funding_type" class="form-control" id="funding_type">
                        <option value="Full">Full</option>
                        <option value="Partial">Partial</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="funding_amount">Funding Amount (optional)</label>
                    <input type="number" name="funding_amount" class="form-control" id="funding_amount">
                </div>
                <div class="form-group">
                    <label for="eligibility_criteria">Eligibility Criteria (optional)</label>
                    <textarea name="eligibility_criteria" class="form-control" id="eligibility_criteria"></textarea>
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" name="country" class="form-control" id="country" required>
                </div>
                <div class="form-group">
                    <label for="application_url">Application URL</label>
                    <input type="url" name="application_url" class="form-control" id="application_url">
                </div>
               
                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Save Scholarship">
                    
                <a href="{{ route('admin.scholarships.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </section>
    </div>
</div>
@endsection
