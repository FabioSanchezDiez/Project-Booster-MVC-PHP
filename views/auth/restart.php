<div class="container login ">
    <?php include_once __DIR__ . "/../templates/name-site.php" ?>

    <div class="container-sm">
        <p class="page-description projectbooster">Escribe tu nueva contraseña</p>

        <?php include_once __DIR__ . "/../templates/alerts.php" ?>

        <?php if($show):?>
        <form class="form" method="POST">
            
            <div class="field">
                <label for="password">Contraseña</label>
                <input type="password" id="password" placeholder="Tu Nueva Contraseña" name="password" required>
            </div>

            <input type="submit" class="boton" value="Guardar Contraseña">
        </form>

        <?php endif;?>

        <div class="actions">
            <a href="/create">¿No tienes una cuenta? Obtener una</a>
            <a href="/forgot">¿Olvidaste tu contraseña? Recuperar acceso</a>
        </div>

    </div> <!--End of container-sm-->
</div>