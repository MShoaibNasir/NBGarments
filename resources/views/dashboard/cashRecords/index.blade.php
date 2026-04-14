<div class="row">
    <div class="col-md-12">
        {{-- <h4>Customer Name: {{$customer_name->name}}</h4>--}}
        <div class="table-responsive">
            <table class="table table-striped table-bordered">

                <thead>
                    <tr>

                        <th>Database Id</th>
                        <th>Date</th>
                        <th>Purpose</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Total Amount</th>
                        <th>Description</th>
                        <th>Bank Name</th>
                        <th>Cheque No</th>
                    </tr>
                </thead>

                <tbody>

                    {{-- 🔥 Running total variable --}}
                    @php $runningTotal = $openingBalance; @endphp
                    @foreach($data as $item)

                    @php

                    if ($item->table_name == 'Payment') {
                    $amount = $item->paymnent->amount ?? null;
                    }
                    elseif($item->table_name == 'expenses'){
                    $amount = $item->expenses->amount ?? 0;
                    }else{
                    $amount = $item->investment->amount;
                    }


                    // Payment = Incoming (Plus)
                    if ($item->table_name == 'Payment') {
                    $runningTotal += $amount;
                    }
                    // Bill = Outgoing (Minus)
                    elseif($item->table_name == 'expenses') {
                    $runningTotal -= $amount;
                    }else{
                    $runningTotal += $amount;
                    }

                    // Row color
                    $rowColor = $item->table_name == 'expenses' ? '#ff4d4d' : '#28a745';
                    @endphp

                    <tr style="background-color: {{ $rowColor }}; color:white;">
                        <td>{{ $item->id }}</td>
                        {{-- Date --}}

                        <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
                        <td>{{ $item->table_name }}</td>
                        <td>
                            {{
        $item->table_name == 'Payment' ? $item->paymnent?->customer?->name 
        : ($item->table_name == 'expenses' ? $item->expenses?->SupplierData?->Supplier?->name 
        : $item->investment?->name ?? '---')
    }}
                        </td>

                        <td>{{ number_format($amount) }}</td>

                        {{-- 🔥 Running Total --}}
                        <td><strong>{{ number_format($runningTotal) }} </strong></td>


                        <td>
                            @if($item->table_name == 'Payment')
                            {{ $item->paymnent->description ?? '----' }}
                            @elseif ($item->table_name == 'expenses')
                            {{ $item->expenses->description ?? '----' }}
                            @else
                            {{ $item->investment->description ?? '----' }}
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