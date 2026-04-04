<div class="row">
    <div class="col-12" style="text-align: end;">
        <a href="{{ route('supplier.create') }}" class="btn btn-danger">Add New Supply Data</a>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h4>Supplier Name: {{$customer_name->name}}</h4>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>S No</th>
                        <th>Purpose</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Total Amount</th>
                        <th>Description</th>
                    </tr>
                </thead>


                <tbody>

                    @php
                    $runningBalance = $openingBalance;
                    @endphp
                    @foreach($data as $item)

                    @php

                    if ($item->status == 'Purchasing') {
                    $runningBalance += $item->amount;
                    } 
                    elseif ($item->status == 'Discount') {
                    $runningBalance -= $item->amount;
                    }
                    else {
                    $runningBalance -= $item->amount;
                    }
                    $rowColor = $item->status == 'Purchasing' ? '#ff4d4d' : '#28a745';
                    @endphp


                    <tr style="background-color: {{ $rowColor }}; color:white;">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{     \Carbon\Carbon::parse($item->supplier_date)->format('d-m-Y')  }}</td>
                        <td><strong>{{ number_format($item->amount) }} Rs</strong></td>
                        <td><strong>{{ number_format($runningBalance) }} Rs</strong></td>
                        <td><strong>{{ $item->description }} </strong></td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-12 my-3">
        {{ $data->links("pagination::bootstrap-4") }}
    </div>

    <div class="col-md-12">
        Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of total {{ $data->total() }} entries
    </div>

</div>