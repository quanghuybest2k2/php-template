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

<?php if (Session::hasFlash('validation_errors')): ?>
    <script>
        const validationErrors = <?= json_encode(Session::getFlash('validation_errors')) ?>;

        let errorHtml = '<ul>';
        for (const field in validationErrors) {
            const fieldErrors = validationErrors[field];
            for (const label in fieldErrors) {
                errorHtml += `<li><strong>${label}:</strong> ${fieldErrors[label]}</li>`;
            }
        }
        errorHtml += '</ul>';

        Swal.fire({
            title: "Vui lòng kiểm tra lại thông tin",
            icon: "error",
            html: errorHtml
        });
    </script>
<?php endif; ?>