export function imCalculate(weight, height) {
  //Exportamos la funcion
  //heigth => 165
  height = height / 100; //=> 1.65
  const imc = weight / (height * height);

  return imc.toFixed(1); //Retormar el valor del IMC con un decimal
}
