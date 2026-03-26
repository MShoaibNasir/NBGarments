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

    a {
        color: white;
    }

    a:hover {
        color: white;
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
                    <!-- Total Users -->
                    @can('investment-list')
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="p-4 rounded-4 text-center stat-card-box"
                            style="background: linear-gradient(135deg, #FFE28A, #FED966); color: #333;">
                            <a href="{{route('investment.list')}}">
                                <div class="stat-icon mb-2"><i class="fa fa-users"></i></div>
                                <div class="stat-label">Investment Management</div>
                            </a>
                        </div>
                    </div>
                    @endcan
                    <!-- Total Invoices -->
                    @can('supplier-list')
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="p-4 rounded-4 text-center stat-card-box"
                            style="background: linear-gradient(135deg, #83d6e9, #8de9fc); color: #070707;">
                            <a href="{{route('supplier.list')}}">
                                <div class="stat-icon mb-2"><i class="fa fa-file-invoice"></i></div>
                                <div class="stat-label">Supplier Management</div>
                            </a>
                        </div>
                    </div>
                    @endcan
                    @can('customer-list')
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="p-4 rounded-4 text-center stat-card-box"
                            style="background: linear-gradient(135deg, #e983db, #b88dfc); color: #070707;">
                            <a href="{{route('customer.list')}}">
                                <div class="stat-icon mb-2"><i class="fa fa-file-invoice"></i></div>
                                <div class="stat-label">Profile Management</div>
                            </a>
                        </div>
                    </div>
                    @endcan
                    @can('roznamcha')
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="p-4 rounded-4 text-center stat-card-box"
                            style="background: linear-gradient(135deg, #0c1e22, #04090a); color: #f1e8e8;">
                            <a href="{{route('cashRecords.filter')}}">
                                <div class="stat-icon mb-2"><i class="fa fa-file-invoice"></i></div>
                                <div class="stat-label">Roznamcha</div>
                            </a>
                        </div>
                    </div>
                    @endcan
                    <!-- Total Employees -->
                    @can('bill-list')
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="p-4 rounded-4 text-center stat-card-box"
                            style="background: linear-gradient(135deg, #FF3333, #C00000); color: #fff;">
                            <a href="{{route('bill.filter')}}">
                                <div class="stat-icon mb-2"><i class="fa fa-user-tie"></i></div>
                                <div class="stat-label">Bill Management</div>
                            </a>
                        </div>
                    </div>
                    @endcan
                    @can('payment-list')
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="p-4 rounded-4 text-center stat-card-box"
                            style="background: linear-gradient(135deg, #ffb833, #ffe033); color: #fff;">
                            <a href="{{route('payment.filter')}}">
                                <div class="stat-icon mb-2"><i class="fa fa-user-tie"></i></div>
                                <div class="stat-label">Payment Management</div>
                            </a>
                        </div>
                    </div>
                    @endcan
                    @can('expenses-list')
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="p-4 rounded-4 text-center stat-card-box"
                            style="background: linear-gradient(135deg, #ff3333, #ff3333); color: #fff;">
                            <a href="{{route('expenses.filter')}}">
                                <div class="stat-icon mb-2"><i class="fa fa-user-tie"></i></div>
                                <div class="stat-label">Expenses Management</div>
                            </a>
                        </div>
                    </div>
                    @endcan

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