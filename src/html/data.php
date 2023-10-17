<?php
header('Content-type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title><?= $config->title ?></title>
        <link rel="stylesheet" href="css/data4.css">
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
                $i = 0;
                foreach( $lang_data as $each_block ){
                    $i++;
                    echo '<h5>'.$each_block[0].'</h5>';

                    echo '<span class="paragraph">';
                    $decoded_value = base64_decode($each_block[1]);
                    $im = imagecreatefromstring($decoded_value);

                    if ($im !== false) {
                        echo '<img style="max-width: 515px;" src="data:image;base64,' . $each_block[1] . '">';
                    }
                    elseif(strpos($each_block[1], '//')) {
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
                    elseif(strpos($each_block[1], 'picture:') === 0) {
                        $picture_code = substr($each_block[1], 8);
                        $decoded_value = base64_decode($pictures[$picture_code]);
                        $im = imagecreatefromstring($decoded_value);

                        if ($im !== false) {
                            echo '<img style="max-width: 515px;" src="data:image;base64,' . $pictures[$picture_code] . '">';
                        }
                        else {
                            echo $each_block[1];
                        }
                    }
                    elseif(strpos($each_block[1], 'file:') === 0) {
                        $file_code = substr($each_block[1], 5);
                        if(isset($files[$file_code]) && isset($files[$file_code]['name'])) {
                            $point_exploded = explode('.', $files[$file_code]['name']);
                            switch (strtolower(end($point_exploded))) {
                                case 'doc':
                                case 'docx':
                                case 'pdf':
                                case 'jpg':
                                case 'jpeg':
                                case 'png':
                                case 'ppt':
                                case 'pptx':
                                case 'odt':
                                case 'txt':
                                case 'xls':
                                case 'xlsx':
                                    $format = strtolower(end($point_exploded));
                                    break;
                                default:
                                    $format = 'none';
                                    break;
                            }
                            $icon = '<span><img class="fileformat" src="/img/files/' . $format . '.svg"></span>';
                            $fname = '<span><p class="filename">' . $files[$file_code]['name'] . '</p></span>';
                            echo '<a href="?download='. $file_code .'" download="' . $files[$file_code]['name'] . '"><div class="fileblock">' . $icon . $fname . '</div></a>';
                        }
                        else {
                            echo $each_block[1];
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
