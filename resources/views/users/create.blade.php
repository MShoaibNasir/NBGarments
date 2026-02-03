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
        background-color: #1edae8;
        border: none;
    }
    .btn-dark:hover {
        background-color: #1edae8;
    }
    .card-header {
        background-color: #1edae8;
        color: #fff;
    }
    
    /* Password toggle styles */
    .password-input-group {
        position: relative;
    }
    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #666;
        cursor: pointer;
        padding: 0;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .password-toggle:hover {
        color: #000;
    }
    .password-toggle:focus {
        outline: none;
    }
     h4.mb-0 {
            color: white;
        }
</style>

<div class="content">
    @include('dashboard.layout.navbar')
    <div class="container py-4">
        <div class="card shadow-lg border-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i> Create New User</h4>
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
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter full name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter email" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="password-input-group">
                                    <input type="password" name="password" id="password" placeholder="Enter password" class="form-control" required>
                                    <button type="button" class="password-toggle" data-target="password">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <div class="password-input-group">
                                    <input type="password" name="confirm-password" id="confirm-password" placeholder="Re-enter password" class="form-control" required>
                                    <button type="button" class="password-toggle" data-target="confirm-password">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="roles" class="form-label">Assign Roles</label>
                            <select name="roles[]" id="roles" class="form-control" multiple>
                                @foreach ($roles as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple roles.</small>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-dark">
                                <i class="bi bi-save me-1"></i> Save User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password toggle functionality
        const toggleButtons = document.querySelectorAll('.password-toggle');
        
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const icon = this.querySelector('i');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });
    });
</script>
@endsection