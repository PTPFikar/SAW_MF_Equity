

<?php $__env->startSection('content'); ?>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Input Criteria Comparison Value</h1>
  </div>

  <div class="table-responsive col-lg-12">
    <div class="d-lg-flex justify-content-end gap-2">
      <a href="/dashboard/criteria-comparisons" class="btn btn-secondary mb-3">
        <span data-feather="arrow-left"></span>
        Back To Comparisons Data
      </a>

      <?php if($isDoneCounting): ?>
      <a href="/dashboard/criteria-comparisons/result/<?php echo e($criteria_analysis->id); ?>" class="btn btn-success mb-3 ml-4">
        <span data-feather="clipboard"></span>
        See Comparison Result
      </a>
      <?php endif; ?>
    </div>

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center">First Criteria</th>
          <th scope="col" class="text-center">Value</th>
          <th scope="col" class="text-center">Second Criteria</th>
          <th scope="col" colspan="2"></th>
        </tr>
      </thead>
      <tbody>
        <?php if(count($details)): ?>
          <form action="/dashboard/criteria-comparisons/<?php echo e($details[0]->criteria_analysis_id); ?>" method="POST">
            <?php echo method_field('put'); ?>
            <?php echo csrf_field(); ?>

            <input type="hidden" name="id" value="<?php echo e($details[0]->criteria_analysis_id); ?>">
            <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <input type="hidden" name="criteria_analysis_detail_id[]" value="<?php echo e($detail->id); ?>">

                <td class="text-center">
                  <?php echo e($detail->firstCriteria->name); ?>

                </td>
                <td class="text-center">
                  <select class="form-select" name="comparison_values[]" required>
                    <option value="" disabled selected>--Choose Value--</option>
                    <option value="1" <?php echo e($detail->comparison_value == 1 ? 'selected' : ''); ?>>
                      1 - Equally Important
                    </option>
                    <option value="2" <?php echo e($detail->comparison_value == 2 ? 'selected' : ''); ?>>
                      2 - Equally Important / A Little More Important
                    </option>
                    <option value="3" <?php echo e($detail->comparison_value == 3 ? 'selected' : ''); ?>>
                      3 - A Little More Important
                    </option>
                    <option value="4" <?php echo e($detail->comparison_value == 4 ? 'selected' : ''); ?>>
                      4 - Equally Important / Obviously More Important
                    </option>
                    <option value="5" <?php echo e($detail->comparison_value == 5 ? 'selected' : ''); ?>>
                      5 - Obviously More Important
                    </option>
                    <option value="6" <?php echo e($detail->comparison_value == 6 ? 'selected' : ''); ?>>
                      6 - Obviously More Important / Very Clearly Important
                    </option>
                    <option value="7" <?php echo e($detail->comparison_value == 7 ? 'selected' : ''); ?>>
                      7 - Very Clearly Important
                    </option>
                    <option value="8" <?php echo e($detail->comparison_value == 8 ? 'selected' : ''); ?>>
                      8 - Very Clearly Important / Absolutely More Important
                    </option>
                    <option value="9" <?php echo e($detail->comparison_value == 9 ? 'selected' : ''); ?>>
                      9 - Absolutely More Important
                    </option>
                  </select>
                </td>
                <td class="text-center">
                  <?php echo e($detail->secondCriteria->name); ?>

                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $criteria_analysis)): ?>
              <tr>
                <td class="text-center">
                  <button type="submit" class="btn btn-primary">Save</button>
                </td>
              </tr>
            <?php endif; ?>
          </form>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\spk-laravel\resources\views/dashboard/criteria-comparison/input-value.blade.php ENDPATH**/ ?>