<div id="patientModal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h3 class="modal-title">Registro de Pacientes</h3>

        <form action="" method="post" id="form" class="form">

            <section class="content-form">

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
                        <input type="text" id="id-data" name="id-data" placeholder="Ingresar Cedula" maxlength="8" />
                    </div>

                    <div class="input-box">
                        <label>Correo Electronico</label>
                        <input type="text" id="email-data" name="email-data" placeholder="Ingresar Correo Electronico"
                            required />
                    </div>
                </div>

                <div class="column">
                    <div class="input-box">
                        <label>Numero de Telefono</label>
                        <input type="tel" id="number-data" name="number-data" placeholder="Ingresar Numero de Contacto"
                            maxlength="11" max="11" required />
                    </div>
                    <div class="input-box">
                        <label>Edad Actual</label>
                        <input type="text" id="born-data" name="born-data" placeholder="Ingresar Edad" min="0" max="126"
                            maxlength="3" required />
                    </div>
                </div>
                <div class="gender-box">

                    <div class="gender-option">
                        Genero del Paciente
                        <div class="gender">
                            <label for="check-male">Masculino</label>
                            <input type="radio" value="Masculino" id="check-male" name="gender-data" class="radio" />
                        </div>
                        <div class="gender">
                            <label for="check-female">Femenino</label>
                            <input type="radio" value="Femenino" id="check-female" name="gender-data" class="radio" />
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="input-box"> <!--caja de los inputs-->
                        <label for="weigth">Peso (KG)</label> <!--Extraer el peso-->
                        <input type="text" id="weigth-data" name="weight-data" placeholder="Ingresar el Peso"
                            required />
                    </div>

                    <div class="input-box"> <!--caja de los inputs-->
                        <label for="heigth">Altura (CM)</label> <!--Extraer la altura-->
                        <input type="text" id="heigth-data" name="height-data" placeholder="Ingresar Altura" required />
                    </div>
                </div>
                <div class="column center-box">
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
                        <select name="reason-data" id="reason-data" class="select-box">
                            <option hidden>Razon de visita</option>
                            <option value="Subir de Peso">Subir de Peso</option>
                            <option value="Bajar de Peso">Bajar de Peso</option>
                            <option value="Mantener Peso">Mantener Peso</option>
                        </select>
                    </div>
                </div>

                <div class="input-box"> <!--caja de los inputs-->
                    <label for="">Patologia destacable</label>
                    <select name="pathology-data" id="pathology-data" class="select-box">
                        <option hidden>Elegir Patologia</option>
                        <option value="Sindrome del intestino irritable">Sindrome del intestino irritable</option>
                        <option value="Diabetes">Diabetes</option>
                        <option value="Hipertension">Hipertension</option>
                        <option value="Resistencia a la insulina">Resistencia a la insulina</option>
                        <option value="Hipoglucemia">Hipoglucemia</option>
                        <option value="Intolerante a la lactosa">Intolerante de la lactosa</option>
                    </select>
                </div>

                <button id="add-button" class="btn">Crear Paciente</button>
            </section>

        </form>
    </div>
</div>