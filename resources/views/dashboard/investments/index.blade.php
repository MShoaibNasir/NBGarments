@extends('dashboard.layout.master')

@section('content')
<style>
    /* Hide arrows from number inputs */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .bg-dark {
        background-color: #52D6E0 !important;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    /* Table styling */
    .table-container {
        background-color: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table.table {
        width: 100%;
        border-collapse: collapse;
    }

    table.table thead {
        background-color: #52D6E0 !important;
        color: #fff;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    table.table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table.table tbody tr:hover {
        background-color: #f1f1f1;
    }

    table.table td,
    table.table th {
        padding: 12px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #e0e0e0;
    }

    .action-btns i {
        font-size: 18px;
    }

    .action-btns a {
        color: #000;
        margin-right: 10px;
        text-decoration: none;
    }

    .action-btns a:hover {
        color: #007bff;
    }
</style>

<div class="content">
    @include('dashboard.layout.navbar')

    <div class="container py-4">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-list-ul me-2"></i> Investments List</h4>
                @can('investment-create')
                <a href="{{ route('investment.create') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-plus-circle"></i> Add New Investment
                </a>
                @endcan
            </div>

            <div class="card-body bg-light">
                <div class="table-container">
                    <table id="brandTable" class="table table-striped table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Date</th>
                                @if(Auth::user()->can('investment-edit') || Auth::user()->can('investment-delete'))
                                <th class="text-center">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $index => $b)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $b->name }}</td>
                                <td>{{ $b->amount }}</td>
                                <td>{{ $b->description }}</td>
                                <td>{{ \Carbon\Carbon::parse($b->investment_date)->format('d-m-Y') }} </td>

                                @if(Auth::user()->can('investment-edit') || Auth::user()->can('investment-delete'))
                                <td class="text-center action-btns">

                                    @can('investment-edit')
                                    <a href="{{ route('investment.edit', $b->id) }}" class="btn btn-success btn-sm">
                                        <i class="bi bi-pen"></i> Edit
                                    </a>
                                    @endcan
                                    @can('investment-delete')
                                    <a href="{{ route('investment.delete', $b->id) }}" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this investment?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                    @endcan
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ Auth::user()->can('customer-edit') || Auth::user()->can('customer-delete') ? 4 : 3 }}" class="text-center text-muted py-4">
                                    No Data Found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ✅ Include DataTables --}}
@section('scripts')
<!-- jQuery (Required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#brandTable').DataTable({
            "pageLength": 10,
            "lengthChange": true,
            "ordering": true,
            "info": true,
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search customers..."
            }
        });
    });
</script>
@endsection
@endsection