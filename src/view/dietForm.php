<?php
//Activar los tipos estrictos
declare(strict_types=1);
//Incluir el archivo de funciones mediante templates
require_once("../templates/functions.php");

?>

<!DOCTYPE html>
<html lang="en">

<?php render_template(template: "head", style: array("style" => "dietForm")) ?>

<body>
    <?php render_template(template: "header", ubication: "dietForm") ?>
    <main>

        <a href="#" class="nav-icon">
            <input type="checkbox">
            <svg class="aside-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="#000" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.3"
                    d="M12 9V5.414a1 1 0 0 1 1.707-.707l6.586 6.586a1 1 0 0 1 0 1.414l-6.586 6.586A1 1 0 0 1 12 18.586V15H6V9zM3 9v6" />
            </svg>
        </a>


        <article class="container">
            <div class="progress-bar">
                <div class="step active" data-step="1">General</div>
                <div class="step" data-step="2">Medico</div>
            </div>
            <form action="#" id="form" class="form">
                <section class="step-content active" id="step1">
                    <h2>Informacion General</h2>
                    <div class="input-box">
                        <label>Nombres</label>
                        <input type="text" placeholder="Ingresar Nombres" required />
                    </div>
                    <div class="input-box">
                        <label>Apellidos</label>
                        <input type="text" placeholder="Ingresar Apellidos" required />
                    </div>

                    <div class="column">
                        <div class="input-box">
                            <label for="">Cedula de Identidad</label>
                            <input type="text" placeholder="Ingresar Cedula" maxlength="8" />
                        </div>

                        <div class="input-box">
                            <label>Correo Electronico</label>
                            <input type="text" placeholder="Ingresar Correo Electronico" required />
                        </div>
                    </div>

                    <div class="column">
                        <div class="input-box">
                            <label>Numero de Telefono</label>
                            <input type="tel" placeholder="Ingresar Numero de Contacto" maxlength="11" max="11"
                                required />
                        </div>
                        <div class="input-box">
                            <label>Fecha de Nacimiento</label>
                            <input type="date" placeholder="Enter birth date" required />
                        </div>
                    </div>
                    <div class="gender-box">
                        <h3><strong>Genero del Paciente</strong></h3>
                        <div class="gender-option">
                            <div class="gender">
                                <label for="check-male">Masculino</label>
                                <input type="radio" id="check-male" name="gender" checked />
                            </div>
                            <div class="gender">
                                <label for="check-female">Femenino</label>
                                <input type="radio" id="check-female" name="gender" />
                            </div>
                        </div>
                    </div>

                    <button type="button" class="next-btn btn">Siguiente</button>
                </section>

                <section class="step-content" id="step2">
                    <h2>Informacion Medica</h2>
                    <div class="column">
                        <div class="input-box">
                            <label for="weigth">Peso (KG)</label>
                            <input type="text" name="weigth" placeholder="Ingresar el Peso" required />
                        </div>

                        <div class="input-box">
                            <label for="heigth">Altura (CM)</label>
                            <input type="text" name="heigth" placeholder="Ingresar Altura" required />
                        </div>
                    </div>
                    <div class="column">
                        <div class="input-box">
                            <label>Actividad Fisica</label>
                            <select name="" id="" class="input-box">
                                <option hidden>Actividad NAF</option>
                                <option value="1">Sedentario</option>
                                <option value="1.2">Ligera</option>
                                <option value="1.5">Moderada</option>
                                <option value="1.8">Intensa</option>
                            </select>
                        </div>

                        <div class="input-box">
                            <label>Razon de Visita</label>
                            <select name="" id="" class="input-box">
                                <option hidden>Razon</option>
                                <option value="">Subir de Peso</option>
                                <option value="">Bajar de Peso</option>
                                <option value="">Mantener Peso</option>
                            </select>
                        </div>
                    </div>

                    <div class="input-box">
                        <label for="observation-input">Ingrese una Observacion:</label>
                        <input type="text" id="observation-input" placeholder="Patologias" />
                        <div class="btn-container">
                            <button id="observation-add" class="btn-add" type="button">
                                Agregar Observacion
                            </button>
                        </div>
                    </div>

                    <div class="chips-container" id="obeservations-list"></div>


                    <div class="buttons">
                        <button type="button" class="prev-btn btn">Anterior</button>
                        <button type="submit" class="submit-btn btn">Registrarse</button>
                    </div>
                </section>
            </form>
        </article>

        <?php render_template(template: "aside", ubication: "dietForm") ?>
    </main>
    <?php render_template(template: "footer", ubication: "dietForm") ?>

    <script src="../app/actionAside.js"></script>
    <script src="../app/dietFormApp.js"></script>

</body>

</html>