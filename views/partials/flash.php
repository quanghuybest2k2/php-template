<?php

use Core\Session;
?>

<?php if (Session::hasFlash('message')): ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '<?= addslashes(Session::getFlash('message')) ?>',
            toast: true,
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        });
    </script>
<?php endif; ?>

<?php if (Session::hasFlash('error')): ?>
    <script>
        Swal.fire({
            title: "Lỗi",
            text: '<?= addslashes(Session::getFlash('error')) ?>',
            icon: "error",
        });
    </script>
<?php endif; ?>