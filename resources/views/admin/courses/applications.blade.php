@extends('admin.admin_master')

@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <!-- عرض رسالة الخطأ -->
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('error') }}
            </div>
            @endif

            <!-- عرض رسالة النجاح -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('success') }}
            </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Course Applications Management</h3>
                            <div class="box-tools pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-filter"></i> Filter by Status
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('admin.courses.applications') }}">All Applications</a></li>
                                        <li><a href="{{ route('admin.courses.applications') }}?status=pending">Pending</a></li>
                                        <li><a href="{{ route('admin.courses.applications') }}?status=approved">Approved</a></li>
                                        <li><a href="{{ route('admin.courses.applications') }}?status=rejected">Rejected</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="applicationsTable">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Course Name</th>
                                            <th>University</th>
                                            <th>Application Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($applications as $application)
                                        <tr class="application-row application-{{ $application->status }}">
                                            <td>
                                                <strong>{{ $application->student->name }}</strong><br>
                                                <small class="text-muted">{{ $application->student->email }}</small>
                                            </td>
                                            <td>
                                                <strong>{{ $application->course->name }}</strong><br>
                                                <small class="text-muted">${{ number_format($application->course->cost, 2) }}</small>
                                            </td>
                                            <td>{{ $application->course->university->name }}</td>
                                            <td>{{ $application->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                @if($application->status == 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($application->status == 'approved')
                            <span class="badge badge-success">Approved</span>
                                                @elseif($application->status == 'rejected')
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($application->status == 'pending')
                                                    <button class="btn btn-success btn-sm" onclick="updateStatus({{ $application->id }}, 'approved')" title="Accept">
                                                        <i class="fa fa-check"></i> Accept
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" onclick="updateStatus({{ $application->id }}, 'rejected')" title="Reject">
                                                        <i class="fa fa-times"></i> Reject
                                                    </button>
                                                @else
                                                    <button class="btn btn-warning btn-sm" onclick="updateStatus({{ $application->id }}, 'pending')" title="Reset to Pending">
                                                        <i class="fa fa-undo"></i> Reset
                                                    </button>
                                                @endif
                                                <button class="btn btn-info btn-sm" onclick="showDetails({{ $application->id }})" title="View Details">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No course applications found.</td>
                                        </tr>
                                        @endforelse
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

<!-- Modal لتحديث حالة الطلب -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Update Application Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="statusForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes (Optional):</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Add any notes about this decision..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal لعرض تفاصيل الطلب -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Application Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailsContent">
                <!-- سيتم تحميل التفاصيل هنا -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
/* ألوان خلفية حسب حالة الطلب */
.application-pending {
    background-color: #1a233a !important;
}

.application-approved {
    background-color: #1a233a !important;
}

.application-rejected {
    background-color: #1a233a !important;
}

.application-row:hover {
    background-color: #1a233a !important;
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

.badge {
    font-size: 0.875em;
    padding: 0.375rem 0.75rem;
}

.badge-warning {
    background-color: #ffc107;
    color: #212529;
}

.badge-success {
    background-color: #28a745;
    color: white;
}

.badge-danger {
    background-color: #dc3545;
    color: white;
}

.btn-sm {
    margin: 2px;
}

.card-body.details{
 min-height: 10vh !important;
}

</style>

<script>
function updateStatus(applicationId, status) {
    document.getElementById('statusForm').action = `/admin/courses/applications/${applicationId}/status`;
    document.getElementById('status').value = status;
    $('#statusModal').modal('show');
}

function showDetails(applicationId) {
    $('#detailsModal').modal('show');
    
    // عرض رسالة التحميل
    document.getElementById('detailsContent').innerHTML = '<div class="text-center"><i class="fa fa-spinner fa-spin"></i> جاري التحميل...</div>';
    
    // استدعاء AJAX لجلب تفاصيل الطلب
    $.ajax({
        url: `/admin/courses/applications/${applicationId}/details`,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const app = response.application;
                const statusText = {
                     'pending': 'Pending',
                     'approved': 'Approved',
                     'rejected': 'Rejected',
                     'withdrawn': 'Withdrawn'
                 };
                
                document.getElementById('detailsContent').innerHTML = `
                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fa fa-user"></i> Student Information</h5>
                             <div class="card">
                                 <div class="card-body">
                                     <p><strong>Name:</strong> ${app.student.name}</p>
                                     <p><strong>Email:</strong> ${app.student.email}</p>
                                     <p><strong>Phone:</strong> ${app.student.phone}</p>
                                     <p><strong>Gender:</strong> ${app.student.gender}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fa fa-book"></i> Course Information</h5>
                             <div class="card">
                                 <div class="card-body">
                                     <p><strong>Course Name:</strong> ${app.course.name}</p>
                                     <p><strong>University:</strong> ${app.course.university.name}</p>
                                     <p><strong>Location:</strong> ${app.course.university.location}</p>
                                     <p><strong>Cost:</strong> $${app.course.cost}</p>
                                     <p><strong>Type:</strong> ${app.course.type}</p>
                                     <p><strong>Level:</strong> ${app.course.level}</p>
                                     <p><strong>Language:</strong> ${app.course.language}</p>
                                     <p><strong>Country:</strong> ${app.course.country}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5><i class="fa fa-info-circle"></i> Application Details</h5>
                             <div class="card">
                                 <div class="card-body details">
                                     <p><strong>Application Status:</strong> <span class="badge badge-${app.status === 'approved' ? 'success' : app.status === 'rejected' ? 'danger' : app.status === 'withdrawn' ? 'warning' : 'secondary'}">${statusText[app.status] || app.status}</span></p>
                                     <p><strong>Applied Date:</strong> ${app.applied_at || 'Not specified'}</p>
                                     <p><strong>Created Date:</strong> ${app.created_at}</p>
                                     <p><strong>Last Updated:</strong> ${app.updated_at}</p>
                                     ${app.notes ? `<p><strong>Notes:</strong> ${app.notes}</p>` : ''}
                                </div>
                            </div>
                        </div>
                    </div>
                    ${app.course.description ? `
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5><i class="fa fa-file-text"></i> Course Description</h5>
                             <div class="card">
                                 <div class="card-body details">
                                     <p>${app.course.description}</p>
                                     <p><strong>Start Date:</strong> ${app.course.start_date}</p>
                                     <p><strong>End Date:</strong> ${app.course.end_date}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    ` : ''}
                `;
            } else {
                document.getElementById('detailsContent').innerHTML = '<div class="alert alert-danger">Error loading details</div>';
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            document.getElementById('detailsContent').innerHTML = '<div class="alert alert-danger">Error loading details. Please try again.</div>';
        }
    });
}

// تهيئة DataTable
$(document).ready(function() {
    $('#applicationsTable').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "order": [[ 3, "desc" ]], // ترتيب حسب تاريخ التقديم
        "pageLength": 25
    });
});
</script>
@endsection