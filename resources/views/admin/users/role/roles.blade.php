@extends('layouts.admin')

@section('title', 'Set Roles')

@section('body')
    @include('layouts.components.admin.sidebar')
    @include('layouts.components.admin.topbar')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            <li class="breadcrumb-item active" aria-current="page">Role</li>
            <li class="breadcrumb-item active" aria-current="page">Set</li>
          </ol>
        </div>

      <div class="row">
          <div class="col-lg-5">
            <div class="table-responsive">
                <form action="{{ route('admin.setRole', $user->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>
                                    @foreach ($roles as $item)
                                        <input type="radio" name="role"
                                        {{ $user->hasRole($item) ? 'checked' : '' }}
                                        value="{{ $item }}"> {{ $item }} <br>
                                    @endforeach
                                </td>
                            </tr>
                        </thead>
                    </table>

                    <button class="btn btn-primary">Set Role</button>
                </form>
            </div>
          </div>
      </div>

    </div>

</div>
    @include('layouts.components.admin.footer')
@endsection
