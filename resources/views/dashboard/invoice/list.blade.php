
    <div class="row">
        <div class="col-md-12 my-3 text-end">
            <form  method="POST" action="{{route('exportInvoice')}}">
                @csrf
                <input type="hidden" name="json_data" value='{{ $jsondata }}'>
                <button type="submit" name="export" class="btn btn-danger">Export Invoice Data</button>
            </form>

        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>

                            <th scope="col">S No</th>
                            <th scope="col">Time</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone No</th>
                            <th scope="col">Address</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Url</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        
                        @foreach($data as $item)
                        <tr style="my-4">
                            <td> {{$loop->index+1}}</td>
                            <td>{{$item->created_at->format('d-m-Y H:i:s')  }}</td>
                            <td>{{ ucfirst($item->first_name)  }}</td>
                            <td>{{ ucfirst($item->last_name)  }}</td>
                            <td>{{ $item->email_address  }}</td>
                            <td>{{ $item->phone_number  }}</td>
                            <td>{{ $item->address  }}</td>
                            <td>{{ number_format($item->invoiceAmount->total_amount,2)  }}</td>
                            <td>
                                @if($item->url)
                                    <button 
                                        class="btn btn-sm btn-outline-primary ms-2 copy-btn" 
                                        data-url="{{ $item->url }}" 
                                        title="Copy URL"
                                    >
                                        <i class="fas fa-copy"></i>
                                    </button>
                                @else
                                    ----
                                @endif
                            </td>

                            <td>{{$item->brand->link}}</td>
                            <td>{{$item->status}}</td>
                            <td>
                                @if($item->status=='Pending' || $item->status=='Failed')

                                @can('invoice-edit')
                                <a class="btn btn-success btn-sm" href="{{route('invoice.edit',[$item->id])}}">Edit</a>
                                @endcan
                                @can('invoice-delete')
                                <a class="btn btn-danger btn-sm" href="{{route('invoice.delete',[$item->id])}}">Delete</a></td>
                                @endcan
                                @else
                                <span class="badge bg-warning text-dark">Edit or delete not allowed</span>
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
$(document).on('click', '.copy-btn', function () {
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