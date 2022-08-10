<?php
header('Content-type: text/html; charset=utf-8');

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Simourg document validator</title>
        <link rel="stylesheet" href="css/error2.css">
    </head>

    <body>
        <div class="container">
            <header>
                <section class="title">
                    <a href="/">
                        <img src="img/back-arrow.svg" class="main-logo">
                    </a>
                    <h1>Simourg document validator</h1>
                </section>
                <section class="logo">
                    <img src="img/simourg.svg">
                </section>
            </header>
            
            <div class="top-del"></div>

            <main>
                <section class="error">
                    <div class="error-img">
                        <img src="img/doc_not_found.svg" class="">
                    </div>
                            
                    <div class="error-txt">
                        <h3>Sorry, document was not found</h3>
                        <p>Please enter proper document number</p>
                    </div>
                </section>
            </main>
            
            <div class="bot-del"></div>

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
    </body>
</html>
