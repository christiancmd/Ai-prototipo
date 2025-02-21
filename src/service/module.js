import { GoogleGenerativeAI } from "@google/generative-ai";
const genAI = new GoogleGenerativeAI("AIzaSyCEGlSk190sUQCeQH7gXWXwjvMZPRLYmcA");
const model = genAI.getGenerativeModel({ model: "gemini-2.0-flash" });

export async function generateAI(request) {
    if (request) {
        try {
            const result = await model.generateContent(request);
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


//es necesario ajuro este paso? no lo puedo saltar