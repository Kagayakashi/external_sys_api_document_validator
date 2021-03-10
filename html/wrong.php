
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<link rel="stylesheet" href="css/error.css">
		<title><?php echo $title; ?></title>
	</head>
	<body class="gradient">
		<center>
		<div class="container">
			<header>
				<section class="header">
				
				<div class="back-btn">
					<a href="<?php echo '?back=1'; ?>">
						<img src="img/back-arrow.svg" class="main-logo">
					</a>
				</div>
			
				<?php
					include '../html/header.php';
				?>
			
			<main>
				<section class="main">
					<div class="error-img">
						<img src="img/error_wrong.svg" class="">
					</div>
							
					<div class="error-txt">
						<h3>Oops, something went wrong</h3>
						<p>Page was not found</p>
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
