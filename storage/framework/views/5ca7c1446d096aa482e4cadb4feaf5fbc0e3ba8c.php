

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Report</h1>
    </div>
    <form method="post" action="<?php echo e(route('reportSAW')); ?>">
        <?php echo csrf_field(); ?>
        <div class="row">
            <label for="date" class="form-label">Select Date</label>
            <div class="col-lg-2">
                <input type="date" class="form-control" id="date" name="date" placeholder="YYYY-MM-DD" required value="<?php echo e($date ?? ''); ?>">
            </div>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-gear"></i> Preview
                </button>
            </div>
        </div>
    </form>
       <!-- Display Data if Available // Raw Data -->
       <?php if(isset($rawData)): ?>
            <div class="table-responsive col-lg-12 text-center">
                <br>
                <h1 class="h2">Report Rank Product</h1>
            </div>
            <div class="table-responsive col-lg-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">ISIN</th>
                            <th scope="col" class="text-center">Product Name</th>
                            <th scope="col" class="text-center">Expect Return 1 Year</th>
                            <th scope="col" class="text-center">Sharpe Ratio</th>
                            <th scope="col" class="text-center">AUM</th>
                            <th scope="col" class="text-center">Deviden</th>
                            <th scope="col" class="text-center">Result SAW</th>
                            <th scope="col" class="text-center">Rank</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($result['ISIN']); ?></td>
                            <td><?php echo e($result['productName']); ?></td>
                            <td class="text-center"><?php echo e($rawData[$result['ID']]['expectReturn']); ?></td>
                            <td class="text-center"><?php echo e($rawData[$result['ID']]['C1']); ?></td>
                            <td class="text-center"><?php echo e($rawData[$result['ID']]['C2']); ?></td>
                            <td class="text-center"><?php echo e($rawData[$result['ID']]['C3'] == 2 ? 'YES': 'NO'); ?></td>
                            <td class="text-center"><?php echo e(number_format($result['Result'], 2)); ?></td>
                            <td class="text-center"><?php echo e($result['Rank']); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <form action="<?php echo e(route('report.exports', $date)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-warning mb-3">
                        <span data-feather="download"></span> Download
                    </button>
                </form>
            </div>
       <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SPK-SAW\resources\views/dashboard/report/index.blade.php ENDPATH**/ ?>