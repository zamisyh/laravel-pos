@extends('client.layouts.app')

@section('title', 'Home')


@section('content')
    @include('client.layouts.components.navbar')

    <div class="container mt-5">
        <div class="d-flex justify-content-between flex-wrap m-1">
            @php $no = 1; @endphp
            @foreach ($product as $prod)
                <div class="card" style="width: 22rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $prod->name }}</h5>
                        <span class="mb-2 badge badge-primary text-white p-1">{{ $prod->category->name }}</span>
                        <img src="{{ asset('assets/images/product/' . $prod->image) }}" height="100px" width="100%" alt="{{ $prod->category->name }}">
                        <p class="card-text">{!! substr($prod->description, 0, 100) !!}</p>

                        <div class="d-flex justify-content-between">
                            <a href='{{ route('client.order', $prod->id) }}' class="btn btn-primary btn-sm"><i class="fas fa-cart-plus"></i> Buy</a>
                            <span class="{{ $prod->stock == 0 ? 'btn btn-danger btn-sm ': 'btn btn-info btn-sm ' }}">
                                {{ $prod->stock == 0 ? 'Habis' : 'Stock : ' . $prod->stock }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

