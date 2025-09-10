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
                    <div class="box course-details-box course-{{ strtolower($course->type) }}">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-graduation-cap"></i> {{ $course->name }}
                            </h3>
                            <div class="box-tools pull-right">
                                <span class="badge badge-{{ $course->type }} badge-lg">
                                    {{ ucfirst($course->type) }}
                                </span>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <!-- معلومات أساسية -->
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <h4 class="section-title"><i class="fa fa-info-circle"></i> Basic Information</h4>
                                        
                                        <div class="info-item">
                                            <label>Course Name:</label>
                                            <span>{{ $course->name }}</span>
                                        </div>
                                        
                                        <div class="info-item">
                                            <label>Description:</label>
                                            <span>{{ $course->description ?? 'No description available' }}</span>
                                        </div>
                                        
                                        <div class="info-item">
                                            <label>University:</label>
                                            <span>{{ $course->university->name ?? 'N/A' }}</span>
                                        </div>
                                        
                                        <div class="info-item">
                                            <label>Level:</label>
                                            <span class="badge badge-{{ $course->level }}">{{ ucfirst($course->level) }}</span>
                                        </div>
                                        
                                        <div class="info-item">
                                            <label>Language:</label>
                                            <span>{{ $course->language }}</span>
                                        </div>
                                        
                                        <div class="info-item">
                                            <label>Country:</label>
                                            <span>{{ $course->country }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- معلومات الجدولة والتكلفة -->
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <h4 class="section-title"><i class="fa fa-calendar"></i> Schedule & Pricing</h4>
                                        
                                        <div class="info-item">
                                            <label>Start Date:</label>
                                            <span class="date-badge">{{ \Carbon\Carbon::parse($course->start_date)->format('M d, Y') }}</span>
                                        </div>
                                        
                                        <div class="info-item">
                                            <label>End Date:</label>
                                            <span class="date-badge">{{ \Carbon\Carbon::parse($course->end_date)->format('M d, Y') }}</span>
                                        </div>
                                        
                                        <div class="info-item">
                                            <label>Duration:</label>
                                            <span>{{ $course->duration ? $course->duration . ' weeks' : 'Not specified' }}</span>
                                        </div>
                                        
                                        <div class="info-item">
                                            <label>Cost:</label>
                                            <span class="price-tag">${{ number_format($course->cost ?? 0, 2) }}</span>
                                        </div>
                                        
                                        <div class="info-item">
                                            <label>Instructor:</label>
                                            <span>{{ $course->instructor ?? 'TBA' }}</span>
                                        </div>
                                        
                                        <div class="info-item">
                                            <label>Max Students:</label>
                                            <span>{{ $course->max_students ?? 'Unlimited' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                                        @if($course->application_url)
                                        <div class="info-item">
                                            <label>Application URL:</label>
                                            <span><a href="{{ $course->application_url }}" target="_blank" class="text-primary"><i class="fa fa-external-link"></i> {{ $course->application_url }}</a></span>
                                        </div>
                                        @endif
                            
                            <!-- معلومات النظام -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="system-info">
                                        <h4 class="section-title"><i class="fa fa-cog"></i> System Information</h4>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="info-item">
                                                    <label>Created:</label>
                                                    <span>{{ $course->created_at->format('M d, Y H:i') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="info-item">
                                                    <label>Last Updated:</label>
                                                    <span>{{ $course->updated_at->format('M d, Y H:i') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="info-item">
                                                    <label>Created by:</label>
                                                    <span>{{ $course->admin->name ?? 'System' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- أزرار الإجراءات -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary btn-lg">
                                            <i class="fa fa-arrow-left"></i> Back to Courses
                                        </a>
                                        <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning btn-lg">
                                            <i class="fa fa-edit"></i> Edit Course
                                        </a>
                                        <button class="btn btn-danger btn-lg" onclick="deleteCourse({{ $course->id }})">
                                            <i class="fa fa-trash"></i> Delete Course
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
/* تصميم صفحة عرض الكورس */
.course-details-box {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.course-online {
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.15) 0%, rgba(40, 167, 69, 0.08) 100%);
    border-left: 4px solid #28a745;
}

.course-offline {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.15) 0%, rgba(255, 193, 7, 0.08) 100%);
    border-left: 4px solid #ffc107;
}

.course-hybrid {
    background: linear-gradient(135deg, rgba(23, 162, 184, 0.15) 0%, rgba(23, 162, 184, 0.08) 100%);
    border-left: 4px solid #17a2b8;
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
    padding: 2%;
    border-radius: 50px;
}

.badge-intermediate {
    background-color: #fd7e14 !important;
    color: white;
}

.badge-advanced {
    background-color: #dc3545 !important;
    color: white;
}

.info-card {
    background: #272e48;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 1px solid #e9ecef;
}

.section-title {
    color: #495057;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #dee2e6;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #e9ecef;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item label {
    font-weight: 600;
    color: #ffffff;
    margin-bottom: 0;
    min-width: 120px;
}

.info-item span {
    color: #ffffff;
    text-align: right;
    flex: 1;
}

.date-badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.9em;
}

.price-tag {
    background: #28a745;
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 1.1em;
}

.badge-lg {
    font-size: 1em;
    padding: 8px 16px;
}

.application-section {
    text-align: center;
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 30px;
    border-radius: 10px;
}

.application-section .section-title {
    color: white;
    border-bottom-color: rgba(255,255,255,0.3);
}

.system-info {
    background: #272e48;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.action-buttons {
    text-align: center;
    padding: 20px;
    background: #272e48;
    border-radius: 8px;
    border: 2px dashed #dee2e6;
}

.action-buttons .btn {
    margin: 0 10px;
    min-width: 150px;
}

/* Responsive Design */
@media (max-width: 992px) {
    .course-details-box {
        margin-bottom: 20px;
    }
    
    .section-title {
        font-size: 16px;
    }
    
    .info-item label {
        min-width: 100px;
        font-size: 0.9em;
    }
    
    .info-item span {
        font-size: 0.9em;
    }
}

@media (max-width: 768px) {
    .course-details-box {
        border-radius: 5px;
        margin-bottom: 15px;
    }
    
    .info-card {
        padding: 15px;
        margin-bottom: 15px;
    }
    
    .section-title {
        font-size: 15px;
        margin-bottom: 15px;
        padding-bottom: 8px;
    }
    
    .info-item {
        flex-direction: column;
        align-items: flex-start;
        padding: 8px 0;
    }
    
    .info-item label {
        min-width: auto;
        margin-bottom: 3px;
        font-size: 0.85em;
    }
    
    .info-item span {
        text-align: left;
        margin-top: 0;
        font-size: 0.85em;
        width: 100%;
    }
    
    .price-tag {
        font-size: 1em;
        padding: 5px 10px;
    }
    
    .badge-lg {
        font-size: 0.9em;
        padding: 6px 12px;
    }
    
    .application-section {
        padding: 20px;
        text-align: left;
    }
    
    .system-info {
        padding: 15px;
    }
    
    .action-buttons {
        padding: 15px;
    }
    
    .action-buttons .btn {
        display: block;
        margin: 8px 0;
        width: 100%;
        min-width: auto;
    }
}

@media (max-width: 576px) {
    .content-wrapper {
        padding: 10px;
    }
    
    .course-details-box {
        border-radius: 3px;
    }
    
    .info-card {
        padding: 12px;
        margin-bottom: 12px;
    }
    
    .section-title {
        font-size: 14px;
        margin-bottom: 12px;
        padding-bottom: 6px;
    }
    
    .info-item {
        padding: 6px 0;
    }
    
    .info-item label {
        font-size: 0.8em;
        font-weight: 500;
    }
    
    .info-item span {
        font-size: 0.8em;
    }
    
    .price-tag {
        font-size: 0.9em;
        padding: 4px 8px;
    }
    
    .badge {
        font-size: 0.75em;
        padding: 3px 6px;
    }
    
    .badge-lg {
        font-size: 0.8em;
        padding: 4px 8px;
    }
    
    .application-section {
        padding: 15px;
    }
    
    .system-info {
        padding: 12px;
    }
    
    .action-buttons {
        padding: 12px;
    }
    
    .action-buttons .btn {
        margin: 6px 0;
        font-size: 0.9em;
        padding: 8px 12px;
    }
    
    .btn-lg {
        font-size: 0.9em;
        padding: 8px 12px;
    }
}
</style>

<script>
function deleteCourse(courseId) {
    Swal.fire({
        title: 'هل أنت متأكد؟',
        text: "لن تتمكن من التراجع عن هذا الإجراء!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
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
</script>
@endsection