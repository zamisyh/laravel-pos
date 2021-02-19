@extends('layouts.admin')

@section('title', 'Order')
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
            <li class="breadcrumb-item active" aria-current="page">Order</li>
          </ol>
        </div>



        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Order</h6>

                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataCategory">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Invoice</th>
                                <th>Name</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->invoice }}</td>
                                    <td>{{ $item->customer->name }}</td>

                                    @foreach ($item->order_detail as $detail)
                                        <td>{{ $detail->product->name }}</td>
                                        <td>{{ $detail->product->category->name }}</td>
                                        <td>{{ $detail->qty }}</td>
                                        <td>Rp. {{ number_format($detail->price) }}</td>
                                        <td>Rp. {{ number_format($detail->qty * $detail->price) }}</td>
                                        <td>
                                            @if ($detail->status == 'pending')
                                                   <span class="badge badge-danger">{{ $detail->status }}</span>
                                                @elseif($detail->status == 'packed')
                                                   <span class="badge badge-info">{{ $detail->status }}</span>
                                                @elseif($detail->status == 'delivery')
                                                   <span class="badge badge-primary">{{ $detail->status }}</span>
                                                @else
                                                   <span class="badge badge-success">{{ $detail->status }}</span>
                                            @endif
                                        </td>
                                        <td class="d-flex">
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateOrder{{ $item->id }}"><i class="fas fa-eye"></i></button>

                                            <form action="{{ route('admin.order.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button" class="btn btn-danger btn-sm ml-1 btn-delete"><i class="fas fa-trash-alt"></i></button>
                                                <input type="hidden" value="{{ $detail->product_id }}" name="prodid">
                                                <input type="hidden" value="{{ $detail->qty }}" name="qtyid">

                                            </form>
                                        </td>

                                        <div class="modal fade" id="updateOrder{{ $item->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="updateOrder{{ $item->id }}Title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="updateOrder{{ $item->id }}Title">Detail Transaction - {{ $item->customer->name }} <br> Date Transaction : <b>{{ $item->created_at->format('d M Y : H:i:s') }}</b><br> Invoice : <b>{{ $item->invoice }}</b></h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                               <div class="form-detail">
                                                    <h4>Customer</h4>
                                                    <div class="form-group">
                                                        <ul style="list-style: none">
                                                            <li>Name: {{ $item->customer->name }}</li>
                                                            <li>Email: {{ $item->customer->email }}</li>
                                                            <li>Phone: {{ $item->customer->phone }}</li>
                                                            <li>Address: {{ $item->customer->address }}</li>
                                                        </ul>
                                                    </div>

                                                    <h4>Product</h4>
                                                    <div class="form-group">
                                                        <ul style="list-style: none">
                                                            <li>Name : {{ $detail->product->name }}</li>
                                                            <li>Category : {{ $detail->product->category->name }}</li>
                                                            <li>Qty : {{ number_format($detail->qty) }}</li>
                                                            <li>Price : Rp. {{ number_format($detail->price) }}</li>
                                                            <li>Total : Rp. {{ number_format($detail->qty * $detail->price) }}</li>
                                                            <li>
                                                                @if ($detail->status == 'pending')
                                                                        Status : <span class="badge badge-danger">{{ $detail->status }}</span>
                                                                    @elseif($detail->status == 'packed')
                                                                        Status : <span class="badge badge-info">{{ $detail->status }}</span>
                                                                    @elseif($detail->status == 'delivery')
                                                                        Status : <span class="badge badge-primary">{{ $detail->status }}</span>
                                                                    @else
                                                                        Status : <span class="badge badge-success">{{ $detail->status }}</span>
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </div>
                                               </div>
                                               <div class="form-edit">
                                                  <form action="{{ route('admin.order.update', $item->id) }}" method="post">
                                                      @csrf
                                                      @method('PATCH')
                                                      <div class="form-group">
                                                          <label for="product">Product</label>
                                                          <select name="product" id="product" class="form-control">
                                                            <option value="{{ $detail->product->id }}">{{ $detail->product->name }}</option>
                                                            <option disabled>----------------</option>
                                                             @foreach ($products as $prod)
                                                                @if ($prod->stock != 0)
                                                                    <option value="{{ $prod->id }}">{{ $prod->name }}</option>
                                                                @endif
                                                             @endforeach
                                                          </select>
                                                      </div>
                                                      <div class="form-group">
                                                          <label for="qty">Qty</label>
                                                          <input type="number" name="qty" id="qty" class="form-control" value="{{ $detail->qty }}">
                                                      </div>

                                                      <input type="hidden" name="qty2" value="{{ $detail->qty }}">

                                                      <div class="form-group">
                                                        <label for="status">Status</label>
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="{{ $detail->status }}">{{ $detail->status }}</option>
                                                            <option disabled>----------------</option>
                                                            <option value="pending">Pending</option>
                                                            <option value="packed">Packed</option>
                                                            <option value="delivery">Delivery</option>
                                                            <option value="success">Success</option>
                                                        </select>
                                                    </div>


                                               </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="button" class="btn btn-primary btn-edit">Edit</button>
                                              <button class="btn btn-success btn-save">Save Changes</button>
                                            </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    @endforeach
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

    @section('js')
        <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('#dataCategory').DataTable();
            });
        </script>


        <script>
            $(document).ready(function() {
                $('.btn-save').hide();
                $('.form-edit').hide();
                $('.btn-edit').click(function() {
                    $('.form-detail').hide();
                    $('.btn-edit').hide();
                    $('.btn-save').show();
                    $('.form-edit').show();

                });
            });
        </script>
    @endsection
@endsection
