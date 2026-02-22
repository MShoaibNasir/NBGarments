@extends('dashboard.layout.master')
@section('content')

<div class="content">
@include('dashboard.layout.navbar')

<div class="container py-4">
<div class="card shadow-lg border-0">

<div class="card-header bg-info text-white d-flex justify-content-between">
<h4>Bill Details</h4>
<a href="{{ route('bill.filter') }}" class="btn btn-light btn-sm">Back</a>
</div>

<div class="card-body bg-light">

<!-- Bill No -->
<div class="mb-3">
<label class="form-label"><b>Bill No:</b></label>
<p>{{ $bill->bill_no }}</p>
</div>

<!-- Customer -->
<div class="mb-3">
<label class="form-label"><b>Customer:</b></label>
<p>{{ $bill->customer->name }}</p>
</div>

<!-- Products Table -->
<table class="table table-bordered">

<thead>
<tr>
<th>Product</th>
<th>Qty</th>
<th>Price</th>
<th>Amount</th>
</tr>
</thead>

<tbody>

@php
$totalQty = 0;
$totalPrice = 0;
$grandTotal = 0;
@endphp

@foreach ($billProducts as $row)

@php
$totalQty += $row->qty;
$totalPrice += $row->price;
$grandTotal += $row->amount;
@endphp

<tr>
<td>{{ $row->product->name }}</td>
<td>{{ $row->qty }}</td>
<td>{{ number_format($row->price) }}</td>
<td>{{ number_format($row->amount) }}</td>
</tr>
@endforeach

</tbody>

<tfoot>
<tr style="background:#f1f1f1; font-weight:bold;">
<td class="text-end">TOTAL:</td>
<td>{{ number_format($totalQty) }}</td>
<td>{{ number_format($totalPrice) }}</td>
<td>{{ number_format($grandTotal) }}</td>
</tr>
</tfoot>

</table>

</div>
</div>
</div>
</div>

@endsection