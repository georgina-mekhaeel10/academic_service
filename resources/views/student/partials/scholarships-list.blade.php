<div class="applications-container">
    @forelse($scholarships as $scholarship)
        <div class="application-item" data-scholarship-id="{{ $scholarship->id }}">
            <div class="course-info">
                <h5 class="course-name">{{ $scholarship->scholarship->name }}</h5>
                <p class="course-university">
                    <i class="fa fa-university"></i> {{ $scholarship->scholarship->university->name ?? 'N/A' }}
                </p>
                <div class="course-meta">
                    <div class="meta-item">
                        <i class="fa fa-tag"></i>
                        <span class="badge badge-scholarship">Scholarship</span>
                    </div>
                    <div class="meta-item">
                        <i class="fa fa-signal"></i>
                        <span class="badge badge-{{ $scholarship->scholarship->level }}">{{ ucfirst($scholarship->scholarship->level) }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fa fa-map-marker"></i>
                        <span>{{ $scholarship->scholarship->country }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fa fa-dollar"></i>
                        <span>
                            @if($scholarship->scholarship->amount)
                                ${{ number_format($scholarship->scholarship->amount, 2) }}
                            @else
                                Full Coverage
                            @endif
                        </span>
                    </div>
                    <div class="meta-item">
                        <i class="fa fa-calendar"></i>
                        <span>{{ date('M d, Y', strtotime($scholarship->scholarship->deadline)) }}</span>
                    </div>
                </div>
            </div>
            
            <div class="application-status">
                <span class="status-badge status-{{ $scholarship->status }}">
                    @if($scholarship->status == 'pending')
                        <i class="fa fa-clock-o"></i> Pending
                    @elseif($scholarship->status == 'approved')
                        <i class="fa fa-check-circle"></i> Approved
                    @elseif($scholarship->status == 'rejected')
                        <i class="fa fa-times-circle"></i> Rejected
                    @endif
                </span>
                <div class="application-date">
                    Applied {{ $scholarship->created_at->diffForHumans() }}
                </div>
            </div>
            
            <div class="application-actions">
                @if($scholarship->scholarship)
                    <a href="{{ route('scholarship.show', $scholarship->scholarship->scholarships_ID) }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-eye"></i> View Scholarship
                    </a>
                @endif
                
                @if($scholarship->status == 'pending')
                    <button class="btn btn-danger btn-sm withdraw-btn" data-scholarship-id="{{ $scholarship->id }}">
                        <i class="fa fa-times"></i> Withdraw
                    </button>
                @endif
                
                @if($scholarship->status == 'approved')
                    <span class="btn btn-success btn-sm" disabled>
                        <i class="fa fa-graduation-cap"></i> Awarded
                    </span>
                @endif
                
                @if($scholarship->notes)
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#notesModal{{ $scholarship->id }}">
                        <i class="fa fa-comment"></i> Notes
                    </button>
                @endif
            </div>
        </div>
        
        <!-- Notes Modal -->
        @if($scholarship->notes)
        <div class="modal fade" id="notesModal{{ $scholarship->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-comment"></i> Scholarship Request Notes
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Scholarship: {{ $scholarship->scholarship->name }}</h6>
                        <hr>
                        <div class="notes-content">
                            {!! nl2br(e($scholarship->notes)) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @empty
        <div class="empty-applications">
            <i class="fa fa-graduation-cap"></i>
            <h4>No Scholarship Requests Found</h4>
            <p>You haven't applied to any scholarships yet.</p>
            <a href="{{ route('scholarships.index') }}" class="btn btn-primary">
                <i class="fa fa-search"></i> Browse Scholarships
            </a>
        </div>
    @endforelse
</div>

<style>
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

/* Badge Styling */
.badge-scholarship {
    background-color: #6f42c1;
    color: white;
}

.badge-beginner {
    background-color: #6f42c1;
    color: white;
}

.badge-intermediate {
    background-color: #fd7e14;
    color: white;
}

.badge-advanced {
    background-color: #dc3545;
    color: white;
}

/* Notes Modal Styling */
.notes-content {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 5px;
    border-left: 4px solid #007bff;
    line-height: 1.6;
}

.modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.modal-header .close {
    color: white;
    opacity: 0.8;
}

.modal-header .close:hover {
    opacity: 1;
}

/* Responsive Design */
@media (max-width: 992px) {
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
    .course-meta {
        flex-direction: column;
        gap: 5px;
    }
    
    .application-actions {
        flex-direction: column;
    }
}

@media (max-width: 576px) {
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
    // Withdraw scholarship request
    $('.withdraw-btn').click(function() {
        var scholarshipId = $(this).data('scholarship-id');
        var row = $(this).closest('.application-item');
        
        if (confirm('Are you sure you want to withdraw this scholarship request?')) {
            $.ajax({
                url: '/student/scholarship-requests/' + scholarshipId + '/withdraw',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        row.fadeOut(300, function() {
                            row.remove();
                        });
                        showToast('Scholarship request withdrawn successfully', 'success');
                        
                        // Update counters
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        showToast(response.message || 'Failed to withdraw scholarship request', 'error');
                    }
                },
                error: function() {
                    showToast('An error occurred. Please try again.', 'error');
                }
            });
        }
    });
});

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