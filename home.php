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
    <header class="month-flower">
        Flower of the month for November: Chrysanthemum
    </header>
    <img src="images/chrysanthemum.jpg">
    <p>
        November is here and chrysanthemums are still blooming unitl winter comes!
        A perfect flower for the fall season, mums go great alongside your fall
        porch displays. Learn more about chrysanthemums by visiting
        <a href="chrysanthemum.html">this page</a>.
    </p>
    <header>About</header>
    <p>
        Want to find the right flowers for your garden? Perhaps you're looking for a
        nice gift for a friend? Or maybe you just want to learn how to care for
        your garden- whatever the case, this site is made for flower gardeners just
        like you. Visit the seasonal tab to make sure you're prepared to plant ahead
        of time. Check out the purchase tab to visit our shop! To learn about the
        flowers in stock, visit the catalog and explore all we have to offer.
    </p>
</div>

<?=template_footer()?>