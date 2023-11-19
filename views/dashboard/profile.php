<?php include_once __DIR__ . "/header-dashboard.php"; ?>
<div class="container-sm animated">
    <?php include_once __DIR__ . "/../templates/alerts.php"?>

    <a href="/change-password" class="link">Cambiar contraseña</a>

    <form class="form" method="POST" action="/profile">
        <div class="field">
            <label for="name">Nombre</label>
            <input type="text" value="<?php echo $user->name?>" name="name" id="name" placeholder="Tu nombre">
        </div>
        <div class="field">
            <label for="email">Email</label>
            <input type="email" value="<?php echo $user->email?>" name="email" id="email" placeholder="Tu email">
        </div>

        <input type="submit" value="Confirmar cambios">
    </form>
</div>
<?php include_once __DIR__ . "/footer-dashboard.php"; ?>