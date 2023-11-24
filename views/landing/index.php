<header class="header">
    <div class="nav animated">

        <nav class="links">
            <a href="#start">Inicio</a>
            <a href="#features">Características</a>
            <a href="#reviews">Opiniones</a>
        </nav>

        <div class="sesion-nav">
            <a href="/login">Iniciar Sesión</a>
            <?php if (isset($_SESSION["login"])) : ?>
                <a href="/logout">Cerrar Sesión</a>
            <?php endif; ?>
        </div>
    </div>


    <div class="header-center animated" id="start">
        <h1>Project Booster</h1>
        <p>Transforma ideas en logros, gestiona con éxito. Un software diseñado especialmente para ser productivo.</p>
        <a class="cssbuttons-io-button" href="/create"> ¡Regístrate!
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path fill="none" d="M0 0h24v24H0z"></path>
                    <path fill="currentColor" d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path>
                </svg>
            </div>
        </a>

    </div>
</header>

<?php include_once __DIR__ . '/features.php';?>
<?php include_once __DIR__ . '/reviews.php';?>
<?php include_once __DIR__ . '/footer.php';?>