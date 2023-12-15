<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Home')?>


<div class="homepage">
    <header>
        <h1>Welcome!</h1>
    </header>
    <div id="month-flower"></div>
    <header>About</header>
    <p>
        Want to find the right flowers for your garden? Perhaps you're looking for a
        nice gift for a friend? Or maybe you just want to learn how to care for
        your garden- whatever the case, this site is made for flower gardeners just
        like you. Visit the seasonal tab to make sure you're prepared to plant ahead
        of time. Check out the purchase tab to visit our shop! To learn about the
        flowers in stock, visit the catalog and explore all we have to offer.
    </p>
    <script type="text/javascript" src="homepage.js"></script>
</div>

<?=template_footer()?>