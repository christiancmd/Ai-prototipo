<?php

//Activar los tipos estrictos
declare(strict_types=1);
//Incluir el archivo de funciones mediante templates
require_once("../templates/functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<?php render_template(template: "head", style: array("style" => "dashboardPatient")) ?>

<body>

  <?php render_template("headerAdmin") ?>

  <main>
    <section id="hero">

      <label class="aside-show-icon-box icon" for="checkbox">
        <input type="checkbox" class="checkbox" id="checkbox" />
        <svg id="aside-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path fill="#000" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.3"
            d="M12 9V5.414a1 1 0 0 1 1.707-.707l6.586 6.586a1 1 0 0 1 0 1.414l-6.586 6.586A1 1 0 0 1 12 18.586V15H6V9zM3 9v6" />
        </svg>
      </label>


    </section>

    <?php render_template("aside") ?>

  </main>

  <?php render_template("footer") ?>

  <script src="../app/actionAside.js"></script>

</body>

</html>