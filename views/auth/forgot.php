<div class="container login">
    <?php include_once __DIR__ . "/../templates/name-site.php" ?>

    <div class="container-sm">
        <p class="page-description projectbooster">Recupera tu Acceso</p>

        <?php include_once __DIR__ . "/../templates/alerts.php" ?>


        <form class="form" method="POST" action="/forgot">
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu Email" name="email" required>
            </div>

            <input type="submit" class="boton" value="Enviar Instrucciones">
        </form>

        <div class="actions">
            <a href="/login">¿Ya tienes una cuenta? Inicia sesión</a>
            <a href="/create">¿No tienes una cuenta? Obtener una</a>
        </div>

    </div> <!--End of container-sm-->
</div>