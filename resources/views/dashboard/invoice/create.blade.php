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

<div class="content">
    @include('dashboard.layout.navbar')

    <div class="container py-4">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i> Add New Invoice</h4>
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

                <form method="POST" action="{{ route('invoice.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Invoice To --}}
                    <div class="mb-4 p-3 bg-white border rounded shadow-sm">
                        <h5 class="border-bottom pb-2 mb-3 text-dark">
                            <i class="bi bi-person-lines-fill me-2"></i>Invoice To
                        </h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">First Name</label>
                                <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control" placeholder="Enter First Name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Last Name</label>
                                <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control" placeholder="Enter Last Name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email Address</label>
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter Email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Phone Number</label>
                                <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Enter Phone Number" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Brand</label>
                                <select name="brand_id" class="form-control">
                                    <option value="">Select Brand</option>
                                    @foreach($brand as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Zip Code</label>
                                <input type="text" name="zipcode" value="{{old('zipcode')}}" class="form-control" placeholder="Enter Zipcode" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Address</label>
                                <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="Enter Address" required>
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
                            <div class="row align-items-end package-item mb-3">
                                <div class="col-md-8 mb-3">
                                    <label class="form-label fw-bold">Description</label>
                                    <input type="text" required name="packages_description[]" class="form-control" placeholder="Enter Description">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Amount</label>
                                    <input type="number" required name="packages_amount[]" step="0.01" class="form-control package-amount" placeholder="Enter Amount">
                                </div>
                                <div class="col-md-1 text-center mb-3">
                                    <button type="button" class="btn btn-danger btn-sm removePackage" style="margin-top:30px;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
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
                                    <option value="USD">USD</option>
                                    <option value="CAD">CAD</option>
                                    <option value="AUD">AUD</option>
                                    <option value="GBP">GBP</option>
                                </select>
                            </div>
                            <input type="hidden" readonly value="{{old('subtotal')}}" step="0.01" class="form-control bg-light" id="subtotal" placeholder="Auto Calculated">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Balance Amount</label>
                                <input type="number" name="balance_amount" value="{{old('balance_amount')}}" step="0.01" class="form-control bg-light" id="balAmount" placeholder="Balance Amount">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Discount</label>
                                <input type="number" name="discount" value="{{old('discount')}}" step="0.01" class="form-control" id="discount" placeholder="Discount Amount">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Tax (%)</label>
                                <input type="number" name="tax" step="0.01" value="{{old('tax')}}" class="form-control" id="tax" placeholder="Tax Percentage">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Total Amount</label>
                                <input type="number" readonly name="total_amount" value="{{old('total_amount')}}" step="0.01" class="form-control bg-light" id="totalAmount" placeholder="Auto Calculated">
                            </div>

                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark btn-sm px-4">
                            <i class="bi bi-save2 me-1"></i> Submit
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

{{-- JavaScript --}}
<script>
        document.addEventListener('DOMContentLoaded', function() {
        const numberInputs = document.querySelectorAll('input[type="number"]');

        numberInputs.forEach(input => {
            input.addEventListener('input', function() {
                // Remove any non-numeric characters except for allowed ones (like '.', '+', '-')
                // This regex removes anything that is NOT a digit, a period, a plus sign, or a minus sign.
                // It also specifically disallows 'e' or 'E'.
                this.value = this.value.replace(/[^0-9.+-]|e|E/g, '');
            });

            // Optional: Prevent specific keys during keydown
            input.addEventListener('keydown', function(event) {
                // Allow backspace, tab, escape, enter, and arrow keys
                if ([8, 9, 27, 13, 37, 38, 39, 40].indexOf(event.keyCode) !== -1 ||
                    // Allow Ctrl/Cmd+A, Ctrl/Cmd+C, Ctrl/Cmd+V, Ctrl/Cmd+X
                    ((event.ctrlKey || event.metaKey) && ['a', 'c', 'v', 'x'].includes(event.key.toLowerCase()))) {
                    return; // Let the event happen
                }
                // Disallow 'i' or 'I'
                if (event.key.toLowerCase() === 'i') {
                    event.preventDefault();
                }
                // Optionally disallow 'e' or 'E' if not desired for scientific notation
                // if (event.key.toLowerCase() === 'e') {
                //     event.preventDefault();
                // }
                // Optionally disallow other characters that are not digits or allowed symbols
                // if (!/[0-9.+-]/.test(event.key) && event.key.length === 1) {
                //     event.preventDefault();
                // }
            });
        });
    });
    let packageIndex = 1;

    // Add new package
    document.getElementById('addPackage').addEventListener('click', function() {
        let container = document.getElementById('packageContainer');
        let newPackage = document.createElement('div');
        newPackage.classList.add('row', 'align-items-end', 'package-item', 'mb-3');
        newPackage.innerHTML = `
            <div class="col-md-8 mb-3">
                <label class="form-label fw-bold">Description</label>
                <input type="text" name="packages_description[]" required class="form-control" placeholder="Enter Description">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label fw-bold">Amount</label>
                <input type="number" name="packages_amount[]" required step="0.01" class="form-control package-amount" placeholder="Enter Amount">
            </div>
            <div class="col-md-1 text-center mb-3">
                <button type="button" class="btn btn-danger btn-sm removePackage" style="margin-top:30px;">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(newPackage);
        packageIndex++;

        attachAmountListeners();
    });

    // Remove package
    document.addEventListener('click', function(e) {
        if (e.target.closest('.removePackage')) {
            e.target.closest('.package-item').remove();
            calculateAmounts();
        }
    });

    // Calculate all amounts
    function calculateAmounts() {
        let subtotal = 0;

        document.querySelectorAll('.package-amount').forEach(function(input) {
            subtotal += parseFloat(input.value) || 0;
        });

        document.getElementById('subtotal').value = subtotal.toFixed(2);

        calculateTotal(subtotal);
    }

    // Calculate total with discount, tax, and balance
    function calculateTotal(subtotal) {
    let discount = parseFloat(document.getElementById('discount').value) || 0;
    let taxPercent = parseFloat(document.getElementById('tax').value) || 0;
    let balanceAmount = parseFloat(document.getElementById('balAmount').value) || 0;

    // Ensure discount doesn't exceed subtotal
    if (discount > subtotal) {
        discount = subtotal;
        document.getElementById('discount').value = discount;
    }

    // Step 1: Apply discount
    let amountAfterDiscount = subtotal - discount;

    // Step 2: Calculate tax (20% of amountAfterDiscount)
    let taxAmount = (amountAfterDiscount * taxPercent) / 100;

    // Step 3: Add tax
    let totalWithTax = amountAfterDiscount + taxAmount;

    // Step 4: Subtract balance (if entered)
    if (balanceAmount > 0) {
        totalWithTax -= balanceAmount;
    }

    // Final total
    document.getElementById('totalAmount').value = totalWithTax.toFixed(2);
}



    // Attach listeners
    function attachAmountListeners() {
        document.querySelectorAll('.package-amount').forEach(function(input) {
            input.removeEventListener('input', calculateAmounts);
            input.addEventListener('input', calculateAmounts);
        });
    }

    attachAmountListeners();

    document.getElementById('discount').addEventListener('input', function() {
        let subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
        calculateTotal(subtotal);
    });

    document.getElementById('tax').addEventListener('input', function() {
        let subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
        calculateTotal(subtotal);
    });

    // ✅ Listen for balance amount input
    document.getElementById('balAmount').addEventListener('input', function() {
        let subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
        calculateTotal(subtotal);
    });

    // Initial calculation on page load
    document.addEventListener('DOMContentLoaded', function() {
        calculateAmounts();
    });
</script>

@endsection