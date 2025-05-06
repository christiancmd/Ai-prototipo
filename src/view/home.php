<?php

//Activar los tipos estrictos
declare(strict_types=1);
//Incluir el archivo de funciones mediante templates
require_once("../templates/functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<?php render_template(template: "head", style: array("style" => "home")) ?>

<body>
  <?php render_template(template: "header", ubication: "home") ?>

  <main>
    <section id="hero">
      <label class="aside-show-icon-box icon" for="checkbox">
        <input type="checkbox" class="checkbox" id="checkbox" />
        <svg id="aside-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path fill="#000" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.3"
            d="M12 9V5.414a1 1 0 0 1 1.707-.707l6.586 6.586a1 1 0 0 1 0 1.414l-6.586 6.586A1 1 0 0 1 12 18.586V15H6V9zM3 9v6" />
        </svg>
      </label>

      <article id="hero-container">
        <header class="hero-bar">
          <p>Guia Alimentaria</p>
        </header>
        <div class="hero-content">

          <section class="hero-box box-user box1">
            <div class="profile-img">
              <img src="../img/home/profile.png" alt="User-profile">
            </div>
            <hgroup>
              <h2>Nombre de usuario</h2>
              <p>Correo electronico</p>
              <p>Numero: 04142961677</p>
            </hgroup>
          </section>

          <section class="pacient-table box2">
            <header class="table-header">
              <strong>Ultimos Pacientes</strong>
            </header>
            <table class="table">
              <thead>
                <tr>
                  <th>Nombre de Paciente</th>
                  <th>Fecha de Nacimiento</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Jose Hernadez</td>
                  <td>02/05/2025</td>
                </tr>
                <tr>
                  <td>Miguel Cabrera</td>
                  <td>12/02/2004</td>
                </tr>
                <tr>
                  <td>Romulo Gallego</td>
                  <td>24/12/2015</td>
                </tr>
              </tbody>
            </table>
          </section>

          <section class="male-box box3">
            <div class="data-resume">
              <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 1024 1024">
                <path fill="#0100ff"
                  d="M874 120H622c-3.3 0-6 2.7-6 6v56c0 3.3 2.7 6 6 6h160.4L583.1 387.3c-50-38.5-111-59.3-175.1-59.3c-76.9 0-149.3 30-203.6 84.4S120 539.1 120 616s30 149.3 84.4 203.6C258.7 874 331.1 904 408 904s149.3-30 203.6-84.4C666 765.3 696 692.9 696 616c0-64.1-20.8-124.9-59.2-174.9L836 241.9V402c0 3.3 2.7 6 6 6h56c3.3 0 6-2.7 6-6V150c0-16.5-13.5-30-30-30M408 828c-116.9 0-212-95.1-212-212s95.1-212 212-212s212 95.1 212 212s-95.1 212-212 212" />
              </svg>
              <p>15</p>
            </div>
          </section>

          <section class="female-box box4">
            <div class="data-resume">
              <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 1024 1024">
                <path fill="#ff00cf"
                  d="M712.8 548.8c53.6-53.6 83.2-125 83.2-200.8c0-75.9-29.5-147.2-83.2-200.8C659.2 93.6 587.8 64 512 64s-147.2 29.5-200.8 83.2S228 272.1 228 348c0 63.8 20.9 124.4 59.4 173.9c7.3 9.4 15.2 18.3 23.7 26.9c8.5 8.5 17.5 16.4 26.8 23.7c39.6 30.8 86.3 50.4 136.1 57V736H360c-4.4 0-8 3.6-8 8v60c0 4.4 3.6 8 8 8h114v140c0 4.4 3.6 8 8 8h60c4.4 0 8-3.6 8-8V812h114c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8H550V629.5c61.5-8.2 118.2-36.1 162.8-80.7M512 556c-55.6 0-107.7-21.6-147.1-60.9C325.6 455.8 304 403.6 304 348s21.6-107.7 60.9-147.1S456.4 140 512 140s107.7 21.6 147.1 60.9C698.4 240.2 720 292.4 720 348s-21.6 107.7-60.9 147.1C619.7 534.4 567.6 556 512 556" />
              </svg>
              <p>16</p>
            </div>
          </section>

          <section id="do-container" class="centex box5">
            <div id="input-container" class="center">
              <h1>Mis Tareas</h1>
              <input type="text" placeholder="Ingresa una tarea" id="Ingresar-tarea">
              <button type="submit">Crear Tarea</button>
              <p id="totalTareas">Numero total de tareas: 0</p>
            </div>
            <div id="list-container"></div>
          </section>
        </div>
      </article>
    </section>

    <?php render_template(template: "aside") ?>
  </main>

  <?php render_template(template: "footer", ubication: "home") ?>

  <script src="../app/actionAside.js"></script>
  <script src="../app/doList.js"></script>
</body>

</html>



<!--  -->