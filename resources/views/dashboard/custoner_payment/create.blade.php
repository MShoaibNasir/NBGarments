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
            border-color: #1edae8;
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
        h4.mb-0 {
            color: white;
        }
            </style>

    <div class="content">
        @include('dashboard.layout.navbar')

        <div class="container py-4">
            <div class="card shadow-lg border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i> Add New Payment</h4>
                    <a href="{{ route('customer.list') }}" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

                <div class="card-body bg-light">
                    <div class="form-container mx-auto" style="max-width: 600px;">
                        <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Customer Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Enter name" required>
                                @error('name')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="link" class="form-label">Address</label>
                                <input type="text" name="address"  value="{{ old('address') }}" class="form-control">
                                @error('address')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-dark">
                                    <i class="bi bi-save me-1"></i> Save Customer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
