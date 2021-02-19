<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon">
        <img src="">
      </div>
      <div class="sidebar-brand-text mx-3">LARAVEL POS</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
      <a class="nav-link" href="{{ route('admin.home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Features
    </div>
    @if (auth()->user()->can('show products') || auth()->user()->can('delete products') || auth()->user()->can('create products')))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.category.index') }}">
          <i class="fa fa-comment"></i>
          <span>Category</span>
        </a>
    </li>
    @endif
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
          aria-controls="collapseTable">
          <i class="fas fa-file-alt"></i>
          <span>Data</span>
        </a>
        <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">All Data</h6>
            @role('admin')
                <a class="collapse-item" href="{{ route('admin.users.index') }}">Admin</a>
            @endrole
            <a class="collapse-item" href="{{ route('admin.customer.index') }}">Customers</a>
          </div>
        </div>
      </li>
     @role('admin')

     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#userManajements" aria-expanded="true"
          aria-controls="userManajements">
          <i class="fas fa-users"></i>
          <span>Users Manajement</span>
        </a>
        <div id="userManajements" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">All Data</h6>
            <a class="collapse-item" href="{{ route('admin.role.index') }}">Role</a>
            <a class="collapse-item" href="{{ route('admin.role_permission') }}">Permission</a>
          </div>
        </div>
      </li>

     @endrole
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.product.index') }}">
          <i class="fa fa-shopping-cart"></i>
          <span>Product</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true"
          aria-controls="collapseReport">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Reports</span>
        </a>
        <div id="collapseReport" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">All Report</h6>
            <a class="collapse-item" href="{{ route('admin.order.index') }}">Order</a>
            <a class="collapse-item" href="">Graph</a>
          </div>
        </div>
      </li>
    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
  </ul>
  <!-- Sidebar -->
