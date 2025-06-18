<?php

//Activar los tipos estrictos
declare(strict_types=1);
//Incluir el archivo de funciones mediante templates
require_once("./src/templates/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<!-- Styles -->
<?php render_template(template: "head", style: array(
  "style" =>
    "index"
)) ?>

<body>
  <!-- HEADER -->
  <?php render_template(template: "header", ubication: "index") ?>
  <!-- MAIN -->

  <main>
    <section id="container-form">
      <article class="initial-box-form"><!-- Img --></article>

      <!--LOGIN FORM-->
      <div class="form-login">
        <h3>Iniciar Sesion</h3>
        <div class="icon-form">
          <div>
            <a href="https://www.google.co.ve/?hl=es" target="_blank">
              <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12ZM21 12C21 16.9706 16.9706 21 12 21C11.8075 21 11.6164 20.994 11.4268 20.982L15.3516 14.1842C15.7616 13.5562 16 12.806 16 12C16 11.2714 15.8052 10.5883 15.4649 10H20.777C20.9229 10.6432 21 11.3126 21 12ZM3 12C3 16.0439 5.66703 19.4648 9.33808 20.5998L11.9938 16C10.4369 15.9976 9.08858 15.1058 8.4297 13.8055L4.5075 7.01205C3.55514 8.43975 3 10.155 3 12ZM5.88442 5.39694C7.48983 3.90934 9.63872 3 12 3C15.5337 3 18.5918 5.03656 20.0645 8H12C10.5219 8 9.23103 8.80174 8.53857 9.99407L5.88442 5.39694ZM10.2633 12.9925L10.2681 12.9897L10.1968 12.8662C10.0707 12.6041 10 12.3103 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12C14 12.361 13.9043 12.6997 13.737 12.9921L13.7321 12.9893L13.6529 13.1263C13.2928 13.6538 12.6868 14 12 14C11.2566 14 10.608 13.5945 10.2633 12.9925Z"
                  fill="#0F0F0F" />
              </svg>
            </a>
          </div>
          <div>
            <a href="https://github.com/" target="_blank">
              <svg width="25px" height="25px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs></defs>
                <g id="Page-1" stroke="" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g id="Dribbble-Light-Preview" transform="translate(-140.000000, -7559.000000)" fill="#000000">
                    <g id="icons" transform="translate(56.000000, 160.000000)">
                      <path
                        d="M94,7399 C99.523,7399 104,7403.59 104,7409.253 C104,7413.782 101.138,7417.624 97.167,7418.981 C96.66,7419.082 96.48,7418.762 96.48,7418.489 C96.48,7418.151 96.492,7417.047 96.492,7415.675 C96.492,7414.719 96.172,7414.095 95.813,7413.777 C98.04,7413.523 100.38,7412.656 100.38,7408.718 C100.38,7407.598 99.992,7406.684 99.35,7405.966 C99.454,7405.707 99.797,7404.664 99.252,7403.252 C99.252,7403.252 98.414,7402.977 96.505,7404.303 C95.706,7404.076 94.85,7403.962 94,7403.958 C93.15,7403.962 92.295,7404.076 91.497,7404.303 C89.586,7402.977 88.746,7403.252 88.746,7403.252 C88.203,7404.664 88.546,7405.707 88.649,7405.966 C88.01,7406.684 87.619,7407.598 87.619,7408.718 C87.619,7412.646 89.954,7413.526 92.175,7413.785 C91.889,7414.041 91.63,7414.493 91.54,7415.156 C90.97,7415.418 89.522,7415.871 88.63,7414.304 C88.63,7414.304 88.101,7413.319 87.097,7413.247 C87.097,7413.247 86.122,7413.234 87.029,7413.87 C87.029,7413.87 87.684,7414.185 88.139,7415.37 C88.139,7415.37 88.726,7417.2 91.508,7416.58 C91.513,7417.437 91.522,7418.245 91.522,7418.489 C91.522,7418.76 91.338,7419.077 90.839,7418.982 C86.865,7417.627 84,7413.783 84,7409.253 C84,7403.59 88.478,7399 94,7399"
                        id="github-[#142]"></path>
                    </g>
                  </g>
                </g>
              </svg>
            </a>
          </div>
          <div>
            <a href="https://linkedin.com/" target="_blank">
              <svg fill="#000000" width="25px" height="25px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                <g id="Linkedln">
                  <path
                    d="M26.49,30H5.5A3.35,3.35,0,0,1,3,29a3.35,3.35,0,0,1-1-2.48V5.5A3.35,3.35,0,0,1,3,3,3.35,3.35,0,0,1,5.5,2h21A3.35,3.35,0,0,1,29,3,3.35,3.35,0,0,1,30,5.5v21A3.52,3.52,0,0,1,26.49,30ZM9.11,11.39a2.22,2.22,0,0,0,1.6-.58,1.83,1.83,0,0,0,.6-1.38A2.09,2.09,0,0,0,10.68,8a2.14,2.14,0,0,0-1.51-.55A2.3,2.3,0,0,0,7.57,8,1.87,1.87,0,0,0,7,9.43a1.88,1.88,0,0,0,.57,1.38A2.1,2.1,0,0,0,9.11,11.39ZM11,13H7.19V24.54H11Zm13.85,4.94a5.49,5.49,0,0,0-1.24-4,4.22,4.22,0,0,0-3.15-1.27,3.44,3.44,0,0,0-2.34.66A6,6,0,0,0,17,14.64V13H13.19V24.54H17V17.59a.83.83,0,0,1,.1-.43,2.73,2.73,0,0,1,.7-1,1.81,1.81,0,0,1,1.28-.44,1.59,1.59,0,0,1,1.49.75,3.68,3.68,0,0,1,.44,1.9v6.15h3.85ZM17,14.7a.05.05,0,0,1,.06-.06v.06Z" />
                </g>
              </svg>
            </a>
          </div>
        </div>

        <!-- <form action="./src/controllers/login.php" method="POST" id="login-form"> -->
        <form action="#" method="POST" id="login-form">
          <!--Formulario de inicio de sesion-->
          <!--Input-->
          <div class="input-group">
            <!--input-->
            <input class="input" type="text" required id="user-login" name="UserCard" autocomplete="user"
              maxlength="20" />
            <!--Atributos-->
            <label class="label" for="UserCard">Cedula</label>
          </div>
          <!--Input-->
          <div class="input-group">
            <!--input de Contraseña-->
            <input class="input" type="password" required id="password-login" name="Password" maxlength="9" />
            <!--Atributos-->
            <label class="label" for="Password">Contraseña</label>
          </div>
          <!--Boton Para iniciar sesion-->
          <button type="submit" class="button-login">Iniciar Sesion</button>
        </form>
        <div class="login-error-message">
          <!--Error-->
          <p>Clave o correo inválido</p>
        </div>

        <small>Sistema de Información</small>
      </div>
    </section>
  </main>

  <!--FOOTER-->
  <?= render_template(template: "footer", ubication: "index") ?>

  <script src="./src/app/actionNav.js"></script>
  <script src="./src/app/login.js"></script>
</body>

</html>