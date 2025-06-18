<?php
declare(strict_types=1);
session_start();
require_once("../templates/functions.php");

?>


<!DOCTYPE html>
<html lang="en">

<?php render_template(template: "head", style: array("style" => "admin")) ?>

<body>

    <?php render_template(template: "headerAdmin", ubication: "admin") ?>


    <main>


        <?php render_template(template: "asideButton", ubication: "admin") ?>
        <section class="Adm-Content">

            <h1>Administrador</h1>
            <a class="adm-bttn" href="#">
                <img src="../img/admin/imgUser.png" alt="">
                <h2>Usuarios</h2>
                <p>Acceso al registro de los usuarios dentro de la plataforma</p>
            </a>

            <div class="spin">

                <div class="spin-item">
                    <img src="../img/admin/imgUser.png" alt="">
                    <h2>Usuarios</h2>
                    <p>Acceso al registro de los usuarios dentro de la plataforma</p>
                </div>

                <div class="spin-item">
                    <img src="../img/admin/imgUser.png" alt="">
                    <h2>Usuarios</h2>
                    <p>Acceso al registro de los usuarios dentro de la plataforma</p>
                </div>

                <div class="spin-item">
                    <img src="../img/admin/imgUser.png" alt="">
                    <h2>Usuarios</h2>
                    <p>Acceso al registro de los usuarios dentro de la plataforma</p>
                </div>

            </div>

        </section>



        <?php render_template(template: "asideAdmin", ubication: "admin") ?>
    </main>

    <?php render_template(template: "footer", ubication: "admin") ?>


    <script src="../app/actionAside.js"></script>
</body>

</html>