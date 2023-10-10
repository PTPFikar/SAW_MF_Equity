

<?php $__env->startSection('content'); ?>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Criterias</h1>
  </div>

  <form class="col-lg-8" method="POST" action="/dashboard/criterias/<?php echo e($criteria->id); ?>">
    <?php echo method_field('PUT'); ?>
    <?php echo csrf_field(); ?>

    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name" value="<?php echo e(old('name', $criteria->name)); ?>" autofocus required>

      <?php $__errorArgs = ['name'];
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
      <label for="attribute" class="form-label">Attribute</label>
      <select class="form-select <?php $__errorArgs = ["attribute"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="attribute" name="attribute" required>
        <option value="" disabled selected>Choose One</option>
        <option value="BENEFIT" <?php echo e(old('attribute', $criteria->attribute) === 'BENEFIT' ?  'selected' : ''); ?>>Benefit</option>
        <option value="COST" <?php echo e(old('attribute', $criteria->attribute) === 'COST' ?  'selected' : ''); ?>>Cost</option>
      </select>

      <?php $__errorArgs = ['attribute'];
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
    <a href="/dashboard/criterias" class="btn btn-danger mb-3">Cancel</a>
  </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\spk-laravel\resources\views/dashboard/criteria/edit.blade.php ENDPATH**/ ?>