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
                            <h3 class="box-title">Manage Courses</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="coursesTable">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Level</th>
                                            <th>Price</th>
                                            <th>Instructor</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($courses as $course)
                        <tr class="course-row course-{{ $course->type }}">
                            <td>{{ $course->name }}</td>
                            <td><span class="badge badge-type badge-{{ $course->type }}">{{ ucfirst($course->type) }}</span></td>
                            <td><span class="badge badge-level badge-{{ $course->level }}">{{ ucfirst($course->level) }}</span></td>
                            <td>${{ number_format($course->cost, 2) }}</td>
                            <td>{{ $course->instructor ?? 'N/A' }}</td>
                            <td>{{ $course->start_date }}</td>
                            <td>{{ $course->end_date }}</td>
                            <td>
                                @if(request('view') == 'edit')
                                    <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                @elseif(request('view') == 'delete')
                                    <button class="btn btn-danger btn-sm" onclick="deleteCourse({{ $course->id }})" title="Delete">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                @elseif(request('view') == 'show')
                                    <a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-primary btn-sm" title="View">
                                        <i class="fa fa-eye"></i> Show
                                    </a>
                                @else
                                    <a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-primary btn-sm" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteCourse({{ $course->id }})" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
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

<!-- Modal لاختيار التواريخ -->
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Download Courses Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.courses.download.pdf') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-download"></i> Download PDF
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* ألوان خلفية حسب نوع الكورس */
.course-online {
    background-color: #e8f5e8 !important;
}

.course-offline {
    background-color: #fff3cd !important;
}

.course-hybrid {
    background-color: #d1ecf1 !important;
}

.course-row:hover {
    background-color: #f8f9fa !important;
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

.box-tools {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn-group .btn {
    margin-right: 2px;
}

.table th {
    color: white;
    font-weight: 600;
}

.badge {
    font-size: 0.8em;
    padding: 4px 8px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .box-header {
        flex-direction: column;
        align-items: flex-start !important;
    }
    
    .box-tools {
        width: 100%;
        justify-content: flex-start;
        margin-top: 10px;
        position: unset !important;
    }
    
    .box-tools .btn {
        flex: 1;
        min-width: 120px;
    }
    
    .table-responsive {
        font-size: 0.85em;
    }
    
    .table td, .table th {
        padding: 8px 4px;
        white-space: nowrap;
    }
    
    .btn-sm {
        padding: 2px 6px;
        font-size: 0.75em;
    }
    
    .badge {
        font-size: 0.7em;
        padding: 2px 6px;
    }
}

@media (max-width: 576px) {
    .box-title {
        font-size: 1.1em;
    }
    
    .table-responsive {
        font-size: 0.8em;
    }
    
    .table td, .table th {
        padding: 6px 3px;
    }
    
    .btn-sm {
        padding: 1px 4px;
        font-size: 0.7em;
    }
    
    .btn-sm i {
        font-size: 0.9em;
    }
    
    .badge {
        font-size: 0.65em;
        padding: 1px 4px;
    }
    
    /* Stack action buttons vertically on very small screens */
    .table td:last-child {
        white-space: normal;
    }
    
    .table td:last-child .btn {
        display: block;
        width: 100%;
        margin-bottom: 2px;
    }
}

/* Badge Colors for Course Types */
.badge-online {
    background-color: #28a745 !important;
    color: white;
}

.badge-offline {
    background-color: #ffc107 !important;
    color: #212529;
}

.badge-hybrid {
    background-color: #17a2b8 !important;
    color: white;
}

/* Badge Colors for Course Levels */
.badge-beginner {
    background-color: #6f42c1 !important;
    color: white;
}

.badge-intermediate {
    background-color: #fd7e14 !important;
    color: white;
}

.badge-advanced {
    background-color: #dc3545 !important;
    color: white;
}

/* Course Type Background Colors */
.course-row.course-online {
    background-color: rgba(40, 167, 69, 0.1) !important;
}

.course-row.course-offline {
    background-color: rgba(255, 193, 7, 0.1) !important;
}

.course-row.course-hybrid {
    background-color: rgba(23, 162, 184, 0.1) !important;
}

.course-row:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}
</style>

<script>
function deleteCourse(courseId) {
    Swal.fire({
        title: 'هل أنت متأكد؟',
        text: "لن تتمكن من التراجع عن هذا الإجراء!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'نعم، احذف!',
        cancelButtonText: 'إلغاء'
    }).then((result) => {
        if (result.isConfirmed) {
            // إنشاء نموذج وإرساله
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/courses/' + courseId;
            
            let csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            let methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// تعيين التاريخ الافتراضي عند فتح المودال
$('#pdfModal').on('show.bs.modal', function (e) {
    // تعيين تاريخ البداية إلى بداية الشهر الحالي
    var today = new Date();
    var firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
    var lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
    
    $('#start_date').val(firstDay.toISOString().split('T')[0]);
    $('#end_date').val(lastDay.toISOString().split('T')[0]);
});

// تهيئة DataTable للجدول
$(document).ready(function() {
    $('#coursesTable').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "language": {
            "search": "البحث:",
            "lengthMenu": "عرض _MENU_ عنصر",
            "info": "عرض _START_ إلى _END_ من _TOTAL_ عنصر",
            "paginate": {
                "first": "الأول",
                "last": "الأخير",
                "next": "التالي",
                "previous": "السابق"
            }
        }
    });
});
</script>
@endsection