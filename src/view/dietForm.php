<?php
//Activar los tipos estrictos
declare(strict_types=1);
//Incluir el archivo de funciones mediante templates
session_start();

require_once("../templates/functions.php");



?>

<!DOCTYPE html>
<html lang="en">

<?php render_template(template: "head", style: array("style" => "dietForm")) ?>

<body>
    <?php render_template(template: "headerAdmin", ubication: "dietForm") ?>
    <main>

        <?php render_template(template: "asideButton", ubication: "dietForm") ?>

        <article class="container">
            <div class="progress-bar">
                <div class="step active" data-step="1">General</div>
                <div class="step" data-step="2">Medico</div>
            </div>
            <form action="../controllers/patientForm.php" method="post" id="form" class="form">
                <section class="step-content active" id="step1">
                    <h2>Informacion General</h2>
                    <div class="input-box">
                        <label>Nombres</label>
                        <input type="text" name="name-data" id="name-data" placeholder="Ingresar Nombres" required />
                    </div>
                    <div class="input-box">
                        <label>Apellidos</label>
                        <input type="text" name="last-name-data" id="last-name-data" placeholder="Ingresar Apellidos"
                            required />
                    </div>

                    <div class="column">
                        <div class="input-box">
                            <label for="">Cedula de Identidad</label>
                            <input type="text" id="id-data" name="id-data" placeholder="Ingresar Cedula"
                                maxlength="8" />
                        </div>

                        <div class="input-box">
                            <label>Correo Electronico</label>
                            <input type="text" id="email-data" name="email-data"
                                placeholder="Ingresar Correo Electronico" required />
                        </div>
                    </div>

                    <div class="column">
                        <div class="input-box">
                            <label>Numero de Telefono</label>
                            <input type="tel" id="number-data" name="number-data"
                                placeholder="Ingresar Numero de Contacto" maxlength="11" max="11" required />
                        </div>
                        <div class="input-box">
                            <label>Edad Actual</label>
                            <input type="text" id="born-data" name="born-data" placeholder="Ingresar Edad" min="0"
                                max="126" maxlength="3" required />
                        </div>
                    </div>
                    <div class="gender-box">
                        <h3><strong>Genero del Paciente</strong></h3>
                        <div class="gender-option">
                            <div class="gender">
                                <label for="check-male">Masculino</label>
                                <input type="radio" value="Masculino" id="check-male" name="gender-data"
                                    class="radio" />
                            </div>
                            <div class="gender">
                                <label for="check-female">Femenino</label>
                                <input type="radio" value="Femenino" id="check-female" name="gender-data"
                                    class="radio" />
                            </div>
                        </div>
                    </div>

                    <button type="button" class="next-btn btn">Siguiente</button>
                </section>

                <section class="step-content" id="step2">
                    <h2>Informacion Medica</h2> <!--Regristrar la informacion medica del paciente-->
                    <div class="column">
                        <div class="input-box"> <!--caja de los inputs-->
                            <label for="weigth">Peso (KG)</label> <!--Extraer el peso-->
                            <input type="text" id="weigth-data" name="weight-data" placeholder="Ingresar el Peso"
                                required />
                        </div>

                        <div class="input-box"> <!--caja de los inputs-->
                            <label for="heigth">Altura (CM)</label> <!--Extraer la altura-->
                            <input type="text" id="heigth-data" name="height-data" placeholder="Ingresar Altura"
                                required />
                        </div>
                    </div>
                    <div class="column">
                        <div class="input-box"> <!--caja de los inputs-->
                            <label>Actividad Fisica</label> <!--Extraer la actividad fisica-->
                            <select name="activity-data" id="activity-data" class="input-box">
                                <option hidden>Actividad NAF</option>
                                <option value="Sedentario">Sedentario</option>
                                <option value="Ligera">Ligera</option>
                                <option value="Moderada">Moderada</option>
                                <option value="Intensa">Intensa</option>
                            </select>
                        </div>

                        <div class="input-box"> <!--caja de los inputs-->
                            <label>Razon de Visita</label> <!--Extraer la razon de visita-->
                            <select name="reason-data" id="reason-data" class="input-box">
                                <option hidden>Razon</option>
                                <option value="Subir de Peso">Subir de Peso</option>
                                <option value="Bajar de Peso">Bajar de Peso</option>
                                <option value="Mantener Peso">Mantener Peso</option>
                            </select>
                        </div>
                    </div>

                    <div class="input-box"> <!--caja de los inputs-->
                        <label for="">Patologia destacable</label>
                        <select name="pathology-data" id="pathology-data" class="input-box">
                            <option hidden>Elegir Patologia</option>
                            <option value="Sindrome del intestino irritable">Sindrome del intestino irritable</option>
                            <option value="Diabetes">Diabetes</option>
                            <option value="Hipertension">Hipertension</option>
                            <option value="Resistencia a la insulina">Resistencia a la insulina</option>
                            <option value="Hipoglucemia">Hipoglucemia</option>
                            <option value="Intolerante a la lactosa">Intolerante de la lactosa</option>
                        </select>
                    </div>




                    <div class="buttons">
                        <button type="button" class="prev-btn btn">Anterior</button>
                        <button type="submit" class="submit-btn btn" onclick="loading();">Generar Guia</button>
                    </div>
                </section>
            </form>
        </article>

        <?php render_template(template: "aside", ubication: "dietForm") ?>
    </main>
    <?php render_template(template: "footer", ubication: "dietForm") ?>

    <script src="../app/actionAside.js"></script>
    <script src="../app/dietFormApp.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../alert/sweetalert2.all.min.js"></script>
    <script>
        function loading() {
            if (navigator.onLine) {
                let timerInterval;
                Swal.fire({
                    title: "Procesando...",
                    html: "Desarrollando Guia alimentaria.",
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log("I was closed by the timer");
                    }
                });
            } else {
                alert("No tienes conexion")

            }
        }
    </script>
    <!-- <script src="../app/aiPrototype.js"></> -->

</body>

</html>