<div class="container login ">

    <?php include_once __DIR__ . "/../templates/name-site.php" ?>

    <div class="container-sm">
        <p class="page-description projectbooster">Crea tu Cuenta</p>

        <?php include_once __DIR__ . "/../templates/alerts.php" ?>

        <form class="form" method="POST" action="/create">
            <div class="field">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tu Nombre" name="name" value="<?php echo $user->name ?>" required>
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu Email" name="email" value="<?php echo $user->email ?>" required>
            </div>
            <div class="field">
                <label for="password">Contraseña</label>
                <input type="password" id="password" placeholder="Tu Contraseña" name="password" required>
            </div>
            <div class="field">
                <label for="password2">Repetir Contraseña</label>
                <input type="password" id="password2" placeholder="Repite tu Contraseña" name="password2" required>
            </div>

            <input type="submit" class="boton" value="Crear Cuenta">
        </form>

        <div class="actions">
            <a href="/login">¿Ya tienes una cuenta? Inicia sesión</a>
            <a href="/forgot">¿Olvidaste tu contraseña? Recuperar acceso</a>
        </div>

    </div> <!--End of container-sm-->
</div>