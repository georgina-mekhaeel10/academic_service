@extends('admin.admin_master')

@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <!-- Display Alert Messages -->
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please correct the following errors:</strong>
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
                    <h3 class="box-title"><i class="fa fa-plus-circle"></i> Add New Course</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Back to Courses
                        </a>
                    </div>
                </div>

                <div class="box-body">
                    <form action="{{ route('admin.courses.store') }}" method="POST" id="courseForm">
                        @csrf

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
                                                <option value="{{ $university->id }}" {{ old('university_ID') == $university->id ? 'selected' : '' }}>{{ $university->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Course Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="form-label">Course Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter detailed course description...">{{ old('description') }}</textarea>
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
                                            <option value="online" {{ old('type') == 'online' ? 'selected' : '' }}>Online</option>
                                            <option value="offline" {{ old('type') == 'offline' ? 'selected' : '' }}>Offline</option>
                                            <option value="hybrid" {{ old('type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="level" class="form-label">Course Level <span class="text-danger">*</span></label>
                                        <select name="level" id="level" class="form-control" required>
                                            <option value="">Select Level</option>
                                            <option value="beginner" {{ old('level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                            <option value="intermediate" {{ old('level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                            <option value="advanced" {{ old('level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cost" class="form-label">Cost ($)</label>
                                        <input type="number" name="cost" id="cost" class="form-control" step="0.01" min="0" value="{{ old('cost') }}" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="duration" class="form-label">Duration (Weeks)</label>
                                        <input type="number" name="duration" id="duration" class="form-control" min="1" value="{{ old('duration') }}" placeholder="Number of weeks">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="language" class="form-label">Course Language <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" class="form-control" value="{{ old('language') }}" required placeholder="Example: Arabic, English">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="max_students" class="form-label">Maximum Students</label>
                                        <input type="number" name="max_students" id="max_students" class="form-control" min="1" value="{{ old('max_students') }}" placeholder="Number of students">
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
                                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" required>
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
                                        <input type="text" name="instructor" id="instructor" class="form-control" value="{{ old('instructor') }}" placeholder="Instructor name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                        <input type="text" name="country" id="country" class="form-control" value="{{ old('country') }}" required placeholder="Country name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="application_url" class="form-label">Application URL</label>
                                        <input type="url" name="application_url" id="application_url" class="form-control" value="{{ old('application_url') }}" placeholder="https://example.com">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="form-actions text-center">
                            <button type="submit" class="btn btn-success btn-lg me-3">
                                <i class="fa fa-save"></i> Save Course
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
    background: #34465b !important;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #007bff;
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
        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268 0%, #495057 100%);
            transform: translateY(-1px);
        }
        
        /* Course Type Preview Colors */
        .type-preview {
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            display: none;
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
            .form-row {
                flex-direction: column;
            }
            
            .form-row .col-md-6 {
                width: 100%;
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
            }
            
            .box-title {
                font-size: 15px;
            }
            
            .box-body {
                padding: 20px 15px;
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
            }
            
            .box-body {
                padding: 15px 12px;
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
            alert('End date must be after start date');
            this.value = '';
        }
    });
    
    // Confirm before cancel
    document.querySelector('a[href*="courses.index"]').addEventListener('click', function(e) {
        const form = document.getElementById('courseForm');
        let hasData = false;
        
        // Check if there is entered data
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            if (input.value.trim() !== '') {
                hasData = true;
            }
        });
        
        if (hasData) {
            if (!confirm('Are you sure you want to cancel? You will lose all entered data.')) {
                e.preventDefault();
            }
        }
    });
    
    // Course type preview
    document.getElementById('type').addEventListener('change', function() {
        const typeValue = this.value;
        let existingPreview = document.getElementById('typePreview');
        
        // Remove previous preview if exists
        if (existingPreview) {
            existingPreview.remove();
        }
        
        if (typeValue) {
            // Create preview element
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
                    typeText = 'In-person - On-site course';
                    break;
                case 'hybrid':
                    typeText = 'Hybrid - Online and in-person course';
                    break;
            }
            
            preview.innerHTML = '<strong>Course Type Preview:</strong> ' + typeText;
            
            // Add preview after type field
            this.parentNode.appendChild(preview);
        }
    });
});
</script>
@endsection