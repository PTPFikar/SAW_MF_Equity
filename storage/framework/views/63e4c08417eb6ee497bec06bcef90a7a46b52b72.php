

<?php $__env->startSection('content'); ?>
<div class="container my-5">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Upload Products</h1>
  </div>
  <div class="row">
      <div class="d-flex my-2">
          <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
           + Upload File
           </button>
      </div>
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
               <th scope="col">Expect Return</th>
               <th scope="col">Standard Deviation</th>
               <th scope="col">AUM</th>
               <th scope="col">Deviden</th>
               </tr>
           </thead>

       </table>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
   <div class="modal-content">
       <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
           <form action="import" method="POST" enctype="multipart/form-data">
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
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SAW\resources\views/dashboard/uploadproducts/index.blade.php ENDPATH**/ ?>