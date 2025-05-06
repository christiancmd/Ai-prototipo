const input = document.querySelector("#Ingresar-tarea");
const boton = document.querySelector("button");
const listaDeTareas = document.querySelector("#list-container");
const cantidadDeTareas = document.querySelector("#totalTareas");

let contadorDeTareas = 0;

function agregarTarea() {
  if (input.value) {
    contadorDeTareas++;
    cantidadDeTareas.innerText = `Numero total de tareas: ${contadorDeTareas}`;

    // Crear tarea
    let tareaNueva = document.createElement("div"); ///elemento
    tareaNueva.classList.add("tarea"); ///Clase tarea

    // Texto ingresado por el input
    let texto = document.createElement("p");
    texto.innerText = input.value;
    input.value = "";
    tareaNueva.appendChild(texto);

    //Crear y agregar contenedor de iconos
    let iconos = document.createElement("div");
    iconos.classList.add("iconos");
    tareaNueva.appendChild(iconos);

    //Iconos
    let completar = document.createElement("i");
    completar.classList.add("bi", "bi-check-circle-fill", "icono-completar");
    completar.addEventListener("click", tareaCompletada);

    let eliminar = document.createElement("i");
    eliminar.classList.add("bi", "bi-trash3-fill", "icono-eliminar");
    eliminar.addEventListener("click", tareaEliminada);

    iconos.append(completar, eliminar);

    //Agregar tarea a la lsta
    listaDeTareas.appendChild(tareaNueva);
  } else {
    alert("Por favor, Ingresar una tarea!");
  }
}

function tareaCompletada(e) {
  //  console.log(e.target.parentNode.parentNode.innerText);
  let tarea = e.target.parentNode.parentNode;
  tarea.classList.toggle("completada");
}

function tareaEliminada(e) {
  let tarea = e.target.parentNode.parentNode;
  tarea.remove();
  contadorDeTareas--;
  cantidadDeTareas.innerText = `Numero total de tareas: ${contadorDeTareas}`;
}

boton.addEventListener("click", agregarTarea);

input.addEventListener("keydown", (e) => {
  ///'keydown = cuando se presione una tecla'
  if (e.key === "Enter") {
    agregarTarea();
  }
});
