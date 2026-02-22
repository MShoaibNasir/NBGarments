<div class="row">
    <div class="col-md-12">
        {{-- <h4>Customer Name: {{$customer_name->name}}</h4>--}}
        <div class="table-responsive">
            <table class="table table-striped table-bordered">

                <thead>
                    <tr>
                        <th>S No</th>
                        <th>Date</th>
                        <th>Purpose</th>
                        <th>Customer Name</th>
                        <th>Amount</th>
                        <th>Total Amount</th>
                        <th>References</th>
                        <th>Description</th>
                        <th>Bank Name</th>
                        <th>Cheque No</th>
                    </tr>
                </thead>

                <tbody>

                    {{-- 🔥 Running total variable --}}
                    @php $runningTotal = 0; @endphp

                    @foreach($data as $item)

                    @php
                    if ($item->table_name == 'Payment') {
                    $amount = $item->paymnent->amount;
                    }
                    else{

                    $amount = $item->expenses->amount;
                    }


                    // Payment = Incoming (Plus)
                    if ($item->table_name == 'Payment') {
                    $runningTotal += $amount;
                    }
                    // Bill = Outgoing (Minus)
                    else {
                    $runningTotal -= $amount;
                    }

                    // Row color
                    $rowColor = $item->table_name == 'expenses' ? '#ff4d4d' : '#28a745';
                    @endphp

                    <tr style="background-color: {{ $rowColor }}; color:white;">
                        <td>{{ $loop->index + 1 }}</td>
                        {{-- Date --}}
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td>{{ $item->table_name }}</td>
                        <td>{{ $item->table_name == 'Payment' ?  $item->paymnent->customer->name : '---' }}</td>
                        <td>{{ number_format($amount) }} Rs</td>

                        {{-- 🔥 Running Total --}}
                        <td><strong>{{ number_format($runningTotal) }} Rs</strong></td>

                        {{-- Reference --}}
                        <td>
                            @if($item->table_name == 'Payment')
                            {{ $item->paymnent->reference ?? '----' }}
                            @else
                            {{ $item->expenses->refrence ?? '----' }}
                            @endif
                        </td>
                        <td>
                            @if($item->table_name == 'Payment')
                            {{ $item->paymnent->description ?? '----' }}
                            @else
                            {{ $item->expenses->description ?? '----' }}
                            @endif
                        </td>

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