<div class="row">
    <div class="col-md-12">
        <h4>Customer Name: {{$customer_name->name}}</h4>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">

                <thead>
                    <tr>
                        <th>S No</th>
                        <th>Purpose</th>
                        <th>Bill No</th>
                        <th>Date</th>
                        <th>QTY</th>
                        <th>Amount</th>
                        <th>Total Amount</th>
                        <th>Bank Name</th>
                        <th>Cheque No</th>
                        <th>Description</th>

                    </tr>
                </thead>

                <tbody>

                    {{-- 🔥 Running total variable --}}
                    @php $runningTotal = $openingBalance; @endphp

                    @foreach($data as $item)


                    @php
                    if ($item->table_name == 'Payment') {
                    $amount = $item->paymnent->amount ?? 0;
                    }
                    elseif ($item->table_name == 'discount') {
                    $amount = $item->discount->amount ?? 0;
                    }
                    else{
                    $amount = $item->bill->total_amount;
                    }


                    // Payment = Incoming (Plus)
                    if ($item->table_name == 'Payment') {
                    $runningTotal -= $amount;
                    }
                    elseif($item->table_name == 'discount'){
                    $runningTotal -= $amount;
                    }



                    else {
                    if($item->bill->bill_type=='return'){
                    $runningTotal -= $amount;
                    }else{
                    $runningTotal += $amount;
                    }
                    }

                    // Row color
                    $rowColor = $item->table_name == 'Bill' ? '#ff4d4d' : ( $item->table_name == 'Amount Credit' ? '#a5a728' : '#28a745');
              
                    @endphp

                    <tr style="background-color: {{ $rowColor }}; color:white;">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->table_name }}</td>
                        <td>{{ $item->table_name == 'Bill' ?  $item->bill->bill_no : '-----' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->ledger_date)->format('d-m-Y') }}</td>
                        <td>{{ $item->table_name == 'Bill' ? $item->bill->qty : '-----' }}</td>
                        <td>{{ number_format($amount) }}</td>
                        <td><strong>{{ number_format($runningTotal) }} Rs</strong></td>


                        {{-- Bank --}}
                        <td>
                            @if($item->table_name == 'Payment')
                            {{ $item->paymnent->bank->name ?? '----' }}
                            @else
                            ----
                            @endif
                        </td>

                        {{-- Cheque --}}
                        <td>
                            @if($item->table_name == 'Payment')
                            {{ $item->paymnent->cheque_no ?? '----' }}
                            @else
                            ----
                            @endif
                        </td>
                        <td>{{ $item->table_name == 'Bill' ? $item->bill->description : ($item->paymnent->description) ?? '---' }}</td>
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