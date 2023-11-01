<?php $__env->startSection('content'); ?>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Criterias</h1>
  </div>

  <div class="table-responsive col-lg-10">

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center">ID Criteria</th>
          <th scope="col" class="text-center">Criteria Name</th>
          <th scope="col" class="text-center">Attribute</th>
          <th scope="col" class="text-center">Weight</th>
        </tr>
      </thead>
      <tbody>
        <?php if($criterias->count()): ?>
          <?php $__currentLoopData = $criterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              
              <td class="text-center"><?php echo e($loop->iteration); ?></td>
              <td class="text-center"><?php echo e($criteria->criteriaName); ?></td>
              <td class="text-center"><?php echo e($criteria->attribute); ?></td>
              <td class="text-center"><?php echo e($criteria->weight); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="text-danger text-center p-4">
              <h4>You Haven't Create Any Criterias Yet</h4>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
    <br>
    <b><i><font size="2">*Nilai Weight yang diberikan merupakan agar investor dapat melakukan investasi yang kerugiannya tidak terlalu signifikan dan Product yang akan direkomendasikan sudah disukai atau dipercaya oleh para investor untuk berinvestasi.</font></i></b><br>
    <b><i><font size="2">*Sharp Ratio adalah Perhitungan nilai Expected Return dibagi dengan Standar.</font></i></b><br>
    <b><i><font size="2">*Asset Under Management (AUM) adalah Total dana kelola product.</font></i></b><br>
    <b><i><font size="2">*Dividen adalah Bagi hasil keuntungan product.</font></i></b><br>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SPK-SAW\resources\views/dashboard/criteria/index.blade.php ENDPATH**/ ?>