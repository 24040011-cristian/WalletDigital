<?php
    include __DIR__ . '/components.php';
    userLogged();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php headContent("Agregar Tarjetas"); ?>
</head>

<body>
    <header>
        <?php navbar(); ?>
    </header>

    <main>
        <div class="form-wrapper">
            <div class="form-card">
                <h2>Agrega tu tarjeta</h2>

                <form action="process.php" method="POST">
                    <input type="hidden" name="accion" value="addCard">

                    <div class="form-group">
                        <label>Numero de Tarjeta</label>
                        <input type="text" name="cardNumber" required>
                    </div>

                    <div class="form-group">
                        <label for="bank">Banco</label>
                        <select name="bank" id="bank" required>
                            <option value="">Seleccione un banco</option>
                            <option value="BBVA">BBVA</option>
                            <option value="Santander">Santander</option>
                            <option value="Banorte">Banorte</option>
                            <option value="HSBC">HSBC</option>
                            <option value="Scotiabank">Scotiabank</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Fecha de registro</label>
                        <input type="date" name="fechaRegistro" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Saldo</label>
                        <input type="number" name="saldo" step="0.01" min="0" required>
                    </div>

                    <button class="btn_general" type="submit">Agregar</button>
                    <button class="btn-rojo" onclick="window.history.go(-1)">Regresar</button>

                </form>
            </div>
        </div>
    </main>

    <?php footer(); ?>
</body>
</html>