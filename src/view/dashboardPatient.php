<?php

//Activar los tipos estrictos
declare(strict_types=1);
session_start();
include_once "../controllers/conection.php";

//Incluir el archivo de funciones mediante templates
require_once("../templates/functions.php");

$Id_doctor = $_SESSION['id'] ?? null; // Obtener el id del doctor de la sesion
$data_patient = send_total_patient($conection, $Id_doctor);
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

      <h2>Visualizador y administrador de los Pacientes</h2>
      <div class="principal-container">
        <div class="button-box ">
          <a href="#" class="btn-register btn-crud">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 11h-4v4h-2v-4H7v-2h4V7h2v4h4z" />
            </svg>
            Nuevo Registro
          </a>

          <a href="#" target="_blank" class="btn-createDocument btn-crud">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <rect width="24" height="24" fill="none" />
              <g fill="none" stroke="#ffffff" stroke-linejoin="round" stroke-width="2">
                <path stroke-linecap="round"
                  d="M4 4v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8.342a2 2 0 0 0-.602-1.43l-4.44-4.342A2 2 0 0 0 13.56 2H6a2 2 0 0 0-2 2m5 9h6m-6 4h3" />
                <path d="M14 2v4a2 2 0 0 0 2 2h4" />
              </g>
            </svg>
            Crear Documento
          </a>
        </div>

        <table>
          <thead>
            <tr>
              <th>Cedula</th>
              <th>Nombre</th>
              <th>Genero</th>
              <th>Edad</th>
              <th>Acción</th>
            </tr>
          </thead>

          <tbody id="table-users-body">

            <!-- <form method="GET" id="myForm" action="dashboardClient.php">
              <input type="text" id="input-filter" name="filtro" placeholder="Buscar usuario...">
              <button type="submit" id="button-filter" onclick=" submitForm()">Filtrar</button>
            </form> -->


            <?php foreach ($data_patient as $key) { ?>
              <tr>
                <td><?= $key["id"] ?></td>
                <td><?= $key["name"] . ' ' . $key["last_name"] ?></td>
                <td><?= $key["genre"] ?></td>
                <td><?= $key["age"] ?></td>
                <td class="action-config">

                  <a href="#" class="btn-edit ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                      <rect width="24" height="24" fill="none" />
                      <g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                        <path
                          d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                      </g>
                    </svg>
                  </a>

                  <a href="#" class="btn-delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                      <rect width="24" height="24" fill="none" />
                      <path fill="#fff"
                        d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z" />
                    </svg>

                  </a>
                </td>
              </tr>
            <?php } ?>

          </tbody>
        </table>



      </div>


























    </section>

    <!--Sistema de renderizado de templates por parametros - aside desplegable -->
    <?php render_template("aside", "dashboardPatient") ?>
  </main>
  <!--Sistema de renderizado de templates por parametros - footer -->

  <?php render_template("footer", "dashboardPatient") ?>

  <script src="../app/actionAside.js"></script>
</body>

</html>