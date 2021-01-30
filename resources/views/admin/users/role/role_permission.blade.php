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

                @if (session()->get('successPermission'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h6><i class="fas fa-check"></i><b> Success</b></h6>
                        {{ session()->get('successPermission') }}
                    </div>
                @endif
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Add New Permission</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <form action="{{ route("admin.add_permission") }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="role">Name</label>
                                <input type="text" name="permission" id="permission" class="form-control {{ $errors->has('permission') ? 'is-invalid' : '' }}"
                                value="{{ old('permission') }}" placeholder="Add your new permission">
                                <p class="text-danger">{{ $errors->first('permission') }}</p>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">

                @if (session()->get('successRole'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h6><i class="fas fa-check"></i><b> Success</b></h6>
                        {{ session()->get('successRole') }}
                    </div>
                @endif
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Set Permission To Role</h6>
                    </div>

                    <div class="table-responsive p-3">

                        <form action="{{ route('admin.role_permission') }}" method="get">
                            <div class="form-group">
                                <label for="roles">Roles</label>
                                <select name="role" id="roles" class="form-control ">
                                    @foreach ($roles as $item)
                                        <option value="{{ $item }}" {{ request()->get('role') == $item ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">Check</button>
                            </div>
                        </form>

                        @if (!empty($permissions))
                        <form action="{{ route('admin.set_role_permission', request()->get('role')) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <div class="nav-tabs-custom">
                                    <h6 class="m-0 font-weight-bold text-primary">Set Permission To Role</h6>
                                    <hr><p></p>

                                    @php $no = 1; @endphp
                                        @foreach ($permissions as $key => $row)
                                            <input type="checkbox"
                                                name="permission[]"
                                                class="minimal-red"
                                                value="{{ $row }}"
                                                {{--  CHECK, JIKA PERMISSION TERSEBUT SUDAH DI SET, MAKA CHECKED --}}
                                                {{ in_array($row, $hasPermission) ? 'checked':'' }}
                                                > {{ $row }} <br>
                                                @if ($no++%4 == 0)
                                                    <br>
                                                @endif
                                        @endforeach
                                </div>

                            </div>
                                <div class="pull-right">
                                    <button class="btn btn-success">
                                        <i class="fas fa-send"></i> Set Permission
                                    </button>
                                </div>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
       </div>

    </div>


    </div
    @include('layouts.components.admin.footer')
@endsection
