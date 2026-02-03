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

    <div class="container py-4">
        <div class="card shadow-lg border-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Edit User</h4>
                <a href="{{ route('users.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <div class="card-body bg-light">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-container mx-auto" style="max-width: 700px;">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name"
                                   value="{{ old('name', $user->name) }}"
                                   placeholder="Enter full name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email"
                                   value="{{ old('email', $user->email) }}"
                                   placeholder="Enter email" readonly class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password"
                                       placeholder="Leave blank to keep current password"
                                       class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm-password" id="confirm-password"
                                       placeholder="Re-enter password" class="form-control">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="roles" class="form-label">Assign Roles</label>
                            <select name="roles[]" id="roles" class="form-control" multiple>
                                @foreach ($roles as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ in_array($label, $userRole) ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple roles.</small>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-dark">
                                <i class="bi bi-save me-1"></i> Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
