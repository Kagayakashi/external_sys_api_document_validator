<?php
header('Content-type: text/html; charset=utf-8');

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Simourg document validator</title>
        <link rel="stylesheet" href="css/search1.css">
    </head>
    <body>
    <center>
    <div class="container">
        <header>
            <section class="header">
            <?php include 'header.php'; ?>
            <nav id="nav">
                <section class="nav" style="height:171px">
                    <div class="logo">
                        <img src="img/simourg.svg" class="main-logo" style="width:120px;margin:20px">
                    </div>
                </section>
            </nav>
            <main>
                <section class="main-search">
                    <div class="data">

                    <div class="search">
                        <form name="token" action="<?php $_SERVER['PHP_SELF']; ?>" method="get">
                            <div class="search-block">
                                <!-- maxlength="10" minlength="10" pattern="[A-Za-z]{2}[0-9]{6}[A-Za-z0-9]{2}" -->
                                <input placeholder="AB<?php echo date("ymd"); ?>01" type="text" name="token" autocomplete="on" required="required">
                                <button type="submit" name="">
                                    <img src="img/search.svg">
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    </div>	
                </section>
            </main>
        
        <?php include 'footer-block.php'; ?>
        </div>
        </center>
    </body>
</html>
