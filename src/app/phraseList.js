const phrasesList = [
  "Sueña en grande. &#128526;",
  "Haz que suceda. &#128513;",
  "Confía en ti. &#128513;",
  "Nunca te rindas. &#128512;",
  "El éxito es acción. &#128512;",
  "Sé tu mejor versión. &#129299;",
  "Hazlo con pasión siempre. &#128526;",
  "Cada día cuenta, recuerdalo. &#128526;",
  "Persiste y vencerás. &#128526;",
  "El límite eres tú. &#129299;",
];

document.addEventListener("DOMContentLoaded", () => {
  const content = document.getElementById("content-phrase");
  let phraseElement = document.createElement("p");
  phraseElement.style.fontSize = "Clamp(1.1rem, 2vw + 1rem, 1.3rem)";
  phraseElement.style.fontWeight = "400";
  phraseElement.textContent = "Cargando frase...";
  content.appendChild(phraseElement);

  const randomIndex = Math.floor(Math.random() * phrasesList.length);
  const randomPhrase = phrasesList[randomIndex];

  phraseElement.innerHTML = randomPhrase;
});
