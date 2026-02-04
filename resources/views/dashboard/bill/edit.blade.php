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

    <div class="container py-5">
        <div class="card shadow-lg border-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i> Edit Bill
                </h4>
                <a href="{{ route('bill.list') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <div class="card-body">
                <div class="form-container mx-auto" style="max-width: 600px;">
                    <form action="{{ route('bill.update', $bill->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Brand Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Bill No</label>
                            <input type="text" name="bill_no" id="name"
                                class="form-control"
                                placeholder="Enter Bill No"
                                value="{{ old('name', $bill->bill_no) }}" required>
                            @error('name')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Customer Name</label>
                            <select name="customer_id" class="form-control">
                                <option>Select Customer</option>
                                @foreach ($customer as $item)
                                <option value="{{$item->id}}" {{ $item->id==$bill->customer_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach

                            </select>
                            @error('address')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">QTY</label>
                            <input type="number" name="qty" id="qty" value="{{$bill->qty}}" class="form-control" placeholder="Quantity" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" id="price" value="{{$bill->price}}" class="form-control" placeholder="Price" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Total Amount</label>
                            <input type="number" name="total_amount" value="{{$bill->total_amount}}" id="total_amount" class="form-control" readonly>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-dark">
                                <i class="bi bi-check-circle me-2"></i> Update Customer
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