<?php $__env->startComponent('mail::message'); ?>
# Sách đã có sẵn

Xin chào <?php echo e($reservation->user->name); ?>,

Sách "<?php echo e($reservation->book->title); ?>" mà bạn đã đặt trước hiện đã có sẵn.

Chi tiết đặt trước:
- Ngày đặt: <?php echo e(Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y')); ?>

- Trạng thái: Có sẵn

Vui lòng đến mượn sách trong vòng 48 giờ. Sau thời gian này, đặt trước của bạn sẽ bị hủy.

<?php $__env->startComponent('mail::button', ['url' => config('app.url').'/books/'.$reservation->book_id]); ?>
Mượn sách ngay
<?php echo $__env->renderComponent(); ?>

Cảm ơn bạn đã sử dụng dịch vụ của thư viện.

<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?> <?php /**PATH C:\Users\nguye\Downloads\webthuvienn\resources\views/emails/books/available.blade.php ENDPATH**/ ?>