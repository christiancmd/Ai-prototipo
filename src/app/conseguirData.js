//import { generateAI } from '../service/module.js';
import { GoogleGenerativeAI } from "https://cdn.skypack.dev/@google/generative-ai";
const genAI = new GoogleGenerativeAI("AIzaSyCEGlSk190sUQCeQH7gXWXwjvMZPRLYmcA");
const model = genAI.getGenerativeModel({ model: "gemini-2.0-flash" });
//import { imCalculate } from './imc.js';

async function generateAI(diet_request) {
  if (diet_request) {
    try {
      const result = await model.generateContent(diet_request);
      //return result.response.text();
      let jsonData = await result.response.text();
      jsonData = jsonData.replace(/```json|```/g, '');
      const jsonObject = JSON.parse(jsonData);

      return jsonObject;

    } catch (error) {
      console.error("Error generating content:", error);
    }
  } else {
    console.log('Void request');
  }
}

async function gettingData(request) {

  try {
    const diet_guide = await generateAI(request); // Usa 'await'
    console.log(diet_guide);
    document.querySelector('#text-content').textContent = diet_guide;

    fetch('http://localhost/AI-healthy-project/src/php/solicitud.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(diet_guide)
    })
      .then(response => response.text())
      .then(data => {
        console.log(data); // Mensaje de respuesta del servidor
      })
      .catch((error) => {
        console.error('Error:', error);
      });


  } catch (error) {
    console.error("Ocurrió un error:", error);
  }
}

function imCalculate(weight, height) { //Operaciones para calcular el imc.
  //heigth => 165
  height = height / 100; //=> 1.65
  const imc = weight / (height * height);

  return imc.toFixed(1);
}


async function main(nameData, ageData, weigthData, heigthData, reasonData, observationData) {
  nameData = nameData !== null ? nameData : 'Usuario';
  weigthData = weigthData !== null ? weigthData : 'Peso no definido';
  heigthData = heigthData !== null ? heigthData : 'Altura no definido';
  ageData = ageData !== null ? ageData : 'Edad no definida';
  observationData = observationData !== null ? observationData : 'No hay observacion';

  const imc = imCalculate(weigthData, heigthData);  //Calculate IMC

  if (!reasonData) {
    alert('Razon no definida');
    return;
  }

  //No integrar al prompt: Sumplementos ni vitaminas, deportes o actividad fisica en especifico.
  //  Usa un esquema en formato JSON para esta guia:
  const request_with_parameters = `Eres mi nutriologo profesional de confianza, 
    Y soy ${nameData} y estoy aqui presentandome con un principal objetivo: ${reasonData}, y te necesito
    a ti como nutriologo que me ayudes a cumplir mi objetivo. a raiz de esto quiero que consideres fijamente
    mis datos personales que mostrare a continuacion, especialmente el resultado del imc para un mejor resultado.
    -edad: ${ageData} años,
    -peso: ${weigthData}kg,
    -altura: ${heigthData}cm,
    -imc: ${imc}.
    Ademas quiero que parametrices el resultado dependiendo de la siguiente Observacion de salud: ${observationData} (Importante).
    pero quiero algo resumido y corto, quiero que vayas al grano sin saludos ni despedidas, sin embargo quiero que tomes en cuenta,
    que no quiero que incluyas nada relacionado con sumplementos ni vitaminas, ni mucho menos deporte en especificos, no es necesario un
    indentificador o algo parecido, solo quiero el objeto y solo eso.

    retorname un array de objeto para esta guia:
    ejemplo:
    
 {
  "Alimentos_permitidos": [
    {
      "pautas": "Desayuno",
      "alimentos": ["Avena", "Frutas", "Yogur"]
    },
    {
      "pautas": "Almuerzo",
      "alimentos": ["Avena", "Frutas", "Yogur"]
    },
    {
      "pautas": "Cena",
      "alimentos": ["Avena", "Frutas", "Yogur"]
    },
    {
      "pautas": "Merienda",
      "alimentos": ["Avena", "Frutas", "Yogur"]
    }
  ],
  "Imc": {
    "imc_resultado": "Normpeso"
  },
  "Alimentos_no_permitidos": [
    {
      "pautas": "Evitar estos alimentos para mantener una dieta equilibrada",
      "alimentos": ["Fritos", "Alimentos procesados", "Refrescos azucarados", "Dulces"]
    }
  ],
  "Recomendaciones":[
  ...
  ]
}
    `;

  gettingData(request_with_parameters);

}


function formProcess(event) {
  event.preventDefault(); // Evita la recarga de la página
  const name = document.querySelector('#input-name').value;
  const age = document.querySelector('#input-weigth').value;
  const weigth = document.querySelector('#input-weigth').value;
  const heigth = document.querySelector('#input-heigth').value;
  const reason = document.querySelector('#input-reason').value;
  const observation = document.querySelector('#input-observation').value;

  main(name, age, weigth, heigth, reason, observation); //main(); // Llama a la función asíncrona
}

const form = document.querySelector('#form');
form.addEventListener('submit', formProcess);


