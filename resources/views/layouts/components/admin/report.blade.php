  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($count['total']) }}</div>

          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
 <!-- Earnings (Annual) Card Example -->
 <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Orders</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['order'] }}</div>

          </div>
          <div class="col-auto">
            <i class="fas fa-shopping-cart fa-2x text-success"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- New User Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Customer</div>
            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $count['customer'] }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-info"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Orders Today</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['orderToday'] }}</div>

          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-warning"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
