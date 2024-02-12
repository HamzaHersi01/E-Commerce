<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $mysqli = require __DIR__ . '/Scripts/database.php';
    $sql = "SELECT * FROM user WHERE id = " . $_SESSION['user_id'];

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/style.css">
    <title>Home</title>
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
                    <li><a href="signup.php">Sign Up</a></li>
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

    <div class="main-content-home">
        <img src="images/HomepageProducts.jpg" class="homepagePic">
        <div class="text">
            <p>Buy the latest products</p>
        </div>


</body>

</html>