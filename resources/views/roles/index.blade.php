@extends('dashboard.layout.master')

@section('content')
<style>
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
        background-color: #000;
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

    .btn-dark {
        background-color: #000;
        border: none;
    }

    .btn-dark:hover {
        background-color: #333;
    }

    .action-btns .btn {
        margin-right: 6px;
    }

    .no-data {
        text-align: center;
        color: #888;
        font-style: italic;
    }
</style>

<div class="content">
    @include('dashboard.layout.navbar')

    <div class="container py-4">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-shield-lock me-2"></i> Role Management</h4>
                @can('role-create')
                <a href="{{ route('roles.create') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-plus-circle"></i> Create New Role
                </a>
                @endcan
            </div>

            <div class="card-body bg-light">
                <div class="table-container">
                    <table id="roleTable" class="table table-striped table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role Name</th>
                                <th class="text-center" width="250px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $index => $role)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ ucfirst($role->name) }}</td>
                                <td class="text-center action-btns">
                                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i> Show
                                    </a>

                                    @can('role-edit')
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-success btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    @endcan

                                    @can('role-delete')
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this role?')">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="no-data py-4">No roles found.</td>
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
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#roleTable').DataTable({
            "pageLength": 10,
            "lengthChange": true,
            "ordering": true,
            "info": true,
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search roles..."
            }
        });
    });
</script>
@endsection
@endsection
