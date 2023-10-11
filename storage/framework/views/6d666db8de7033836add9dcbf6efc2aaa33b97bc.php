

<?php $__env->startSection('content'); ?>
  <style>
    .badge:hover {
      color: #fff !important;
      text-decoration: none;
    }

    .bg-success:hover {
      background: #2f9164 !important;
    }

    .bg-danger:hover {
      background: #e84a59 !important;
    }
  </style>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Calculation SAW</h1>
  </div>
  <div class="table-responsive col-lg-2">
    <label for="date" class="form-label">Select Date</label>
    <input type="date" class="form-control" id="date" name="date" required>
  </div>
  <button type="button" class="btn btn-primary mb-3 lg-2" data-bs-toggle="calculate" data-bs-target="#calculate">
    <span data-feather="check-square"></span>
    Calculate
  </button>
  <div class="table-responsive col-lg-10">
   
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center">ISIN</th>
          <th scope="col" class="text-center">Product Name</th>
          <th scope="col" class="text-center">C1</th>
          <th scope="col" class="text-center">C2</th>
          <th scope="col" class="text-center">C3</th>
          <th scope="col" class="text-center">Result Total</th>
          <th scope="col" class="text-center">Rank</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($result->ISIN); ?></td>
                <td><?php echo e($result->productName); ?></td>
                <td><?php echo e($result->criteria_first_value); ?></td>
                <td><?php echo e($result->criteria_second_value); ?></td>
                <td><?php echo e($result->criteria_third_value); ?></td>
                <td><?php echo e($result->criteria_result); ?></td>
                <td><?php echo e($result->criteria_rank); ?></td>
                <td><?php echo e($result->date); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
    <div class="table-responsive col-lg-10">
      <button type="button" class="btn btn-primary mb-3" data-bs-toggle="download" data-bs-target="#download">
        <span data-feather="download"></span>
        Download Excel
      </button>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SPK-SAW\resources\views/dashboard/calculation/index.blade.php ENDPATH**/ ?>