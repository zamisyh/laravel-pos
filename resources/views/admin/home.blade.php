@extends('layouts.admin')

@section('title', 'Home Admin Dashboard')

@section('body')
    @include('layouts.components.admin.sidebar')
    @include('layouts.components.admin.topbar')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </div>

        <div class="row mb-3">
            @include('layouts.components.admin.report')

            <div class="col-xl-8 col-lg-7 mb-4">
                <div class="card">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Orders Today</h6>
                    <a class="m-0 float-right btn btn-danger btn-sm" href="{{ route('admin.order.index') }}">View More <i
                        class="fas fa-chevron-right"></i></a>
                  </div>
                  <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                        <tr>
                          <th>Invoice</th>
                          <th>Customer</th>
                          <th>Item</th>
                          <th>Qty</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($order as $item)
                            <tr>
                                <td><a href="#">{{ $item->invoice }}</a></td>
                                <td>{{ $item->customer->name }}</td>
                                @foreach ($item->order_detail as $detail)
                                   <td>{{ $detail->product->name }}</td>
                                   <td>{{ $detail->qty }}</td>
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

                                @empty
                                <td class="text-center" colspan="5">There is no order today</td>
                            </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer"></div>
                </div>
              </div>

              <div class="col-xl-4 col-lg-3 mb-4">
                <div class="card">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Product Sold</h6>
                        <a class="m-0 float-right btn btn-danger btn-sm" href="{{ route('admin.order.index') }}">View More <i
                            class="fas fa-chevron-right"></i></a>
                  </div>

                  <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                        <tr>
                          <th>Product</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                           @forelse ($order_sold as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->stock }}</td>

                           @empty
                                <td class="text-center" colspan="2">Many products are available </td>
                                </tr>



                           @endforelse

                      </tbody>
                    </table>

                    <div class="p-3 mt-">
                        {{ $order_sold->links() }}
                   </div>
                  </div>

                </div>
              </div>


        </div>


    </div>

</div>
    @include('layouts.components.admin.footer')
@endsection
