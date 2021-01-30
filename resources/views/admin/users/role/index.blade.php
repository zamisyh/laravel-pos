@extends('layouts.admin')

@section('title', 'Roles Manajement')

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
            <li class="breadcrumb-item active" aria-current="page">Roles</li>
          </ol>
        </div>

       <div class="row">
            <div class="col-lg-4">

                @if (session()->get('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h6><i class="fas fa-check"></i><b> Success</b></h6>
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Create Role</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <form action="{{ route('admin.role.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" name="role" id="role" class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}"
                                value="{{ old('role') }}" placeholder="Add your new Role">
                                <p class="text-danger">{{ $errors->first('role') }}</p>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">

                    @if (session()->get('successDel'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            <h6><i class="fas fa-check"></i><b> Success</b></h6>
                            {{ session()->get('successDel') }}
                        </div>
                     @endif

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Role</h6>
                    </div>

                    <div class="table-responsive p-3">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Guard</th>
                                    <th>Created At</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->guard_name }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                           <form action="{{ route("admin.role.destroy", $item->id) }}" method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button class="btn btn-danger btn-sm btn-delete" type="button"> <i class="fas fa-trash-alt"></i></button>
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


    </div
    @include('layouts.components.admin.footer')
@endsection
