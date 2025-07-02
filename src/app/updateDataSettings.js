const contactForm = document.getElementById("contact-update-form");

contactForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const data = new FormData(contactForm);

  const newContact = data.get("Contact");
  const pass = data.get("Password");

  if (!newContact || !pass) {
    alert("Rellene todos los campos del formulario de contacto");
    return;
  }

  const result = await Swal.fire({
    title: "¿Estás Seguro?",
    text: "Se actualizará el número de contacto!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Actualizar",
    cancelButtonText: "Cancelar",
  });

  if (result["dismiss"] === "cancel") {
    return;
  }

  // console.log(result);

  if (result.isConfirmed) {
    try {
      const response = await fetch("../controllers/updateContactSettings.php", {
        method: "POST",
        body: data,
      });

      if (response.ok) {
        //console.log(response);
        console.log(response.redirected);

        if (response.redirected) {
          //const result = await response.text();
          //console.log(result);
          alert("Proceso exitoso");
          location.reload();
          return;
        }

        alert("Contraseña incorrecta");
        location.reload();
      }

      if (!response.ok) {
        const result = await response.text();
        console.log(result);
        alert("Error Proceso");
      }
    } catch (error) {
      console.error("Error de: ", error);
      alert("Hubo un problema");
    }
  }
});

/*--------------------------------------------------------------------------------- */

const passwordForm = document.getElementById("pass-update-form");

passwordForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const data = new FormData(passwordForm);

  const idCard = parseInt(data.get("IdCardNumber"), 10);
  const newPass = parseInt(data.get("NewPassword"), 10);
  const confirmPass = parseInt(data.get("ConfirmPassword"), 10);

  console.log(idCard, newPass, confirmPass);

  if (!idCard || !newPass || !confirmPass) {
    alert("Los campos estan vacios o invalidos!");
    return;
  }

  if (newPass !== confirmPass) {
    alert("Confirmacion del password es incorrecta!");
    return;
  }

  if (!Number.isInteger(newPass) || !Number.isInteger(confirmPass)) {
    alert("Alguna de los password no es numerica!");
    return;
  }

  const result = await Swal.fire({
    title: "¿Estás Seguro?",
    text: "Se actualizará la Contraseña!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Actualizar",
    cancelButtonText: "Cancelar",
  });

  if (result["dismiss"] === "cancel") {
    return;
  }

  // console.log(result);

  if (result.isConfirmed) {
    try {
      const response = await fetch("../controllers/updatePassSettings.php", {
        method: "POST",
        body: data,
      });

      if (response.ok) {
        //const result = await response.text();
        //console.log(result);
        alert("Proceso exitoso");
        location.reload();
      }

      if (!response.ok) {
        const result = await response.text();
        console.log(result);
        alert("Error Proceso");
      }
    } catch (error) {
      console.error("Error de: ", error);
      alert("Hubo un problema");
    }
  }
});
