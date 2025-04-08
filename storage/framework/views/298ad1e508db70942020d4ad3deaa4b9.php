<!DOCTYPE html>
<html>
<head>
    <title>Đặt trước sách thành công</title>
</head>
<body>
    <h1>Xin chào <?php echo e($reservation->user->name); ?>,</h1>
    
    <p>Bạn đã đặt trước thành công sách "<?php echo e($reservation->book->title); ?>".</p>
    
    <p>Chúng tôi sẽ thông báo cho bạn ngay khi sách có sẵn.</p>
    
    <p>Trân trọng,<br>
    <?php echo e(config('app.name')); ?></p>
</body>
</html> <?php /**PATH C:\Users\nguye\Downloads\webthuvienn\resources\views/emails/book-reserved.blade.php ENDPATH**/ ?>