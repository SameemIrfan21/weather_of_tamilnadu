<?php
session_start();
$products = [
    1 => ['name' => 'Apple', 'price' => 1.00],
    2 => ['name' => 'Banana', 'price' => 0.50],
    3 => ['name' => 'Orange', 'price' => 0.80]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['product_id'];
    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = 0;
    }
    $_SESSION['cart'][$id]++;
    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Products</h1>
    <ul>
        <?php foreach ($products as $id => $product): ?>
            <li>
                <?= htmlspecialchars($product['name']) ?> - $<?= number_format($product['price'], 2) ?>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="product_id" value="<?= $id ?>">
                    <button type="submit">Add to Cart</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <p><a href="cart.php">View Cart</a></p>
</body>
</html>
<?php
session_start();
$products = [
    1 => ['name' => 'Apple', 'price' => 1.00],
    2 => ['name' => 'Banana', 'price' => 0.50],
    3 => ['name' => 'Orange', 'price' => 0.80]
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Your Cart</h1>

    <?php if (empty($_SESSION['cart'])): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <ul>
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $id => $qty):
                $product = $products[$id];
                $subtotal = $product['price'] * $qty;
                $total += $subtotal;
            ?>
                <li>
                    <?= htmlspecialchars($product['name']) ?> - 
                    Quantity: <?= $qty ?> -
                    $<?= number_format($subtotal, 2) ?>
                    <a href="remove.php?id=<?= $id ?>">Remove</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <p><strong>Total: $<?= number_format($total, 2) ?></strong></p>
    <?php endif; ?>

    <p><a href="index.php">Continue Shopping</a></p>
</body>
</html>
<?php
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    unset($_SESSION['cart'][$id]);
}
header("Location: cart.php");
exit;
?>