<?php
if (empty($_POST['username'])) {
    die("Username field is required");
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    die("Email is not valid");
}

if (strlen($_POST['password']) < 8) {
    die("Password must be at least 8 characters long");
}

if (!preg_match("#[0-9]+#", $_POST['password'])) {
    die("Password must include at least one number!");
}

if (!preg_match("#[a-zA-Z]+#", $_POST['password'])) {
    die("Password must include at least one letter!");
}

if ($_POST['password'] != $_POST['password_confirmation']) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);


$mysqli = require __DIR__ . '/database.php';

$email = $_POST['email'];
$check_email_sql = "SELECT COUNT(*) as count FROM user WHERE email = ?";
$stmt = $mysqli->prepare($check_email_sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$email_count = $row['count'];

if ($email_count > 0) {
    die("Email already exists");
}

$sql = "INSERT INTO user (name, email, password_hash) VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
};

$stmt->bind_param("sss", $_POST["username"], $_POST["email"], $password_hash);

if ($stmt->execute()) {
    header("Location: ../login.php");
    exit;
} else {

    die($mysqli->error . " " . $mysqli->errno);
}
