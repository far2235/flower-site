<?php
session_start();

include 'functions.php';
?>

<?=template_header('My Account')?>

<div class="flower-page">
    <h2>Logged in as: <?php echo htmlspecialchars($_SESSION["username"]); ?>.</h2>
    <p><a href="logout.php">Sign Out</a></p>
</div>

<?=template_footer()?>