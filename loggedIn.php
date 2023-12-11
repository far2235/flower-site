<?php
session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="flowerCSS.css">
        <h1>Account</h1>
    </head>
    <body>
        <div class="mainNav">
            <div class="dropdown">
                <a href="flowerCatalog.html"><button class="drop-button">Catalog</button></a>
                <div class="drop-options">
                    <a href="aster.html">Aster</a>
                    <a href="chrysanthemum.html">Chrysanthemum</a>
                    <a href="crocus.html">Crocus</a>
                    <a href="daffodil.html">Daffodil</a>
                    <a href="fuchsia.html">Fuchsia</a>
                    <a href="rose.html">Rose</a>
                    <a href="tulip.html">Tulip</a>
                </div>
            </div>
                <a href="flowerHome.html">Home</a>
                <a href="flowerSeasonal.html">Seasonal</a>
                <a href="flowerPurchase.html">Purchase</a>
                <a href="authentication.php">My Account</a>
            </div>
        </div>
        <div class="flower-page">
            <h2>Logged in as: <?php echo htmlspecialchars($_SESSION["username"]); ?>.</h2>
            <p><a href="logout.php">Sign Out</a></p>
        </div>
    </body>
</html>