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
            <!-- عرض رسالة نجاح عند الإضافة أو التعديل -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">All Students</h3>
                            <div class="box-tools pull-right">
                        </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="studentsTable">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Age</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                        <tr class="student-row">
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->age }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>
                                @if($student->gender == 'male')
                                    <span class="badge badge-info"><i class="fa fa-male"></i> Male</span>
                                @elseif($student->gender == 'female')
                                    <span class="badge badge-pink"><i class="fa fa-female"></i> Female</span>
                                @else
                                    <span class="badge badge-secondary">{{ $student->gender }}</span>
                                @endif
                            </td>
                            <td>
                                @if($student->is_blocked)
                                    <span class="badge badge-danger">Blocked</span>
                                @else
                                    <span class="badge badge-success">Active</span>
                                @endif
                            </td>
                            <td>
                                @if($student->is_blocked)
                                    <!-- زر إلغاء الحظر -->
                                    <form action="{{ route('admin.student.unblock', $student->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to unblock this student?')">Unblock</button>
                                    </form>
                                @else
                                    <!-- زر الحظر -->
                                    <form action="{{ route('admin.student.block', $student->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to block this student?')">Block</button>
                                    </form>
                                @endif
                                
                                <!-- زر الحذف -->
                                <form action="{{ route('admin.student.destroy', $student->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to permanently delete this student?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
