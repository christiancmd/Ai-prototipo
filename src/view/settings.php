<?php
include_once "../controllers/conection.php";
require_once("../templates/functions.php");
session_start();

$Name_doctor = $_SESSION['name_doctor'] ?? null; // Obtener el nombre del doctor de la sesion
$Last_name_doctor = $_SESSION['last_name_doctor'] ?? null; // Obtener el apellido del doctor de la sesion
$Contact_doctor = $_SESSION['contact'] ?? null;

function startFirstZero($num)
{
  if (isset($num[0]) && $num[0] === '0') {
    return ltrim($num, '0');
  }

  return $num;
}

$Contact_doctor = startFirstZero($Contact_doctor);

?>
<!DOCTYPE html>
<html lang="en">

<?php render_template(template: "head", style: array("style" => "settings")) ?>


<body>
  <?php render_template(template: "headerAdmin", ubication: "settings") ?>

  <main>
    <?php render_template(template: "asideButton", ubication: "settings") ?>

    <section id="hero">

      <!-- Profile user -->

      <article class="hero-content">
        <div id="profile" class="settings-box">
          <header>
            <h2>Perfil</h2>
          </header>
          <hr>
          <div class="convertor">
            <img id="profileimg" src="../img/settings/user.png">
          </div>
          <hgroup>
            <span id="name"><?= $Name_doctor . " " . $Last_name_doctor ?></span>
            <span id="Num-tlf"><?= '0' . $Contact_doctor ?></span>
          </hgroup>
          <hr>
        </div>

        <!-- contact user -->

        <div id="contact" class="settings-box">
          <header>
            <h2>Cambiar Contacto</h2>

          </header>

          <form action="#" method="post" id="contact-update-form" novalidate>
            <div>
              <div class="input-box">
                <input type="text" class="num-input" name="Contact" required minlength="11" maxlength="11"
                  placeholder="Nuevo Contacto">
                <label class="numtxt">Nuevo Contacto</label>
              </div>
              <div class="input-box">
                <input type="password" class="pass-input" name="Password" required minlength="8" maxlength="12"
                  placeholder="Contraseña para confirmar">
                <label class="passtxt">Ingresar Contraseña</label>
              </div>
            </div>
            <button type="submit" id="aceptar-num">Cambiar</button>
          </form>

        </div>
        <!-- Pass user -->

        <div id="password" class="settings-box">
          <header>
            <h2>Cambiar Contraseña</h2>
          </header>
          <form action="#" method="post" id="pass-update-form" novalidate>
            <div class="input-container">

              <div class="input-box">
                <input type="text" id="id-card-number" name="IdCardNumber" required minlength="6" maxlength="12"
                  placeholder="Cedula del Doctor">
                <label class="actual-passtxt">Ingresar Cedula de verificacion</label>
              </div>

              <div class="input-box">
                <input type="password" id="new-pass" name="NewPassword" required minlength="8" maxlength="12"
                  placeholder="Nueva Contraseña">
                <label class="new-passtxt">Nueva Contraseña</label>
              </div>

              <div class="input-box">
                <input type="password" id="confirm-pass" name="ConfirmPassword" required minlength="8" maxlength="12"
                  placeholder="Confirmar Nueva Contraseña">
                <label class="confirm-passtxt">Confirmar Contraseña</label>
              </div>
            </div>
            <small>Los datos deben ser numericos!</small>
            <button type="submit" id="update-pass-btn">Cambiar</button>
          </form>
        </div>
      </article>
      <!-- Profile user -->

    </section>

    <?php render_template(template: "aside", ubication: "settings") ?>

  </main>

  <?php render_template(template: "footer", ubication: "settings") ?>

  <script src="../app/actionAside.js"></script>
  <script src="../app/updateDataSettings.js"></script>
  <!-- <script src="settings.js"></script> -->
</body>

</html>