

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
    <h1 class="h2">Criteria Comparisons</h1>
  </div>

  <div class="table-responsive col-lg-10">
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalChoose">
      <span data-feather="check-square"></span>
      Choose criteria
    </button>

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center">#</th>
          <th scope="col" class="text-center">Created By</th>
          <th scope="col" class="text-center">Created At</th>
          <th scope="col" class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if($comparisons->count()): ?>
          <?php $__currentLoopData = $comparisons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comparison): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              
              <td class="text-center"><?php echo e($loop->iteration); ?></td>
              <td class="text-center"><?php echo e($comparison->user->name); ?></td>
              <td class="text-center"><?php echo e($comparison->created_at->toFormattedDateString()); ?></td>
              <td class="text-center">
                <a href="/dashboard/criteria-comparisons/<?php echo e($comparison->id); ?>" class="badge bg-success text-decoration-none">
                  See Comparison Values
                </a>
                <form action="/dashboard/criteria-comparisons/<?php echo e($comparison->id); ?>" method="POST" class="d-inline">
                  <?php echo method_field('delete'); ?>
                  <?php echo csrf_field(); ?>

                  <span role="button" class="badge bg-danger btnDelete" data-object="Comparison Data">
                    Delete
                  </span>
                </form>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="text-danger text-center p-4">
              <h4>You haven't create any comparisons yet</h4>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- Modal Choose Criteria -->
  <div class="modal fade" id="modalChoose" tabindex="-1" aria-labelledby="modalChooseLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalChooseLabel">Choose Criteria</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/dashboard/criteria-comparisons" method="POST">
          <?php echo csrf_field(); ?>
          <div class="modal-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="text-center" colspan="2">Name</th>
                  <th scope="col" class="text-center">Attribute</th>
                </tr>
              </thead>
              <tbody>
                <?php if($criterias->count()): ?>
                  <?php $__currentLoopData = $criterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <th scope="row" class="text-center">
                        <input type="checkbox" value="<?php echo e($criteria->id); ?>" name="criteria_id[]">
                      </th>
                      <td class="text-center"><?php echo e($criteria->name); ?></td>
                      <td class="text-center"><?php echo e(Str::ucfirst(Str::lower($criteria->attribute))); ?></td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <tr>
                    <td class="text-center text-danger" colspan="4">No criteria found</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Continue</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\spk-laravel\resources\views/dashboard/criteria-comparison/index.blade.php ENDPATH**/ ?>