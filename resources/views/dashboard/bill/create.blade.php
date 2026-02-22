@extends('dashboard.layout.master')
@section('content')

<div class="content">
    @include('dashboard.layout.navbar')

    <div class="container py-4">
        <div class="card shadow-lg border-0">

            <div class="card-header bg-info text-white d-flex justify-content-between">
                <h4>Add New Bill</h4>
                <a href="{{ route('bill.list') }}" class="btn btn-light btn-sm">Back</a>
            </div>

            <div class="card-body bg-light">

                <form action="{{ route('bill.store') }}" method="POST">
                    @csrf

                    <!-- Bill No -->
                    <div class="mb-3">
                        <label class="form-label">Bill No</label>
                        <input type="text" name="bill_no" class="form-control" required>
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

                    <!-- Products Table -->
                    <div class="mb-3">
                        <label class="form-label">Products</label>

                        <table class="table table-bordered" id="productTable">

                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th width="120">Qty</th>
                                    <th width="150">Price</th>
                                    <th width="150">Amount</th>
                                    <th width="80">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>
                                        <select name="product_id[]" class="form-control" required>
                                            <option>Select Product</option>
                                            @foreach ($product as $item)
                                                <option value="{{$item->id}}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="number" name="qty[]" class="form-control qty" required>
                                    </td>

                                    <td>
                                        <input type="number" name="price[]" class="form-control price" required>
                                    </td>

                                    <td>
                                        <input type="number" name="amount[]" class="form-control amount" readonly>
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-danger removeRow">X</button>
                                    </td>
                                </tr>
                            </tbody>

                            <!-- TOTAL ROW -->
                            <tfoot>
                                <tr style="background:#f1f1f1; font-weight:bold;">
                                    <td class="text-end">TOTAL:</td>
                                    <td><input type="number" id="totalQty" name="totalQty" class="form-control" readonly></td>
                                    <td><input type="number" id="totalPrice" name="totalPrice" class="form-control" readonly></td>
                                    <td><input type="number" id="grandTotal" name="grandTotal" class="form-control" readonly></td>
                                    <td></td>
                                </tr>
                            </tfoot>

                        </table>

                        <button type="button" id="addRow" class="btn btn-primary">
                            + Add Product
                        </button>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">
                            Save Bill
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function () {

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
    addRowBtn.addEventListener("click", function () {

        let newRow = tableBody.rows[0].cloneNode(true);
        newRow.querySelectorAll("input").forEach(input => input.value = "");
        tableBody.appendChild(newRow);

    });

    // Remove Row
    document.addEventListener("click", function(e){
        if(e.target.classList.contains("removeRow")){
            if(tableBody.rows.length > 1){
                e.target.closest("tr").remove();
                calculateTotals();
            }
        }
    });

    // Row Calculation
    document.addEventListener("input", function(e){

        if(e.target.classList.contains("qty") || e.target.classList.contains("price")){

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