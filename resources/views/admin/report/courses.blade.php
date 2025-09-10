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

            <h1>Generate Courses Report</h1>

            <!-- نموذج إدخال التواريخ -->
            <form action="{{ route('admin.reports.courses') }}" method="GET">
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
            @if(isset($courses))
                <h2>Report Results</h2>
                <p>Report for courses registered between <strong>{{ $startDate }}</strong> and <strong>{{ $endDate }}</strong>.</p>
                <p><strong>Total Courses:</strong> {{ $coursesCount }}</p>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Level</th>
                            <th>Cost</th>
                            <th>Instructor</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>{{ $course->id }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->type }}</td>
                                <td>{{ $course->level }}</td>
                                <td>${{ number_format($course->cost, 2) }}</td>
                                <td>{{ $course->instructor ?? 'N/A' }}</td>
                                <td>{{ $course->start_date }}</td>
                                <td>{{ $course->end_date }}</td>
                                <td>{{ $course->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- زر تحميل PDF -->
                <form action="{{ route('admin.reports.courses.pdf') }}" method="POST" style="margin-top: 20px;">
                    @csrf
                    <input type="hidden" name="start_date" value="{{ $startDate }}">
                    <input type="hidden" name="end_date" value="{{ $endDate }}">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-download"></i> Download PDF Report
                    </button>
                </form>
            @endif
        </section>
    </div>
</div>
@endsection