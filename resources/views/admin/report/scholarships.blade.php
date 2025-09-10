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

            <h1>Generate Scholarships Report</h1>

            <!-- نموذج إدخال التواريخ -->
            <form action="{{ route('admin.reports.scholarships') }}" method="GET">
                @csrf
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" class="form-control" id="start_date" required>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" class="form-control" id="end_date" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Generate Report">
            </form>

            <hr>

            <!-- عرض النتائج -->
            @if(isset($scholarships))
                <h2>Report Results</h2>
                <p>Report for scholarships registered between <strong>{{ $startDate ?? 'N/A' }}</strong> and <strong>{{ $endDate ?? 'N/A' }}</strong>.</p>
                <p><strong>Total scholarships:</strong> {{ $scholarshipsCount }}</p> <!-- عرض عدد الطلاب -->

                @if($scholarships->isEmpty())
                    <p>No scholarships registered in this period.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Registration Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scholarships as $scholarship)
                <tr>
                    <td>{{ $scholarship->scholarships_ID }}</td>
                    <td>{{ $scholarship->name }}</td>
                    <td>{{ $scholarship->description }}</td>
                    <td>{{ $scholarship->created_at }}</td>
                </tr>
            @endforeach
                        </tbody>
                    </table>
                @endif
            @endif
             <!-- زر تحميل كـ PDF -->

            <form action="{{ route('admin.reports.scholarships.pdf') }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="start_date" value="{{ $startDate ?? '' }}">
                <input type="hidden" name="end_date" value="{{ $endDate ?? '' }}">
                <input type="submit" class="btn btn-primary" value="Download as PDF">
            </form>
        
        </section>
       
    </div>
   
  
</div>

@endsection
