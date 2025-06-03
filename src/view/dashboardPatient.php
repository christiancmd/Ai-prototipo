<?php

//Activar los tipos estrictos
declare(strict_types=1);
session_start();

//Incluir el archivo de funciones mediante templates
require_once("../templates/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<!--Sistema de renderizado de templates por parametros - estilos -->
<?php render_template(template: "head", style: array("style" => "dashboardPatient")) ?>

<body>

  <!--Sistema de renderizado de templates por parametros - header -->
  <?php render_template("headerAdmin", "dashboardPatient") ?>

  <main>
    <section id="hero">
      <!--Sistema de renderizado de templates por parametros - boton de aside -->
      <?php render_template("asideButton", "dashboardPatient") ?>
    </section>

    <!--Sistema de renderizado de templates por parametros - aside desplegable -->
    <?php render_template("aside", "dashboardPatient") ?>
  </main>
  <!--Sistema de renderizado de templates por parametros - footer -->

  <?php render_template("footer", "dashboardPatient") ?>

  <script src="../app/actionAside.js"></script>
</body>

</html>