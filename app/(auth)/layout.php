<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= APP_NAME ?></title>
	<link rel="stylesheet" href="<?= APP_URL ?>/public/css/style.css">
</head>
<body>
	<nav class="navbar">
		<div class="container">
			<a href="<?= APP_URL ?>"><?= APP_NAME ?></a>
			<ul class="nav-links">
				<li><a href="<?= APP_URL ?>">Home</a></li>
				<li><a href="<?= APP_URL ?>/login">Login</a></li>
				<li><a href="<?= APP_URL ?>/register">Register</a></li>
			</ul>
		</div>
	</nav>

	<!-- Render the captured content from the page view -->
	<?= $content ?>

	<footer class="footer">
		<div class="container">
			<p>&copy; <?= date('Y') ?> <?= APP_NAME ?>. All rights reserved.</p>
		</div>
	</footer>
</body>
</html>