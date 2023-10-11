<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/assets/img/unbin.png">
    <title><?php echo e($title); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/assets/css/dashboard.css" rel="stylesheet">
  </head>
  <body>

    
    <?php echo $__env->make('partials.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

    <div class="container-fluid">
      <div class="row">
        
        <?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        

        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <?php echo $__env->yieldContent('content'); ?>
        </main>
        
      </div>
    </div>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/script.js"></script>
    <script src="/assets/js/dashboard.js"></script>

    
    <?php if(session()->has('success')): ?>
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: "<?php echo e(session('success')); ?>",
        });
      </script>
    <?php endif; ?>
    <?php if(session()->has('failed')): ?>
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Failed',
          text: "<?php echo e(session('failed')); ?>",
        });
      </script>
    <?php endif; ?>
    <?php if(isset($errors) && $errors->has('oldPassword') || $errors->has('password')): ?>
      <script>
        const myModal = document.getElementById('modalUbahPassword');
        const modal = bootstrap.Modal.getOrCreateInstance(myModal);
        modal.show();
      </script>
    <?php endif; ?>
  </body>
</html>
<?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\SPK-SAW\resources\views/layouts/main.blade.php ENDPATH**/ ?>