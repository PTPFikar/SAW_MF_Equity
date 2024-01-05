<?php $__env->startSection('content'); ?>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Criterias</h1>
  </div>

  <div class="table-responsive col-lg-10">
    <a href="<?php echo e(route('criteria.create')); ?>" class="btn btn-primary mb-3">
      <span data-feather="plus"></span>
      Add Criteria
    </a>  
  </div>

  <div class="table-responsive col-lg-10">

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center">ID Criteria</th>
          <th scope="col" class="text-center">Criteria Name</th>
          <th scope="col" class="text-center">Attribute</th>
          <th scope="col" class="text-center">Weight</th>
          <th scope="col" class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if($objects->count()): ?>
          <?php $__currentLoopData = $objects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $object): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              
              <td class="text-center"><?php echo e($loop->iteration); ?></td>
              <td class="text-center"><?php echo e($object->criteriaName); ?></td>
              <td class="text-center"><?php echo e($object->attribute); ?></td>
              <td class="text-center"><?php echo e($object->weight); ?></td>
              <td class="text-center">
                <a href="<?php echo e(route('criteria.edit', $object->id)); ?>" class="text-decoration-none text-success">
                  <span data-feather="edit"></span>
                </a>
                <form action="<?php echo e(route('criteria.delete', $object->id)); ?>" method="POST" class="d-inline">
                  <?php echo method_field('DELETE'); ?>
                  <?php echo csrf_field(); ?>
                  <span role="button" class="text-decoration-none text-danger btnDelete" data-object="criteria">
                    <span data-feather="x-circle"></span>
                  </span>
                </form>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="text-danger text-center p-4">
              <h4>You Haven't Create Any Criterias Yet</h4>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
    <br>
    <b><i><font size="2">*Nilai Weight yang diberikan merupakan agar investor dapat melakukan investasi yang kerugiannya tidak terlalu signifikan dan Product yang akan direkomendasikan sudah disukai atau dipercaya oleh para investor untuk berinvestasi.</font></i></b><br>
    <b><i><font size="2">*Sharpe Ratio adalah Perhitungan nilai Expected Return yang sudah dikurangi sama Risk Free kemudian dibagi dengan Standar.</font></i></b><br>
    <b><i><font size="2">*Asset Under Management (AUM) adalah Total dana kelola product.</font></i></b><br>
    <b><i><font size="2">*Deviden adalah Bagi hasil keuntungan product.</font></i></b><br><br>
    <b><i><font size="2">*Attribute BENEFIT merupakan jenis kriteria yang mengutamakan nilai tertinggi sebagai acuan pemilihan.</font></i></b><br>
    <b><i><font size="2">*Attribute COST merupakan jenis kriteria yang mengutamakan nilai terendah sebagai acuan pemilihan.</font></i></b><br>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SPK-SAW\resources\views/dashboard/criteria/index.blade.php ENDPATH**/ ?>