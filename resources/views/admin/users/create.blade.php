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
            <li class="breadcrumb-item active" aria-current="page">Create</li>
          </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Create Admin</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                placeholder="Input your name" value="{{ old('name') }}">
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                placeholder="Input your email" value="{{ old('email') }}">
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="email">Role</label>
                                <select name="role" id="role" class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}">
                                    <option>Choose</option>
                                    @foreach ($role as $item)
                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('role') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                placeholder="Input your password" value="{{ old('password') }}">
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control {{ $errors->has('confirm_password') ? 'is-invalid' : '' }}"
                                placeholder="Input your same password" value="{{ old('confirm_password') }}">
                                <p class="text-danger">{{ $errors->first('confirm_password') }}</p>
                            </div>
                            <div class="form-grup">
                                <button class="btn btn-success"><i class="fas fa-save"></i> &nbsp; Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

    @include('layouts.components.admin.footer')

@endsection
