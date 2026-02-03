@extends('dashboard.layout.master')

@section('content')
<style>
    /* Card hover animation */
    .stat-card-box {
        transition: all 0.3s ease;
        border: none !important;
    }

    .stat-card-box:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
    }

    .stat-icon {
        font-size: 2.5rem;
        opacity: 0.8;
    }

    .graph-heading {
        font-weight: 700;
        color: #002060;
        letter-spacing: 0.5px;
    }

    .content-wrapper {
        padding: 20px;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
    }

    .stat-label {
        font-weight: 600;
        font-size: 0.9rem;
    }
</style>

<div class="content">
    @include('dashboard.layout.navbar')

    <div class="container-fluid content-wrapper">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 pt-3 pb-1">
                <h4 class="graph-heading mb-0">
                    <i class="fa fa-chart-line me-2 text-primary"></i> System Statistics
                </h4>
                <hr class="mt-2 mb-0">
            </div>

            <div class="card-body">
                <div class="row g-4">
@if(auth()->user()->hasRole('Admin'))
                    <!-- Total Users -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="p-4 rounded-4 text-center stat-card-box"
                            style="background: linear-gradient(135deg, #FFE28A, #FED966); color: #333;">
                            <div class="stat-icon mb-2"><i class="fa fa-users"></i></div>
                            <div class="stat-number">{{ $users_count }}</div>
                            <div class="stat-label">Total Users</div>
                        </div>
                    </div>
@endif
                    <!-- Total Invoices -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="p-4 rounded-4 text-center stat-card-box"
                            style="background: linear-gradient(135deg, #B3D1D8, #9BBCC3); color: #333;">
                            <div class="stat-icon mb-2"><i class="fa fa-file-invoice"></i></div>
                            <div class="stat-number">{{$invoices_count}}</div>
                            <div class="stat-label">Total Invoices</div>
                        </div>
                    </div>

                    <!-- Total Employees -->
                    @if(auth()->user()->hasRole('Admin'))
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="p-4 rounded-4 text-center stat-card-box"
                            style="background: linear-gradient(135deg, #FF3333, #C00000); color: #fff;">
                            <div class="stat-icon mb-2"><i class="fa fa-user-tie"></i></div>
                            <div class="stat-number">{{ $employees_count }}</div>
                            <div class="stat-label">Total Employees</div>
                        </div>
                    </div>
                    @endif
                    <!-- Total Payment -->
  @if(auth()->user()->hasRole('Admin'))                 
<div class="col-lg-12 col-md-12 col-12">
    <div class="p-4 rounded-4 stat-card-box shadow"
        style="background: linear-gradient(135deg, #17a2b8, #138496); color: #fff;">

<h5 class="mb-3 fw-bold">
    <span class="badge bg-info text-dark p-2">Invoice Summary</span>
</h5>

        <div class="table-responsive">
            <table class="table table-borderless text-white mb-0">
                <thead>
                    <tr class="text-uppercase">
                        <th>S No</th>
                        <th>Brand Name</th>
                        <th>Total Invoice</th>
                        <th>Total Money</th>
                        <th>Money Received</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($brand as $data)

                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{number_format(countInvoices($data->id))}}</td>
                        <td>{{number_format(totalInvoiceAmount($data->id))}}</td>
                        <td>{{number_format(totalInvoiceAmountRecieved($data->id))}}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
  @endif
                    

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Automatically close alerts
    setTimeout(function() {
        $('#success-alert').fadeOut('slow');
        $('#alert-danger').fadeOut('slow');
    }, 2000);
</script>
@endsection
