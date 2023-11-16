<?php include_once __DIR__ . "/header-dashboard.php"; ?>
<?php if (count($projects) === 0) { ?>

    <div class="container" style="text-align: center; margin-bottom: 2rem;">
        <p>¡Bienvenido! Todavía no tienes ningún proyecto por tanto no aún no puedes usar el calendario.</p>
        <a href="/create-project" class="create-calendar">Crear Proyecto</a>
    </div>

<?php } else { ?>

    <div class="container-sm animated">
    <?php include_once __DIR__ . "/../templates/alerts.php" ?>
        <form class="form-calendar" method="POST" action="/calendar">
            <div class="field">
                <label for="weekDay">Selecciona un día:</label>
                <select name="weekDay" id="weekDay" class="btn-calendar">
                    <option disabled selected>-- Seleccionar --</option>
                    <option value="Lunes">Lunes</option>
                    <option value="Martes">Martes</option>
                    <option value="Miercoles">Miércoles</option>
                    <option value="Jueves">Jueves</option>
                    <option value="Viernes">Viernes</option>
                    <option value="Sabado">Sábado</option>
                    <option value="Domingo">Domingo</option>
                </select>
            </div>
            <div class="field">
                <label for="projectId">Selecciona un proyecto:</label>
                <select name="projectId" id="projectId" class="btn-calendar">
                    <option disabled selected>-- Seleccionar --</option>
                    <?php foreach ($projects as $project) : ?>
                        <option value="<?php echo $project->id ?>"><?php echo $project->project ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="field">
                <label for="hours">Indica cuantas horas le quieres dedicar al proyecto el día seleccionado:</label>
                <input type="number" id="hours" name="hours" min="1" max="24" class="btn-calendar-number">
            </div>

            <input type="hidden" value="<?php echo $_SESSION["id"] ?>" name="userId">
            <input type="submit" value="Añadir al calendario">

        </form>
    </div>
<?php } ?>
<div class="container animated">
    <div class="calendar">
        <div class="day">
            <h3 class="day-name">Lunes</h3>

            <div class="project-calendar">
                <div class="text-content">
                    <p>Aprender a aprender</p>
                </div>
                <div class="hour-content">
                    <p>5 horas al día</p>
                    <div class="actions-content">
                        <a href="">
                            <img src="build/img/edit.svg" alt="Editar datos">
                        </a>
                        <a href="">
                            <img src="build/img/bin.png" alt="Eliminar del calendario" style="filter: invert(100%);">
                        </a>
                    </div>
                </div>

            </div>
        
            <div class="empty-addproject">
            </div>
            <div class="empty-addproject">
            </div>
        </div>
        <div class="day">
            <h3 class="day-name">Martes</h3>
            <div class="empty-addproject">
            </div>
            <div class="empty-addproject">
            </div>
            <div class="empty-addproject">
            </div>
        </div>
        <div class="day">
            <h3 class="day-name">Miércoles</h3>
            <div class="empty-addproject">
            </div>
            <div class="empty-addproject">
            </div>
            <div class="empty-addproject">
            </div>
        </div>
        <div class="day">
            <h3 class="day-name">Jueves</h3>
            <div class="empty-addproject">
            </div>
            <div class="empty-addproject">
            </div>
            <div class="empty-addproject">
            </div>
        </div>
        <div class="day">
            <h3 class="day-name">Viernes</h3>
            <div class="empty-addproject">
            </div>
            <div class="empty-addproject">
            </div>
            <div class="empty-addproject">
            </div>
        </div>
        <div class="day">
            <h3 class="day-name">Sábado</h3>
            <div class="empty-addproject">
            </div>
            <div class="empty-addproject">
            </div>
            <div class="empty-addproject">
            </div>
        </div>
        <div class="day">
            <h3 class="day-name">Domingo</h3>
            <div class="empty-addproject">
            </div>
            <div class="empty-addproject">
            </div>
            <div class="empty-addproject">
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . "/footer-dashboard.php"; ?>