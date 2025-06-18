const loginForm = document.getElementById("login-form");

loginForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const data = new FormData(loginForm);

  const pass = data.get("Password");
  const idCardNumber = data.get("UserCard");

  if (!pass || !idCardNumber) {
    alert("Rellene todos los campos del formulario de contacto");
    return;
  }

  try {
    const response = await fetch(
      "http://localhost/AI-healthy-project/src/controllers/loginP.php",
      {
        method: "POST",
        body: data,
      }
    );

    if (response.ok) {
      //location.reload();

      const result = await response.json(); // Convertir la respuesta en objeto
      console.log(result); // Mostrar el objeto JSON

      const messageValue = result.message; // Obtener el valor de "message"
      console.log("El valor de message es:", messageValue);

      if (messageValue && messageValue === "error") {
        alert("error");
      }

      if (messageValue && messageValue === 1) {
        window.location.href =
          "http://localhost/AI-healthy-project/src/view/home.php";
      }

      if (messageValue && messageValue === 2) {
        window.location.href =
          "http://localhost/AI-healthy-project/src/view/admin.php";
      }

      //alert("Proceso exitoso");
    }

    if (!response.ok) {
      const result = await response.text();
      console.log("Respuesta con error:", result);
      alert("Error Proceso");
    }
  } catch (error) {
    console.error("Error de: ", error);
    alert("Hubo un problema");
  }
});
