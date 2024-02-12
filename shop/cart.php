<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $mysqli = require __DIR__ . '/Scripts/database.php';
    $sql = "SELECT * FROM user WHERE id = " . $_SESSION['user_id'];

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();


    $cart_items = array();
    $user_id = $_SESSION['user_id'];
    $cart_sql = "SELECT * FROM cart WHERE user_id = $user_id";
    $cart_result = $mysqli->query($cart_sql);

    while ($cart_item = $cart_result->fetch_assoc()) {
        $cart_items[] = $cart_item;
    }
}


$total_price = 0.00;
foreach ($cart_items as $item) {
    $total_price += (float)$item['price'];
}

$item_list = array();
foreach ($cart_items as $item) {
    $item_list[] = $item['name'];
}



function removeFromCart($item_id)
{
    if (isset($_SESSION['user_id'])) {
        $mysqli = require __DIR__ . '/Scripts/database.php';
        $user_id = $_SESSION['user_id'];
        $sql = "DELETE FROM cart WHERE user_id = $user_id AND id = $item_id";
        $mysqli->query($sql);
        header("Location: cart.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["remove_from_cart"])) {
    if (isset($_SESSION['user_id']) && isset($_POST["item_id"])) {
        $item_id = $_POST["item_id"];
        removeFromCart($item_id);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/style.css">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="nav-bar">
        <div class="search-box">
            <img src="images/logo3.png" class="logo">
            <input type="text" class="form-control">
            <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
        </div>
        <div class="menu-bar">
            <ul>
                <?php if (isset($user)) : ?>
                    <li>
                        <p>Hello <?= htmlspecialchars($user["name"]) ?></p>
                    </li>
                    <li><a href="cart.php"><i class="fa-solid fa-basket-shopping"></i>Cart</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                <?php else : ?>
                    <li><a href="signup.html">Sign Up</a></li>
                    <li><a href="login.php">Log In</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <div class="sidebar">
        <ul id="menu-items">
            <li><a href="index.php"><i class="fa-solid fa-house" style="color: #ffa500;"></i> Home</a></li>
            <li><a href="products.php"><i class="fa-solid fa-shop" style="color: #ffa500;"></i> Products</a></li>
            <li><a href="contact.php"><i class="fa-regular fa-envelope" style="color: #ffa500;"></i> Contact Us</a></li>
        </ul>
    </div>



    <div class="main-content-products">
        <?php if (empty($cart_items)) : ?>
            <p>Your cart is empty.</p>
        <?php else : ?>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item) : ?>
                        <tr>
                            <td><?= htmlspecialchars($item["name"]) ?></td>
                            <td>£<?= htmlspecialchars($item["price"]) ?></td>
                            <td>
                                <form method="post" action="cart.php">
                                    <input type="hidden" name="item_id" value="<?= htmlspecialchars($item["id"]) ?>">
                                    <input type="submit" value="Remove from Cart" name="remove_from_cart" class="button">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="total-price">
                <strong>Total Price: £<?= number_format($total_price, 2) ?></strong>
            </div>
            <div class="buy-button-container">
                <form method="post" action="checkout.php">
                    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                    <input type="hidden" name="item_list" value="<?= htmlspecialchars(json_encode($item_list)) ?>">
                    <input type="hidden" name="total_price" value="<?= htmlspecialchars($total_price) ?>">
                    <input type="submit" value="Buy Now" name="buy_now" class="buy-button">
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>