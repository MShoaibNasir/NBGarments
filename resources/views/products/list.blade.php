 @if($data->count() > 0)
 <table id="roleTable" class="table table-striped table-bordered align-middle" style="margin-top:30px;">
       <thead>
           <tr>
               <th>#</th>
               <th>Description</th>
               <th>Amount</th>
           </tr>
       </thead>
       <tbody>
           @foreach ($data as $item)
           <tr>

               <td>{{ $loop->index+1 }}</td>
               <td>{{ $item->description ?? '-----' }}</td>
               <td>{{ number_format($item->amount) ?? '-----'}}</td>

           </tr>
           @endforeach
       </tbody>
   </table>
   @endif