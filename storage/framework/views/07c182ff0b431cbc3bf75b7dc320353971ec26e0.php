

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
    <h1 class="h2">Alternatives</h1>
  </div>

  <div class="table-responsive">
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addAlternativeModal">
      <span data-feather="plus"></span>
      Create New Alternative
    </button>

    <table class="table table-bordered">
      <thead class="table-dark">
          <tr>
            <th class="text-center align-middle" rowspan="2">#</th>
            <th class="text-center align-middle" rowspan="2">Alternative's Name</th>
            <th class="text-center" colspan="<?php echo e($criterias->count()); ?>">Criterias</th>
            <th class="text-center align-middle" rowspan="2">Action</th>
          </tr>
          <tr>
            <?php if($criterias->count()): ?>
              <?php $__currentLoopData = $criterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th class="text-center"><?php echo e($criteria->name); ?></th>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
              <th class="text-center">No Criteria Data Found</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php if($alternatives->count()): ?>
            <?php $__currentLoopData = $alternatives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alternative): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <th scope="row" class="text-center">
                  <?php echo e($loop->iteration); ?>

                </th>
                <td class="text-center">
                  <?php echo e($alternative->name); ?>

                </td>
                <?php $__currentLoopData = $criterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if(isset($alternative->alternatives[$key])): ?>
                    <td class="text-center">
                      <?php echo e(floatval($alternative->alternatives[$key]->alternative_value)); ?>

                    </td>
                  <?php else: ?>
                    <td class="text-center">
                      Empty
                    </td>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <td class="text-center">
                  <a href="/dashboard/alternatives/<?php echo e($alternative->id); ?>/edit" class="badge bg-success text-decoration-none">
                    Edit
                  </a>

                  <form action="/dashboard/alternatives/<?php echo e($alternative->id); ?>" method="post" class="d-inline">
                    <?php echo method_field('delete'); ?>
                    <?php echo csrf_field(); ?>

                    <span class="badge bg-danger btnDelete" data-object="Alternative" style="cursor: pointer;">
                      Delete
                    </span>
                  </form>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
          <tr>
            <td colspan="<?php echo e(3 + $criterias->count()); ?>" class="text-center text-danger">
              No Data
            </td>
          </tr>
          <?php endif; ?>
        </tbody>
    </table>
  </div>

  <!-- Add Alternative -->
  <div class="modal fade" id="addAlternativeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAlternativeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addAlternativeModalLabel">Add Alternative</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/dashboard/alternatives" method="post">
          <div class="modal-body">
            <span class="mb-2">Rules :</span>
            <ul class="list-group mb-2">
              <li class="list-group-item bg-success text-white">
                The minimum number is 0
              </li>
              <li class="list-group-item bg-success text-white">
                The maximum number is 999
              </li>
              <li class="list-group-item bg-success text-white">
                Please use dot (.) if you want to make a decimal input
              </li>
            </ul>

              <?php echo csrf_field(); ?>
              <div class="my-2">
                <label for="products_id" class="form-label">Products</label>
                <select class="form-select <?php $__errorArgs = ['products_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 'is-invalid' : ''  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="products_id" name="products_id" required>
                  <?php if($products->count()): ?>
                    <option disabled selected>--Choose One--</option>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($products->id); ?>">
                        <?php echo e($products->name); ?>

                      </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                    <option disabled value="" selected>--NO DATA FOUND--</option>
                  <?php endif; ?>
                </select>
                
                <?php $__errorArgs = ['products_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback">
                  <?php echo e($message); ?>

                </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <?php if($criterias->count()): ?>
                <?php $__currentLoopData = $criterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $criteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <input type="hidden" name="criteria_id[]" value="<?php echo e($criteria->id); ?>">

                  <div class="my-2">
                    <label for="<?php echo e(str_replace(' ','', $criteria->name)); ?>" class="form-label">
                      Value of <?php echo e($criteria->name); ?>

                    </label>
                    <input type="text" id="<?php echo e(str_replace(' ','', $criteria->name)); ?>" class="form-control <?php $__errorArgs = ['alternative_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 'is-invalid' : '' <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="alternative_value[]" placeholder="Enter the value" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)|| event.charCode == 46)" maxlength="5" autocomplete="off" required>

                    <?php $__errorArgs = ['alternative_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <div class="invalid-feedback">
                        <?php echo e($message); ?>

                      </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="<?php echo e($criterias->count() ? "submit" : "button"); ?>" class="btn btn-primary">Add Alternative</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\spk-laravel\resources\views/dashboard/alternative/index.blade.php ENDPATH**/ ?>