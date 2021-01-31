@extends('layouts.admin')

@section('title', 'Data Admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('body')
    @include('layouts.components.admin.sidebar')
    @include('layouts.components.admin.topbar')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            <li class="breadcrumb-item active" aria-current="page">Admin</li>
          </ol>
        </div>

        <div class="col-lg-12">

            @if (session()->get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session()->get('success') }}
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create Admin</a>
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataCategory">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Create At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @foreach ($item->getRoleNames() as $role)
                                           @if ($role === 'admin')
                                                <span class="badge badge-success">{{ $role }}</span>
                                           @endif
                                           @if ($role === 'cashier')
                                                <span class="badge badge-primary">{{ $role }}</span>
                                           @endif
                                           @if ($role === 'operators')
                                                <span class="badge badge-info">{{ $role }}</span>
                                           @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($item->status === true)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Suspend</span>
                                        @endif
                                    </td>
                                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y H:i:s') }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('admin.role_set', $item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-user-shield"></i></a>
                                        <a href='{{ url("admin/users/{$item->id}/edit") }}' class="btn btn-primary btn-sm ml-1"><i class="fas fa-edit"></i></a>
                                        <form action='{{ url("admin/users/{$item->id}") }}' class="ml-1" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm btn-delete" type="button"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>

    @include('layouts.components.admin.footer')
@endsection
