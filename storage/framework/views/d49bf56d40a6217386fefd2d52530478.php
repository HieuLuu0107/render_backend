<?php $__env->startComponent('mail::message'); ?>
# Đặt trước sách thành công

Xin chào <?php echo e($reservation->user->name); ?>,

Bạn đã đặt trước thành công sách "<?php echo e($reservation->book->title); ?>".

Chi tiết:
- Ngày đặt: <?php echo e(Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y')); ?>

- Trạng thái: Đang chờ

Chúng tôi sẽ thông báo cho bạn ngay khi sách có sẵn.

<?php $__env->startComponent('mail::button', ['url' => config('app.url').'/borrows']); ?>
Xem sách đã đặt trước
<?php echo $__env->renderComponent(); ?>

Cảm ơn bạn đã sử dụng dịch vụ của thư viện.

<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?> <?php /**PATH C:\Users\nguye\Downloads\webthuvienn\resources\views/emails/books/reserved.blade.php ENDPATH**/ ?>