@extends('dashboard.layout.master')

@section('content')
<style>
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        background: #fff;
    }

    .card-header {
        background-color: #000;
        color: #fff;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 15px 25px;
    }

    .card-body {
        padding: 25px;
        background-color: #f9f9f9;
    }

    .detail-label {
        font-weight: 600;
        color: #333;
    }

    .detail-value {
        font-size: 15px;
        color: #555;
    }

    .badge {
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 13px;
    }

    .btn-back {
        background-color: #000;
        color: #fff;
        border-radius: 8px;
        padding: 6px 12px;
    }

    .btn-back:hover {
        background-color: #333;
        color: #fff;
    }
</style>

<div class="content">
    @include('dashboard.layout.navbar')

    <div class="container py-4">
        <div class="card shadow-lg border-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-person-circle me-2"></i> User Details</h4>
                <a class="btn btn-back btn-sm" href="{{ route('users.index') }}">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="detail-label mb-1">Name:</p>
                        <p class="detail-value">{{ $user->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="detail-label mb-1">Email:</p>
                        <p class="detail-value">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p class="detail-label mb-2">Roles:</p>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <span class="badge bg-success">{{ $v }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">No roles assigned</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
