<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Calculation SAW</h1>
    </div>
    <form method="post" action="<?php echo e(route('calculateSAW')); ?>">
        <?php echo csrf_field(); ?>
        <div class="table-responsive col-lg-2">
            <label for="date" class="form-label">Select Date</label>
            <input type="date" class="form-control" id="date" name="date" required
            value="<?php echo e($date ?? ''); ?>">
        </div>
        <button type="submit" class="btn btn-primary">
            <span data-feather="check-square"></span>
            Calculate
        </button>
    </form>
    <!-- Display results if available -->
    <?php if(isset($results)): ?>
    <div class="table-responsive col-lg-10">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-center">ISIN</th>
                    <th scope="col" class="text-center">Product Name</th>
                    <th scope="col" class="text-center">C1</th>
                    <th scope="col" class="text-center">C2</th>
                    <th scope="col" class="text-center">C3</th>
                    <th scope="col" class="text-center">Result Total</th>
                    <th scope="col" class="text-center">Rank</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($result['ISIN']); ?></td>
                    <td><?php echo e($result['productName']); ?></td>
                    <td><?php echo e(number_format($result['C1'], 4)); ?></td>
                    <td><?php echo e(number_format($result['C2'], 2)); ?></td>
                    <td><?php echo e(number_format($result['C3'], 2)); ?></td>
                    <td><?php echo e(number_format($result['Result'], 4)); ?></td>
                    <td><?php echo e($result['Rank']); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <a href="calculation/export_excel">
            <button type="submit" class="btn btn-success mb-3">
            Download
            </button>
          </a>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SPK-SAW\resources\views/dashboard/calculation/index.blade.php ENDPATH**/ ?>