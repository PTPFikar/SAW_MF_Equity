<?php $__env->startSection('content'); ?>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Risk Free</h1>
  </div>
  <div class="table-responsive col-lg-10">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center">Risk Free (%)</th>
        </tr>
      </thead>
      <tbody>
        <?php if($objects->count()): ?>
          <?php $__currentLoopData = $objects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $object): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td class="text-center"><?php echo e(number_format($object->risk * 100, 2)); ?>%</td>
              <td class="text-center">
                <a href="<?php echo e(route('risk.edit', $object->id)); ?>" class="text-decoration-none text-success">
                  <span data-feather="edit"></span>
                </a>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </tbody>
    </table>
    <b><i><font size="2">*Risk Free digunakan dalam perhitungan sharpe ratio</font></i></b><br>
    <b><i><font size="2">*Risk Free didapatkan nilai dari https://www.bi.go.id/id/statistik/indikator/bi-7day-rr.aspx</font></i></b><br>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SPK-SAW\resources\views/dashboard/risk/index.blade.php ENDPATH**/ ?>