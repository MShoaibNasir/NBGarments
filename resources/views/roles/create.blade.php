@extends('dashboard.layout.master')

@section('content')
<style>
    /* Form styling */
    .form-container {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
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
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.25);
    }

    .btn-dark {
        background-color: #000;
        border: none;
    }

    .btn-dark:hover {
        background-color: #333;
    }

    .card-header {
        background-color: #000;
        color: #fff;
    }

    .checkbox-group {
        border: 1px solid #000;
        border-radius: 8px;
        padding: 15px;
        background-color: #f8f9fa;
        max-height: 300px;
        overflow-y: auto;
    }

    .checkbox-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #000;
    }

    .text-danger {
        font-size: 0.875rem;
    }
</style>

<div class="content">
    @include('dashboard.layout.navbar')

    <div class="container py-4">
        <div class="card shadow-lg border-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-shield-lock me-2"></i> Create New Role</h4>
                <a href="{{ route('roles.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <div class="card-body bg-light">
                <div class="form-container mx-auto" style="max-width: 700px;">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Please fix the following errors:
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Role Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Enter role name" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Assign Permissions</label>
                            <div class="checkbox-group">
                                @foreach($permission as $value)
                                    <label>
                                        <input type="checkbox" name="permission[{{ $value->id }}]" value="{{ $value->id }}">
                                        {{ ucfirst($value->name) }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-dark">
                                <i class="bi bi-save me-1"></i> Save Role
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
