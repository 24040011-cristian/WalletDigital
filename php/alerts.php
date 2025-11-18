<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION['alert']) && is_array($_SESSION['alert'])) {
    $type = $_SESSION['alert']['type'] ?? 'info';
    $msg  = $_SESSION['alert']['msg']  ?? '';

    // Escapar texto para JS
    $jsType = json_encode($type);
    $jsMsg  = json_encode($msg);

    echo <<<HTML
<script>
if (typeof Swal !== 'undefined') {
    Swal.fire({
        icon: $jsType,
        title: $jsMsg,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2500
    });
} else {
    // Fallback simple alert si SweetAlert2 no está cargado
    console.warn('SweetAlert2 no cargado. Mensaje:', $jsMsg);
}
</script>
HTML;

    unset($_SESSION['alert']);
}
?>
