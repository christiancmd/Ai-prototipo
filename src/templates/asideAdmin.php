<?php



$name = "Admin";
$l_name = "Super";

$first_name = explode(separator: " ", string: $name)[0];
$first_l_name = explode(separator: " ", string: $l_name)[0];

$full_name = "$first_name $first_l_name";





?>

<aside id="aside">
    <article class="container-aside">
        <nav class="navegator-box">
            <ul class="nav-aside-list">
                <li id="home-page"><a href="home.php">Inicio</a></li>
                <li id="dashboard-page">
                    <a href="dashboardPatient.php">Dashboard</a>
                </li>
                <li id="dietForm-page"><a href="dietForm.php">Guia Alimentaria</a></li>
                <li id="settings-page"><a href="settings.php">Configuraciones</a></li>
            </ul>
        </nav>
    </article>

    <div class="config-aside-box">
        <div class="info-user-aside">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 448 512">
                <path fill="#000"
                    d="M224 256a128 128 0 1 0 0-256a128 128 0 1 0 0 256m-96 55.2C54 332.9 0 401.3 0 482.3C0 498.7 13.3 512 29.7 512h388.6c16.4 0 29.7-13.3 29.7-29.7c0-81-54-149.4-128-171.1V362c27.6 7.1 48 32.2 48 62v40c0 8.8-7.2 16-16 16h-16c-8.8 0-16-7.2-16-16s7.2-16 16-16v-24c0-17.7-14.3-32-32-32s-32 14.3-32 32v24c8.8 0 16 7.2 16 16s-7.2 16-16 16h-16c-8.8 0-16-7.2-16-16v-40c0-29.8 20.4-54.9 48-62v-57.1q-9-.9-18.3-.9h-91.4q-9.3 0-18.3.9v65.4c23.1 6.9 40 28.3 40 53.7c0 30.9-25.1 56-56 56s-56-25.1-56-56c0-25.4 16.9-46.8 40-53.7zM144 448a24 24 0 1 0 0-48a24 24 0 1 0 0 48" />
            </svg>
            <h3><?= $full_name ?></h3>
        </div>
        <ul class="config-list">
            <li><a href="../controllers/closeSession.php">Cerrar Session</a></li>
        </ul>
    </div>
</aside>