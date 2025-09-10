@extends('layout')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5" style="font-weight: bold; color: #333;">Paidprograms</h1>




    <div class="row justify-content-center mb-5">
        <div class="col-md-10">
            <form method="GET" action="{{ route('paidprograms.search') }}">
                <div class="row">
                    <!-- University Dropdown -->
                    <div class="col-md-4 mb-3">
                        <select name="university" class="form-control">
                            <option value="">Select University</option>
                            @foreach($universities as $university)
                                <option value="{{ $university->name }}" {{ request('university') == $university->name ? 'selected' : '' }}>
                                    {{ $university->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
    
 <!-- Type Dropdown -->
                    <div class="col-md-4 mb-3">
                        <select name="type" class="form-control">
                            <option value="">Select Type of PaidPrograms</option>
                            @foreach($type as $types)
                                <option value="{{ $types->type }}" {{ request('types') == $types->type ? 'selected' : '' }}>
                                    {{ $types->type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Country Dropdown -->
                    <div class="col-md-4 mb-3">
                        <select name="place" class="form-control">
                            <option value="">Select Country</option>
                            @foreach($countries as $countries)
                                <option value="{{ $countries->country }}" {{ request('place') == $countries->country ? 'selected' : '' }}>
                                    {{ $countries->country }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" style="background-color: #ffc107; color: #fff; border-radius: 25px; padding: 10px 30px; font-weight: bold;" value="Search">
                </div>
            </form>
        </div>
    </div>





    <div class="row">
        @forelse($paidprograms as $paidprogram)
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card scholarship-card">
                <!-- Card Header -->
                <div class="card-header scholarship-card-header d-flex justify-content-between align-items-center">
                    <span>{{ $paidprogram->name }}</span>
                    @if(Auth::guard('student')->check())
                        <div class="favorite-btn {{ in_array($paidprogram->id, $favoritePaidProgramIds) ? 'active' : '' }}" data-paidprogram-id="{{ $paidprogram->id }}">
                            <i class="fa {{ in_array($paidprogram->id, $favoritePaidProgramIds) ? 'fa-heart' : 'fa-heart-o' }}"></i>
                        </div>
                    @endif
                </div>
                <!-- Card Body -->
                <div class="card-body scholarship-card-body">
                    <p><strong>Description:</strong> {{ Str::limit($paidprogram->description, 100) }}</p>
                    <p><strong>Country:</strong> {{ $paidprogram->country }}</p>
                    <p><strong>Type PaidPrograms:</strong> {{ $paidprogram->type }}</p>
                    <p><strong>University Name:</strong> {{ $paidprogram->university->name }}</p>
                    <p><strong>Cost:</strong> {{ $paidprogram->cost ? '$' . $paidprogram->cost : 'N/A' }}</p>
                    <p><strong>start_date:</strong> {{ $paidprogram->start_date }}</p>
                    <p><strong>end_date:</strong> {{ $paidprogram->end_date }}</p>
                </div>
                <!-- Card Footer -->
                <div class="card-footer scholarship-card-footer">
                    <!-- إذا كانت هناك رسالة نجاح -->
<!-- عرض رسالة الخطأ -->
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- عرض رسالة النجاح -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

                    @auth('student')
                    <div class="d-flex justify-content-between">
                        @if(auth('student')->user()->is_blocked)
                            <button class="scholarship-apply-btn" disabled style="background-color: #ccc; cursor: not-allowed;" title="Your account is blocked">Account Blocked</button>
                        @else
                            <form action="{{ route('submitPaidProgramRequest') }}" method="POST" class="mr-2">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ auth('student')->user()->id }}">
                                <input type="hidden" name="paid_program_id" value="{{ $paidprogram->id }}">
                                <input type="submit" value="Apply Now" class="scholarship-apply-btn">
                            </form>
                        @endif
                        

                    </div>
                        
                    @else
                        <a href="#" class="scholarship-login-btn" data-toggle="modal" data-target="#login" title="​Please login">Login to Apply</a>
                    @endauth
                </div>
            </div>
        </div>
        @empty
        <p class="text-center">No paidprograms found matching your criteria.</p>
        @endforelse
    </div>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Favorite toggle for paid programs
    $('.favorite-btn').click(function(e) {
        e.preventDefault();
        var paidProgramId = $(this).data('paidprogram-id');
        var btn = $(this);
        
        $.ajax({
            url: '/paidprograms/' + paidProgramId + '/toggle-favorite',
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
            error: function(xhr, status, error) {
                showToast('An error occurred. Please try again.', 'error');
            }
        });
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

<style>
.favorite-btn {
    cursor: pointer;
    padding: 8px;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.favorite-btn:hover {
    transform: scale(1.1);
}

.favorite-btn.active i {
    color: #dc3545;
}

.favorite-btn i {
    font-size: 18px;
    color: white;
    transition: color 0.3s ease;
}
</style>

@endsection