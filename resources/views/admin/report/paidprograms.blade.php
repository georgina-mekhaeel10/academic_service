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

            <h1>Generate paidprograms Report</h1>

            <!-- نموذج إدخال التواريخ -->
            <form action="{{ route('admin.reports.paidprograms') }}" method="GET">
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
            @if(isset($paidprograms))
                <h2>Report Results</h2>
                <p>Report for paidprograms registered between <strong>{{ $startDate ?? 'N/A' }}</strong> and <strong>{{ $endDate ?? 'N/A' }}</strong>.</p>
                <p><strong>Total paidprograms:</strong> {{ $paidprogramsCount }}</p> <!-- عرض عدد الطلاب -->

                @if($paidprograms->isEmpty())
                    <p>No paidprograms registered in this period.</p>
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
                            @foreach ($paidprograms as $paidprogram)
                <tr>
                    <td>{{ $paidprogram->id }}</td>
                    <td>{{ $paidprogram->name }}</td>
                    <td>{{ $paidprogram->description }}</td>
                    <td>{{ $paidprogram->created_at }}</td>
                </tr>
            @endforeach
                        </tbody>
                    </table>
                @endif
            @endif
             <!-- زر تحميل كـ PDF -->

            <form action="{{ route('admin.reports.paidprograms.pdf') }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="start_date" value="{{ $startDate ?? '' }}">
                <input type="hidden" name="end_date" value="{{ $endDate ?? '' }}">
                <input type="submit" class="btn btn-primary" value="Download as PDF">
            </form>
        
        </section>
       
    </div>
   
  
</div>

@endsection
