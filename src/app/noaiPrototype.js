document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("form");

  function main(data) {
    console.log(data);
  }

  function getData(event) {
    //event.preventDefault();

    const dataPacient = {
      //Objeto que contiene los datos del paciente
      name: document.querySelector("#name-data").value, //Obtener los valores de los inputs
      age: document.querySelector("#born-data").value,
      weigth: document.querySelector("#weigth-data").value,
      heigth: document.querySelector("#heigth-data").value,
      reason: document.querySelector("#reason-data").value,
      activity: document.querySelector("#activity-data").value,
      //Genre
      //Observation
    };

    const radios = document.querySelectorAll(".radio");
    let genreData = null;
    radios.forEach((element) => {
      //Recorrer los inputs radio, generos
      if (element.checked === true) {
        genreData = element.value; //Obtener el valor del input radio
        dataPacient.genre = genreData; //Agregar el valor al objeto dataPacient
      }
    });

    const obserBox = document.querySelector("#observations-list"); //Obtener el elemento de la lista de observaciones

    if (obserBox.children.length > 0) {
      //Si hay observaciones
      const listObs = Array.from(obserBox.children);
      const observations = listObs.map((Element) => {
        return Element.textContent.replace("x", "").trim();
      });

      dataPacient.observation = observations; //Agregar las observaciones al objeto dataPacient
    } else {
      console.log("No hubo Observaciones");
    }

    main(dataPacient); //Enviar el objeto dataPacient a la funcion main
  }

  form.addEventListener("submit", getData);
});
