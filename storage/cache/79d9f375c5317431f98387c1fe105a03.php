 

<?php $__env->startSection('content'); ?>
    <h1>Crear usuarios</h1>
    <form action="<?php echo e(BASE_URI); ?>/users/store" method="POST">
        <input type="hidden" name="_token" value="<?php echo e($csrfToken); ?>">
        <label>Nombre:</label>
        <input type="text" name="name" required>
        <br><br>

        <label>Email:</label>
        <input type="email" name="email" required>
        <br><br>

        <label>Contraseña:</label>
        <input type="password" name="password" required>
        <br><br>

        <button type="submit">Guardar</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mvcrp\resources\views/users/create.blade.php ENDPATH**/ ?>