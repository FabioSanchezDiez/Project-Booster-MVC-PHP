<?php include_once __DIR__ . "/header-dashboard.php"; ?>
<?php if (count($projects) === 0) { ?>
    <div class="container" style="text-align: center;">
        <p>¡Bienvenido! Es hora de añadir un nuevo proyecto a tu lista.</p>
    </div>
    <ul class="project-list animated container">
        <?php for ($i = 0; $i < 8; $i++) : ?>
            <li>
                <a href="/create-project">
                    <div class="empty-project">
                        <img src="build/img/plus.svg" alt="Añadir Imagen">
                    </div>
                </a>
            </li>
        <?php endfor; ?>
    </ul>

<?php } else {  ?>

    <ul class="project-list animated container-projects">

        <?php foreach ($projects as $project) : ?>
            <li>
                <!--<a class="project" href="/project?id=<?php echo $project->url ?>"><?php echo $project->project ?></a>-->
                <a href="/project?id=<?php echo $project->url ?>" style="text-decoration: none;">
                    <article class="article-wrapper">
                        <div class="project-info">
                            <div class="flex-pr">
                                <div class="project-title text-nowrap"><?php echo $project->project ?></div>
                                <div class="project-hover">
                                    <svg style="color: black;" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" color="black" stroke-linejoin="round" stroke-linecap="round" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor">
                                        <line y2="12" x2="19" y1="12" x1="5"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </div>
                            </div>
                            <div class="types">
                                <?php foreach ($project->tags as $tag) : ?>
                                    <span class="project-type">• <?php echo $tag ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </article>
                </a>
                <a href="" class="delete-project-a bin-for-projects" <?php echo "data-item-id=$project->id" ?> <?php echo "data-item-userid=$project->userId" ?>>
                    <div class="delete-project">
                        <img src="build/img/bin.png" alt="Imagen Papelera">
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
        <?php for ($i = 0; $i < 8 - count($projects); $i++) : ?>
            <li>
                <a href="/create-project">
                    <div class="empty-project">
                        <img src="build/img/plus.svg" alt="Añadir Imagen">
                    </div>
                </a>
            </li>
        <?php endfor; ?>

    </ul>
<?php } ?>
<?php include_once __DIR__ . "/footer-dashboard.php"; ?>