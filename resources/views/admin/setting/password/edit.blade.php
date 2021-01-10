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
            <li class="breadcrumb-item active" aria-current="page">Settings</li>
            <li class="breadcrumb-item active" aria-current="page">Password</li>
            <li class="breadcrumb-item active" aria-current="page">{{ ucwords(strtolower($data->name)) }}</li>
          </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Settings Password</h6>
                    </div>
                    <div class="card-body">
                        @if ($data->id === Auth::user()->id)
                        <form action='{{ url("admin/setting/password/{$data->id}") }}' method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="old_password">Old Password</label>
                                <input type="old_password" name="old_password" id="old_password" class="form-control {{ $errors->has('old_password') ? 'is-invalid' : '' }}"
                                placeholder="Input your old Password" value="{{ $data->old_password }}">
                                <p class="text-danger">{{ $errors->first('old_password') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}"
                                placeholder="Input your New Password" value="{{ $data->new_password }}">
                                <p class="text-danger">{{ $errors->first('new_password') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control {{ $errors->has('confirm_password') ? 'is-invalid' : '' }}"
                                placeholder="Input your Confirm Password" value="{{ $data->confirm_password }}">
                                <p class="text-danger">{{ $errors->first('confirm_password') }}</p>
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
