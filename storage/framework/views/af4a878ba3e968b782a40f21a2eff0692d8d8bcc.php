<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/assets/img/unbin.png">
    <title><?php echo e($title); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

<!-- Custom styles for this template -->
    <link href="/assets/css/auth.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <?php echo $__env->yieldContent('content'); ?>
  </body>

  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="/assets/js/script.js"></script>

  
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
</html>
<?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\spk-laravel\resources\views/layouts/auth.blade.php ENDPATH**/ ?>