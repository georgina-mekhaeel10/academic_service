@extends('admin.admin_master')

@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <!-- عرض رسائل التنبيه -->
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>خطأ!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>نجح!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>يرجى تصحيح الأخطاء التالية:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Header -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-edit"></i> Edit Course: {{ $course->name }}</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-info btn-sm me-2">
                            <i class="fa fa-eye"></i> View Course
                        </a>
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Back to Courses
                        </a>
                    </div>
                </div>

                <div class="box-body">
                    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" id="courseEditForm">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information Section -->
                        <div class="form-section mb-4">
                            <h4 class="section-title"><i class="fa fa-info-circle"></i> Basic Information</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="university_ID" class="form-label">University <span class="text-danger">*</span></label>
                                        <select name="university_ID" id="university_ID" class="form-control" required>
                                            <option value="">Select University</option>
                                            @foreach($universities as $university)
                                                <option value="{{ $university->id }}" + "" {{ (old('university_ID', $course->university_ID) == $university->id) ? 'selected' : '' }}>{{ $university->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Course Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $course->name) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="form-label">Course Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter detailed course description...">{{ old('description', $course->description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Course Details Section -->
                        <div class="form-section mb-4">
                            <h4 class="section-title"><i class="fa fa-cogs"></i> Course Details</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type" class="form-label">Course Type <span class="text-danger">*</span></label>
                                        <select name="type" id="type" class="form-control" required>
                                            <option value="">Select Type</option>
                                            <option value="online" {{ old('type', $course->type) == 'online' ? 'selected' : '' }}>Online</option>
                                            <option value="offline" {{ old('type', $course->type) == 'offline' ? 'selected' : '' }}>Offline</option>
                                            <option value="hybrid" {{ old('type', $course->type) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="level" class="form-label">Course Level <span class="text-danger">*</span></label>
                                        <select name="level" id="level" class="form-control" required>
                                            <option value="">Select Level</option>
                                            <option value="beginner" {{ old('level', $course->level) == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                            <option value="intermediate" {{ old('level', $course->level) == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                            <option value="advanced" {{ old('level', $course->level) == 'advanced' ? 'selected' : '' }}>Advanced</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cost" class="form-label">Cost ($)</label>
                                        <input type="number" name="cost" id="cost" class="form-control" step="0.01" min="0" value="{{ old('cost', $course->cost) }}" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="duration" class="form-label">Duration (Weeks)</label>
                                        <input type="number" name="duration" id="duration" class="form-control" min="1" value="{{ old('duration', $course->duration) }}" placeholder="Number of weeks">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="language" class="form-label">Course Language <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" class="form-control" value="{{ old('language', $course->language) }}" required placeholder="Example: Arabic, English">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="max_students" class="form-label">Maximum Students</label>
                                        <input type="number" name="max_students" id="max_students" class="form-control" min="1" value="{{ old('max_students', $course->max_students) }}" placeholder="Number of students">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Schedule Section -->
                        <div class="form-section mb-4">
                            <h4 class="section-title"><i class="fa fa-calendar"></i> Schedule and Dates</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $course->start_date) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $course->end_date) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information Section -->
                        <div class="form-section mb-4">
                            <h4 class="section-title"><i class="fa fa-user-plus"></i> Additional Information</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="instructor" class="form-label">Instructor</label>
                                        <input type="text" name="instructor" id="instructor" class="form-control" value="{{ old('instructor', $course->instructor) }}" placeholder="Instructor name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                        <input type="text" name="country" id="country" class="form-control" value="{{ old('country', $course->country) }}" required placeholder="Country name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="application_url" class="form-label">Application URL</label>
                                        <input type="url" name="application_url" id="application_url" class="form-control" value="{{ old('application_url', $course->application_url) }}" placeholder="https://example.com">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Course Status Section -->
                        <div class="form-section mb-4 bg-light">
                            <h4 class="section-title"><i class="fa fa-info"></i> System Information</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <strong>Created Date:</strong> {{ $course->created_at->format('Y-m-d H:i') }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <strong>Last Updated:</strong> {{ $course->updated_at->format('Y-m-d H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="form-actions text-center">
                            <button type="submit" class="btn btn-success btn-lg me-3">
                                <i class="fa fa-save"></i> Save Changes
                            </button>
                            <a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-info btn-lg me-3">
                                <i class="fa fa-eye"></i> View Course
                            </a>
                            <button type="button" class="btn btn-danger btn-lg me-3" onclick="deleteCourse({{ $course->id }})">
                                <i class="fa fa-trash"></i> Delete Course
                            </button>
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fa fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
.form-section {
    background: #272e48;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #007bff;
    margin-bottom: 20px;
}

.form-section.bg-light {
    background: #e9ecef;
    border-left-color: #6c757d;
}

.section-title {
    color: #495057;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 15px;
    padding-bottom: 8px;
    border-bottom: 1px solid #dee2e6;
}

.form-label {
    font-weight: 500;
    color: #ffffff;
    margin-bottom: 5px;
}

.form-control {
    border-radius: 6px;
    border: 1px solid #ced4da;
    padding: 10px 12px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.form-actions {
    background: #272e48;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.btn-lg {
    padding: 12px 30px;
    font-size: 16px;
    border-radius: 6px;
}

.text-danger {
    color: #dc3545 !important;
}

.box {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.box-header {
    background: #272e48;
    padding: 15px 20px;
    border-bottom: 1px solid #dee2e6;
    border-radius: 8px 8px 0 0;
}

.box-title {
    font-size: 18px;
    font-weight: 600;
    color: #495057;
    margin: 0;
}

.box-body {
    padding: 25px;
}

.info-item {
    padding: 8px 0;
    color: #c3c3c3;
}

.info-item strong {
    color: #c3c3c3;
}
/* Course Type Preview Colors */
.type-preview {
    padding: 10px;
    border-radius: 5px;
    margin-top: 10px;
}

.type-online {
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(40, 167, 69, 0.05) 100%);
    border-left: 4px solid #28a745;
}

.type-offline {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 193, 7, 0.05) 100%);
    border-left: 4px solid #ffc107;
}

.type-hybrid {
    background: linear-gradient(135deg, rgba(23, 162, 184, 0.1) 0%, rgba(23, 162, 184, 0.05) 100%);
    border-left: 4px solid #17a2b8;
}

/* Responsive Design */
@media (max-width: 992px) {
    .box-tools {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .box-tools .btn {
        margin-bottom: 5px;
        width: 100%;
    }
    
    .form-section .row .col-md-6 {
        margin-bottom: 15px;
    }
    
    .box-title {
        font-size: 16px;
    }
}

@media (max-width: 768px) {
    .content-wrapper {
        padding: 10px;
    }
    
    .box {
        border-radius: 5px;
        margin-bottom: 15px;
    }
    
    .box-header {
        padding: 12px 15px;
        border-radius: 5px 5px 0 0;
        flex-direction: column;
        align-items: flex-start;
    }
    
    .box-title {
        font-size: 15px;
        margin-bottom: 10px;
    }
    
    .box-tools {
        width: 100%;
        flex-direction: column;
    }
    
    .box-tools .btn {
        width: 100%;
        margin: 3px 0;
        font-size: 0.9em;
    }
    
    .box-body {
        padding: 20px 15px;
    }
    
    .form-section {
        padding: 15px;
        margin-bottom: 15px;
    }
    
    .section-title {
        font-size: 14px;
        margin-bottom: 12px;
        padding-bottom: 6px;
    }
    
    .form-label {
        font-size: 0.9em;
        margin-bottom: 4px;
    }
    
    .form-control {
        padding: 8px 10px;
        font-size: 0.9em;
    }
    
    .form-actions {
        padding: 15px;
        text-align: center;
    }
    
    .btn-lg {
        padding: 10px 20px;
        font-size: 14px;
        width: 100%;
        margin-bottom: 10px;
    }
    
    .type-preview {
        padding: 8px;
        margin-top: 8px;
        font-size: 0.9em;
    }
    
    .info-item {
        padding: 6px 0;
        font-size: 0.9em;
    }
}

@media (max-width: 576px) {
    .content-wrapper {
        padding: 5px;
    }
    
    .box {
        border-radius: 3px;
    }
    
    .box-header {
        padding: 10px 12px;
        border-radius: 3px 3px 0 0;
    }
    
    .box-title {
        font-size: 14px;
        margin-bottom: 8px;
    }
    
    .box-tools .btn {
        font-size: 0.8em;
        padding: 6px 10px;
    }
    
    .box-body {
        padding: 15px 12px;
    }
    
    .form-section {
        padding: 12px;
        margin-bottom: 12px;
    }
    
    .section-title {
        font-size: 13px;
        margin-bottom: 10px;
        padding-bottom: 5px;
    }
    
    .form-label {
        font-size: 0.85em;
        margin-bottom: 3px;
    }
    
    .form-control {
        padding: 6px 8px;
        font-size: 0.85em;
    }
    
    .form-actions {
        padding: 12px;
    }
    
    .btn-lg {
        padding: 8px 15px;
        font-size: 13px;
        margin-bottom: 8px;
    }
    
    .type-preview {
        padding: 6px;
        margin-top: 6px;
        font-size: 0.8em;
    }
    
    .info-item {
        padding: 4px 0;
        font-size: 0.8em;
    }
    
    textarea.form-control {
        min-height: 80px;
    }
}
</style>

<script>
// تحسين تجربة المستخدم
document.addEventListener('DOMContentLoaded', function() {
    // التحقق من صحة التواريخ
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');
    
    startDate.addEventListener('change', function() {
        endDate.min = this.value;
    });
    
    endDate.addEventListener('change', function() {
        if (this.value < startDate.value) {
            alert('تاريخ النهاية يجب أن يكون بعد تاريخ البداية');
            this.value = '';
        }
    });
    
    // تتبع التغييرات في النموذج
    const form = document.getElementById('courseEditForm');
    const originalData = new FormData(form);
    let hasChanges = false;
    
    // مراقبة التغييرات
    form.addEventListener('input', function() {
        hasChanges = true;
    });
    
    form.addEventListener('change', function() {
        hasChanges = true;
    });
    
    // Confirm before canceling
    document.querySelectorAll('a[href*="courses"]').forEach(link => {
        link.addEventListener('click', function(e) {
            if (hasChanges) {
                if (!confirm('Are you sure you want to leave? You will lose all unsaved changes.')) {
                    e.preventDefault();
                }
            }
        });
    });
    
    // Confirm before submitting form
    form.addEventListener('submit', function(e) {
        if (!confirm('Are you sure you want to save the changes?')) {
            e.preventDefault();
        }
    });
    
    // Course type preview
    document.getElementById('type').addEventListener('change', function() {
        const typeValue = this.value;
        let existingPreview = document.getElementById('typePreview');
        
        // إزالة المعاينة السابقة إن وجدت
        if (existingPreview) {
            existingPreview.remove();
        }
        
        if (typeValue) {
            // إنشاء عنصر المعاينة
            const preview = document.createElement('div');
            preview.id = 'typePreview';
            preview.className = 'type-preview type-' + typeValue;
            preview.style.display = 'block';
            
            let typeText = '';
            switch(typeValue) {
                case 'online':
                    typeText = 'Online - Internet-based course';
                    break;
                case 'offline':
                    typeText = 'Offline - On-site course';
                    break;
                case 'hybrid':
                    typeText = 'Hybrid - Online and offline course';
                    break;
            }
            
            preview.innerHTML = '<strong>Course Type Preview:</strong> ' + typeText;
            
            // Add preview after type field
            this.parentNode.appendChild(preview);
        }
    });
    
    // Show current preview on page load
    const currentType = document.getElementById('type').value;
    if (currentType) {
        document.getElementById('type').dispatchEvent(new Event('change'));
    }
});

// وظيفة حذف الكورس مع تأكيد
function deleteCourse(courseId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this action!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
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