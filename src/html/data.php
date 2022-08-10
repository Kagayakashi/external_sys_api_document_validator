<?php
header('Content-type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Simourg document validator</title>
        <link rel="stylesheet" href="css/data2.css">
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
                <section class="validate">
                    <table class="status-language">
                        <tr>
                            <td class="img">
                                <img src="img/<?php echo $status_img; ?>.svg">
                            </td>
                            <td class="txt">
                                <p class="number" style="color:<?php echo $status_color; ?>;"><?php echo $status; ?></p>
                                <p class="status"><?php echo $doc; ?></p>
                            </td>
                        </tr>
                    </table>
                </section>
                <section class="language">
                    <nav>
                        <form name="sw_lang" action="<?php $_SERVER['PHP_SELF']; ?>" method="get" autocomplete="on">
                            <input type="hidden" name="token" value="<?= $token ?>">
                            <ul>
                                <?php $this->get_language_list( $lang, $all_data ); ?>
                            </ul>
                        </form>
                    </nav>
                </section>
            </header>
            
            <main>
                <div class="data">

                <?php
                foreach( $lang_data as $each_block ){
                    echo '<h5>'.$each_block[0].'</h5>';
                    echo '<span class="paragraph">';

                    if(strpos($each_block[1], '//')) {
                        $pieces = explode(' // ', $each_block[1]);
                        foreach ($pieces as &$value) {
                            $first_2_char = substr($value, 0, 5);

                            $numeric_class = '';
                            if(preg_match('/^[0-9]+\./', $first_2_char)) {
                                $numeric_class = ' numeric';
                            }

                            echo '<span class="paragraph'.$numeric_class.'">';
                            echo $value;
                            echo '</span>';
                        }
                    }
                    else {
                        echo $each_block[1];
                    }

                    echo '</span>';
                    echo '<hr>';
                }
                ?>

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
    </body>
</html>
