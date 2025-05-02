<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Framework</title>
</head>
<body>
    <!-- Header -->
    <header>
        <nav>
            <ul>
                <li><a href="<?php echo e(BASE_URI); ?>/">Inicio</a></li>
                <li><a href="<?php echo e(BASE_URI); ?>/users/create">Crear usuarios</a></li>
                <li><a href="<?php echo e(BASE_URI); ?>/about">Acerca de</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php echo $__env->yieldContent('content'); ?> 
    </main>

    <footer>
        <p>&copy; <?= date('Y'); ?> Mi Framework</p>
    </footer>
    <script src="<?php echo e(BASE_URI); ?>/public/js/script.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\mvcrp\resources\views/layouts/app.blade.php ENDPATH**/ ?>