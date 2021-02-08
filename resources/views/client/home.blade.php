@extends('client.layouts.app')

@section('title', 'Home')


@section('content')
    @include('client.layouts.components.navbar')

    <div class="container mt-5">
        <div class="d-flex justify-content-between flex-wrap">
            @php $no = 1; @endphp
            @foreach ($product as $prod)
                <div class="card" style="width: 22rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $prod->name }}</h5>
                        <span class="mb-2 badge badge-primary text-white p-1">{{ $prod->category->name }}</span>
                        <img src="{{ asset('assets/images/product/' . $prod->image) }}" height="100px" width="100%" alt="{{ $prod->category->name }}">
                        <p class="card-text">{!! substr($prod->description, 0, 100) !!}</p>

                    </div>
                </div>
                @if ($no++ %3 == 0)
                    <div style="margin-top: 2%"></div>
                @endif
            @endforeach
        </div>
    </div>
@endsection

