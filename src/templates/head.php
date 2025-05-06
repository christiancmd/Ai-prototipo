
<?php

    if ($style) {
        $link_style = ($style !== "index") ? "../styles/$style": "./src/styles/$style";
    }
?>


<head>
    <!-- Data meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Christian Parisca">
    <!-- Estilos -->
    <link rel="stylesheet" href="<?= $link_style?>.css">

    
    <!-- Titulo -->
    <title>Guia Alimentaria</title>
</head>