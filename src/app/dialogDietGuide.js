/*document.getElementById("open-dialog").addEventListener("click", function () {
  document.getElementById("warning-dialog").showModal();
});

document.getElementById("close-dialog").addEventListener("click", function () {
  document.getElementById("warning-dialog").close();
});
*/

document.getElementById("open-dialog").addEventListener("click", () => {
  Swal.fire({
    title: "Quieres Cancelar?",
    text: "Regresaras al formulario y se perderan los datos!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Regresar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result["dismiss"] === "cancel") {
      // Si el usuario hizo clic en "Cancelar", no hacemos nada
      return;
    }

    if (result["value"] === true) {
      // Si el usuario hizo clic en "Regresar", redirigimos a la página del formulario
      window.location.href = "../view/dietForm.php";
    }
  });
});
