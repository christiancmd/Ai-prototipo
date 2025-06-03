<?php

declare(strict_types=1);
session_start();

require_once("../templates/functions.php");
require_once("../controllers/patientForm.php");

$json_patient = file_get_contents('../controllers/patient.json');

// Convertir JSON a objeto PHP
$patient_data = json_decode($json_patient, true);


extract(array: $patient_data);


?>

<!DOCTYPE html>
<html lang="en">

<?php render_template(template: "head", style: array("style" => "dietGuide")) ?>

<body>

    <?php render_template("headerAdmin", "dietGuide") ?>

    <main>
        <?php render_template("asideButton", "dietGuide") ?>

        <dialog id="warning-dialog" closedby="any">
            <div class="dialog-content">
                <h2>¿Estas seguro que quieres regresar?</h2>

                <form method="dialog">
                    <div class="option-content">
                        <a href="dietForm.php" class="btn back-btn"> <!--REGRESAMOS AL FORMULARIO DE PACIENTE -->
                            Regresar Proceso
                        </a>
                        <a id="close-dialog" class="cancel-btn">Cancelar Proceso</a>
                    </div>

                </form>
            </div>
        </dialog>


        <section id="hero"> <!--MOSTRAMOS LOS DATOS RESUMINDOS EN UNA CARD -->
            <h2>Guia Alimentaria</h2>
            <div class="hero-content">
                <a href="../document/foodGuide3.php" id="btn-guide" class="btn" target="_blank">
                    <!--ABRIMOS LA GUIA ALIMENTARIA EN UNA NUEVA PESTAÑA -->
                    Abrir Guia Alimentaria
                </a>
                <hgroup class="patient-content"> <!--MOSTRAMOS LOS DATOS DEL PACIENTE -->
                    <h3>Resumen Del Paciente</h3>
                    <div class="data-patient">
                        <p>Cedula: <span id="id-data"> <?= $id_card_number ?> </span> </p> <!--ID DEL PACIENTE -->
                        <p>Nombre: <span id="name-data"><?= $name ?></span></p> <!--NOMBRE DEL PACIENTE -->
                        <p>Apellido: <span id="last-name-data"> <?= $last_name ?></span></p>
                        <!--APELLIDO DEL PACIENTE -->
                        <p>Genero: <span id="genre-data"> <?= $genre ?></span></p><!--GENERO DEL PACIENTE -->
                        <p>Edad: <span id="age-data"><?= $age ?></span></p><!--EDAD DEL PACIENTE -->
                        <p>Telefono: <span id="number-data"> <?= "0" . $number ?></span></p>
                        <!--NUMERO DE TELEFONO DEL PACIENTE -->
                        <p>Peso: <span id=""><?= $weight . " Kg" ?></span></p><!--PESO DEL PACIENTE -->
                        <p>Altura: <span id=""><?= $height . " Cm" ?></span></p><!--ALTURA DEL PACIENTE -->
                        <p>Objetvo: <span id=""> <?= $reason ?></span></p><!--OBJETIVO DEL PACIENTE -->
                        <p>Patología: <span id=""> <?= $pathology ?></span> </p>
                        <p>Imc: <span id> <?= $nutrients_data["imc"] ?></span></p>
                    </div>
                </hgroup>
                <div class="button-content"> <!--BOTONES DE ACCION -->
                    <button id="open-dialog" class="btn back-open-dialog">Regresar Proceso</button>
                    <button id="add-button" class="btn add-open-dialog">Anexar Paciente</button>
                </div>
            </div>
        </section>

        <?php render_template("aside", "dietGuide") ?>
    </main>

    <?php render_template("footer", "dietGuide") ?>

    <script src="../app/actionAside.js"></script>
    <script src="../app/dataPatientDb.js"></script>
    <script src="../app/dialogDietGuide.js"></script>

</body>


</html>