import { GoogleGenerativeAI } from "@google/generative-ai";
const genAI = new GoogleGenerativeAI("AIzaSyCEGlSk190sUQCeQH7gXWXwjvMZPRLYmcA"); //Api key
const model = genAI.getGenerativeModel({ model: "gemini-2.0-flash" }); //Modelo de geminis

export async function generateAI(request) {
  if (request) {
    //Validar si hay una solicitud
    try {
      const result = await model.generateContent(request); // Se genera el contenido
      //return result.response.text();
      let jsonData = await result.response.text(); /// Se obtiene el texto de la respuesta
      jsonData = jsonData.replace(/```json|```/g, ""); //Remover un string especifico que no es JSON
      const jsonObject = JSON.parse(jsonData); // Se convierte a JSON

      return jsonObject;
    } catch (error) {
      console.error("Error generating content:", error);
    }
  } else {
    console.log("Void request");
  }
}
