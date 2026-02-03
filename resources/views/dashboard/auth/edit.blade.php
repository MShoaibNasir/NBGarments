@extends('dashboard.layout.master')

@section('content')
<style>
    .form-container {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
        padding: 40px;
    }

    .form-label {
        font-weight: 600;
        color: #000;
    }

    .form-control {
        border: 1px solid #000;
        border-radius: 8px;
        padding: 10px;
        color: #000;
    }

    .form-control:focus {
        border-color: #000;
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.2);
    }

    .btn-dark {
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        background-color: #52D6E0 !important;
    }
     .btn-dark:hover {
        background-color: #52D6E0 !important;
    }

  

    .card-header {
        background-color: #52D6E0 !important;
        color: #fff;
        border-radius: 8px 8px 0 0;
    }

    .card {
        border: none;
        background-color: #f8f9fa;
    }

    .text-danger.small {
        font-size: 0.85rem;
    }
</style>

<div class="content">
    @include('dashboard.layout.navbar')

    <div class="container py-5">
        <div class="card shadow-lg border-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i> Edit Profile
                </h4>
                <a href="{{ route('brand.list') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <div class="card-body">
                <div class="form-container mx-auto" style="max-width: 600px;">
                    <form action="{{route('user.update',[$user->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Brand Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control"
                                value="{{$user->name}}">
                            @error('name')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Email</label>
                            <input type="text" id="name"
                                class="form-control"
                                value="{{$user->email}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">New Password</label>
                            <input type="password" name="password"
                                class="form-control">
                            @error('password')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Profile Image</label>
                            <input type="file" name="profile"
                                class="form-control">
                            @error('profile')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-dark">
                                <i class="bi bi-check-circle me-2"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection