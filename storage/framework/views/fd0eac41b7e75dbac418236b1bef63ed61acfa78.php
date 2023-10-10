

<?php $__env->startSection('content'); ?>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Product</h1>
  </div>

  <div class="table-responsive col-lg-10">
    <a href="/dashboard/product/create" class="btn btn-primary mb-3">
      <span data-feather="plus"></span>
      Create New Product
    </a>

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center">#</th>
          <th scope="col" class="text-center">Name</th>
          <th scope="col" class="text-center">Address</th>
          <th scope="col" class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if($objects->count()): ?>
          <?php $__currentLoopData = $objects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $object): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              
              <td class="text-center"><?php echo e($loop->iteration); ?></td>
              <td class="text-center"><?php echo e($object->name); ?></td>
              <td class="text-center"><?php echo e($object->address); ?></td>
              <td class="text-center">
                <a href="/dashboard/product/<?php echo e($object->id); ?>/edit" class="text-decoration-none text-success">
                  <span data-feather="edit"></span>
                </a>
                <form action="/dashboard/product/<?php echo e($object->id); ?>" method="POST" class="d-inline">
                  <?php echo method_field('delete'); ?>
                  <?php echo csrf_field(); ?>

                  <span role="button" class="text-decoration-none text-danger btnDelete" data-object="product">
                    <span data-feather="x-circle"></span>
                  </span>
                </form>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="text-danger text-center p-4">
              <h4>You haven't create any product objects yet</h4>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\spk-laravel\resources\views/dashboard/product/index.blade.php ENDPATH**/ ?>