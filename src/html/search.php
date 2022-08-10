<?php
header('Content-type: text/html; charset=utf-8');

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Simourg document validator</title>
        <link rel="stylesheet" href="css/search2.css">
    </head>

    <body>
        <div class="container">
            <header>
                <section class="title">
                    <h1>Simourg document validator</h1>
                </section>
                <section class="logo">
                    <img src="img/simourg.svg">
                </section>
            </header>
            
            <div class="top-del"></div>

            <main>
                <div class="search">
                    <form name="token" action="<?php $_SERVER['PHP_SELF']; ?>" method="get">
                        <div class="search-block">
                            <!-- maxlength="10" minlength="10" pattern="[A-Za-z]{2}[0-9]{6}[A-Za-z0-9]{2}" -->
                            <input placeholder="AB<?php echo date("ymd"); ?>01" type="text" name="token" autocomplete="on" required="required" maxlength="20">
                            <button type="submit" name="">
                                <img src="img/search.svg">
                            </button>
                        </div>
                    </form>
                </div>
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
