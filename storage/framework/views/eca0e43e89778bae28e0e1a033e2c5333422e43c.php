<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-4">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link <?php echo e(request()->is('dashboard') ? 'active' : ''); ?>" aria-current="page" href="/dashboard">
          <span data-feather="home"></span>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo e(request()->is('dashboard/profile*') ? 'active' : ''); ?>" href="/dashboard/profile">
          <span data-feather="user"></span>
          Admin
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo e(request()->is('dashboard/calculation*') ? 'active' : ''); ?>" href="/dashboard/calculation">
          <span data-feather="clipboard"></span>
          Calculation
        </a>
      </li>
    </ul>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
      <hr>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link <?php echo e(request()->is('dashboard/upload-products*') ? 'active' : ''); ?>" href="/dashboard/upload-products">
            <span data-feather="upload"></span>
            Upload Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo e(request()->is('dashboard/products*') ? 'active' : ''); ?>" href="/dashboard/products">
            <span data-feather="database"></span>
            Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo e(request()->is('dashboard/criterias*') ? 'active' : ''); ?>" href="/dashboard/criterias">
            <span data-feather="flag"></span>
            Criterias
          </a>
        </li>
      </ul>
    <?php endif; ?>
  </div>
</nav><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SPK-SAW\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>