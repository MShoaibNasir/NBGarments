<div class="row">
    <div class="col-md-12 my-3 text-end">
        <h4>Total Amount: {{$total_sell_amount}} Rs</h4>
        {{-- <form  method="POST" action="{{route('exportInvoice')}}">
        @csrf
        <input type="hidden" name="json_data" value='{{ $jsondata }}'>
        <button type="submit" name="export" class="btn btn-danger">Export Invoice Data</button>
        </form>
        --}}

    </div>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>

                        <th scope="col">S No</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Refrence</th>
                        <th scope="col">Bank Name</th>
                        <th scope="col">Cheque No</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        @if(Auth::user()->can('payment-edit') || Auth::user()->can('payment-delete'))
                        <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>

                <tbody>


                    @foreach($data as $item)

                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$item->customer->name}}</td>
                        <td>{{$item->reference?? '--'}}</td>
                        <td>{{$item->bank->name ?? '--'}}</td>
                        <td>{{$item->cheque_no ?? '--'}}</td>
                        <td>{{number_format($item->amount)}}</td>
                         <td>{{ $item->created_at->format('d-m-Y') }}</td>
                       
                        @if(Auth::user()->can('payment-edit') || Auth::user()->can('payment-delete'))
                        <td class="text-center action-btns">
                            @can('payment-edit')
                            <a href="{{ route('payment.edit', $item->id) }}" class="btn btn-success btn-sm">
                                <i class="bi bi-pen"></i> Edit
                            </a>
                            @endcan
                            @can('payment-delete')
                            <a href="{{ route('payment.delete', $item->id) }}" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this payment data?')">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                            @endcan
                        </td>
                        @endif
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-12 my-3">{{ $data->links("pagination::bootstrap-4") }}</div>
    <div class="col-md-12">Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of total {{$data->total()}} entries</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).on('click', '.copy-btn', function() {
        // Get the value from the data-url attribute
        const url = $(this).data('url');

        // Copy to clipboard
        navigator.clipboard.writeText(url).then(() => {
            // Optional: show message or toast
            alert("url copy successfully!");
        }).catch(() => {
            alert('Failed to copy.');
        });
    });
</script>