<?php

function debug($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Function for sanitize
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Function for check if user is auth
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

//Function for validate urls
function validateCustomUrl($url) {
    $pattern = '/^[a-f0-9]{32}$/i';
    return preg_match($pattern, $url) === 1;
}

//Function for print every part of the calendar by day
function showProjectsCalendar($calendarFull, $projects, $day){
    $emptyProject = 0;
    $userId = $projects[0]->userId;

    foreach ($calendarFull as $value) {
        if ($value->weekDay == $day) {
            $emptyProject += 1;
            ?>

            <div class="project-calendar">
                <div class="text-content">
                    <?php
                    
                    $nameProject = "";
                    foreach ($projects as $project) {
                        if ($project->id == $value->projectId) {
                            $nameProject = $project->project;
                        }
                    }
                    ?>
                    <p><?php echo $nameProject; ?></p>
                </div>
                <div class="hour-content">
                    <p>
                        <?php echo $value->hours; ?> horas al día
                    </p>
                    <div class="actions-content">
                        <a href="#" class="delete-project-a bin-for-calendar-entries"<?php echo "data-item-id=$value->id" ?> <?php echo "data-item-userid=$userId"?>>
                            <img src="build/img/bin.png" alt="Eliminar del calendario" style="filter: invert(100%);">
                        </a>
                    </div>
                </div>
            </div>
        <?php }
    }

    for ($i = 0; $i < 3 - $emptyProject; $i++) { ?>
        <div class="empty-addproject">
        </div>
    <?php
    }
}