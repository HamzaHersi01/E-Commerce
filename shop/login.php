<?php
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . '/Scripts/database.php';


    if (isset($_POST['email'])) {
        $email = $mysqli->real_escape_string($_POST['email']);

        $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $email);

        $result = $mysqli->query($sql);

        $user = $result->fetch_assoc();

        if ($user) {
            if (password_verify($_POST['password'], $user['password_hash'])) {
                session_start();
                session_regenerate_id();
                $_SESSION['user_id'] = $user['id'];
                header("Location: index.php");
                exit;
            }
        }
        $is_invalid = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/style.css">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="nav-bar">
        <div class="search-box">
            <img src="images/logo3.png" class="logo">

        </div>

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

    <div class="main-content-login">
        <h1>Login</h1>
        <form method="post">
            <div class="txt_field">
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" required>
                <label for="email">Email</label>
            </div>

            <div class="txt_field">
                <input type="password" name="password" id="password" required>
                <label>password</label>
                <input type="submit" value="Login">
                <div class="signup_link">
                    Not a member? <a href="signup.php">Signup</a>
                </div>
                <?php if ($is_invalid) : ?>
                    <em>Invalid email or password</em>
                <?php endif; ?>
        </form>

    </div>


</body>

</html>