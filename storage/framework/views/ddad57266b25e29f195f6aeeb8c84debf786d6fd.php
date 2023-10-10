<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Upload Products</title>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

            <form action="<?php echo e(route('upload')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="file" name="csv">
                <input type="submit" value="submit">
          </form>

        </div>
    </body>
</html><?php /**PATH D:\MyFiles\Kuliah\Skripsi\Aplication\spk-laravel\resources\views/dashboard/uploadproducts/index.blade.php ENDPATH**/ ?>