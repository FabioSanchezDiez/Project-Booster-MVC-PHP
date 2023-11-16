<div class="mobile-bar">
    <h1>Project Booster</h1>

    <div class="menu">
        <img id="mobile-menu" src="/build/img/menu.svg" alt="imagen de menu">
    </div>
</div>

<div class="bar">
    <div class="content-bar">
    <p>Usuario: <span><?php echo $_SESSION["name"]?></span></p>
    <p>Email: <span><?php echo $_SESSION["email"]?></span></p>
    </div>
    
    <a href="/logout" class="close-session">Cerrar Sesión</a>
    
</div>