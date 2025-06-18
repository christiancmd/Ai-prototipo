//import { generateAI } from "../service/module.js";
import { GoogleGenerativeAI } from "https://cdn.skypack.dev/@google/generative-ai"; //Importar la libreria de google
const genAI = new GoogleGenerativeAI("AIzaSyCEGlSk190sUQCeQH7gXWXwjvMZPRLYmcA"); // API key
const model = genAI.getGenerativeModel({ model: "gemini-2.0-flash" }); //Modelo de la AI
import { imCalculate } from "./imc.js"; //Importar la funcion del calculo IMC

async function generateAI(diet_request) {
  if (diet_request) {
    try {
      const result = await model.generateContent(diet_request);
      result.response.text();
      let jsonData = await result.response.text();
      jsonData = jsonData.replace(/```json|```/g, "");
      const jsonObject = JSON.parse(jsonData); ///

      return jsonObject;
    } catch (error) {
      console.error("Error generating content:", error);
    }
  } else {
    console.log("Void request");
  }
}

async function gettingData(request) {
  //Funcion para obtener los datos
  try {
    //Usar try-catch para prevenir errores

    const diet_guide = await generateAI(request); // Usa 'await' para la peticion de la Ai
    console.log(diet_guide); //Mostrar en consola el resultado
    document.querySelector("#text-content").textContent = diet_guide; //Mostrar en el HTML

    fetch("/AI-healthy-project/src/controllers/solicitud.php", {
      //Enviar los datos al backend
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(diet_guide), //Convertir el objeto a JSON
    })
      .then((response) => response.text())
      .then((data) => {
        console.log(data); // Mensaje de respuesta del servidor
      })
      .catch((error) => {
        console.error("Error:", error); //Error en caso que no se encie
      });
  } catch (error) {
    console.error("Ocurrió un error:", error);
  }
}

async function main(
  nameData,
  ageData,
  weigthData,
  heigthData,
  reasonData,
  observationData
) {
  nameData = nameData !== null ? nameData : "Usuario"; //Validar los datos para prevenir errores
  weigthData = weigthData !== null ? weigthData : "Peso no definido";
  heigthData = heigthData !== null ? heigthData : "Altura no definido";
  ageData = ageData !== null ? ageData : "Edad no definida";
  observationData !== null ? observationData : "No hay observacion";

  const imc = imCalculate(weigthData, heigthData); //Calculate IMC

  if (!reasonData) {
    //Validar la razon
    alert("Razon no definida");
    return;
  }

  //No integrar al prompt: Sumplementos ni vitaminas, deportes o actividad fisica en especifico.
  //  Usa un esquema en formato JSON para esta guia:

  const request_with_parameters = `
Como nutricionista profesional, Genera un plan de alimentación personalizado con los siguientes datos:
- Nombre: ${nameData}  
- Objetivo: ${reasonData}  
- Datos: ${ageData} años, ${weigthData}kg, ${heigthData}cm, IMC: ${imc}  
- Observación clave: ${observationData}  
**Formato requerido (JSON):**  
{
  "Platillos_permitidos": [
    {"pautas": "Desayuno", "alimentos": ["Avena", "Frutas", "Yogur", "Otro mas"]}, 
    {"pautas": "Almuerzo", "alimentos": ["..."]},
    {"pautas": "Cena", "alimentos": ["..."]},
    {"pautas": "Merienda", "alimentos": ["..."]}
  ],
  "Imc": {"resultado": "..."},
  "Alimentos_no_permitidos": [{"pautas": "Evitar", "alimentos": ["..."]}],
  "Recomendaciones": ["Consumir agua diariamente", "Evitar frituras", "maximo 5 recomendaciones"] (array) 
}

**Excluir:** suplementos, vitaminas, deportes específicos, textos extras ni indentificadores, solo se necesita el objeto y ya.
`; //Prompt para la solicitud

  gettingData(request_with_parameters); //Enviamos el prompt a la función
}

function formProcess(event) {
  event.preventDefault(); // Evita la recarga de la página
  const name = document.querySelector("#input-name").value; //Obtener los valores de los inputs
  const age = document.querySelector("#input-weigth").value;
  const weigth = document.querySelector("#input-weigth").value;
  const heigth = document.querySelector("#input-heigth").value;
  const reason = document.querySelector("#input-reason").value;
  const observation = document.querySelector("#input-observation").value;

  main(name, age, weigth, heigth, reason, observation); //main(); // Llama a la función asíncrona y le pasamos los parametros
}

const form = document.querySelector("#form");
form.addEventListener("submit", formProcess); //Evento del formulario
