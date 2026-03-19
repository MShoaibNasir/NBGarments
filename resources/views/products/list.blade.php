 @if($data->count() > 0)
 <table id="roleTable" class="table table-striped table-bordered align-middle" style="margin-top:30px;">
     <h5 style="margin-top: 10px;">Total Cost : {{ number_format($data->sum('amount')) }}</h5>

     <thead>
         <tr>
             <th>#</th>
             <th>Description</th>
             <th>Amount</th>
             <th>Action</th>
         </tr>
     </thead>
     <tbody>

         @foreach ($data as $item)
         <tr>

             <td>{{ $loop->index+1 }}</td>
             <td>{{ $item->description ?? '-----' }}</td>
             <td>{{ number_format($item->amount) ?? '-----'}}</td>
             <td><a href="{{route('list.product.delete',[$item->id])}}" class="btn btn-danger btn-sm">Delete</a></td>
         </tr>
         @endforeach
     </tbody>
 </table>
 @endif