<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <link rel="stylesheet" href="css/error1.css">
        <title>Simourg document validator</title>
    </head>
    <body class="gradient">
        <center>
        <div class="container">
            <header>
                <section class="header">
                
                <div class="back-btn">
                    <a href="/">
                        <img src="img/back-arrow.svg" class="main-logo">
                    </a>
                </div>
            
                <?php
                    include 'header.php';
                ?>
            
            <main>
                <section class="main">
                    <div class="error-img">
                        <img src="img/error_wrong.svg" class="">
                    </div>
                            
                    <div class="error-txt">
                        <h3>Oops, something went wrong</h3>
                        <p>Internal error</p>
                    </div>
                </section>
            </main>
    
            <?php
                include 'footer.php';
            ?>
            
        </div>
        </center>
    </body>
</html>
