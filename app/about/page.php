<?php
$home_url = APP_URL;
$name = $router->getParam('name') ?? 'Guest';
$id = $router->getParam('id') ?? 'N/A';
?>

<!-- HTML View -->
<h1>About Us</h1>
<p>Welcome, <?= htmlspecialchars($name) ?></p>
<p>Your ID is: <?= htmlspecialchars($id) ?></p>
<a href='<?= $home_url ?>'>home</a>
