

<?php $__env->startSection('content'); ?>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Update Data</h1>
  </div>

  <form class="col-lg-8" method="POST" action="/dashboard/products/edit/<?php echo e($object->id); ?>"  >
    <?php echo method_field('POST'); ?>
    <?php echo csrf_field(); ?>

    <div class="mb-3">
      <label for="ISIN" class="form-label">ISIN</label>
      <input type="text" class="form-control" id="ISIN" name="ISIN" value="<?php echo e(($object->ISIN)); ?>" readonly>
    </div>

    <div class="mb-3">
      <label for="name" class="form-label">Product Name</label>
      <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $object->productName)); ?>">
    </div>

    <div class="mb-3">
      <label for="sharpRatio" class="form-label">Sharp Ratio</label>
      <input type="number" step="0.0001" class="form-control <?php $__errorArgs = ['sharpRatio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="sharpRatio" name="sharpRatio" value="<?php echo e(old('sharpRatio', $object->sharpRatio)); ?>" required>

      <?php $__errorArgs = ['sharpRatio'];
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

    <div class="mb-3">
      <label for="AUM" class="form-label">AUM</label>
      <input type="number" class="form-control <?php $__errorArgs = ['AUM'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="AUM" name="AUM" value="<?php echo e(old('AUM', $object->AUM)); ?>" required>

      <?php $__errorArgs = ['address'];
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

    <div class="mb-3">
      <label for="deviden" class="form-label">Deviden</label>
      <select class="form-select <?php $__errorArgs = ["deviden"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="deviden" name="deviden" required>
        <option value="" disabled selected>Choose One</option>
        <option value="1" <?php echo e(old('deviden', $object->deviden) === '1' ?  'selected' : ''); ?>>YES</option>
        <option value="0" <?php echo e(old('deviden', $object->deviden) === '0' ?  'selected' : ''); ?>>NO</option>
      </select>

      <?php $__errorArgs = ['deviden'];
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

    <button type="submit" class="btn btn-primary mb-3">Save Changes</button>
    <a href="/dashboard/products" class="btn btn-danger mb-3">Cancel</a>
  </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SAW\resources\views/dashboard/products/edit.blade.php ENDPATH**/ ?>