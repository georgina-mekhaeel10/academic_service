@extends('admin.admin_master')

@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <!-- Success Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Error Messages -->
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-triangle me-2"></i>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="box">
                <div class="box-header">
                    <h3><i class="fa fa-edit"></i> Edit Support Staff</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.support.update', $support->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Basic Information Section -->
                        <div class="form-section mb-4">
                            <h4 class="section-title"><i class="fa fa-info-circle"></i> Basic Information</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $support->name) }}" required placeholder="Enter full name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $support->email) }}" required placeholder="Enter email address">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Security Section -->
                        <div class="form-section mb-4">
                            <h4 class="section-title"><i class="fa fa-lock"></i> Security Settings</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password>
                                        <small class="form-text text-muted">Leave empty if you don't want to change the password</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="admin_id" class="form-label">Assigned Admin</label>
                                        <select name="admin_id" id="admin_id" class="form-control">
                                            <option value="">Select Admin (Optional)</option>
                                            @foreach($admins as $admin)
                                                <option value="{{ $admin->id }}" {{ old('admin_id', $support->admin_id) == $admin->id ? 'selected' : '' }}>
                                                    {{ $admin->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="form-actions text-center">
                            <button type="submit" class="btn btn-success btn-lg me-3">
                                <i class="fa fa-save"></i> Save Changes
                            </button>
                            <a href="{{ route('admin.support.index') }}" class="btn btn-secondary btn-lg">
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
    .box-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 20px;
        border-radius: 8px 8px 0 0;
        margin-bottom: 0;
    }

    .form-label {
        color: #FFF !important;
    }

    .box-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }

    .box-body {
        background: #34465b;
        padding: 25px;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .form-section {
        background: #34465b !important;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #667eea;
    }

    .section-title {
        color: #495057;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 2px solid #e9ecef;
    }

    .section-title i {
        margin-right: 8px;
        color: #667eea;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 5px;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 6px;
        padding: 10px 12px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        padding: 12px 30px;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
        padding: 12px 30px;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }

    .alert {
        border-radius: 8px;
        border: none;
        padding: 15px 20px;
        margin-bottom: 20px;
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .form-actions {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 2px solid #e9ecef;
    }

    .form-text {
        font-size: 0.875em;
        margin-top: 0.25rem;
    }

    .text-muted {
        color: #6c757d !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.querySelector('form');
    const requiredFields = form.querySelectorAll('[required]');
    
    // Email validation
    const emailField = document.getElementById('email');
    
    if (emailField) {
        emailField.addEventListener('input', function() {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (this.value && !emailPattern.test(this.value)) {
                this.setCustomValidity('Please enter a valid email address');
            } else {
                this.setCustomValidity('');
            }
        });
    }
    
    // Password strength indicator
    const passwordField = document.getElementById('password');
    
    if (passwordField) {
        passwordField.addEventListener('input', function() {
            if (this.value && this.value.length < 6) {
                this.setCustomValidity('Password must be at least 6 characters long');
            } else {
                this.setCustomValidity('');
            }
        });
    }
    
    // Track form changes
    let formChanged = false;
    const formElements = form.querySelectorAll('input, select, textarea');
    
    formElements.forEach(element => {
        element.addEventListener('change', function() {
            formChanged = true;
        });
    });
    
    // Warn before leaving if form has changes
    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
    
    // Reset form changed flag on submit
    form.addEventListener('submit', function() {
        formChanged = false;
    });
    
    // Enhanced form validation
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Please fill in all required fields.');
        }
    });
});
</script>
@endsection
