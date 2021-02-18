@extends('layouts.admin')

@section('title', 'Customer')
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
            <li class="breadcrumb-item active" aria-current="page">Customer</li>
          </ol>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Customer</h6>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dataCustomerModalAdd"
                    id="#myBtn">New Customer</button>
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataCategory">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ Carbon\carbon::parse($item->created_at)->format('d M Y - H:i:s') }}</td>
                                    <td class="d-flex">
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateCustomer{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                        @role('admin')
                                            <form action="{{ route('admin.customer.destroy', $item->id) }}" method="post" class="ml-1">
                                                @csrf
                                                @method("DELETE")
                                                <button class="btn btn-danger btn-sm btn-delete" type="button"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        @endrole
                                    </td>
                                </tr>

                                <div class="modal fade" id="updateCustomer{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="updateCustomer{{ $item->id }}Label"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateCustomer{{ $item->id }}Label">{{ $item->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.customer.update', $item->id) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $item->name }}">
                                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ $item->email }}">
                                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="number" name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" value="{{ $item->phone }}">
                                                    <p class="text-danger">{{ $errors->first('phone') }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <textarea name="address" id="address" rows="5" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}">{{ $item->address }}</textarea>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
    @section('modal')
    <div class="modal fade" id="dataCustomerModalAdd" tabindex="-1" role="dialog" aria-labelledby="dataCustomerModalAddLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataCustomerModalAddLabel">Add New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.customer.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email " class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}">
                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" rows="5" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    @endsection

    @include('layouts.components.admin.footer')

    @section('js')
        <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('#dataCategory').DataTable();
            });
        </script>
    @endsection
@endsection
