<?php
header('Content-type: text/html; charset=utf-8');

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title><?= $config->title ?></title>
        <script src="js/longbow.slidercaptcha.min.js"></script>
        <link rel="stylesheet" href="css/fonts/fontawesome-6.1.2.min.css" />
        <link rel="stylesheet" href="css/slidercaptcha.min.css" />
        <link rel="stylesheet" href="css/captcha2.css">
        <link rel="stylesheet" href="custom/custom.css">
    </head>

    <body>
        <div class="container">
            <header>
                <section class="title">
                    <a href="/">
                        <img src="img/back-arrow.svg" class="main-logo">
                    </a>
                    <h1><?= $config->title ?></h1>
                </section>
                <section class="logo">
                    <img src="img/simourg.svg">
                </section>
            </header>

            <div class="top-del"></div>

            <main>
                <div class="captcha slidercaptcha">
                    <div class="label">
                        <p>Confirm that you are not robot</p>
                    </div>
                    <div class="">
                        <div id="captcha"></div>
                    </div>
                </div>
            </main>

            <footer>
                <section class="footer-block">
                    <a class="link" href="https://www.simourg.com">
                        <div class="text">
                            <span class="part">Powered by</span>
                            <span class="part"><img src="img/simbase.svg"></span>
                        </div>
                    </a>
                </section>
            </footer>
        </div>
        <script src="js/captcha.js"></script>
    </body>
</html>
