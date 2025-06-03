<?php

//Activar los tipos estrictos
declare(strict_types=1);
session_start();

//Incluir el archivo de funciones mediante templates
require_once("../templates/functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<?php render_template(template: "head", style: array("style" => "settings")) ?>

<body>

  <?php render_template("headerAdmin", "settings") ?>

  <main>
    <section id="hero">

      <?php render_template("asideButton", "settings") ?>



      <div class="wrapper">
        <div class="box1">One</div>
        <div class="box2">Two</div>
        <div class="box3">Three</div>
        <div class="box4">Four</div>
        <div class="box5">Five</div>
      </div>



    </section>

    <?php render_template("aside", "settings") ?>

  </main>

  <?php render_template("footer", "settings") ?>

  <script src="../app/actionAside.js"></script>
</body>

</html>