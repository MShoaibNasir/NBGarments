@extends('dashboard.layout.master')
@section('content')
<style>
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
            <div class="card-header bg-info text-white d-flex justify-content-between">
                <h4>Add Return Bill Data</h4>
                <a href="{{ route('bill.filter') }}" class="btn btn-light btn-sm">Back</a>
            </div>
            <div class="card-body bg-light">

                <form action="{{ route('returnBill.save') }}" method="POST">
                    @csrf
                    <!-- Bill No -->
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="bill_date" class="form-control" required>
                    </div>

                     <div class="mb-3">
                        <label class="form-label">Qty</label>
                        <input type="number" name="qty" class="form-control" required>
                    </div>

                    <!-- Customer -->
                    <div class="mb-3">
                        <label class="form-label">Customer</label>
                        <select name="customer_id" class="form-control" required>
                            <option>Select Customer</option>
                            @foreach ($customer as $item)
                            <option value="{{$item->id}}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>


</div>

<!-- JAVASCRIPT -->
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const tableBody = document.querySelector("#productTable tbody");
        const addRowBtn = document.getElementById("addRow");

        function calculateTotals() {

            let totalQty = 0;
            let totalPrice = 0;
            let grandTotal = 0;

            document.querySelectorAll(".qty").forEach(el => {
                totalQty += parseFloat(el.value) || 0;
            });

            document.querySelectorAll(".price").forEach(el => {
                totalPrice += parseFloat(el.value) || 0;
            });

            document.querySelectorAll(".amount").forEach(el => {
                grandTotal += parseFloat(el.value) || 0;
            });

            document.getElementById("totalQty").value = totalQty;
            document.getElementById("totalPrice").value = totalPrice;
            document.getElementById("grandTotal").value = grandTotal;
        }

        // Add Row
        addRowBtn.addEventListener("click", function() {

            let newRow = tableBody.rows[0].cloneNode(true);
            newRow.querySelectorAll("input").forEach(input => input.value = "");
            tableBody.appendChild(newRow);

        });

        // Remove Row
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("removeRow")) {
                if (tableBody.rows.length > 1) {
                    e.target.closest("tr").remove();
                    calculateTotals();
                }
            }
        });

        // Row Calculation
        document.addEventListener("input", function(e) {

            if (e.target.classList.contains("qty") || e.target.classList.contains("price")) {

                let row = e.target.closest("tr");
                let qty = row.querySelector(".qty").value || 0;
                let price = row.querySelector(".price").value || 0;

                row.querySelector(".amount").value = qty * price;

                calculateTotals();
            }

        });

    });
</script>

@endsection