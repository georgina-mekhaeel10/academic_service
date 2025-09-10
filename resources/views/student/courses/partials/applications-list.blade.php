<div class="applications-container">
    @forelse($applications as $application)
        <div class="application-item" data-application-id="{{ $application->id }}">
            <div class="course-info">
                <h5 class="course-name">{{ $application->course->name }}</h5>
                <p class="course-university">
                    <i class="fa fa-university"></i> {{ $application->course->university->name ?? 'N/A' }}
                </p>
                <div class="course-meta">
                    <div class="meta-item">
                        <i class="fa fa-tag"></i>
                        <span class="badge badge-{{ $application->course->type }}">{{ ucfirst($application->course->type) }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fa fa-signal"></i>
                        <span class="badge badge-{{ $application->course->level }}">{{ ucfirst($application->course->level) }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fa fa-map-marker"></i>
                        <span>{{ $application->course->country }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fa fa-dollar"></i>
                        <span>
                            @if($application->course->cost == 0 || $application->course->cost == null)
                                Free
                            @else
                                ${{ number_format($application->course->cost, 2) }}
                            @endif
                        </span>
                    </div>
                    <div class="meta-item">
                        <i class="fa fa-calendar"></i>
                        <span>{{ date('M d, Y', strtotime($application->course->start_date)) }}</span>
                    </div>
                </div>
            </div>
            
            <div class="application-status">
                <span class="status-badge status-{{ $application->status }}">
                    @if($application->status == 'pending')
                        <i class="fa fa-clock-o"></i> Pending
                    @elseif($application->status == 'approved')
                        <i class="fa fa-check-circle"></i> Approved
                    @elseif($application->status == 'rejected')
                        <i class="fa fa-times-circle"></i> Rejected
                    @endif
                </span>
                <div class="application-date">
                    Applied {{ $application->applied_at ? $application->applied_at->diffForHumans() : $application->created_at->diffForHumans() }}
                </div>
            </div>
            
            <div class="application-actions">
                <a href="{{ route('student.courses.show', $application->course->id) }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-eye"></i> View Course
                </a>
                
                @if($application->status == 'pending')
                    <button class="btn btn-danger btn-sm withdraw-btn" data-application-id="{{ $application->id }}">
                        <i class="fa fa-times"></i> Withdraw
                    </button>
                @endif
                
                @if($application->status == 'approved')
                    <span class="btn btn-success btn-sm" disabled>
                        <i class="fa fa-graduation-cap"></i> Enrolled
                    </span>
                @endif
                
                @if($application->notes)
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#notesModal{{ $application->id }}">
                        <i class="fa fa-comment"></i> Notes
                    </button>
                @endif
            </div>
        </div>
        
        <!-- Notes Modal -->
        @if($application->notes)
        <div class="modal fade" id="notesModal{{ $application->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-comment"></i> Application Notes
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Course: {{ $application->course->name }}</h6>
                        <hr>
                        <div class="notes-content">
                            {!! nl2br(e($application->notes)) !!}
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
            <i class="fa fa-file-text-o"></i>
            <h4>No Applications Found</h4>
            <p>You haven't applied to any courses yet.</p>
            <a href="{{ route('student.courses.index') }}" class="btn btn-primary">
                <i class="fa fa-search"></i> Browse Courses
            </a>
        </div>
    @endforelse
</div>

<style>
/* Badge Styling for Course Types */
.badge-online {
    background-color: #28a745;
    color: white;
}

.badge-offline {
    background-color: #ffc107;
    color: #212529;
}

.badge-hybrid {
    background-color: #17a2b8;
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
</style>