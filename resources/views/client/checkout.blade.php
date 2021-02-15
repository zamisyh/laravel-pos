@extends('client.layouts.app')

@section('title', 'Checkout')

@section('content')
    @include('client.layouts.components.navbar')

    <div class="container d-flex justify-content-center mt-5">
        <div class="card card-body box1" style="max-width: 400px">
            <h3>Data Customers</h3>
            <hr>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                        @foreach ($errors->all() as $item)
                            <li style="list-style: none">{{ $item }}</li>
                        @endforeach
                </div>
            @endif



            @if (empty($customer))
            <form action="" method="get">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Search email">

                </div>
                <div class="form-group">
                    @if ($errors->has('email'))
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-dark form-control" type="button" data-toggle="modal" data-target="#exampleModal">Add Customer</button>
                            <button class="btn btn-primary form-control ml-2">Check</button>
                        </div>
                    @else
                        <button class="btn btn-primary form-control">Check</button>
                    @endif

                </div>
            </form>
            @else
            <form action="{{ route('client.store.order') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $customer->name }}">
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ $customer->email }}">
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" value="{{ $customer->phone }}">
                    <p class="text-danger">{{ $errors->first('phone') }}</p>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" rows="5" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}">{{ $customer->address }}</textarea>
                </div>
                <input type="hidden" value="{{ $customer->id }}" name="idCustomer">
            @endif
        </div>

        <div class="card card-body box2 ml-2" style="max-height: 350px;">
            <h3>Detail Order</h3>
            <hr>

                <div class="form-group">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Products</th>
                                <th>Image</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td><img src="{{ asset('assets/images/product/' . $product->image) }}" alt="{{ $product->image }}" style="max-height: 100px"></td>
                                <td><input type="number" class="form-control" name="qty"></td>
                                <td><input type="text" class="form-control" readonly name="price" value="{{ $product->price }}"></td>
                                <input type="hidden" value="{{ $product->id }}" name="idProduct">
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    @if (!empty($customer))
                        <button class="btn btn-success form-control">Checkout</button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('client.add.customer') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                <p class="text-danger">{{ $errors->first('name') }}</p>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="emailreg" class="form-control {{ $errors->has('emailreg') ? 'is-invalid' : '' }}">
                <p class="text-danger">{{ $errors->first('emailreg') }}</p>
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
          <button  class="btn btn-primary">Submit</button>
        </div>
    </form>
      </div>
    </div>
  </div>
@endsection
