@extends('dashboard.layout.master')

@section('content')
<style>
    /* Table Styling */
    .table-container {
        background-color: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .card-header{
        background-color: #52D6E0 !important;
    }

    table.table {
        width: 100%;
        border-collapse: collapse;
    }

    table.table thead {
        background-color: #52D6E0;
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

    .badge {
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 13px;
    }

    .btn-sm i {
        margin-right: 4px;
    }
</style>

<div class="content">
    @include('dashboard.layout.navbar')

    <div class="container py-4">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-people-fill me-2"></i> Users Management</h4>
                @can('user-create')
                <a href="{{ route('users.create') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-plus-circle"></i> Create New User
                </a>
                @endcan
            </div>

            <div class="card-body bg-light">
                <div class="table-container">
                    <table id="usersTable" class="table table-striped table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th class="text-center" width="280px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $key => $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                            <span class="badge bg-success">{{ $v }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}">
                                        <i class="bi bi-eye"></i> Show
                                    </a>
                                    @can('user-edit')
                                    <a class="btn btn-success btn-sm" href="{{ route('users.edit',$user->id) }}">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    @endcan

                                    @can('user-delete')
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                    @endcan
                                
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No Users Found</td>
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
        $('#usersTable').DataTable({
            "pageLength": 10,
            "lengthChange": true,
            "ordering": true,
            "info": true,
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search users..."
            }
        });
    });
</script>
@endsection
@endsection
