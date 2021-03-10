
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<link rel="stylesheet" href="css/search.css">
		<title><?php echo $title; ?></title>
	</head>
	<body class="gradient">
		<center>
		<div class="container">
			<header>
				<section class="header">
			
				<?php
					include '../html/header.php';
				?>
			
			<main>
				<section class="main">
					<div class="logo">
						<img src="img/simourg.svg" class="main-logo">
					</div>
							
					<div class="search">
						<form name="token" action="<?php $_SERVER['PHP_SELF']; ?>" method="get">
							<div class="search-block">
								<input placeholder="ED<?php echo date("ymd"); ?>01" type="text" name="token" maxlength="10" minlength="10" autocomplete="on" pattern="[A-Za-z]{2}[0-9]{6}[A-Za-z0-9]{2}" required="required">
								<button type="submit" name="">
									<img src="img/search.svg">
								</button>
							</div>
						</form>
					</div>
				</section>
			</main>
	
			<?php
				include '../html/footer.php';
			?>
			
		</div>
		</center>
	</body>
</html>