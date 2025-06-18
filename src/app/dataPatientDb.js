// Función para enviar datos al servidor PHP
async function sendDataToServer(data) {
  try {
    const response = await fetch(
      "http://localhost/AI-healthy-project/src/controllers/registerPatient.php",
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json", // Asegúrate de que el servidor PHP lo espera
        },
        body: JSON.stringify(data), // Envía el objeto JSON como una cadena
      }
    );

    // Intenta parsear la respuesta del servidor como JSON
    const serverResponse = await response.json();
    console.log("Respuesta del servidor:", serverResponse);

    // Condicional para mostrar alert según la respuesta del servidor
    if (serverResponse.status === "success") {
      Swal.fire({
        title: "Registro Exitoso!",
        text: "Se ha registrado el paciente exitosamente!",
        icon: "success",
      });
    } else if (serverResponse.status === "error") {
      Swal.fire({
        icon: "error",
        title: "Registro Fallido",
        text: "El usuario ya existe en el sistema.",
      });
    } else {
      Swal.fire({
        icon: "warning",
        title: "Registro Fallido",
        text: "El usuario ya existe en el sistema.",
      });
    }
  } catch (error) {
    console.error("Error al enviar datos al servidor:", error);
    alert(error.message); // Muestra el error al usuario

    // Aquí podrías mostrar un mensaje al usuario en la interfaz
  }
}

// Función para procesar los datos del archivo local
async function processData() {
  try {
    const response = await fetch("../controllers/patient.json");
    if (!response.ok) {
      // Si el archivo no se encuentra o hay un error de red
      throw new Error("Error al cargar el archivo JSON: " + response.status);
    }

    // *** PASO CLAVE PARA DEPURAR EL ERROR DE SINTAXIS JSON ***
    // Primero, lee la respuesta como texto plano.
    const rawText = await response.text();
    console.log("Contenido crudo de patient.json:", rawText); // ¡Revisa esto en la consola!

    let dataPatient;
    try {
      // Luego, intenta parsear el texto como JSON
      dataPatient = JSON.parse(rawText);
      console.log("Datos del paciente parseados correctamente:", dataPatient);
    } catch (jsonError) {
      console.error("Error al parsear patient.json:", jsonError);
      console.error(
        "El error probablemente se debe a caracteres extra en el archivo patient.json."
      );
      console.error(
        "Asegúrate de que el archivo termine exactamente con la última llave '}' o corchete ']' del JSON."
      );
      return; // Detén la ejecución si el JSON no es válido
    }

    // Si el JSON se parseó correctamente, envía los datos al servidor
    sendDataToServer(dataPatient);
  } catch (error) {
    console.error("Error general al procesar los datos:", error);
    // Aquí podrías mostrar un mensaje al usuario en la interfaz
  }
}

// Asegúrate de que el botón 'add-button' exista en tu HTML
document.getElementById("add-button").addEventListener("click", processData);
