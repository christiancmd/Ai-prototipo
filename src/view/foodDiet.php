<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/main.css" />
    <title>Document</title>
  </head>

  <body>
    <section id="hero">
      <form action="" id="form">
        <input
          type="text"
          class="input"
          id="input-name"
          name="input-name"
          placeholder="Nombre aqui..."
        />
        <input
          type="text"
          class="input"
          id="input-age"
          name="input-age"
          placeholder="Edad aqui..."
        />
        <input
          type="text"
          class="input"
          id="input-weigth"
          name="input-weigth"
          placeholder="Peso aqui..."
        />
        <input
          type="text"
          class="input"
          id="input-heigth"
          name="input-heigth"
          placeholder="Altura aqui..."
        />
        <input
          type="text"
          class="input"
          id="input-reason"
          name="input-text"
          placeholder="Razon aqui..."
        />
        <input
          type="text"
          class="input"
          id="input-observation"
          name="input-observation"
          placeholder="Observacion..."
        />
        <button type="submit" id="generate-button">Generar</button>
      </form>

      <pre id="text-content"></pre>
    </section>

    <script type="module" src="../app/getDataDiet.js"></script>
  </body>
</html>
