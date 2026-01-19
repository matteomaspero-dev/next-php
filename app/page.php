<?php
$about_url = APP_URL . '/about';

/*
Example of using the Router to redirect
$router->redirect('about');
*/
?>

<!-- HTML View -->
<h1>Welcome to Next-PHP!</h1>
<p>This is the default homepage. No more HEREDOC strings needed.</p>
<a href='<?= $about_url ?>'>about</a>
