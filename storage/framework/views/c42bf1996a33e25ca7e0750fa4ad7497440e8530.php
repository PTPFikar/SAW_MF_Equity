<?php $__env->startSection('content'); ?>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Products</h1>
  </div>

  <div class="table-responsive col-lg-10">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center">#</th>
          <th scope="col" class="text-center">ISIN</th>
          <th scope="col" class="text-center">Product Name</th>
          <th scope="col" class="text-center">Sharp Ratio</th>
          <th scope="col" class="text-center">AUM</th>
          <th scope="col" class="text-center">Deviden</th>
          <th scope="col" class="text-center">Date</th>
        </tr>
      </thead>
      <tbody>
        <?php if($objects->count()): ?>
          <?php $__currentLoopData = $objects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $object): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              
              <td class="text-center"><?php echo e($loop->iteration); ?></td>
              <td class="text-center"><?php echo e($object->ISIN); ?></td>
              <td class><?php echo e($object->productName); ?></td>
              <td class="text-center"><?php echo e($object->sharpRatio); ?></td>
              <td class="text-center"><?php echo e($object->AUM); ?></td>
              <td class="text-center"><?php echo e($object->deviden == 2 ? 'YES': 'NO'); ?></td>
              <td class="text-center"><?php echo e($object->date); ?></td>
              <td class="text-center">
                <a href="<?php echo e(route('product.edit', $object->id)); ?>" class="text-decoration-none text-success">
                  <span data-feather="edit"></span>
                </a>
                <form action="<?php echo e(route('product.delete', $object->id)); ?>" method="POST" class="d-inline">
                  <?php echo method_field('DELETE'); ?>
                  <?php echo csrf_field(); ?>

                  <span role="button" class="text-decoration-none text-danger btnDelete" data-object="products">
                    <span data-feather="x-circle"></span>
                  </span>
                </form>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <tr>
            <td colspan="7" class="text-danger text-center p-3">
              <h4>You Haven't Create Any Products Objects Yet</h4>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
    <b><i><font size="2">*Nilai Deviden "YES" bukan berarti akan selalu mendapatkan keuntungan</font></i></b>
    <br>
    <?php echo e($objects->links()); ?>

      <a href="products/export_excel">
        <button type="submit" class="btn btn-warning mb-3">
          <span data-feather="download"></span> Download
        </button>
      </a>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SPK-SAW\resources\views/dashboard/products/index.blade.php ENDPATH**/ ?>