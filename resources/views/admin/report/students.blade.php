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
            <h1>Generate Student Report</h1>

            <!-- نموذج إدخال التواريخ -->
            <form action="{{ route('admin.reports.students') }}" method="GET">
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
            @if(isset($students))
                <h2>Report Results</h2>
                <p>Report for students registered between <strong>{{ $startDate }}</strong> and <strong>{{ $endDate }}</strong>.</p>
                <p><strong>Total Students:</strong> {{ $studentCount }}</p> <!-- عرض عدد الطلاب -->

                @if($students->isEmpty())
                    <p>No students registered in this period.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Registration Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->age }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ ucfirst($student->gender) }}</td>
                                    <td>{{ $student->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endif
             <!-- زر تحميل كـ PDF -->

            <form action="{{ route('admin.reports.students.pdf') }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="start_date" value="{{ $startDate }}">
                <input type="hidden" name="end_date" value="{{ $endDate }}">
                <input type="submit" class="btn btn-primary" value="Download as PDF">
            </form>
        
        </section>
       
    </div>
   
  
</div>

@endsection
