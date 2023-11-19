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
                    <option value="1">Lunes</option>
                    <option value="2">Martes</option>
                    <option value="3">Miércoles</option>
                    <option value="4">Jueves</option>
                    <option value="5">Viernes</option>
                    <option value="6">Sábado</option>
                    <option value="7">Domingo</option>
                </select>
            </div>
            <div class="field">
                <label for="projectId">Selecciona un proyecto:</label>
                <select name="projectId" id="projectId" class="btn-calendar">
                    <option disabled selected>-- Seleccionar --</option>
                    <?php foreach ($projects as $project): ?>
                        <option value="<?php echo $project->id ?>">
                            <?php echo $project->project ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="field">
                <label for="hours">Indica cuantas horas le quieres dedicar al proyecto el día seleccionado:</label>
                <input type="number" id="hours" name="hours" min="1" max="24" class="btn-calendar-number" required>
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
            <?php showProjectsCalendar($calendarFull, $projects, 1); ?>
        </div>
        <div class="day">
            <h3 class="day-name">Martes</h3>
            <?php showProjectsCalendar($calendarFull, $projects, 2); ?>
        </div>
        <div class="day">
            <h3 class="day-name">Miércoles</h3>
            <?php showProjectsCalendar($calendarFull, $projects, 3); ?>
        </div>
        <div class="day">
            <h3 class="day-name">Jueves</h3>
            <?php showProjectsCalendar($calendarFull, $projects, 4); ?>
        </div>
        <div class="day">
            <h3 class="day-name">Viernes</h3>
            <?php showProjectsCalendar($calendarFull, $projects, 5); ?>
        </div>
        <div class="day">
            <h3 class="day-name">Sábado</h3>
            <?php showProjectsCalendar($calendarFull, $projects, 6); ?>
        </div>
        <div class="day">
            <h3 class="day-name">Domingo</h3>
            <?php showProjectsCalendar($calendarFull, $projects, 7); ?>
        </div>
    </div>
</div>

<?php include_once __DIR__ . "/footer-dashboard.php"; ?>