<div class="container login">
    <?php include_once __DIR__ . "/../templates/name-site.php" ?>

    <div class="container-sm">
        <p class="page-description projectbooster">Iniciar Sesión</p>

        <?php include_once __DIR__ . "/../templates/alerts.php" ?>

        <form class="form" method="POST" action="/login">
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu Email" name="email" required>
            </div>
            <div class="field">
                <label for="password">Contraseña</label>
                <input type="password" id="password" placeholder="Tu Contraseña" name="password" required>
            </div>

            <input type="submit" class="boton" value="Iniciar Sesión">
        </form>

        <div class="actions">
            <a href="/create">¿No tienes una cuenta? Obtener una</a>
            <a href="/forgot">¿Olvidaste tu contraseña? Recuperar acceso</a>
        </div>

    </div> <!--End of container-sm-->
</div>