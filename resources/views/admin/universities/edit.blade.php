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
                    <h3><i class="fa fa-edit"></i> Edit University</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.universities.update', $university->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Basic Information Section -->
                        <div class="form-section mb-4">
                            <h4 class="section-title"><i class="fa fa-info-circle"></i> Basic Information</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">University Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $university->name) }}" required placeholder="Enter university name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                                        <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $university->location) }}" required placeholder="Enter location">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter university description...">{{ old('description', $university->description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- University Details Section -->
                        <div class="form-section mb-4">
                            <h4 class="section-title"><i class="fa fa-university"></i> University Details</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="established_year" class="form-label">Established Year <span class="text-danger">*</span></label>
                                        <input type="number" name="established_year" id="established_year" class="form-control" min="1800" max="{{ date('Y') }}" value="{{ old('established_year', $university->established_year) }}" required placeholder="Enter established year">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website" class="form-label">Website</label>
                                        <input type="url" name="website" id="website" class="form-control" value="{{ old('website', $university->website) }}" placeholder="Enter website URL">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="form-actions text-center">
                            <button type="submit" class="btn btn-success btn-lg me-3">
                                <i class="fa fa-save"></i> Save Changes
                            </button>
                            <a href="{{ route('admin.universities.index') }}" class="btn btn-secondary btn-lg">
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

    .box-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }

    .box-body {
        background: #1a233a;
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
        color: #FFF;
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.querySelector('form');
    const requiredFields = form.querySelectorAll('[required]');
    
    // Year validation
    const establishedYear = document.getElementById('established_year');
    
    if (establishedYear) {
        establishedYear.addEventListener('input', function() {
            const currentYear = new Date().getFullYear();
            const year = parseInt(this.value);
            
            if (year < 1800 || year > currentYear) {
                this.setCustomValidity('Please enter a valid year between 1800 and ' + currentYear);
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
