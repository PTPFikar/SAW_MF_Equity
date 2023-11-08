<?php $__env->startSection('content'); ?>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Risk</h1>
  </div>

  <form class="col-lg-8" method="POST" action="<?php echo e(route('risk.update', $object->id)); ?>">
    <?php echo method_field('PUT'); ?>
    <?php echo csrf_field(); ?>

    <div class="mb-3">
      <label for="risk" class="form-label">Risk Free (%)</label>
      <input type="number" step="0.01" class="form-control <?php $__errorArgs = ['risk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="risk" name="risk" value="<?php echo e(old('risk', $object->risk * 100)); ?>" required>

      <?php $__errorArgs = ['risk'];
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
    <a href="/dashboard/risks" class="btn btn-danger mb-3">Cancel</a>
  </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SPK-SAW\resources\views/dashboard/risk/edit.blade.php ENDPATH**/ ?>