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
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
          </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Admin</h6>
                    </div>
                    <div class="card-body">
                        @if ($data->id === Auth::user()->id)
                        <form action='{{ url("admin/users/{$data->id}") }}' method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                placeholder="Input your name" value="{{ $data->name }}">
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                placeholder="Input your email" value="{{ $data->email }}">
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            </div>

                            <div class="form-grup">
                                <button class="btn btn-success"><i class="fas fa-save"></i> &nbsp; Save </button>
                            </div>
                         </form>
                        @else
                          <div class="alert alert-danger">Access Blocked</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

    @include('layouts.components.admin.footer')

@endsection
