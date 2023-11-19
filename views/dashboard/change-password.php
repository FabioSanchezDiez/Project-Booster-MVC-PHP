<?php include_once __DIR__ . "/header-dashboard.php"; ?>
<div class="container-sm animated">
    <?php include_once __DIR__ . "/../templates/alerts.php"?>

    <a href="/profile" class="link">Volver a la configuración</a>

    <form class="form" method="POST" action="/change-password">
        <div class="field">
            <label for="actual_password">Contraseña actual</label>
            <input type="password" name="actual_password" id="actual_password" placeholder="Tu contraseña actual">
        </div>
        <div class="field">
            <label for="new_password">Contraseña nueva</label>
            <input type="password" name="new_password" id="new_password" placeholder="Tu contraseña nueva">
        </div>

        <input type="submit" value="Confirmar cambios">
    </form>
</div>
<?php include_once __DIR__ . "/footer-dashboard.php"; ?>