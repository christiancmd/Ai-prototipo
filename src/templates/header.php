<?php

if ($ubication) {
    $brand_icon = ($ubication !== "index") ? "../../public/logo_nutrimore.png" : "./public/logo_nutrimore.png";
}
?>


<header id="header-container">
    <div class="header-box">
        <div class="title">
            <img src="<?= $brand_icon ?> " alt="Our icon">
            <h1><a href="#">NUTRIMORE</a></h1>
        </div>
        <nav class="navegator-box">
            <section class="ul-list-mobile" id="nav-php">
                <header class="header-list">
                    <img id="icon-close" src="./public/close.png" alt="close">
                </header>
                <div class="info-project">
                    <div class="info-box">
                        <h2>Proyecto</h2>
                        <p>Este proyecto fue realizado por el equipo de Nutrimore, con el fin de ayudar a las personas a
                            llevar un control de su alimentación y mejorar su calidad de vida.</p>

                        <hgroup>
                            <h3>Integrantes</h3>
                            <ul>
                                <li>Christian Parisca.</li>
                                <li>Miguelangel Flores</li>
                            </ul>
                        </hgroup>
                    </div>
                </div>
                <footer>Sistema de información</footer>
            </section>
        </nav>
        <a class="icon-personal" href="#">
            <svg id="active-nav-button" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" width="50" height="50"
                viewBox="0 0 24 24">
                <path
                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
            </svg>
        </a>
    </div>
    <!-- <div class="progress"></div> -->
</header>