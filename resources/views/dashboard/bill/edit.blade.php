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

            <div class="card-header bg-warning text-dark d-flex justify-content-between">
                <h4>Edit Bill</h4>
                <a href="{{ route('bill.filter') }}" class="btn btn-light btn-sm">Back</a>
            </div>

            <div class="card-body bg-light">

                <form action="{{ route('bill.update', $bill->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Is Cash Bill</label>
                        <input type="checkbox" {{ $bill->is_cash==1 ? 'checked': '' }} />
                    </div>



                    <!-- Bill No -->
                    <div class="mb-3">
                        <label class="form-label">Bill No</label>
                        <input type="text" name="bill_no" value="{{ $bill->bill_no }}" class="form-control" required>
                    </div>

                    <!-- Customer -->
                    <div class="mb-3">
                        <label class="form-label">Customer</label>
                        <select name="customer_id" class="form-control" required>
                            @foreach ($customer as $item)
                            <option value="{{$item->id}}"
                                {{ $bill->customer_id == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Products Table -->
                    <table class="table table-bordered" id="productTable">

                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($billProducts as $row)
                            <tr>
                                <td>
                                    <select name="product_id[]" class="form-control" required>
                                        @foreach ($product as $p)
                                        <option value="{{$p->id}}"
                                            {{ $row->product_id == $p->id ? 'selected' : '' }}>
                                            {{ $p->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <input type="number" name="qty[]" value="{{$row->qty}}" class="form-control qty">
                                </td>

                                <td>
                                    <input type="number" name="price[]" value="{{$row->price}}" class="form-control price">
                                </td>

                                <td>
                                    <input type="number" name="amount[]" value="{{$row->amount}}" class="form-control amount" readonly>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-danger removeRow">X</button>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                        <tfoot>
                            <tr style="background:#f1f1f1; font-weight:bold;">
                                <td class="text-end">TOTAL:</td>
                                <td><input type="number" id="totalQty" class="form-control" readonly></td>
                                <td><input type="number" id="totalPrice" class="form-control" readonly></td>
                                <td><input type="number" id="grandTotal" class="form-control" readonly></td>
                                <td></td>
                            </tr>
                        </tfoot>

                    </table>

                    <button type="button" id="addRow" class="btn btn-primary">+ Add Product</button>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">Update Bill</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- SAME JS AS CREATE PAGE -->
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const tableBody = document.querySelector("#productTable tbody");
        const addRowBtn = document.getElementById("addRow");

        function calculateTotals() {

            let totalQty = 0;
            let totalPrice = 0;
            let grandTotal = 0;

            document.querySelectorAll(".qty").forEach(el => totalQty += parseFloat(el.value) || 0);
            document.querySelectorAll(".price").forEach(el => totalPrice += parseFloat(el.value) || 0);
            document.querySelectorAll(".amount").forEach(el => grandTotal += parseFloat(el.value) || 0);

            document.getElementById("totalQty").value = totalQty;
            document.getElementById("totalPrice").value = totalPrice;
            document.getElementById("grandTotal").value = grandTotal;
        }

        calculateTotals();

        addRowBtn.addEventListener("click", function() {

            let newRow = tableBody.rows[0].cloneNode(true);
            newRow.querySelectorAll("input").forEach(input => input.value = "");
            tableBody.appendChild(newRow);

        });

        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("removeRow")) {
                if (tableBody.rows.length > 1) {
                    e.target.closest("tr").remove();
                    calculateTotals();
                }
            }
        });

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