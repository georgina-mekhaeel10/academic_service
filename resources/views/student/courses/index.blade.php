@extends('layout')
@section('content')

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- <div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Available Courses</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Courses</li>
                </ul>
            </div>
        </div>
    </div>
</div> --}}

<div id="overviews" class="section wb">
    <div class="container">
        <!-- Search and Filter Section -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="search-filter-box">
                    <form method="GET" action="{{ route('student.courses.index') }}" id="filterForm">
                        <div class="row">
                            <!-- Search Bar -->
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="search">Search Courses</label>
                                    <input type="text" name="search" id="search" class="form-control" 
                                           placeholder="Search by name, description, instructor..." 
                                           value="{{ request('search') }}">
                                </div>
                            </div>
                            
                            <!-- Course Type Filter -->
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label for="type">Course Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="">All Types</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                                {{ ucfirst($type) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Course Level Filter -->
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label for="level">Course Level</label>
                                    <select name="level" id="level" class="form-control">
                                        <option value="">All Levels</option>
                                        @foreach($levels as $level)
                                            <option value="{{ $level }}" {{ request('level') == $level ? 'selected' : '' }}>
                                                {{ ucfirst($level) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Price Range Filter -->
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label for="price_range">Price Range</label>
                                    <select name="price_range" id="price_range" class="form-control">
                                        <option value="">All Prices</option>
                                        <option value="free" {{ request('price_range') == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="under_100" {{ request('price_range') == 'under_100' ? 'selected' : '' }}>Under $100</option>
                                        <option value="100_500" {{ request('price_range') == '100_500' ? 'selected' : '' }}>$100 - $500</option>
                                        <option value="over_500" {{ request('price_range') == 'over_500' ? 'selected' : '' }}>Over $500</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Country Filter -->
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select name="country" id="country" class="form-control">
                                        <option value="">All Countries</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country }}" {{ request('country') == $country ? 'selected' : '' }}>
                                                {{ $country }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mr-2">
                                    <i class="fa fa-search"></i> Search & Filter
                                </button>
                                <a href="{{ route('student.courses.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-refresh"></i> Clear Filters
                                </a>
                                @if(Auth::guard('student')->check())
                                    <a href="{{ route('student.courses.favorites') }}" class="btn btn-warning ml-2">
                                        <i class="fa fa-heart"></i> My Favorites
                                    </a>
                                    <a href="{{ route('student.courses.applications') }}" class="btn btn-info ml-2">
                                        <i class="fa fa-file-text"></i> My Applications
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Results Count -->
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="results-info">
                    <p class="text-muted">
                        Showing {{ $courses->firstItem() ?? 0 }} to {{ $courses->lastItem() ?? 0 }} 
                        of {{ $courses->total() }} courses
                        @if(request()->hasAny(['search', 'type', 'level', 'price_range', 'country']))
                            (filtered)
                        @endif
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Courses Grid -->
        <div class="row">
            @forelse($courses as $course)
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="course-card course-{{ $course->type }}">
                        <div class="course-header">
                            <div class="course-badges">
                                <span class="badge badge-type badge-{{ $course->type }}">
                                    {{ ucfirst($course->type) }}
                                </span>
                                <span class="badge badge-level badge-{{ $course->level }}">
                                    {{ ucfirst($course->level) }}
                                </span>
                            </div>
                            @if(Auth::guard('student')->check())
                                <div class="favorite-btn {{ in_array($course->id, $favoriteCourseIds) ? 'active' : '' }}" data-course-id="{{ $course->id }}">
                                    <i class="fa {{ in_array($course->id, $favoriteCourseIds) ? 'fa-heart' : 'fa-heart-o' }}"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="course-body">
                            <h4 class="course-title">{{ $course->name }}</h4>
                            <p class="course-university">
                                <i class="fa fa-university"></i> {{ $course->university->name ?? 'N/A' }}
                            </p>
                            <p class="course-description">
                                {{ Str::limit($course->description, 100) }}
                            </p>
                            
                            <div class="course-details">
                                <div class="detail-item">
                                    <i class="fa fa-map-marker"></i>
                                    <span>{{ $course->country }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fa fa-user"></i>
                                    <span>{{ $course->instructor ?? 'TBA' }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fa fa-clock-o"></i>
                                    <span>{{ $course->duration ?? 'N/A' }} weeks</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fa fa-language"></i>
                                    <span>{{ $course->language }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="course-footer">
                            <div class="course-price">
                                @if($course->cost == 0 || $course->cost == null)
                                    <span class="price free">Free</span>
                                @else
                                    <span class="price">${{ number_format($course->cost, 2) }}</span>
                                @endif
                            </div>
                            
                            <div class="course-dates">
                                <small class="text-muted">
                                    {{ date('M d, Y', strtotime($course->start_date)) }} - 
                                    {{ date('M d, Y', strtotime($course->end_date)) }}
                                </small>
                            </div>
                            
                            <div class="course-actions">
                                <a href="{{ route('student.courses.show', $course->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i> View Details
                                </a>
                                @if(Auth::guard('student')->check())
                                    @if(in_array($course->id, $appliedCourseIds))
                                        <button class="btn btn-secondary btn-sm" disabled>
                                            <i class="fa fa-check"></i> Applied
                                        </button>
                                    @else
                                        @if(auth('student')->user()->is_blocked)
                                            <button class="btn btn-secondary btn-sm" disabled title="Your account is blocked">
                                                <i class="fa fa-ban"></i> Account Blocked
                                            </button>
                                        @else
                                            <button class="btn btn-success btn-sm apply-btn" data-course-id="{{ $course->id }}">
                                                <i class="fa fa-paper-plane"></i> Apply
                                            </button>
                                        @endif
                                    @endif
                                @else
                                    <a href="#" data-toggle="modal" data-target="#login" class="btn btn-success btn-sm">
                                        <i class="fa fa-sign-in"></i> Login to Apply
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="no-courses-found">
                        <div class="text-center py-5">
                            <i class="fa fa-search fa-3x text-muted mb-3"></i>
                            <h4>No courses found</h4>
                            <p class="text-muted">Try adjusting your search criteria or filters.</p>
                            <a href="{{ route('student.courses.index') }}" class="btn btn-primary">
                                <i class="fa fa-refresh"></i> View All Courses
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($courses->hasPages())
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="pagination-wrapper">
                        {{ $courses->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
/* Course Cards Styling */
.course-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.course-header {
    position: relative;
    padding: 15px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.course-badges {
    display: flex;
    gap: 8px;
    margin-bottom: 10px;
}

.favorite-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    cursor: pointer;
    font-size: 18px;
    transition: all 0.3s ease;
}

.favorite-btn:hover {
    transform: scale(1.2);
}

.favorite-btn.active i {
    color: #ff6b6b;
}

.course-body {
    padding: 20px;
    flex-grow: 1;
}

.course-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
}

.course-university {
    color: #666;
    margin-bottom: 15px;
    font-size: 14px;
}

.course-description {
    color: #777;
    font-size: 14px;
    line-height: 1.5;
    margin-bottom: 15px;
}

.course-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
}

.detail-item {
    display: flex;
    align-items: center;
    font-size: 12px;
    color: #666;
}

.detail-item i {
    margin-right: 5px;
    width: 12px;
}

.course-footer {
    padding: 15px 20px;
    border-top: 1px solid #eee;
    background: #f8f9fa;
}

.course-price {
    margin-bottom: 10px;
}

.price {
    font-size: 18px;
    font-weight: 600;
    color: #28a745;
}

.price.free {
    color: #17a2b8;
}

.course-dates {
    margin-bottom: 15px;
}

.course-actions {
    display: flex;
    gap: 8px;
}

.course-actions .btn {
    flex: 1;
    font-size: 12px;
    padding: 6px 12px;
}

/* Search and Filter Styling */
.search-filter-box {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.search-filter-box .form-group label {
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.search-filter-box .form-control {
    border-radius: 5px;
    border: 1px solid #ddd;
    padding: 8px 12px;
}

.search-filter-box .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

/* Badge Styling */
.badge-type {
    font-size: 10px;
    padding: 4px 8px;
}

.badge-online {
    background-color: #28a745;
}

.badge-offline {
    background-color: #ffc107;
    color: #212529;
}

.badge-hybrid {
    background-color: #17a2b8;
}

.badge-level {
    font-size: 10px;
    padding: 4px 8px;
}

.badge-beginner {
    background-color: #6f42c1;
}

.badge-intermediate {
    background-color: #fd7e14;
}

.badge-advanced {
    background-color: #dc3545;
}

/* Course Type Background */
.course-online .course-header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.course-offline .course-header {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
}

.course-hybrid .course-header {
    background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
}

/* Results Info */
.results-info {
    background: #f8f9fa;
    padding: 10px 15px;
    border-radius: 5px;
    border-left: 4px solid #667eea;
}

/* No Courses Found */
.no-courses-found {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
}

/* Responsive Design */
@media (max-width: 768px) {
    .search-filter-box {
        padding: 15px;
    }
    
    .course-details {
        grid-template-columns: 1fr;
    }
    
    .course-actions {
        flex-direction: column;
    }
    
    .course-actions .btn {
        margin-bottom: 5px;
    }
}

@media (max-width: 576px) {
    .course-card {
        margin-bottom: 20px;
    }
    
    .course-title {
        font-size: 16px;
    }
    
    .search-filter-box .btn {
        width: 100%;
        margin-bottom: 10px;
    }
}
</style>

<script>
$(document).ready(function() {
    // Auto-submit form on filter change
    $('#type, #level, #price_range, #country').change(function() {
        $('#filterForm').submit();
    });
    
    // Favorite toggle
    $('.favorite-btn').click(function() {
        var courseId = $(this).data('course-id');
        var btn = $(this);
        
        $.ajax({
            url: '/courses/' + courseId + '/toggle-favorite',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'added') {
                    btn.addClass('active');
                    btn.find('i').removeClass('fa-heart-o').addClass('fa-heart');
                } else {
                    btn.removeClass('active');
                    btn.find('i').removeClass('fa-heart').addClass('fa-heart-o');
                }
                
                // Show toast notification
                showToast(response.message, response.status === 'added' ? 'success' : 'info');
            },
            error: function() {
                showToast('An error occurred. Please try again.', 'error');
            }
        });
    });
    
    // Apply for course
    $('.apply-btn').click(function() {
        var courseId = $(this).data('course-id');
        var btn = $(this);
        
        if (confirm('Are you sure you want to apply for this course?')) {
            $.ajax({
                url: '/courses/' + courseId + '/apply',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        btn.removeClass('btn-success').addClass('btn-secondary')
                           .html('<i class="fa fa-check"></i> Applied')
                           .prop('disabled', true);
                        showToast('Application submitted successfully!', 'success');
                    } else {
                        showToast(response.message || 'Application failed.', 'error');
                    }
                },
                error: function(xhr) {
                    var message = 'An error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    showToast(message, 'error');
                }
            });
        }
    });
});

// Toast notification function
function showToast(message, type) {
    var bgColor = type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : '#17a2b8';
    
    // Create toast element
    var toast = $('<div class="toast-notification">' + message + '</div>');
    toast.css({
        'position': 'fixed',
        'top': '20px',
        'right': '20px',
        'background': bgColor,
        'color': 'white',
        'padding': '15px 20px',
        'border-radius': '5px',
        'z-index': '9999',
        'box-shadow': '0 4px 6px rgba(0,0,0,0.1)'
    });
    
    $('body').append(toast);
    
    // Auto remove after 3 seconds
    setTimeout(function() {
        toast.fadeOut(function() {
            toast.remove();
        });
    }, 3000);
}
</script>

@endsection