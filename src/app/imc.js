export function imCalculate(weight, height) {
    //heigth => 165
    height = height / 100; //=> 1.65

    const imc = weight / (height * height);
    console.log(imc);

    return imc.toFixed(1);
}
