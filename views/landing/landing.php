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
        <p>Gestiona tus proyectos de manera eficiente con nuestro software diseñado especialmente para ello.</p>
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

<div class="grid-features container animated">
    <div class="feature">
        <img src="/build/img/eficiente.png" alt="usuarios imagen">
        <div>
            <h2>Eficiente</h2>
            <p>Nuestro gestor es líder en eficiencia para organizarte todas las tareas de la semana de manera efectiva</p>
        </div>
    </div>
    <div class="feature">
        <img src="/build/img/custom.png" alt="usuarios imagen">
        <div>
            <h2>Sencillo</h2>
            <p>El software dispone de una alta capacidad de personalización y es de un uso bastante intuitivo para cualquiera</p>
        </div>
    </div>
    <div class="feature">
        <img src="/build/img/custom.png" alt="usuarios imagen">
        <div>
            <h2>Sencillo</h2>
            <p>El software dispone de una alta capacidad de personalización y es de un uso bastante intuitivo para cualquiera</p>
        </div>
    </div>
    <div class="feature">
        <img src="/build/img/custom.png" alt="usuarios imagen">
        <div>
            <h2>Sencillo</h2>
            <p>El software dispone de una alta capacidad de personalización y es de un uso bastante intuitivo para cualquiera</p>
        </div>
    </div>
</div>