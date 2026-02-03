@extends('dashboard.layout.master')

@section('content')
<style>
    /* Hide arrows from number inputs */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
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
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Edit Invoice</h4>
                <a href="{{ route('invoice.filter') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <div class="card-body bg-light">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('invoice.update', $invoice->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Invoice To --}}
                    <div class="mb-4 p-3 bg-white border rounded shadow-sm">
                        <h5 class="border-bottom pb-2 mb-3 text-dark">
                            <i class="bi bi-person-lines-fill me-2"></i>Invoice To
                        </h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">First Name</label>
                                <input type="text" name="first_name" value="{{ old('first_name', $invoice->first_name) }}" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Last Name</label>
                                <input type="text" name="last_name" value="{{ old('last_name', $invoice->last_name) }}" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email Address</label>
                                <input type="email" name="email_address" value="{{ old('email_address', $invoice->email_address) }}" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Phone Number</label>
                                <input type="text" name="phone_number" value="{{ old('phone_number', $invoice->phone_number) }}" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Brand</label>
                                <select name="brand_id" class="form-control">
                                    <option value="">Select Brand</option>
                                    @foreach($brand as $data)
                                        <option value="{{$data->id}}" {{ $data->id == $invoice->brand_id ? 'selected' : '' }}>{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Zip Code</label>
                                <input type="text" name="zip_code" value="{{ old('zip_code', $invoice->zip_code) }}" class="form-control" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Address</label>
                                <input type="text" name="address" value="{{ old('address', $invoice->address) }}" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    {{-- Packages --}}
                    <div class="mb-4 p-3 bg-white border rounded shadow-sm">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <h5 class="text-dark mb-0">
                                <i class="bi bi-box-seam me-2"></i>Packages
                            </h5>
                            <button type="button" id="addPackage" class="btn btn-sm btn-success">
                                <i class="bi bi-plus-circle me-1"></i> Add Package
                            </button>
                        </div>

                        <div id="packageContainer">
                            @foreach($invoice->packages as $pkg)
                                <div class="row align-items-end package-item mb-3">
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label fw-bold">Description</label>
                                        <input type="text" name="packages_description[]" value="{{ $pkg->description ?? '' }}" required class="form-control">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label fw-bold">Amount</label>
                                        <input type="number" name="packages_amount[]" value="{{ $pkg->amount ?? 0 }}" required step="0.01" class="form-control package-amount">
                                    </div>
                                    <div class="col-md-1 text-center mb-3">
                                        <button type="button" class="btn btn-danger btn-sm removePackage" style="margin-top:30px;">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Amount --}}
                    <div class="mb-4 p-3 bg-white border rounded shadow-sm">
                        <h5 class="border-bottom pb-2 mb-3 text-dark">
                            <i class="bi bi-cash-coin me-2"></i>Amount Details
                        </h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Select Currency</label>
                                <select name="currency" class="form-control">
                                    <option>Select Currency</option>
                                    @foreach(['USD','CAD','AUD','GBP'] as $cur)
                                        <option value="{{ $cur }}" {{ $invoice->currency == $cur ? 'selected' : '' }}>{{ $cur }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" id="subtotal" value="{{ $invoice->subtotal ?? 0 }}">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Balance Amount</label>
                                <input type="number" name="balance_amount" id="balAmount" value="{{ $invoice->balance_amount ?? 0 }}" step="0.01" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Discount</label>
                                <input type="number" name="discount" id="discount" value="{{ $invoice->discount ?? 0 }}" step="0.01" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Tax (%)</label>
                                <input type="number" name="tax" id="tax" value="{{ $invoice->tax ?? 0 }}" step="0.01" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Total Amount</label>
                                <input type="number" readonly name="total_amount" id="totalAmount" value="{{ $invoice->total_amount ?? 0 }}" step="0.01" class="form-control bg-light">
                            </div>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark btn-sm px-4">
                            <i class="bi bi-save2 me-1"></i> Update
                        </button>
                        <a href="{{ route('invoice.filter') }}" class="btn btn-outline-secondary btn-sm px-4 ms-2">
                            <i class="bi bi-x-lg me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- JS same as before --}}
<script>
    // (Same JS from your create page, no changes)
    let packageIndex = 1;

    document.getElementById('addPackage').addEventListener('click', function() {
        let container = document.getElementById('packageContainer');
        let newPackage = document.createElement('div');
        newPackage.classList.add('row','align-items-end','package-item','mb-3');
        newPackage.innerHTML = `
            <div class="col-md-8 mb-3">
                <label class="form-label fw-bold">Description</label>
                <input type="text" name="packages_description[]" required class="form-control">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label fw-bold">Amount</label>
                <input type="number" name="packages_amount[]" required step="0.01" class="form-control package-amount">
            </div>
            <div class="col-md-1 text-center mb-3">
                <button type="button" class="btn btn-danger btn-sm removePackage" style="margin-top:30px;">
                    <i class="bi bi-trash"></i>
                </button>
            </div>`;
        container.appendChild(newPackage);
        attachAmountListeners();
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.removePackage')) {
            e.target.closest('.package-item').remove();
            calculateAmounts();
        }
    });

    function calculateAmounts() {
        let subtotal = 0;
        document.querySelectorAll('.package-amount').forEach(function(input) {
            subtotal += parseFloat(input.value) || 0;
        });
        document.getElementById('subtotal').value = subtotal.toFixed(2);
        calculateTotal(subtotal);
    }

    function calculateTotal(subtotal) {
        let discount = parseFloat(document.getElementById('discount').value) || 0;
        let taxPercent = parseFloat(document.getElementById('tax').value) || 0;
        let balanceAmount = parseFloat(document.getElementById('balAmount').value) || 0;
        if (discount > subtotal) discount = subtotal;

        let afterDiscount = subtotal - discount;
        let taxAmount = (afterDiscount * taxPercent) / 100;
        let totalWithTax = afterDiscount + taxAmount - balanceAmount;

        document.getElementById('totalAmount').value = totalWithTax.toFixed(2);
    }

    function attachAmountListeners() {
        document.querySelectorAll('.package-amount').forEach(function(input) {
            input.removeEventListener('input', calculateAmounts);
            input.addEventListener('input', calculateAmounts);
        });
    }

    attachAmountListeners();

    document.getElementById('discount').addEventListener('input', () => calculateAmounts());
    document.getElementById('tax').addEventListener('input', () => calculateAmounts());
    document.getElementById('balAmount').addEventListener('input', () => calculateAmounts());
    document.addEventListener('DOMContentLoaded', () => calculateAmounts());
</script>
@endsection
