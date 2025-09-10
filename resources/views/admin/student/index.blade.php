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

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
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

<!-- Report Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="reportModalLabel">Generate Students Report</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="GET">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date" class="form-control" id="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" name="end_date" class="form-control" id="end_date" required>
                    </div>
                    <div class="form-group">
                        <label for="gender_filter">Filter by Gender</label>
                        <select name="gender_filter" class="form-control" id="gender_filter">
                            <option value="">All Genders</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.box {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.box-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px 20px;
    border-radius: 8px 8px 0 0;
    border-bottom: 1px solid #e0e0e0;
}

.box-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.box-body {
    padding: 20px;
}

.table {
    margin-bottom: 0;
}

.table thead th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 12px 8px;
    font-weight: 600;
    text-align: center;
}

.table tbody tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.table tbody td {
    padding: 12px 8px;
    vertical-align: middle;
    border-color: #e9ecef;
}

.badge {
    font-size: 12px;
    padding: 6px 10px;
    border-radius: 20px;
}

.badge-pink {
    background-color: #e91e63;
    color: white;
}

.modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

@media (max-width: 768px) {
    .box-header {
        padding: 10px 15px;
    }
    
    .box-header h3 {
        font-size: 16px;
    }
}
</style>

<script>
$(document).ready(function() {
    $('#example1').DataTable({
        'responsive': true,
        'lengthChange': false,
        'autoWidth': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'paging': false,
        'pageLength': 10,
        'language': {
            // 'search': 'Search:',
            // 'lengthMenu': 'Show _MENU_ entries',
            // 'info': 'Showing _START_ to _END_ of _TOTAL_ entries',
            // 'infoEmpty': 'Showing 0 to 0 of 0 entries',
            // 'infoFiltered': '(filtered from _MAX_ total entries)',
            // 'paginate': {
            //     'first': 'First',
            //     'last': 'Last',
            //     'next': 'Next',
            //     'previous': 'Previous'
            // }
        }
    });
    
    // Set default dates
    const today = new Date();
    const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
    const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
    
    document.getElementById('start_date').valueAsDate = firstDay;
    document.getElementById('end_date').valueAsDate = lastDay;
});
</script>
@endsection
