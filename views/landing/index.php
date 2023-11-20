<header class="header">
    <div class="nav animated">

        <nav class="links">
            <a href="">Inicio</a>
            <a href="">Características</a>
            <a href="">Opiniones</a>
        </nav>

        <div class="sesion-nav">
            <a href="/login">Iniciar Sesión</a>
            <?php if (isset($_SESSION["login"])) : ?>
                <a href="/logout">Cerrar Sesión</a>
            <?php endif; ?>
        </div>
    </div>


    <div class="header-center animated">
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

<main class="container main animated">
    <div class="cont-img">
        <img src="/build/img/app.webp" alt="Imagen Principal">
    </div>
    <div class="cont-content">
        <h2>Eficiente Gestor de Proyectos</h2>
        <p>Optimiza tu productividad y controla tus proyectos con nuestro gestor diseñado especialmente para eso. Organiza tareas, colabora sin esfuerzo y logra resultados excepcionales con nuestra plataforma intuitiva y poderosa.</p>
        <div class="div-main">
            <a href="/create" class="contact">¡Forma parte de nosotros!</a>
            <a href="https://www.youtube.com/" target="_blank" class="video-contain">
                <img src="/build/img/play.png" alt="boton ir al video">
                <span class="span">¿Cómo funciona el software?</span>
            </a>
        </div>
    </div>
</main>

<div class="grid-features container animated">
    <div class="feature">
        <img src="/build/img/eficiente.png" alt="usuarios imagen">
        <div>
            <h2>Rápido</h2>
            <p>Nuestro gestor es líder en eficiencia para organizarte todas las tareas de la semana de manera efectiva</p>
        </div>
    </div>
    <div class="feature">
        <img src="/build/img/custom.png" alt="usuarios imagen">
        <div>
            <h2>Sencillo</h2>
            <p>El software dispone de una alta capacidad de personalización y es bastante intuitivo para cualquier persona</p>
        </div>
    </div>
    <div class="feature">
        <img src="/build/img/secure.png" alt="usuarios imagen">
        <div>
            <h2>Seguro</h2>
            <p>Todos los datos que utilices en nuestra aplicación estan completamente seguros en nuestros servidores.</p>
        </div>
    </div>
    <div class="feature">
        <img src="/build/img/phone.png" alt="usuarios imagen">
        <div>
            <h2>Teléfono</h2>
            <p>A pesar de ser una aplicación web, nuestro software esta disponible al 100% para cualquier teléfono.</p>
        </div>
    </div>
</div>