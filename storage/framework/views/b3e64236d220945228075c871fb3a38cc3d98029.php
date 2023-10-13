<?php $__env->startSection('content'); ?>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Criterias</h1>
  </div>

  <div class="table-responsive col-lg-10">

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center">ID Criteria</th>
          <th scope="col" class="text-center">Name</th>
          <th scope="col" class="text-center">Attribute</th>
          <th scope="col" class="text-center">Weight</th>
        </tr>
      </thead>
      <tbody>
        <?php if($criterias->count()): ?>
          <?php $__currentLoopData = $criterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              
              <td class="text-center"><?php echo e($loop->iteration); ?></td>
              <td class="text-center"><?php echo e($criteria->name); ?></td>
              <td class="text-center"><?php echo e(Str::ucfirst(Str::lower($criteria->attribute))); ?></td>
              <td class="text-center"><?php echo e($criteria->weight); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="text-danger text-center p-4">
              <h4>You haven't create any criterias yet</h4>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SPK-SAW\resources\views/dashboard/criteria/index.blade.php ENDPATH**/ ?>