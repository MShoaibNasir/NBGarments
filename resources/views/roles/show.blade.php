@extends('dashboard.layout.master')

@section('content')
<style>
    .card {
        border: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
    }

    .card-header {
        background-color: #000;
        color: #fff;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .card-body {
        background-color: #f8f9fa;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        padding: 30px;
    }

    .info-box {
        background-color: #fff;
        border: 1px solid #000;
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 20px;
    }

    .info-title {
        font-weight: 600;
        color: #000;
        margin-bottom: 8px;
    }

    .info-text {
        color: #333;
        font-size: 16px;
    }

    .badge-permission {
        background-color: #000;
        color: #fff;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.875rem;
        margin: 3px;
        display: inline-block;
    }

    .btn-dark {
        background-color: #000;
        border: none;
    }

    .btn-dark:hover {
        background-color: #333;
    }
</style>

<div class="content">
    @include('dashboard.layout.navbar')

    <div class="container py-4">
        <div class="card shadow-lg border-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-eye me-2"></i> View Role Details</h4>
                <a href="{{ route('roles.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <div class="card-body">
                <div class="info-box">
                    <div class="info-title">Role Name</div>
                    <div class="info-text">{{ $role->name }}</div>
                </div>

                <div class="info-box">
                    <div class="info-title">Permissions</div>
                    <div class="info-text">
                        @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $permission)
                                <span class="badge-permission">{{ ucfirst($permission->name) }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">No permissions assigned.</span>
                        @endif
                    </div>
                </div>

                <div class="text-end mt-3">
                    <a href="{{ route('roles.index') }}" class="btn btn-dark">
                        <i class="bi bi-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
