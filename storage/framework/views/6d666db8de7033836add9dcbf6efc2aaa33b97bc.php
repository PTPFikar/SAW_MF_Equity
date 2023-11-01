

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Calculation SAW</h1>
    </div>
    <form method="post" action="<?php echo e(route('calculateSAW')); ?>">
        <?php echo csrf_field(); ?>
        <div class="row">
            <label for="date" class="form-label">Select Date</label>
            <div class="col-lg-2">
                <input type="date" class="form-control" id="date" name="date" placeholder="YYYY-MM-DD" required
                    value="<?php echo e($date ?? ''); ?>">
            </div>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary">
                    <span data-feather="settings"></span> Calculate
                </button>
            </div>
        </div>
    </form>
       <!-- Display Data if Available Raw Data-->
       <?php if(isset($results)): ?>
       <div class="table-responsive col-lg-10 text-center">
           <br>
           <h1 class="h2">Raw Data</h1>
       </div>
       <div class="table-responsive col-lg-10">
           <table class="table table-striped">
               <thead>
                   <tr>
                       <th scope="col" class="text-center">ISIN</th>
                       <th scope="col" class="text-center">Product Name</th>
                       <th scope="col" class="text-center">C1</th>
                       <th scope="col" class="text-center">C2</th>
                       <th scope="col" class="text-center">C3</th>
                   </tr>
               </thead>
               <tbody>
                   <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <tr>
                       <td class="text-center"><?php echo e($result['ISIN']); ?></td>
                       <td><?php echo e($result['productName']); ?></td>
                       <td class="text-center"><?php echo e(number_format($result['C1'], 2)); ?></td>
                       <td class="text-center"><?php echo e(number_format($result['C2'], 2)); ?></td>
                       <td class="text-center"><?php echo e(number_format($result['C3'], 2)); ?></td>
                   </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </tbody>
           </table>
       </div>
       <?php endif; ?>
    <!-- Display Data if Available // Normalization -->
    <?php if(isset($results)): ?>
    <div class="table-responsive col-lg-10 text-center">
        <br>
        <h1 class="h2">Normalization Data</h1>
    </div>
    <div class="table-responsive col-lg-10">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-center">ISIN</th>
                    <th scope="col" class="text-center">Product Name</th>
                    <th scope="col" class="text-center">C1</th>
                    <th scope="col" class="text-center">C2</th>
                    <th scope="col" class="text-center">C3</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="text-center"><?php echo e($result['ISIN']); ?></td>
                    <td><?php echo e($result['productName']); ?></td>
                    <td class="text-center"><?php echo e(number_format($result['C1'], 2)); ?></td>
                    <td class="text-center"><?php echo e(number_format($result['C2'], 2)); ?></td>
                    <td class="text-center"><?php echo e(number_format($result['C3'], 2)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
    <!-- Display Preferences Data // Preferences -->
    <?php if(isset($results)): ?>
    <div class="table-responsive col-lg-10 text-center">
        <br>
        <h1 class="h2">Preferences Data</h1>
    </div>
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
                    <td class="text-center"><?php echo e($result['ISIN']); ?></td>
                    <td><?php echo e($result['productName']); ?></td>
                    <td class="text-center"><?php echo e(number_format($result['C1'], 2)); ?></td>
                    <td class="text-center"><?php echo e(number_format($result['C2'], 2)); ?></td>
                    <td class="text-center"><?php echo e(number_format($result['C3'], 2)); ?></td>
                    <td class="text-center"><?php echo e(number_format($result['Result'], 2)); ?></td>
                    <td class="text-center"><?php echo e($result['Rank']); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <form action="<?php echo e(route('calculate.exports', $date)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-warning mb-3">
                <span data-feather="download"></span> Download
            </button>
        </form>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SPK-SAW\resources\views/dashboard/calculation/index.blade.php ENDPATH**/ ?>