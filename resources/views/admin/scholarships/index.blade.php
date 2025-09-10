@extends('admin.admin_master')

@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">All Scholarships</h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Cost</th>
                                            <th>Type</th>
                                            <th>Funding Type</th>
                                            <th>Country</th>
                                            <th>University</th>
                                            <th>Application URL</th>
                                            @if(request()->has('view'))
                                                <th>Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($scholarships as $scholarship)
                                            <tr>
                                                <td><strong>{{ $scholarship->name }}</strong></td>
                                                <td>{{ Str::limit($scholarship->description, 50) }}</td>
                                                <td><span class="text-info" style="color: #FFF !important">{{ $scholarship->start_date }}</span></td>
                                                <td><span class="text-warning">{{ $scholarship->end_date }}</span></td>
                                                <td><span class="text-success">{{ $scholarship->cost ?? 'N/A' }}</span></td>
                                                <td><span class="badge badge-info">{{ $scholarship->type }}</span></td>
                                                <td><span class="badge badge-secondary">{{ $scholarship->funding_type }}</span></td>
                                                <td><span class="text-primary">{{ $scholarship->country }}</span></td>
                                                <td><span class="text-dark">{{ $scholarship->university->name ?? 'N/A' }}</span></td>
                                                <td>
                                                    @if($scholarship->application_url)
                                                        <a href="{{ $scholarship->application_url }}" target="_blank" class="btn btn-link btn-sm">
                                                            <i class="fa fa-external-link"></i> Apply
                                                        </a>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                @if(request()->has('view'))
                                                    <td>
                                                        <div class="btn-group">
                                                            @if(request()->get('view') == 'edit')
                                                                <a href="{{ route('admin.scholarships.edit', $scholarship->scholarships_ID) }}" class="btn btn-info btn-sm">
                                                                    <i class="fa fa-edit"></i> Edit
                                                                </a>
                                                            @elseif(request()->get('view') == 'delete')
                                                                <form action="{{ route('admin.scholarships.destroy', $scholarship->scholarships_ID) }}" method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this scholarship?')">
                                                                        <i class="fa fa-trash"></i> Delete
                                                                    </button>
                                                                </form>
                                                            @elseif(request()->get('view') == 'show')
                                                                <a href="{{ route('admin.scholarships.show', $scholarship->scholarships_ID) }}" class="btn btn-primary btn-sm">
                                                                    <i class="fa fa-eye"></i> View
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>



<style>
.box {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.box-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px 20px;
    border-radius: 8px 8px 0 0;
    border-bottom: 1px solid #e0e0e0;
}

.box-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.box-body {
    padding: 20px;
}

.table {
    margin-bottom: 0;
}

.table thead th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 12px 8px;
    font-weight: 600;
    text-align: center;
}

.table tbody tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.table tbody td {
    padding: 12px 8px;
    vertical-align: middle;
    border-color: #e9ecef;
}

.btn-group .btn {
    margin-right: 5px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.btn-group .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.badge {
    font-size: 12px;
    padding: 6px 10px;
    border-radius: 20px;
}

.modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.badge-secondary {
    background-color: #28A777 !important;
}
.btn-link {
    background-color: #1a233a !important;
    border-color: #1a233a !important;
}
.text-dark {
    color: #FFF !important;
}

@media (max-width: 768px) {
    .box-header {
        padding: 10px 15px;
    }
    
    .box-header h3 {
        font-size: 16px;
    }
    
    .btn-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .btn-group .btn {
        margin-right: 0;
        margin-bottom: 5px;
    }
}
</style>

<script>
$(document).ready(function() {
    $('#example1').DataTable({
        'responsive': true,
        'lengthChange': false,
        'autoWidth': false,
        'searching': false,
        'ordering': false,
        'info': true,
        'paging': true,
        'pageLength': 10,
        'language': {
            'search': 'Search:',
            'lengthMenu': 'Show _MENU_ entries',
            'info': 'Showing _START_ to _END_ of _TOTAL_ entries',
            'infoEmpty': 'Showing 0 to 0 of 0 entries',
            'infoFiltered': '(filtered from _MAX_ total entries)',
            'paginate': {
                'first': 'First',
                'last': 'Last',
                'next': 'Next',
                'previous': 'Previous'
            }
        }
    });
    
    // Set default dates
    const today = new Date();
    const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
    const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
    
    document.getElementById('start_date').valueAsDate = firstDay;
    document.getElementById('end_date').valueAsDate = lastDay;
    
    // Delete confirmation
    $('.btn-danger').on('click', function(e) {
        if (!confirm('Are you sure you want to delete this scholarship?')) {
            e.preventDefault();
        }
    });
});
</script>
@endsection
