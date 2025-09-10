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

<!-- عرض رسالة النجاح -->
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
                <h1>University Details</h1>

                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $university->name }}</td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td>{{ $university->location }}</td>
                    </tr>
                    <tr>
                        <th>Established Year</th>
                        <td>{{ $university->established_year }}</td>
                    </tr>
                    <tr>
                        <th>Website</th>
                        <td>
                            @if ($university->website)
                                <a href="{{ $university->website }}" target="_blank">{{ $university->website }}</a>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $university->description ?? 'N/A' }}</td>
                    </tr>
                </table>

                <a href="{{ route('admin.universities.index') }}" class="btn btn-secondary">Back</a>
            </section>
        </div>
    </div>
@endsection
