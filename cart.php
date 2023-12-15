<?php
//add item to cart
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_POST['product_id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($product && $quantity > 0) {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    header('location: index.php?page=cart');
    exit;
}

//removing an item
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    //remove product from shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}

//updating quantities
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    //loop to update quantities of everything
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            //validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                //update quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    header('location: index.php?page=cart');
    exit;
}

//handle placing orders
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: index.php?page=placeorder');
    exit;
}

//member discount
$member_discount = 1.00;
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $member_discount = 0.90; //10 percent off
}

//get cart items and select from DB
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
$discount_total = 0.00;
//if there are products in cart
if ($products_in_cart) {
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    $stmt->execute(array_keys($products_in_cart));
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //calculate subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']] * $member_discount;
        $discount_total += (float)$product['price'] * (int)$products_in_cart[$product['id']] * (1-$member_discount);
    }
    //fix pricing precision
    $subtotal = $subtotal*100;
    $subtotal = floor($subtotal);
    $subtotal = $subtotal/100;

    $discount_total = $discount_total*100;
    $discount_total = floor($discount_total);
    $discount_total = $discount_total/100;
}
?>

<?=template_header('Cart')?>

<div class="cart content-wrapper">
    <h1>Shopping Cart</h1>
    <form action="index.php?page=cart" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="img">
                        <a href="index.php?page=product&id=<?=$product['id']?>">
                            <img src="images/<?=$product['img']?>" width="50" height="50" alt="<?=$product['name']?>">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?page=product&id=<?=$product['id']?>"><?=$product['name']?></a>
                        <br>
                        <a href="index.php?page=cart&remove=<?=$product['id']?>" class="remove">Remove</a>
                    </td>
                    <td class="price">&dollar;<?=$product['price']?></td>
                    <td class="quantity">
                        <input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                    </td>
                    <td class="price">&dollar;<?=$product['price'] * $products_in_cart[$product['id']]?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <br>
        <div class="subtotal">
            <span class="shop-item-title">Discount:</span>
            <span class="shop-item-price">&dollar;<?=$discount_total?></span>
        <div class="subtotal">
            <span class="shop-item-title">Subtotal</span>
            <span class="shop-item-price">&dollar;<?=$subtotal?></span>
        </div>
        <br>
        <div class="buttons">
            <input type="submit" value="Update" name="update">
            <input type="submit" value="Place Order" name="placeorder">
        </div>
    </form>
</div>

<?=template_footer()?>