@extends('client.layouts.app')

@section('title', 'Detail Product ' . $product->name)


@section('content')
    @include('client.layouts.components.navbar')

    <div class="container mt-5 d-flex justify-content-center">
        <div class="box1">
            <div class="card card-body" style="max-width: 400px">
                <img src="{{ asset('assets/images/product/' . $product->image) }}" alt="{{ $product->name }}" style="max-height: 300px">
                <strong class="mt-5">Description</strong>
                <p>{!! $product->description !!}</p>
            </div>
        </div>
        <div class="ml-2" style="width: 400px">
            <div class="card card-body">
                <h3>{{ $product->name }}</h3>
                <span class="text-success">{{ $product->category->name }}</span>
                <hr>
                <form action="">
                    <div class="form-group">
                        <label for="name">Products Name</label>
                        <input type="text" class="form-control" value="{{ $product->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" value="{{ number_format($product->price) }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="text" class="form-control" value="{{ number_format($product->stock) }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" value="{{ $product->category->name }}" readonly>
                    </div>
                    <div class="form-group">

                        @if ($product->stock == 0)
                            <button class="btn btn-danger form-control">Sold Out</button>
                            @elseif(!Auth::user())
                                <button class="btn btn-primary form-control" type="button" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-cart-plus"></i> Order</button>
                            @else
                                <a class="btn btn-primary form-control" href='{{ url("order/{$product->id}/checkout") }}'><i class="fas fa-cart-plus"></i> Order</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
