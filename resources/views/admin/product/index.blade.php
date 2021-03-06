@extends('layouts.admin')

@section('title', 'Data Product')
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
            <li class="breadcrumb-item active" aria-current="page">Product</li>
          </ol>
        </div>

        <div class="col-lg-12">
            @if (session()->get('successDelete'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h6><i class="fas fa-check"></i><b> Success</b></h6>
                 {{ session()->get('successDelete') }}
            </div>
            @endif
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Product</h6>
                    <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Create Product</a>
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataCategory">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Last Update</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ number_format($item->stock) }}</td>
                                    <td>Rp. {{ number_format($item->price) }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td class="d-flex">
                                        <a href='{{ url("admin/product/{$item->id}/edit") }}' class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                        <form action='{{ url("admin/product/{$item->id}") }}' method="post" class="ml-1">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-delete btn-sm" type="button"><i class="fas fa-trash-alt"></i></button>
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
