@extends('dashboard.layout.master')
@section('content')

<style>
    .form-container {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .form-label { font-weight: 600; color: #000; }

    .form-control {
        border: 1px solid #000;
        border-radius: 8px;
        padding: 10px;
        color: #000;
    }

    .btn-dark { background-color: #1edae8; border: none; }

    .card-header { background-color: #1edae8; color: #fff; }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] { -moz-appearance: textfield; }
</style>

<div class="content">
    @include('dashboard.layout.navbar')

    <div class="container py-4">
        <div class="card shadow-lg border-0">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Payment</h4>
                <a href="{{ route('payment.list') }}" class="btn btn-outline-light btn-sm">Back</a>
            </div>

            <div class="card-body bg-light">
                <div class="form-container mx-auto" style="max-width: 600px;">

                    <form action="{{ route('payment.update', $payment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Customer --}}
                        <div class="mb-3">
                            <label class="form-label">Customer Name</label>
                            <select name="customer_id" class="form-control" required>
                                <option value="">Select Customer</option>
                                @foreach($customers as $item)
                                <option value="{{$item->id}}"
                                    {{ $payment->customer_id == $item->id ? 'selected' : '' }}>
                                    {{$item->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Amount --}}
                        <div class="mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control"
                                   value="{{ $payment->amount }}" required>
                        </div>

                        {{-- Reference --}}
                        <div class="mb-3">
                            <label class="form-label">Reference</label>
                            <input type="text" name="reference" class="form-control"
                                   value="{{ $payment->reference }}">
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control">{{ $payment->description }}</textarea>
                        </div>

                        {{-- Is Cheque --}}
                        <div class="mb-3">
                            <label class="form-label">Is Cheque</label><br>
                            <input type="checkbox" id="is_cheque" name="is_cheque" value="1"
                                {{ $payment->is_cheque ? 'checked' : '' }}>
                        </div>

                        {{-- Cheque Fields --}}
                        <div id="chequeFields"
                             style="display: {{ $payment->is_cheque ? 'block' : 'none' }};">

                            <div class="mb-3">
                                <label class="form-label">Bank Name</label>
                                <select name="bank_id" id="bank_id" class="form-control">
                                    <option value="">Select Bank</option>
                                    @foreach($banks as $item)
                                    <option value="{{$item->id}}"
                                        {{ $payment->bank_id == $item->id ? 'selected' : '' }}>
                                        {{$item->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Cheque No</label>
                                <input type="text" name="cheque_no" id="cheque_no"
                                       class="form-control"
                                       value="{{ $payment->cheque_no }}">
                            </div>

                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-dark">Update Payment</button>
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

    checkbox.addEventListener('change', function () {
        if (this.checked) {
            chequeFields.style.display = 'block';
            bankField.required = true;
            chequeNoField.required = true;
        } else {
            chequeFields.style.display = 'none';
            bankField.required = false;
            chequeNoField.required = false;
        }
    });
</script>

@endsection