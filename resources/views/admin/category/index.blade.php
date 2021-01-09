@extends('layouts.admin')

@section('title', 'Category')
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
            <li class="breadcrumb-item active" aria-current="page">Category</li>
          </ol>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Category</h6>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dataCategoryModal"
                    id="#myBtn">New Category</button>
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataCategory">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $item)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $item->name }}</th>
                                    <th>{{ $item->description }}</th>
                                    <th class="d-flex">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#dataCategoryModalEdit{{ $item->id }}"
                                        id="#myBtn"><i class="fas fa-edit"></i></button>
                                        <form action='{{ url("admin/category/{$item->id}") }}' method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm ml-1 btn-delete" type="button"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </th>
                                </tr>

                                <div class="modal fade" id="dataCategoryModalEdit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="dataCategoryModalEdit{{ $item->id }}Label"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="dataCategoryModalEdit{{ $item->id }}Label">{{ $item->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action='{{ url("admin/category/{$item->id}") }}' method="post">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $item->name }}">
                                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea rows="3" name="description" id="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ $item->description }}</textarea>
                                                    <p class="text-danger">{{ $errors->first('description') }}</p>
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
    <div class="modal fade" id="dataCategoryModal" tabindex="-1" role="dialog" aria-labelledby="dataCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataCategoryModalLabel">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.category.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}">
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea rows="3" name="description" id="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"></textarea>
                        <p class="text-danger">{{ $errors->first('description') }}</p>
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
