<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/style.css">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="nav-bar">
        <div class="search-box">
            <img src="images/logo3.png" class="logo">

        </div>
        <div class="menu-bar">

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
        <h1>Sign Up</h1>
        <form action="Scripts/signup-process.php" method="post">

            <div class="txt_field">
                <input type="username" id="username" name="username" required>
                <label for="username">Username</label>
            </div>

            <div class="txt_field">
                <input type="email" id="email" name="email" required>
                <label for="email">Email</label>
            </div>

            <div class="txt_field">
                <input type="password" id="password" name="password" required>
                <label for="password">Password</label>
            </div>


            <div class="txt_field">
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                <label for="password_confirmation"> Confirm Password</label>
                <input type="submit" value="Sign Up">
                <div class="signup_link">
                    Already a member? <a href="login.php">Login</a>
                </div>
            </div>
        </form>

    </div>


</body>

</html>