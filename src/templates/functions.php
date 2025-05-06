<?php
//Activar los tipos estrictos
declare(strict_types=1);

//Función para renderizar plantillas con los datos que se les pase
function render_template(string $template, string $ubication = null, array $style = [], array $data = []): void
{
  extract(array: $style);
  extract(array: $data);

  //  echo $template . " - " . $style;

  require("$template.php");

  //Ubication es una variable que se mandara al template
}

