@extends('client.layouts.app')
@section('title', 'Search Status Data Customer')

@section('css')
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('client.layouts.components.navbar')

    <div class="wrapper">
        <div class="container">
            <div class="card card-body mt-5"">
                <h3>Search Data Customer</h3>
                <hr>
                <form action="" method="GET">
                    @if (session()->get('cNotFound'))
                        <div class="form-group">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                               {{ session()->get('cNotFound') }}
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="search">Search Email</label>
                        <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Search Email...">
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block">Search</button>
                    </div>
                </form>
            </div>

            @if (!empty($order))
            <div class="card card-body mb-4 mt-3">
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataCustomer">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Invoice</th>
                                <th>Name</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Date Transaction</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($order as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->invoice }}</td>
                                <td>{{ ucwords(strtolower($item->customer->name)) }}</td>



                                @foreach ($item->order_detail as $detail)
                                <td>{{ ucwords(strtolower($detail->product->name)) }}</td>
                                <td>{{ $detail->qty }}</td>
                                <td>{{ number_format($detail->price) }}</td>
                                <td>{{ number_format($detail->qty * $detail->price) }}</td>
                                <td>{{ $item->created_at->format('d M Y - H:i:s') }}</td>
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

                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
             </div>
        </div>
            @endif
    </div>
@endsection

@section('js')

<script src="{{ asset("assets/vendor/datatables/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("assets/vendor/datatables/dataTables.bootstrap4.min.js") }}"></script>

<script>
    $(document).ready(function () {
      $('#dataCustomer').DataTable(); // ID From dataTable with Hover
    });
  </script>
@endsection
