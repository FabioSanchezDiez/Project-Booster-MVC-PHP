<header>
    <nav class="nav">
        <div>
            <a href="/">
                <img src="/build/img/ProjectBoosterLog.png" alt="Project Booster Logo">
            </a>
        </div>
        <div class="links">
            <a href="">Inicio</a>
            <a href="">Características</a>
            <a href="">Opiniones</a>
            <a href="">FAQ</a>
        </div>
        <div class="sesion">
            <a href="/login">Entrar</a>
            <?php if (isset($_SESSION["login"])) : ?>
                <a href="/logout">Salir</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<main class="container main animated">
    <div class="cont-img2">
        <img src="/build/img/ImagenPrincipal.png" alt="Imagen Principal">
    </div>
    <div class="cont-content">
        <h1>Eficiente Gestor de Proyectos</h1>
        <p>Optimiza tu productividad y controla tus proyectos con nuestro gestor diseñado especialmente para eso. Organiza tareas, colabora sin esfuerzo y logra resultados excepcionales con nuestra plataforma intuitiva y poderosa.</p>
        <div class="div-main">
            <!--<a href="/create" class="contact">¡Regístrate!</a>-->
            <a class="cssbuttons-io-button" href="/create"> ¡Regístrate!
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path fill="currentColor" d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path>
                    </svg>
                </div>
            </a>
            <a href="https://www.youtube.com/" target="_blank" class="video-contain">
                <img src="/build/img/play.webp" alt="boton ir al video">
                <span class="span">¿Cómo funciona el software?</span>
            </a>
        </div>
    </div>
</main>

<div class="container animated middle">
    <div class="grid-middle">
        <div class="bg-middle" style="background-color: #7377fb;">
            <img src="/build/img/user.png" alt="usuarios imagen" style="filter: invert(100%);">
        </div>
        <div class="op-text">
            <span>14K +</span>
            <div class="black-line"></div>
            <p>Miles de usuarios forman parte de nuestra comunidad.</p>
        </div>
    </div>
    <div class="grid-middle">
        <div class="bg-middle" style="background-color: #5a7bff;">
            <img src="/build/img/positiva.png" alt="usuarios imagen" style="filter: invert(100%);">
        </div>
        <div class="op-text">
            <span>6K +</span>
            <div class="black-line"></div>
            <p>Más de 6.000 reseñas positivas en cuanto a nuestro software.</p>
        </div>
    </div>
    <div class="grid-middle">
        <div class="bg-middle" style="background-color: #6987ff;">
            <img src="/build/img/crecimiento.png" alt="usuarios imagen" style="filter: invert(100%);">
        </div>
        <div class="op-text">
            <span>12% +</span>
            <div class="black-line"></div>
            <p>El crecimiento de la plataforma aumenta mensualmente.</p>
        </div>
    </div>
</div>