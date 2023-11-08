<?php $__env->startSection('content'); ?>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome Back, <?php echo e(auth()->user()->name); ?>!</h1>
  </div>
  <div class="row">
    <div class="col-lg-4"> 
      <div class="card-data products">
        <div class="row">
          <div class="col-6"><i class="bi bi-database-check"></i></div>
          <div class="col-6 d-flex flex-column justify-content-center align-items-end">
            <div class="card-desc">Products</div>
            <div class="card-count"><?php echo e($products_count); ?></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4"> 
      <div class="card-data risks">
        <div class="row">
          <div class="col-6"><i class="bi bi-calculator"></i></div>
          <div class="col-6 d-flex flex-column justify-content-center align-items-end">
            <div class="card-desc">Risk Free</div>
            <div class="card-count"><?php echo e(number_format($risk * 100, 2)); ?>%</div>
            <div class="card-date"><?php echo e($date); ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SPK-SAW\resources\views/dashboard/index.blade.php ENDPATH**/ ?>