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

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

    <div class="content">
        @include('dashboard.layout.navbar')

        <div class="container py-4">
            <div class="card shadow-lg border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i> Add New Bill</h4>
                    <a href="{{ route('bill.list') }}" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

                <div class="card-body bg-light">
                    <div class="form-container mx-auto" style="max-width: 600px;">
                        <form action="{{ route('bill.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Bill No</label>
                                <input type="text" name="bill_no" id="name" value="{{ old('bill_no') }}" class="form-control" placeholder="Enter Bill No" required>
                                @error('name')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="link" class="form-label">Customer Name</label>
                                <select name="customer_id" class="form-control">
                                    <option>Select Customer</option>
                                    @foreach ($customer as $item)
                                    <option value="{{$item->id}}">{{ $item->name }}</option>
                                    @endforeach

                                </select>
                                @error('address')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label">QTY</label>
                                <input type="number" name="qty" id="qty" class="form-control" placeholder="Quantity" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" name="price" id="price" class="form-control" placeholder="Price" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Total Amount</label>
                                <input type="number" name="total_amount" id="total_amount" class="form-control" placeholder="Amount" readonly>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-dark">
                                    <i class="bi bi-save me-1"></i> Save Bill
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
            const qtyInput = document.getElementById('qty');
            const priceInput = document.getElementById('price');
            const totalInput = document.getElementById('total_amount');

            function calculateTotal() {
                const qty = parseFloat(qtyInput.value) || 0;
                const price = parseFloat(priceInput.value) || 0;
                totalInput.value = qty * price;
            }

            qtyInput.addEventListener('input', calculateTotal);
            priceInput.addEventListener('input', calculateTotal);
        });
    </script>

    @endsection