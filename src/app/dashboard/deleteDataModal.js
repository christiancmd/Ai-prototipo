const btnDelete = Array.from(document.querySelectorAll(".btn-delete"));

function handleShowDeleteModal(event) {
  const id = event.currentTarget.id;

  if (!id) {
    console.error("ID not found for the delete button.");
    return;
  }

  Swal.fire({
    title: "¿Estás seguro?",
    text: "¡No podrás revertir esto!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, eliminarlo",
  }).then(async (result) => {
    if (result.isConfirmed) {
      try {
        const response = await fetch(
          "http://localhost/AI-healthy-project/src/controllers/modalDeletePatient.php",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({ id }),
          }
        );

        const data = await response.json();

        if (data.status === "success") {
          console.log("Paciente eliminado:", data.message);

          Swal.fire(
            "¡Eliminado!",
            "El paciente ha sido eliminado.",
            "success"
          ).then(() => {
            location.reload();
          });
        } else {
          Swal.fire("Error", data.message, "error");
        }
      } catch (error) {
        console.error("Error al eliminar el paciente:", error);
        Swal.fire("Error", "No se pudo eliminar el paciente.", "error");
      }
    }
  });
}

for (const btn of btnDelete) {
  btn.addEventListener("click", handleShowDeleteModal);
}
