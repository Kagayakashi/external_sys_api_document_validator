<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<link rel="stylesheet" href="css/data.css">
		<title><?php echo $title; ?></title>
	</head>
	<body>
	<center>
	<div class="container">
		<header>
			<section class="header">
				<div class="back-btn">
					<a href="<?php echo '/?back=1'; ?>">
						<img src="img/back-arrow.svg" class="main-logo">
					</a>
				</div>
			<?php include '../html/header.php'; ?>
			<nav id="nav"">
				<section class="nav" >
					<table class="status-language">
						<tr class="status">
							<td class="img">
								<img src="img/<?php echo $status_img; ?>.svg">
							</td>
							<td class="txt">
								<p class="doc" style="color:<?php echo $status_color; ?>;"><?php echo $status; ?></p>
								<p class="status"><?php echo $doc; ?></p>
							</td>
						</tr>
					</table>
					<div class="language">
						<form name="sw_lang" action="<?php $_SERVER['PHP_SELF']; ?>" method="get" autocomplete="on">
							<ul>
							
							<?php $this->get_language_list( $lang, $all_data ); ?>
							
							</ul>
						</form>
					</div>
				</section>
			</nav>
			<main>
				<section class="main">
					<div class="data">
	
					<?php
					foreach( $lang_data as $each_block ){
                        
                        $tmp = str_replace(' // // ', '<br />', $each_block[1]);
                        
						echo '<h5>'.$each_block[0].'</h5>';
						//echo '<h4>'.$each_block[1].'</h4>';
                        echo '<h4>'.$tmp.'</h4><hr>';
					}
					?>
					
					</div>	
				</section>
			</main>
		
		<?php include '../html/footer-block.php'; ?>
		</div>
		</center>
	</body>
</html>