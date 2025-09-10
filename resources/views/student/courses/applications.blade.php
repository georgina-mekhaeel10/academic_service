@extends('layout')
@section('content')

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div id="overviews" class="section wb">
    <div class="container">
        <!-- Header Stats -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="applications-stats">
                    <div class="stats-grid">
                        <div class="stat-card stat-total">
                            <div class="stat-icon">
                                <i class="fa fa-file-text"></i>
                            </div>
                            <div class="stat-info">
                                <h3>{{ $applications->count() }}</h3>
                                <p>Total Applications</p>
                            </div>
                        </div>
                        
                        <div class="stat-card stat-pending">
                            <div class="stat-icon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <div class="stat-info">
                                <h3>{{ $applications->where('status', 'pending')->count() }}</h3>
                                <p>Pending Review</p>
                            </div>
                        </div>
                        
                        <div class="stat-card stat-approved">
                            <div class="stat-icon">
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <div class="stat-info">
                                <h3>{{ $applications->where('status', 'approved')->count() }}</h3>
                                <p>Approved</p>
                            </div>
                        </div>
                        
                        <div class="stat-card stat-rejected">
                            <div class="stat-icon">
                                <i class="fa fa-times-circle"></i>
                            </div>
                            <div class="stat-info">
                                <h3>{{ $applications->where('status', 'rejected')->count() }}</h3>
                                <p>Rejected</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Filter Tabs -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="filter-tabs">
                    <ul class="nav nav-pills" id="statusTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="all-tab" data-toggle="pill" href="#all" role="tab">
                                <i class="fa fa-list"></i> All Applications ({{ $applications->count() }})
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pending-tab" data-toggle="pill" href="#pending" role="tab">
                                <i class="fa fa-clock-o"></i> Pending ({{ $applications->where('status', 'pending')->count() }})
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="approved-tab" data-toggle="pill" href="#approved" role="tab">
                                <i class="fa fa-check-circle"></i> Approved ({{ $applications->where('status', 'approved')->count() }})
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="rejected-tab" data-toggle="pill" href="#rejected" role="tab">
                                <i class="fa fa-times-circle"></i> Rejected ({{ $applications->where('status', 'rejected')->count() }})
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Applications Content -->
        <div class="tab-content" id="statusTabsContent">
            <!-- All Applications -->
            <div class="tab-pane fade show active" id="all" role="tabpanel">
                @include('student.courses.partials.applications-list', ['applications' => $applications])
            </div>
            
            <!-- Pending Applications -->
            <div class="tab-pane fade" id="pending" role="tabpanel">
                @include('student.courses.partials.applications-list', ['applications' => $applications->where('status', 'pending')])
            </div>
            
            <!-- Approved Applications -->
            <div class="tab-pane fade" id="approved" role="tabpanel">
                @include('student.courses.partials.applications-list', ['applications' => $applications->where('status', 'approved')])
            </div>
            
            <!-- Rejected Applications -->
            <div class="tab-pane fade" id="rejected" role="tabpanel">
                @include('student.courses.partials.applications-list', ['applications' => $applications->where('status', 'rejected')])
            </div>
        </div>
        
        <!-- Quick Actions -->
        @if($applications->count() > 0)
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="quick-actions-card">
                    <h4><i class="fa fa-bolt"></i> Quick Actions</h4>
                    <div class="quick-actions">
                        <a href="{{ route('student.courses.index') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Apply to More Courses
                        </a>
                        <a href="{{ route('student.courses.favorites') }}" class="btn btn-warning">
                            <i class="fa fa-heart"></i> View Favorites
                        </a>
                        <button class="btn btn-info" onclick="exportApplications()">
                            <i class="fa fa-download"></i> Export Applications
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
/* Applications Stats */
.applications-stats {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.stat-card {
    display: flex;
    align-items: center;
    padding: 20px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.stat-total {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.stat-pending {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    color: white;
}

.stat-approved {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.stat-rejected {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.stat-icon {
    font-size: 24px;
    margin-right: 15px;
    opacity: 0.8;
}

.stat-info h3 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 5px;
}

.stat-info p {
    font-size: 14px;
    margin: 0;
    opacity: 0.9;
}

/* Filter Tabs */
.filter-tabs {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.nav-pills .nav-link {
    border-radius: 25px;
    padding: 10px 20px;
    margin-right: 10px;
    color: #666;
    background: #fff;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
}

.nav-pills .nav-link:hover {
    background: #1a233a;
    color: #495057;
}

.nav-pills .nav-link.active {
    background: #667eea;
    border-color: #667eea;
    color: white;
}

/* Applications List */
.applications-container {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.application-item {
    display: flex;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #eee;
    transition: all 0.3s ease;
}

.application-item:hover {
    background: #f8f9fa;
}

.application-item:last-child {
    border-bottom: none;
}

.course-info {
    flex: 1;
    margin-right: 20px;
}

.course-name {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.course-university {
    color: #666;
    font-size: 14px;
    margin-bottom: 10px;
}

.course-meta {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    font-size: 12px;
    color: #777;
}

.meta-item i {
    margin-right: 5px;
}

.application-status {
    margin-right: 20px;
    text-align: center;
}

.status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: 5px;
}

.status-pending {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.status-approved {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.status-rejected {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.application-date {
    font-size: 11px;
    color: #999;
}

.application-actions {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.application-actions .btn {
    font-size: 12px;
    padding: 5px 12px;
    white-space: nowrap;
}

/* Empty State */
.empty-applications {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.empty-applications i {
    font-size: 48px;
    margin-bottom: 20px;
    opacity: 0.5;
}

.empty-applications h4 {
    margin-bottom: 10px;
}

.empty-applications p {
    margin-bottom: 20px;
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

/* Responsive Design */
@media (max-width: 992px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .application-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .course-info {
        margin-right: 0;
        width: 100%;
    }
    
    .application-status {
        margin-right: 0;
        text-align: left;
    }
    
    .application-actions {
        flex-direction: row;
        width: 100%;
    }
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .nav-pills {
        flex-direction: column;
    }
    
    .nav-pills .nav-link {
        margin-right: 0;
        margin-bottom: 10px;
        text-align: center;
    }
    
    .course-meta {
        flex-direction: column;
        gap: 5px;
    }
    
    .application-actions {
        flex-direction: column;
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
    .applications-stats,
    .filter-tabs,
    .quick-actions-card {
        padding: 15px;
    }
    
    .application-item {
        padding: 15px;
    }
    
    .course-name {
        font-size: 16px;
    }
}
</style>

<script>
$(document).ready(function() {
    // Tab switching with URL hash
    if (window.location.hash) {
        var hash = window.location.hash;
        $('.nav-pills a[href="' + hash + '"]').tab('show');
    }
    
    $('.nav-pills a').on('shown.bs.tab', function(e) {
        window.location.hash = e.target.getAttribute('href');
    });
    
    // Withdraw application
    $('.withdraw-btn').click(function() {
        var applicationId = $(this).data('application-id');
        var row = $(this).closest('.application-item');
        
        if (confirm('Are you sure you want to withdraw this application?')) {
            $.ajax({
                url: '/student/applications/' + applicationId + '/withdraw',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        row.fadeOut(300, function() {
                            row.remove();
                        });
                        showToast('Application withdrawn successfully', 'success');
                        
                        // Update counters
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        showToast(response.message || 'Failed to withdraw application', 'error');
                    }
                },
                error: function() {
                    showToast('An error occurred. Please try again.', 'error');
                }
            });
        }
    });
});

// Export applications
function exportApplications() {
    window.open('/courses/applications/export', '_blank');
    showToast('Exporting your applications...', 'info');
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