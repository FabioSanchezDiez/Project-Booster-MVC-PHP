<aside class="sidebar">
    <div class="sidebar-container">
    <h2>Project Booster</h2>
    <div class="close-menu">
        <img id="close-menu" src="/build/img/close.svg" alt="imagen de cerrar">
    </div>
    </div>
    

    <nav class="sidebar-nav">
        <a class="<?php echo ($title === 'Proyectos') ? 'active' : '';?>" href="/dashboard">Mis Proyectos</a>
        <a class="<?php echo ($title === 'Nuevo Proyecto') ? 'active' : '';?>" href="/create-project">Nuevo Proyecto</a>
        <a class="<?php echo ($title === 'Calendario') ? 'active' : '';?>" href="/calendar">Calendario</a>
        <a class="<?php echo ($title === 'Configuración' || $title === 'Cambiar contraseña') ? 'active' : '';?>" href="/profile">Configuración</a>
        <a href="/">Volver Atrás</a>
    </nav>

    <div class="close-sesion-mobile">
        <a href="/logout" class="close-sesion">Cerrar Sesión</a>
    </div>
</aside>