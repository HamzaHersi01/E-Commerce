<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $mysqli = require __DIR__ . '/Scripts/database.php';
    $sql = "SELECT * FROM user WHERE id = " . $_SESSION['user_id'];

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_to_cart"])) {
    if (isset($_SESSION['user_id'])) {
        if (isset($_POST["product_id"])) {
            $product_id = $_POST["product_id"];
            $sql = "SELECT * FROM products WHERE id = $product_id";
            $result = $mysqli->query($sql);

            if ($result && $result->num_rows > 0) {
                $product = $result->fetch_assoc();

                if (!isset($_SESSION["cart"])) {
                    $_SESSION["cart"] = array();
                }
                $_SESSION["cart"][] = $product;

                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    $name = $product['name'];
                    $price = $product['price'];
                    $image = $product['image'];

                    $sql = "INSERT INTO cart (user_id, name, price, image) VALUES ('$user_id', '$name', '$price', '$image')";
                    $mysqli->query($sql);
                }
            }
        }
        header("Location: products.php");
        exit();
    } else {
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/style.css">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
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

    <footer>
        <div class="footerContainer">
            <div class="icons">
                <a href="https://en-gb.facebook.com/"><i class="fab fa-facebook" style="color: #ffa500;"></i></a>
                <a href="https://www.instagram.com/"><i class="fab fa-instagram" style="color: #ffa500;"></i></a>
                <a href="https://twitter.com/home"><i class="fab fa-twitter" style="color: #ffa500;"></i></a>
                <a href="https://www.youtube.com/watch?v=xvFZjo5PgG0&ab_channel=Duran"><i class="fab fa-youtube" style="color: #ffa500;"></i></a>
            </div>
            <div class="footer-text">
                <p>© 2023 All Rights Reserved. Design by <a href="#">Hamza Hersi</a></p>
            </div>
    </footer>

    <div class="main-content-products">

        <form method="post" action="products.php">
            <input type="hidden" name="product_id" value="1">
            <div class="card">
                <div class="product-image">
                    <img src="images/m1.jpg" alt="S23">
                </div>
                <div class="product-info">
                    <h5>Samsung Galaxy S23</h5>
                    <h6>£700</h6>
                    <input type="submit" value="Add to cart" name="add_to_cart" class="button">
                </div>
            </div>
        </form>

        <form method="post" action="products.php">
            <input type="hidden" name="product_id" value="2">
            <div class="card">
                <div class="product-image">
                    <img src="images/m2.jpg" alt="Xiaomi Mi 11 Ultra">
                </div>
                <div class="product-info">
                    <h5>Xiaomi Mi 11 Ultra</h5>
                    <h6>£500</h6>
                    <input type="submit" value="Add to cart" name="add_to_cart" class="button">
                </div>
            </div>
        </form>

        <form method="post" action="products.php">
            <input type="hidden" name="product_id" value="3">
            <div class="card">
                <div class="product-image">
                    <img src="images/m3.jpg" alt="Samsung Z Fold 2">
                </div>
                <div class="product-info">
                    <h5>Samsung Z Fold 2</h5>
                    <h6>£2000</h6>
                    <input type="submit" value="Add to cart" name="add_to_cart" class="button">
                </div>
            </div>
        </form>

        <form method="post" action="products.php">
            <input type="hidden" name="product_id" value="4">
            <div class="card">
                <div class="product-image">
                    <img src="images/m4.jpg" alt="OnePlus 8T">
                </div>
                <div class="product-info">
                    <h5>OnePlus 8T</h5>
                    <h6>£400</h6>
                    <input type="submit" value="Add to cart" name="add_to_cart" class="button">
                </div>
            </div>
        </form>


    </div>

</body>

</html>