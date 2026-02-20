    @extends('dashboard.layout.master')
    @section('content')

    <style>
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

        .card-header {
            background-color: #1edae8;
            color: #fff;
        }

        h4.mb-0 {
            color: white;
        }

        /* Chrome, Safari, Edge, Opera */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
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
                    <h4 class="mb-0">Add New Payment</h4>
                    <a href="{{ route('payment.list') }}" class="btn btn-outline-light btn-sm">Back</a>
                </div>

                <div class="card-body bg-light">
                    <div class="form-container mx-auto" style="max-width: 600px;">

                        <form action="{{ route('payment.store') }}" method="POST">
                            @csrf

                            {{-- Customer --}}
                            <div class="mb-3">
                                <label class="form-label">Customer Name</label>
                                <select name="customer_id" class="form-control" required>
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Amount --}}
                            <div class="mb-3">
                                <label class="form-label">Amount</label>
                                <input type="number" name="amount" class="form-control" placeholder="Enter Amount" required>
                            </div>

                            {{-- Reference --}}
                            <div class="mb-3">
                                <label class="form-label">Reference</label>
                                <input type="text" name="reference" class="form-control" placeholder="Optional">
                            </div>
                            {{-- description --}}
                            <div class="mb-3">
                                <label class="form-label">Description</label><br>
                                <textarea name="description" id="description" class="form-control" placeholder="Enter Description (optional)"></textarea>
                            </div>


                            {{-- Is Cheque --}}
                            <div class="mb-3">
                                <label class="form-label">Is Cheque</label><br>
                                <input type="checkbox" id="is_cheque" name="is_cheque" value="1">
                            </div>

                            {{-- Cheque Fields --}}
                            <div id="chequeFields" style="display:none;">

                                <div class="mb-3">
                                    <label class="form-label">Bank Name</label>
                                    <select name="bank_id" id="bank_id" class="form-control">
                                        <option value="">Select Bank</option>
                                        @foreach($banks as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Cheque No</label>
                                    <input type="text" name="cheque_no" id="cheque_no" class="form-control" placeholder="Enter Cheque No">
                                </div>

                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-dark">Save Payment</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script --}}
    <script>
        const checkbox = document.getElementById('is_cheque');
        const chequeFields = document.getElementById('chequeFields');
        const bankField = document.getElementById('bank_id');
        const chequeNoField = document.getElementById('cheque_no');

        checkbox.addEventListener('change', function() {

            if (this.checked) {
                chequeFields.style.display = 'block';

                // Make required
                bankField.required = true;
                chequeNoField.required = true;

            } else {
                chequeFields.style.display = 'none';

                // Remove required
                bankField.required = false;
                chequeNoField.required = false;
            }
        });

        // Maintain state on reload
        window.onload = function() {
            if (checkbox.checked) {
                chequeFields.style.display = 'block';
                bankField.required = true;
                chequeNoField.required = true;
            }
        };
    </script>

    @endsection