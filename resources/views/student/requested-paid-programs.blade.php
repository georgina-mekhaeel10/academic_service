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
                                <i class="fa fa-credit-card"></i>
                            </div>
                            <div class="stat-info">
                                <h3>{{ $paidPrograms->count() }}</h3>
                                <p>Total Program Requests</p>
                            </div>
                        </div>
                        
                        <div class="stat-card stat-pending">
                            <div class="stat-icon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <div class="stat-info">
                                <h3>{{ $paidPrograms->where('status', 'pending')->count() }}</h3>
                                <p>Pending Review</p>
                            </div>
                        </div>
                        
                        <div class="stat-card stat-approved">
                            <div class="stat-icon">
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <div class="stat-info">
                                <h3>{{ $paidPrograms->where('status', 'approved')->count() }}</h3>
                                <p>Approved</p>
                            </div>
                        </div>
                        
                        <div class="stat-card stat-rejected">
                            <div class="stat-icon">
                                <i class="fa fa-times-circle"></i>
                            </div>
                            <div class="stat-info">
                                <h3>{{ $paidPrograms->where('status', 'rejected')->count() }}</h3>
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
                                <i class="fa fa-list"></i> All Requests ({{ $paidPrograms->count() }})
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pending-tab" data-toggle="pill" href="#pending" role="tab">
                                <i class="fa fa-clock-o"></i> Pending ({{ $paidPrograms->where('status', 'pending')->count() }})
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="approved-tab" data-toggle="pill" href="#approved" role="tab">
                                <i class="fa fa-check-circle"></i> Approved ({{ $paidPrograms->where('status', 'approved')->count() }})
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="rejected-tab" data-toggle="pill" href="#rejected" role="tab">
                                <i class="fa fa-times-circle"></i> Rejected ({{ $paidPrograms->where('status', 'rejected')->count() }})
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Paid Programs Content -->
        <div class="tab-content" id="statusTabsContent">
            <!-- All Paid Programs -->
            <div class="tab-pane fade show active" id="all" role="tabpanel">
                @include('student.partials.paid-programs-list', ['paidPrograms' => $paidPrograms])
            </div>
            
            <!-- Pending Paid Programs -->
            <div class="tab-pane fade" id="pending" role="tabpanel">
                @include('student.partials.paid-programs-list', ['paidPrograms' => $paidPrograms->where('status', 'pending')])
            </div>
            
            <!-- Approved Paid Programs -->
            <div class="tab-pane fade" id="approved" role="tabpanel">
                @include('student.partials.paid-programs-list', ['paidPrograms' => $paidPrograms->where('status', 'approved')])
            </div>
            
            <!-- Rejected Paid Programs -->
            <div class="tab-pane fade" id="rejected" role="tabpanel">
                @include('student.partials.paid-programs-list', ['paidPrograms' => $paidPrograms->where('status', 'rejected')])
            </div>
        </div>
        
        <!-- Quick Actions -->
        @if($paidPrograms->count() > 0)
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="quick-actions-card">
                    <h4><i class="fa fa-bolt"></i> Quick Actions</h4>
                    <div class="quick-actions">
                        <a href="{{ route('paidprograms.index') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Apply to More Programs
                        </a>
                        <button class="btn btn-info" onclick="exportPaidPrograms()">
                            <i class="fa fa-download"></i> Export Requests
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
});

// Export paid programs
function exportPaidPrograms() {
    showToast('Exporting your paid program requests...', 'info');
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