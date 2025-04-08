<?php $__env->startComponent('mail::message'); ?>
# Đăng ký gói thành viên thành công

Xin chào <?php echo e($subscription->user->name); ?>,

Cảm ơn bạn đã đăng ký gói thành viên <?php echo e($subscription->package->name); ?>.

Chi tiết gói:
- Tên gói: <?php echo e($subscription->package->name); ?>

- Ngày bắt đầu: <?php echo e(Carbon\Carbon::parse($subscription->start_date)->format('d/m/Y')); ?>

- Ngày kết thúc: <?php echo e(Carbon\Carbon::parse($subscription->end_date)->format('d/m/Y')); ?>


<?php $__env->startComponent('mail::button', ['url' => 'http://localhost:3000/membership']); ?>
Xem chi tiết gói thành viên
<?php echo $__env->renderComponent(); ?>

Trân trọng,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?> <?php /**PATH C:\Users\nguye\Downloads\webthuvienn\resources\views/emails/subscription/created.blade.php ENDPATH**/ ?>