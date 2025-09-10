@extends('layout')

@section('content')
<div class="container mt-5">
    <!-- عرض رسالة النجاح -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs justify-content-center mb-4" id="favoritesTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="courses-tab" data-toggle="tab" href="#courses" role="tab" aria-controls="courses" aria-selected="true">
                <i class="fa fa-book-open"></i> Courses ({{ $favoriteCourses->count() }})
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="scholarships-tab" data-toggle="tab" href="#scholarships" role="tab" aria-controls="scholarships" aria-selected="false">
                <i class="fa fa-graduation-cap"></i> Scholarships ({{ $favoriteScholarships->count() }})
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="programs-tab" data-toggle="tab" href="#programs" role="tab" aria-controls="programs" aria-selected="false">
                <i class="fa fa-book"></i> Paid Programs ({{ $favoritePaidPrograms->count() }})
            </a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="favoritesTabContent">
        <!-- Courses Tab -->
        <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab">
            @if($favoriteCourses->count() > 0)
                <div class="row">
                    @foreach($favoriteCourses as $favorite)
                        @php $course = $favorite->course; @endphp
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card scholarship-card">
                                <!-- Card Header -->
                                <div class="card-header scholarship-card-header d-flex justify-content-between align-items-center">
                                    <span>{{ $course->name }}</span>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-favorite-btn" data-type="course" data-id="{{ $course->id }}" title="Remove from favorites">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body scholarship-card-body">
                                    <p><strong>Description:</strong> {{ Str::limit($course->description, 100) }}</p>
                                    <p><strong>University:</strong> {{ $course->university->name ?? 'N/A' }}</p>
                                    <p><strong>Country:</strong> {{ $course->country }}</p>
                                    <p><strong>Type:</strong> {{ $course->type }}</p>
                                    <p><strong>Level:</strong> {{ $course->level }}</p>
                                    <p><strong>Duration:</strong> {{ $course->duration ?? 'N/A' }} weeks</p>
                                    <p><strong>Cost:</strong> {{ $course->cost == 0 || $course->cost == null ? 'Free' : '$' . number_format($course->cost, 2) }}</p>
                                </div>
                                <!-- Card Footer -->
                                <div class="card-footer scholarship-card-footer">
                                    <a href="{{ route('student.courses.show', $course->id) }}" class="btn btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fa fa-heart-o" style="font-size: 4rem; color: #ccc;"></i>
                    <h4 class="mt-3 text-muted">No favorite courses yet</h4>
                    <p class="text-muted">Start exploring courses and save your favorites!</p>
                    <a href="{{ route('student.courses.index') }}" class="btn btn-primary">Browse Courses</a>
                </div>
            @endif
        </div>

        <!-- Scholarships Tab -->
        <div class="tab-pane fade" id="scholarships" role="tabpanel" aria-labelledby="scholarships-tab">
            @if($favoriteScholarships->count() > 0)
                <div class="row">
                    @foreach($favoriteScholarships as $favorite)
                        @php $scholarship = $favorite->scholarship; @endphp
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card scholarship-card">
                                <!-- Card Header -->
                                <div class="card-header scholarship-card-header d-flex justify-content-between align-items-center">
                                    <span>{{ $scholarship->name }}</span>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-favorite-btn" data-type="scholarship" data-id="{{ $scholarship->scholarships_ID }}" title="Remove from favorites">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body scholarship-card-body">
                                    <p><strong>Description:</strong> {{ Str::limit($scholarship->description, 100) }}</p>
                                    <p><strong>Country:</strong> {{ $scholarship->country }}</p>
                                    <p><strong>Type:</strong> {{ $scholarship->type }}</p>
                                    <p><strong>University:</strong> {{ $scholarship->university->name }}</p>
                                    <p><strong>Funding Type:</strong> {{ $scholarship->funding_type }}</p>
                                    <p><strong>Cost:</strong> {{ $scholarship->cost ? '$' . $scholarship->cost : 'N/A' }}</p>
                                    <p><strong>End Date:</strong> {{ $scholarship->end_date }}</p>
                                </div>
                                <!-- Card Footer -->
                                <div class="card-footer scholarship-card-footer">
                                    @if(auth('student')->user()->is_blocked)
                                        <button class="scholarship-apply-btn w-100" disabled style="background-color: #ccc; cursor: not-allowed;" title="Your account is blocked">Account Blocked</button>
                                    @else
                                        <form action="{{ route('submitScholarshipRequest') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ auth('student')->user()->id }}">
                                            <input type="hidden" name="scholarship_id" value="{{ $scholarship->scholarships_ID }}">
                                            <input type="hidden" name="type" value="{{ $scholarship->type }}">
                                            <input type="hidden" name="funding_type" value="{{ $scholarship->funding_type }}">
                                            <input type="submit" value="Apply Now" class="scholarship-apply-btn w-100">
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fa fa-heart-o" style="font-size: 4rem; color: #ccc;"></i>
                    <h4 class="mt-3 text-muted">No favorite scholarships yet</h4>
                    <p class="text-muted">Start exploring scholarships and save your favorites!</p>
                    <a href="{{ route('scholarships.index') }}" class="btn btn-primary">Browse Scholarships</a>
                </div>
            @endif
        </div>

        <!-- Paid Programs Tab -->
        <div class="tab-pane fade" id="programs" role="tabpanel" aria-labelledby="programs-tab">
            @if($favoritePaidPrograms->count() > 0)
                <div class="row">
                    @foreach($favoritePaidPrograms as $favorite)
                        @php $program = $favorite->paidProgram; @endphp
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card scholarship-card">
                                <!-- Card Header -->
                                <div class="card-header scholarship-card-header d-flex justify-content-between align-items-center">
                                    <span>{{ $program->name }}</span>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-favorite-btn" data-type="paidprogram" data-id="{{ $program->id }}" title="Remove from favorites">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body scholarship-card-body">
                                    <p><strong>Description:</strong> {{ Str::limit($program->description, 100) }}</p>
                                    <p><strong>Country:</strong> {{ $program->country }}</p>
                                    <p><strong>Type:</strong> {{ $program->type }}</p>
                                    <p><strong>University:</strong> {{ $program->university->name }}</p>
                                    <p><strong>Cost:</strong> {{ $program->cost ? '$' . $program->cost : 'N/A' }}</p>
                                    <p><strong>End Date:</strong> {{ $program->end_date }}</p>
                                </div>
                                <!-- Card Footer -->
                                <div class="card-footer scholarship-card-footer">
                                    @if(auth('student')->user()->is_blocked)
                                        <button class="scholarship-apply-btn w-100" disabled style="background-color: #ccc; cursor: not-allowed;" title="Your account is blocked">Account Blocked</button>
                                    @else
                                        <form action="{{ route('submitPaidProgramRequest') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ auth('student')->user()->id }}">
                                            <input type="hidden" name="paid_program_id" value="{{ $program->id }}">
                                            <input type="submit" value="Apply Now" class="scholarship-apply-btn w-100">
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fa fa-heart-o" style="font-size: 4rem; color: #ccc;"></i>
                    <h4 class="mt-3 text-muted">No favorite paid programs yet</h4>
                    <p class="text-muted">Start exploring paid programs and save your favorites!</p>
                    <a href="{{ route('paidprograms.index') }}" class="btn btn-primary">Browse Paid Programs</a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.scholarship-card {
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
}

.scholarship-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.scholarship-card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    font-weight: bold;
    border-radius: 10px 10px 0 0;
    padding: 15px;
}

.scholarship-card-body {
    padding: 20px;
    flex-grow: 1;
}

.scholarship-card-footer {
    background-color: #f8f9fa;
    border-top: 1px solid #e0e0e0;
    padding: 15px;
}

.scholarship-apply-btn {
    background: linear-gradient(135deg, #ffc107 0%, #ff8f00 100%);
    color: white;
    border: none;
    border-radius: 25px;
    padding: 10px 20px;
    font-weight: bold;
    transition: all 0.3s ease;
    cursor: pointer;
}

.scholarship-apply-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
}

.nav-tabs .nav-link {
    border: none;
    color: #666;
    font-weight: 500;
    padding: 12px 24px;
    margin: 0 5px;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.nav-tabs .nav-link.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
}

.nav-tabs .nav-link:hover {
    border: none;
    background-color: #f8f9fa;
}
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.remove-favorite-btn').click(function() {
        var btn = $(this);
        var type = btn.data('type');
        var id = btn.data('id');
        var url;
        
        console.log('Button clicked - Type:', type, 'ID:', id);
        
        if (type === 'scholarship') {
            url = '{{ route("student.favorites.scholarship.toggle", ":id") }}';
        } else if (type === 'paidprogram') {
            url = '{{ route("student.favorites.paidprogram.toggle", ":id") }}';
        } else if (type === 'course') {
            url = '{{ route("student.courses.favorites.toggle", ":id") }}';
        }
        
        url = url.replace(':id', id);
        console.log('Request URL:', url);
        
        if (confirm('هل أنت متأكد من إزالة هذا العنصر من المفضلة؟')) {
            // Show loading state
            btn.prop('disabled', true);
            btn.html('<i class="fa fa-spinner fa-spin"></i>');
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.post(url)
                .done(function(response) {
                    console.log('Response received:', response);
                    
                    // Check if item was successfully removed
                    if (response.status === 'removed') {
                        // Remove the card with animation
                        btn.closest('.col-md-4, .col-sm-6').fadeOut(300, function() {
                            $(this).remove();
                            
                            // Check if tab is empty after removal
                            var tabPane = btn.closest('.tab-pane');
                            var remainingCards = tabPane.find('.col-md-4, .col-sm-6').length;
                            
                            if (remainingCards === 0) {
                                var emptyMessage;
                                if (type === 'course') {
                                    emptyMessage = '<div class="text-center py-5">' +
                                        '<i class="fa fa-heart-o" style="font-size: 4rem; color: #ccc;"></i>' +
                                        '<h4 class="mt-3 text-muted">لا توجد كورسات مفضلة</h4>' +
                                        '<p class="text-muted">ابدأ في استكشاف الكورسات وحفظ المفضلة لديك!</p>' +
                                        '<a href="{{ route("student.courses.index") }}" class="btn btn-primary">تصفح الكورسات</a>' +
                                        '</div>';
                                } else if (type === 'scholarship') {
                                    emptyMessage = '<div class="text-center py-5">' +
                                        '<i class="fa fa-heart-o" style="font-size: 4rem; color: #ccc;"></i>' +
                                        '<h4 class="mt-3 text-muted">لا توجد منح دراسية مفضلة</h4>' +
                                        '<p class="text-muted">ابدأ في استكشاف المنح الدراسية وحفظ المفضلة لديك!</p>' +
                                        '<a href="{{ route("scholarships.index") }}" class="btn btn-primary">تصفح المنح الدراسية</a>' +
                                        '</div>';
                                } else if (type === 'paidprogram') {
                                    emptyMessage = '<div class="text-center py-5">' +
                                        '<i class="fa fa-heart-o" style="font-size: 4rem; color: #ccc;"></i>' +
                                        '<h4 class="mt-3 text-muted">لا توجد برامج مدفوعة مفضلة</h4>' +
                                        '<p class="text-muted">ابدأ في استكشاف البرامج المدفوعة وحفظ المفضلة لديك!</p>' +
                                        '<a href="{{ route("paidprograms.index") }}" class="btn btn-primary">تصفح البرامج المدفوعة</a>' +
                                        '</div>';
                                }
                                tabPane.find('.row').html('<div class="col-12">' + emptyMessage + '</div>');
                            }
                            
                            // Update tab count
                            var tabId = tabPane.attr('id');
                            var tabLink = $('a[href="#' + tabId + '"]');
                            var countMatch = tabLink.text().match(/\((\d+)\)/);
                            if (countMatch) {
                                var currentCount = parseInt(countMatch[1]);
                                var newCount = Math.max(0, currentCount - 1);
                                var newText = tabLink.text().replace(/\(\d+\)/, '(' + newCount + ')');
                                tabLink.text(newText);
                            }
                        });
                        
                        // Show success message
                        var message = response.message || 'تم حذف العنصر من المفضلة بنجاح';
                        if (typeof toastr !== 'undefined') {
                            toastr.success(message);
                        } else {
                            alert(message);
                        }
                    } else if (response.status === 'added') {
                        // This shouldn't happen for remove button, but handle it
                        btn.prop('disabled', false);
                        btn.html('<i class="fa fa-trash"></i>');
                        
                        var message = response.message || 'تم إضافة العنصر للمفضلة';
                        if (typeof toastr !== 'undefined') {
                            toastr.info(message);
                        } else {
                            alert(message);
                        }
                    } else {
                        // Handle unexpected response
                        console.log('Unexpected response format:', response);
                        btn.prop('disabled', false);
                        btn.html('<i class="fa fa-trash"></i>');
                        
                        if (typeof toastr !== 'undefined') {
                            toastr.error('حدث خطأ غير متوقع');
                        } else {
                            alert('حدث خطأ غير متوقع');
                        }
                    }
                })
                .fail(function(xhr, status, error) {
                    console.error('AJAX Error:', xhr.responseText);
                    
                    // Reset button state
                    btn.prop('disabled', false);
                    btn.html('<i class="fa fa-trash"></i>');
                    
                    var errorMessage = 'حدث خطأ أثناء حذف العنصر.';
                    if (xhr.status === 401) {
                        errorMessage = 'يرجى تسجيل الدخول أولاً.';
                    } else if (xhr.status === 404) {
                        errorMessage = 'العنصر غير موجود.';
                    }
                    
                    if (typeof toastr !== 'undefined') {
                        toastr.error(errorMessage);
                    } else {
                        alert(errorMessage);
                    }
                });
        }
    });
});
</script>
@endsection