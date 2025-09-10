@extends('layout')
@section('content')

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ $course->name }}</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('student.courses.index') }}">Courses</a></li>
                    <li class="breadcrumb-item active">{{ $course->name }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="overviews" class="section wb">
    <div class="container">
        <div class="row">
            <!-- Main Course Content -->
            <div class="col-lg-8">
                <div class="course-detail-card">
                    <!-- Course Header -->
                    <div class="course-header course-{{ $course->type }}">
                        <div class="course-badges">
                            <span class="badge badge-type badge-{{ $course->type }}">
                                {{ ucfirst($course->type) }}
                            </span>
                            <span class="badge badge-level badge-{{ $course->level }}">
                                {{ ucfirst($course->level) }}
                            </span>
                        </div>
                        @if(Auth::guard('student')->check())
                            <div class="favorite-btn {{ $isFavorite ? 'active' : '' }}" data-course-id="{{ $course->id }}">
                                <i class="fa {{ $isFavorite ? 'fa-heart' : 'fa-heart-o' }}"></i>
                            </div>
                        @endif
                        <h1 class="course-title">{{ $course->name }}</h1>
                        <p class="course-university">
                            <i class="fa fa-university"></i> {{ $course->university->name ?? 'N/A' }}
                        </p>
                    </div>
                    
                    <!-- Course Description -->
                    <div class="course-section">
                        <h3><i class="fa fa-info-circle"></i> Course Description</h3>
                        <div class="course-description">
                            {!! nl2br(e($course->description)) !!}
                        </div>
                    </div>
                    
                    <!-- Course Details Grid -->
                    <div class="course-section">
                        <h3><i class="fa fa-list"></i> Course Details</h3>
                        <div class="details-grid">
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fa fa-user"></i> Instructor
                                </div>
                                <div class="detail-value">{{ $course->instructor ?? 'To Be Announced' }}</div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fa fa-clock-o"></i> Duration
                                </div>
                                <div class="detail-value">{{ $course->duration ?? 'N/A' }} weeks</div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fa fa-language"></i> Language
                                </div>
                                <div class="detail-value">{{ $course->language }}</div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fa fa-map-marker"></i> Country
                                </div>
                                <div class="detail-value">{{ $course->country }}</div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fa fa-calendar"></i> Start Date
                                </div>
                                <div class="detail-value">{{ date('F d, Y', strtotime($course->start_date)) }}</div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fa fa-calendar-check-o"></i> End Date
                                </div>
                                <div class="detail-value">{{ date('F d, Y', strtotime($course->end_date)) }}</div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fa fa-users"></i> Max Students
                                </div>
                                <div class="detail-value">{{ $course->max_students ?? 'Unlimited' }}</div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fa fa-graduation-cap"></i> Prerequisites
                                </div>
                                <div class="detail-value">{{ $course->prerequisites ?? 'None' }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Course Requirements -->
                    @if($course->requirements)
                    <div class="course-section">
                        <h3><i class="fa fa-check-square-o"></i> Requirements</h3>
                        <div class="requirements-list">
                            {!! nl2br(e($course->requirements)) !!}
                        </div>
                    </div>
                    @endif
                    
                    <!-- Course Objectives -->
                    @if($course->objectives)
                    <div class="course-section">
                        <h3><i class="fa fa-target"></i> Learning Objectives</h3>
                        <div class="objectives-list">
                            {!! nl2br(e($course->objectives)) !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Price and Action Card -->
                <div class="action-card">
                    <div class="price-section">
                        @if($course->cost == 0 || $course->cost == null)
                            <div class="price free">
                                <span class="currency">FREE</span>
                            </div>
                        @else
                            <div class="price">
                                <span class="currency">$</span>
                                <span class="amount">{{ number_format($course->cost, 2) }}</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="action-buttons">
                        @if(Auth::guard('student')->check())
                            @if($hasApplied)
                                <button class="btn btn-secondary btn-block" disabled>
                                    <i class="fa fa-check"></i> Already Applied
                                </button>
                            @else
                                @if(auth('student')->user()->is_blocked)
                                    <button class="btn btn-secondary btn-block" disabled title="Your account is blocked">
                                        <i class="fa fa-ban"></i> Account Blocked
                                    </button>
                                @else
                                    <button class="btn btn-success btn-block apply-btn" data-course-id="{{ $course->id }}">
                                        <i class="fa fa-paper-plane"></i> Apply for Course
                                    </button>
                                @endif
                            @endif
                            
                            <button class="btn btn-outline-warning btn-block favorite-btn-sidebar {{ $isFavorite ? 'active' : '' }}" data-course-id="{{ $course->id }}">
                                <i class="fa {{ $isFavorite ? 'fa-heart' : 'fa-heart-o' }}"></i> 
                                {{ $isFavorite ? 'Remove from Favorites' : 'Add to Favorites' }}
                            </button>
                        @else
                            <a href="#" data-toggle="modal" data-target="#login" class="btn btn-success btn-block">
                                <i class="fa fa-sign-in"></i> Login to Apply
                            </a>
                        @endif
                        
                        <a href="{{ route('student.courses.index') }}" class="btn btn-outline-primary btn-block">
                            <i class="fa fa-arrow-left"></i> Back to Courses
                        </a>
                    </div>
                </div>
                
                <!-- Course Info Card -->
                <div class="info-card">
                    <h4><i class="fa fa-info-circle"></i> Course Information</h4>
                    <div class="info-list">
                        <div class="info-item">
                            <span class="info-label">Course Type:</span>
                            <span class="info-value badge badge-{{ $course->type }}">{{ ucfirst($course->type) }}</span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">Difficulty Level:</span>
                            <span class="info-value badge badge-{{ $course->level }}">{{ ucfirst($course->level) }}</span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">Duration:</span>
                            <span class="info-value">{{ $course->duration ?? 'N/A' }} weeks</span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">Language:</span>
                            <span class="info-value">{{ $course->language }}</span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">Country:</span>
                            <span class="info-value">{{ $course->country }}</span>
                        </div>
                        
                        @if($course->max_students)
                        <div class="info-item">
                            <span class="info-label">Max Students:</span>
                            <span class="info-value">{{ $course->max_students }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Share Card -->
                <div class="share-card">
                    <h4><i class="fa fa-share-alt"></i> Share This Course</h4>
                    <div class="share-buttons">
                        <a href="#" class="btn btn-social btn-facebook" onclick="shareOnFacebook()">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="#" class="btn btn-social btn-twitter" onclick="shareOnTwitter()">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-social btn-linkedin" onclick="shareOnLinkedIn()">
                            <i class="fa fa-linkedin"></i>
                        </a>
                        <button class="btn btn-social btn-copy" onclick="copyLink()">
                            <i class="fa fa-copy"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Course Detail Card */
.course-detail-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-bottom: 30px;
}

.course-header {
    position: relative;
    padding: 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.course-header.course-online {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.course-header.course-offline {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
}

.course-header.course-hybrid {
    background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
}

.course-badges {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
}

.favorite-btn {
    position: absolute;
    top: 30px;
    right: 30px;
    cursor: pointer;
    font-size: 24px;
    transition: all 0.3s ease;
}

.favorite-btn:hover {
    transform: scale(1.2);
}

.favorite-btn.active i {
    color: #ff6b6b;
}

.course-title {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 10px;
    line-height: 1.2;
}

.course-university {
    font-size: 16px;
    opacity: 0.9;
}

.course-section {
    padding: 25px 30px;
    border-bottom: 1px solid #eee;
}

.course-section:last-child {
    border-bottom: none;
}

.course-section h3 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #333;
    display: flex;
    align-items: center;
    gap: 10px;
}

.course-description {
    font-size: 16px;
    line-height: 1.6;
    color: #555;
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.detail-label {
    font-weight: 600;
    color: #666;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.detail-value {
    font-size: 16px;
    color: #333;
}

.requirements-list,
.objectives-list {
    font-size: 16px;
    line-height: 1.6;
    color: #555;
}

/* Sidebar Cards */
.action-card,
.info-card,
.share-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    overflow: hidden;
}

.action-card {
    position: sticky;
    top: 20px;
}

.price-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 25px;
    text-align: center;
}

.price {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
}

.price.free .currency {
    font-size: 24px;
    font-weight: 700;
}

.price .currency {
    font-size: 20px;
    font-weight: 600;
}

.price .amount {
    font-size: 32px;
    font-weight: 700;
}

.action-buttons {
    padding: 20px;
}

.action-buttons .btn {
    margin-bottom: 10px;
    font-weight: 600;
}

.action-buttons .btn:last-child {
    margin-bottom: 0;
}

.favorite-btn-sidebar.active {
    background-color: #ffc107;
    border-color: #ffc107;
    color: #212529;
}

.info-card,
.share-card {
    padding: 20px;
}

.info-card h4,
.share-card h4 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #333;
    display: flex;
    align-items: center;
    gap: 8px;
}

.info-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 600;
    color: #666;
    font-size: 14px;
}

.info-value {
    font-size: 14px;
    color: #333;
}

.share-buttons {
    display: flex;
    gap: 10px;
    justify-content: center;
}

.btn-social {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-social:hover {
    transform: translateY(-2px);
    color: white;
    text-decoration: none;
}

.btn-facebook {
    background-color: #3b5998;
}

.btn-twitter {
    background-color: #1da1f2;
}

.btn-linkedin {
    background-color: #0077b5;
}

.btn-copy {
    background-color: #6c757d;
}

/* Badge Styling */
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

.badge-beginner {
    background-color: #6f42c1;
}

.badge-intermediate {
    background-color: #fd7e14;
}

.badge-advanced {
    background-color: #dc3545;
}

/* Responsive Design */
@media (max-width: 992px) {
    .action-card {
        position: static;
        margin-bottom: 30px;
    }
    
    .details-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .course-header {
        padding: 20px;
    }
    
    .course-title {
        font-size: 24px;
    }
    
    .course-section {
        padding: 20px;
    }
    
    .favorite-btn {
        top: 20px;
        right: 20px;
        font-size: 20px;
    }
}

@media (max-width: 576px) {
    .course-header {
        padding: 15px;
    }
    
    .course-title {
        font-size: 20px;
    }
    
    .course-section {
        padding: 15px;
    }
    
    .price .amount {
        font-size: 28px;
    }
    
    .share-buttons {
        flex-wrap: wrap;
    }
}
</style>

<script>
$(document).ready(function() {
    // Favorite toggle (header)
    $('.favorite-btn').click(function() {
        toggleFavorite($(this));
    });
    
    // Favorite toggle (sidebar)
    $('.favorite-btn-sidebar').click(function() {
        toggleFavorite($(this));
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
                           .html('<i class="fa fa-check"></i> Already Applied')
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

function toggleFavorite(btn) {
    var courseId = btn.data('course-id');
    
    $.ajax({
        url: '/courses/' + courseId + '/toggle-favorite',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.status === 'added') {
                // Update header favorite button
                $('.favorite-btn').addClass('active');
                $('.favorite-btn i').removeClass('fa-heart-o').addClass('fa-heart');
                
                // Update sidebar favorite button
                $('.favorite-btn-sidebar').addClass('active')
                    .html('<i class="fa fa-heart"></i> Remove from Favorites');
            } else {
                // Update header favorite button
                $('.favorite-btn').removeClass('active');
                $('.favorite-btn i').removeClass('fa-heart').addClass('fa-heart-o');
                
                // Update sidebar favorite button
                $('.favorite-btn-sidebar').removeClass('active')
                    .html('<i class="fa fa-heart-o"></i> Add to Favorites');
            }
            
            showToast(response.message, response.status === 'added' ? 'success' : 'info');
        },
        error: function() {
            showToast('An error occurred. Please try again.', 'error');
        }
    });
}

// Share functions
function shareOnFacebook() {
    var url = encodeURIComponent(window.location.href);
    var title = encodeURIComponent('{{ $course->name }}');
    window.open('https://www.facebook.com/sharer/sharer.php?u=' + url, '_blank', 'width=600,height=400');
}

function shareOnTwitter() {
    var url = encodeURIComponent(window.location.href);
    var title = encodeURIComponent('Check out this course: {{ $course->name }}');
    window.open('https://twitter.com/intent/tweet?url=' + url + '&text=' + title, '_blank', 'width=600,height=400');
}

function shareOnLinkedIn() {
    var url = encodeURIComponent(window.location.href);
    window.open('https://www.linkedin.com/sharing/share-offsite/?url=' + url, '_blank', 'width=600,height=400');
}

function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        showToast('Link copied to clipboard!', 'success');
    }, function() {
        showToast('Failed to copy link.', 'error');
    });
}

// Toast notification function
function showToast(message, type) {
    var bgColor = type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : '#17a2b8';
    
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
    
    setTimeout(function() {
        toast.fadeOut(function() {
            toast.remove();
        });
    }, 3000);
}
</script>

@endsection