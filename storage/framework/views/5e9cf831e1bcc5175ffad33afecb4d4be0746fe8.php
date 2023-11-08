<?php $__env->startSection('content'); ?>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Update Data</h1>
  </div>

  <form class="col-lg-8" method="POST" action="<?php echo e(route('product.update', $object->id)); ?>">
    <?php echo method_field('PUT'); ?>
    <?php echo csrf_field(); ?>

    <div class="mb-3">
      <label for="ISIN" class="form-label">ISIN</label>
      <input type="text" class="form-control" id="ISIN" name="ISIN" value="<?php echo e(($object->ISIN)); ?>">
    </div>

    <?php $__errorArgs = ['ISIN'];
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

    <div class="mb-3">
      <label for="productName" class="form-label">Product Name</label>
      <input type="text" class="form-control" id="productName" name="productName" value="<?php echo e(old('name', $object->productName)); ?>">
    </div>

    <?php $__errorArgs = ['productName'];
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

      <div class="mb-3">
        <label for="expectReturn" class="form-label">Expect Return</label>
        <input type="number" step="0.0001" class="form-control <?php $__errorArgs = ['expectReturn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="expectReturn" name="expectReturn" value="<?php echo e(old('expectReturn', $object->expectReturn)); ?>" required>
  
    <?php $__errorArgs = ['expectReturn'];
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
      
      <div class="mb-3">
        <label for="standardDeviation" class="form-label">Standard Deviation</label>
        <input type="number" step="0.0001" class="form-control <?php $__errorArgs = ['standardDeviation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="standardDeviation" name="standardDeviation" value="<?php echo e(old('standardDeviation', $object->standardDeviation)); ?>" required>
    
    <?php $__errorArgs = ['standardDeviation'];
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

      <div class="mb-3">
        <label for="risk" class="form-label">Risk Free</label>
        <?php
            $riskPercentage = $risk * 100;
        ?>
        <input type="text" class="form-control" id="risk" name="risk" value="<?php echo e(old('risk', number_format($riskPercentage, 2) . '%')); ?>" readonly>
        
      <div class="mb-3">
        <label for="sharpeRatio" class="form-label">Sharpe Ratio</label>
        <input type="text" class="form-control" id="sharpeRatio" name="sharpeRatio" value="<?php echo e(old('sharpeRatio', $object->sharpeRatio)); ?>" readonly>

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

    <?php $__errorArgs = ['AUM'];
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

      <div class="mb-3">
        <label for="deviden" class="form-label">Deviden</label>
        <select class="form-select <?php $__errorArgs = ['deviden'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="deviden" name="deviden" required>
          <option value="2" <?php echo e(old('deviden', $object->deviden) == '2' ? 'selected' : ''); ?>>YES</option>
          <option value="1" <?php echo e(old('deviden', $object->deviden) == '1' ? 'selected' : ''); ?>>NO</option>
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

      <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="date" name="date" value="<?php echo e(old('date', $object->date)); ?>" required>

    <?php $__errorArgs = ['date'];
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

  <script>
    // Add JavaScript to calculate the Sharpe Ratio
    document.addEventListener("DOMContentLoaded", function () {
      const expectReturn = document.getElementById("expectReturn");
      const standardDeviation = document.getElementById("standardDeviation");
      const sharpeRatio = document.getElementById("sharpeRatio");
  
      expectReturn.addEventListener("input", calculateSharpeRatio);
      standardDeviation.addEventListener("input", calculateSharpeRatio);
  
      function calculateSharpeRatio() {
        const expectReturnValue = parseFloat(expectReturn.value);
        const standardDeviationValue = parseFloat(standardDeviation.value);
        const risk = parseFloat(document.getElementById("risk").value) / 100;
  
        if (!isNaN(expectReturnValue) && !isNaN(standardDeviationValue) && standardDeviationValue !== 0) {
          const calculatedSharpeRatio = (expectReturnValue-risk) / standardDeviationValue;
          sharpeRatio.value = calculatedSharpeRatio.toFixed(4);
        } else {
          sharpeRatio.value = "";
        }
      }
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SPK-SAW\resources\views/dashboard/products/edit.blade.php ENDPATH**/ ?>