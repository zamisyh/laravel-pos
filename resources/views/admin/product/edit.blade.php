@extends('layouts.admin')

@section('title', 'Product Edit')
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
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
          </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Product</h6>
                    </div>
                    <div class="card-body">
                        <form action='{{ url("admin/product/{$data->id}") }}' method="post" enctype="multipart/form-data">
                            @csrf
                            @method("PATCH")
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                placeholder="Input your name" value="{{ $data->name }}">
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" name="stock" id="stock" class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}"
                                placeholder="Input your stock" value="{{ $data->stock }}">
                                <p class="text-danger">{{ $errors->first('stock') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                placeholder="Input your price" value="{{ $data->price }}">
                                <p class="text-danger">{{ $errors->first('price') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}">
                                    <option value="{{ $data->category->id }}">{{ $data->category->name }}</option>
                                    <option>--------------------------</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id}}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('category') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" rows="3" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ $data->description }}</textarea>
                                <p class="text-danger">{{ $errors->first('description') }}</p>
                            </div>
                            <div class="form-group">
                                <label>Image</label>

                                <p>
                                    <img src="{{ asset('assets/images/product/' . $data->image) }}" height="100px" alt="">
                                </p>

                                <div class="custom-file">
                                  <input type="file" name="image" class="form-control{{ $errors->has('image') ? 'is-invalid' : '' }}" id="customFile">

                                </div>
                                <p class="text-danger">{{ $errors->first('image') }}</p>
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
    @section('js')
        <script src="{{ asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>

        <script>
            ClassicEditor
                .create( document.querySelector( '#description' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
            });
        </script>
    @endsection

@endsection
