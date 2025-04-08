<?php $__env->startComponent('mail::message'); ?>
# Mượn sách thành công

Xin chào <?php echo e($borrow->user->name); ?>,

Bạn đã mượn thành công sách "<?php echo e($borrow->book->title); ?>".

Chi tiết mượn sách:
- Ngày mượn: <?php echo e(Carbon\Carbon::parse($borrow->borrow_date)->format('d/m/Y')); ?>

- Ngày hẹn trả: <?php echo e(Carbon\Carbon::parse($borrow->due_date)->format('d/m/Y')); ?>


<?php $__env->startComponent('mail::button', ['url' => 'http://localhost:3000/borrows']); ?>
Xem sách đã mượn
<?php echo $__env->renderComponent(); ?>

Trân trọng,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?> <?php /**PATH C:\Users\nguye\Downloads\webthuvienn\resources\views/emails/books/borrowed.blade.php ENDPATH**/ ?>