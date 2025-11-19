<?php
// Si la sesión no está iniciada, iniciarla
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si hay una alerta en la sesión, mostrarla usando SweetAlert2
if (!empty($_SESSION['alert']) && is_array($_SESSION['alert'])) {
    $type = $_SESSION['alert']['type'] ?? 'info';
    $msg  = $_SESSION['alert']['msg']  ?? '';

    // Escapar texto para JS
    $jsType = json_encode($type);
    $jsMsg  = json_encode($msg);

    // Generar el script para SweetAlert2
    echo <<<HTML
<script>
// Si SweetAlert2 está disponible, mostrar la alerta
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
    // Limpiar la alerta de la sesión después de mostrarla
    unset($_SESSION['alert']);
}
?>
