

<?php $__env->startSection('content'); ?>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Upload Products</h1>
  </div>
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <span data-feather="upload"></span> Upload File
        </button>
         <a href="<?php echo e(asset('assets/example/Data_Product.csv')); ?>" download>
            <button type="submit" class="btn btn-warning mb-3">
                <span data-feather="download"></span> Download Sample
            </button>
         </a>

  <div class="row">     
      <?php if(session('success')): ?>
           <div class="alert alert-success alert-dismissible fade show" role="alert">
           <?php echo e(session('success')); ?>

           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>
      <?php endif; ?>
      
       <table class="table">
           <thead>
               <tr>
               <th scope="col">ISIN</th>
               <th scope="col">Product Name</th>
               <th scope="col">Expect Return 1 Year</th>
               <th scope="col">Standard Deviation 1 Year</th>
               <th scope="col">Sharpe Ratio</th>
               <th scope="col">AUM</th>
               <th scope="col">Deviden</th>
               <th scope="col">Date</th>
               </tr>
           </thead>
           <tbody>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($product->ISIN); ?></td>
                    <td><?php echo e($product->productName); ?></td>
                    <td><?php echo e($product->expectReturn); ?></td>
                    <td><?php echo e($product->standardDeviation); ?></td>
                    <td><?php echo e($product->sharpeRatio); ?></td>
                    <td><?php echo e($product->AUM); ?></td>
                    <td><?php echo e($product->deviden == 2 ? 'YES': 'NO'); ?></td>
                    <td><?php echo e($product->date); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           </tbody>
       </table>
       <?php echo e($products->links()); ?>

  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
   <div class="modal-content">
       <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
           <form action="<?php echo e(route('upload_csv')); ?>" method="POST" enctype="multipart/form-data">
               <?php echo csrf_field(); ?>
               <div class="input-group mb-3">
                   <input type="file" name="file" class="form-control">
                   <button class="btn btn-primary" type="submit">Submit</button>
               </div>
           </form>
       </div>
   </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SPK-SAW\resources\views/dashboard/uploadproducts/index.blade.php ENDPATH**/ ?>