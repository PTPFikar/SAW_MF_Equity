<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-4">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
          <span data-feather="home"></span>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('dashboard/profile*') ? 'active' : '' }}" href="/dashboard/profile">
          <span data-feather="user"></span>
          Admin
        </a>
      </li>
    </ul>

    @can('admin')
      <hr>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('dashboard/criterias*') ? 'active' : '' }}" href="/dashboard/criterias">
            <i class="bi bi-flag-fill"></i>
            Criterias
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('dashboard/risks*') ? 'active' : '' }}" href="/dashboard/risks">
            <i class="bi bi-flag"></i>
            Risk Free
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('dashboard/upload-products*') ? 'active' : '' }}" href="/dashboard/upload-products">
            <span data-feather="upload"></span>
            Upload Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('dashboard/products*') ? 'active' : '' }}" href="/dashboard/products">
            <span data-feather="archive"></span>
            Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('dashboard/calculation*') ? 'active' : '' }}" href="/dashboard/calculation">
            <i class="bi bi-clipboard2-data-fill"></i>
            Result
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('dashboard/report*') ? 'active' : '' }}" href="/dashboard/report">
            <i class="bi bi-file-earmark-bar-graph-fill"></i>
            Report
          </a>
        </li>
      </ul>
    @endcan
  </div>
</nav>