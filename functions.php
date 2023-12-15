<?php
if(!function_exists('pdo_connect_mysql')){
    function pdo_connect_mysql() {
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'shoppingcart';
        try {
        $connString = "mysql:host=localhost;port=3306;dbname=shoppingcart";
        // creating a php database object
        $pdo = new PDO($connString, $DATABASE_USER, $DATABASE_PASS);
        return $pdo;
        } catch (PDOException $exception) {
        // If there is an error with the connection,
        // stop the script and display the error.
        echo "Database connection unsuccessful";
        // die($e->getMessage());
        exit('Failed to connect to database!');
        }
    }
}

if(!function_exists('template_header')){
    function template_header($title){
        echo <<<EOT
        <!DOCTYPE html>
        <html>
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="flowerCSS.css">
                <h1>$title</h1>
            </head>
            <body>
                <div class="mainNav">
                    <div class="dropdown">
                        <a href="index.php?page=flowerCatalog"><button class="drop-button">Catalog</button></a>
                        <div class="drop-options">
                            <a href="index.php?page=aster">Aster</a>
                            <a href="index.php?page=chrysanthemum">Chrysanthemum</a>
                            <a href="index.php?page=crocus">Crocus</a>
                            <a href="index.php?page=daffodil">Daffodil</a>
                            <a href="index.php?page=fuchsia">Fuchsia</a>
                            <a href="index.php?page=rose">Rose</a>
                            <a href="index.php?page=tulip">Tulip</a>
                        </div>
                    </div>
                        <a href="index.php">Home</a>
                        <a href="index.php?page=flowerSeasonal">Seasonal</a>
                        <a href="index.php?page=products">Purchase</a>
                        <a href="authentication.php">Account</a>
                    </div>
                </div>

                <header>
                    <div class="content-wrapper">
                        <div class="link-icons">
                            <a href="index.php?page=cart">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                </header

                <main>
        EOT;
    }
}

if(!function_exists('template_footer')){
    function template_footer(){
        $year = date('Y');
        echo <<<EOT
            </main>
            <footer>
            </footer>
        </body>
        </html>
        EOT;
    }
}
?>