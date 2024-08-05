<div id="print-area">
    <table class="table table-hover table-bordered">

        <thead>
        <tr>
            <th><?php echo app('translator')->get('site.name'); ?></th>
            <th><?php echo app('translator')->get('site.quantity'); ?></th>
            <th><?php echo app('translator')->get('site.price'); ?></th>
        </tr>
        </thead>

        <tbody>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($product->name); ?></td>
            <td><?php echo e($product->pivot->quantity); ?></td>
            <td><?php echo e(number_format($product->pivot->quantity * $product->sale_price, 2)); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <h3><?php echo app('translator')->get('site.total'); ?> <span><?php echo e(number_format($order->total_price, 2)); ?></span></h3>

</div>

<button class="btn btn-block btn-primary print-btn"><i class="fa fa-print"></i> <?php echo app('translator')->get('site.print'); ?></button>
<?php /**PATH C:\xampp\htdocs\pos_app\resources\views/dashboard/orders/_products.blade.php ENDPATH**/ ?>
