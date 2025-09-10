@extends('layout')
@section('content')

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div id="overviews" class="section wb">
    <div class="container">
        <!-- Header Actions -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="favorites-header">
                    <div class="favorites-info">
                        <h4><i class="fa fa-heart text-danger"></i> You have {{ $favoriteCourses->count() }} favorite courses</h4>
                        <p class="text-muted">Keep track of courses you're interested in</p>
                    </div>
                    <div class="favorites-actions">
                        <a href="{{ route('student.courses.index') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Browse More Courses
                        </a>
                        <a href="{{ route('student.courses.applications') }}" class="btn btn-info">
                            <i class="fa fa-file-text"></i> My Applications
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Favorites Grid -->
        <div class="row">
            @forelse($favoriteCourses as $favorite)
                @php $course = $favorite->course; @endphp
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="favorite-course-card course-{{ $course->type }}">
                        <div class="course-header">
                            <div class="course-badges">
                                <span class="badge badge-type badge-{{ $course->type }}">
                                    {{ ucfirst($course->type) }}
                                </span>
                                <span class="badge badge-level badge-{{ $course->level }}">
                                    {{ ucfirst($course->level) }}
                                </span>
                            </div>
                            <div class="favorite-btn active" data-course-id="{{ $course->id }}" title="Remove from favorites">
                                <i class="fa fa-heart"></i>
                            </div>
                            <div class="favorite-date">
                                <small>Added {{ $favorite->created_at->diffForHumans() }}</small>
                            </div>
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
                                @php
                                    $hasApplied = Auth::guard('student')->user()->courseApplications()->where('course_id', $course->id)->exists();
                                @endphp
                                @if($hasApplied)
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
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="no-favorites">
                        <div class="text-center py-5">
                            <i class="fa fa-heart-o fa-5x text-muted mb-4"></i>
                            <h3>No Favorite Courses Yet</h3>
                            <p class="text-muted mb-4">
                                You haven't added any courses to your favorites yet.<br>
                                Browse our course catalog and save the ones you're interested in!
                            </p>
                            <a href="{{ route('student.courses.index') }}" class="btn btn-primary btn-lg">
                                <i class="fa fa-search"></i> Browse Courses
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($favoriteCourses->hasPages())
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="pagination-wrapper">
                        {{ $favoriteCourses->links() }}
                    </div>
                </div>
            </div>
        @endif
        
        <!-- Quick Actions -->
        @if($favoriteCourses->count() > 0)
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="quick-actions-card">
                    <h4><i class="fa fa-bolt"></i> Quick Actions</h4>
                    <div class="quick-actions">
                        <button class="btn btn-outline-success" onclick="applyToAllFavorites()">
                            <i class="fa fa-paper-plane"></i> Apply to All Favorites
                        </button>
                        <button class="btn btn-outline-danger" onclick="clearAllFavorites()">
                            <i class="fa fa-trash"></i> Clear All Favorites
                        </button>
                        <button class="btn btn-outline-info" onclick="exportFavorites()">
                            <i class="fa fa-download"></i> Export List
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
/* Favorites Header */
.favorites-header {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.favorites-info h4 {
    margin-bottom: 5px;
    color: #333;
}

.favorites-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

/* Favorite Course Cards */
.favorite-course-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 2px solid transparent;
}

.favorite-course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    border-color: #ff6b6b;
}

.favorite-course-card .course-header {
    position: relative;
    padding: 15px;
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
    color: white;
}

.favorite-course-card.course-online .course-header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.favorite-course-card.course-offline .course-header {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
}

.favorite-course-card.course-hybrid .course-header {
    background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
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
    color: #ff6b6b;
}

.favorite-btn:hover {
    transform: scale(1.2);
}

.favorite-date {
    position: absolute;
    bottom: 10px;
    right: 15px;
    font-size: 11px;
    opacity: 0.8;
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

/* No Favorites */
.no-favorites {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin: 50px 0;
}

/* Quick Actions */
.quick-actions-card {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.quick-actions-card h4 {
    margin-bottom: 20px;
    color: #333;
}

.quick-actions {
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
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

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
}

/* Responsive Design */
@media (max-width: 768px) {
    .favorites-header {
        flex-direction: column;
        text-align: center;
    }
    
    .favorites-actions {
        justify-content: center;
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
    
    .quick-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .quick-actions .btn {
        width: 100%;
        max-width: 300px;
    }
}

@media (max-width: 576px) {
    .favorites-header {
        padding: 15px;
    }
    
    .course-title {
        font-size: 16px;
    }
    
    .quick-actions-card {
        padding: 15px;
    }
}
</style>

<script>
$(document).ready(function() {
    // Favorite toggle
    $('.favorite-btn').click(function() {
        var courseId = $(this).data('course-id');
        var btn = $(this);
        var card = btn.closest('.favorite-course-card');
        
        if (confirm('Are you sure you want to remove this course from your favorites?')) {
            $.ajax({
                url: '/courses/' + courseId + '/toggle-favorite',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Always remove the card regardless of response status
                    card.fadeOut(300, function() {
                        card.remove();
                        
                        // Check if no more favorites
                        if ($('.favorite-course-card').length === 0) {
                            location.reload();
                        }
                    });
                    
                    showToast('Course removed from favorites', 'info');
                },
                error: function() {
                    showToast('An error occurred. Please try again.', 'error');
                }
            });
        }
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

// Quick Actions Functions
function applyToAllFavorites() {
    if (confirm('Are you sure you want to apply to all your favorite courses?')) {
        var courseIds = [];
        $('.apply-btn').each(function() {
            courseIds.push($(this).data('course-id'));
        });
        
        if (courseIds.length === 0) {
            showToast('No courses available to apply to.', 'info');
            return;
        }
        
        $.ajax({
            url: '/courses/apply-multiple',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                course_ids: courseIds
            },
            success: function(response) {
                if (response.success) {
                    $('.apply-btn').each(function() {
                        $(this).removeClass('btn-success').addClass('btn-secondary')
                               .html('<i class="fa fa-check"></i> Applied')
                               .prop('disabled', true);
                    });
                    showToast('Applications submitted for ' + response.count + ' courses!', 'success');
                } else {
                    showToast(response.message || 'Some applications failed.', 'error');
                }
            },
            error: function() {
                showToast('An error occurred. Please try again.', 'error');
            }
        });
    }
}

function clearAllFavorites() {
    if (confirm('Are you sure you want to remove all courses from your favorites? This action cannot be undone.')) {
        $.ajax({
            url: '/courses/favorites/clear',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    showToast('All favorites cleared successfully!', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    showToast('Failed to clear favorites.', 'error');
                }
            },
            error: function() {
                showToast('An error occurred. Please try again.', 'error');
            }
        });
    }
}

function exportFavorites() {
    window.open('/courses/favorites/export', '_blank');
    showToast('Exporting your favorites list...', 'info');
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