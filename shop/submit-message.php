<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["send_message"])) {
    $user_id = $_SESSION['user_id'];
    $message = $_POST["message"];


    $mysqli = require __DIR__ . '/Scripts/database.php';
    $message = $mysqli->real_escape_string($message);

    $sql = "INSERT INTO contact (user_id, message) VALUES ('$user_id', '$message')";
    $result = $mysqli->query($sql);

    if ($result) {
        header("Location: contact.php");
        exit();
    } else {
        die($mysqli->error . " " . $mysqli->errno);
        header("Location: contact.php");
        exit();
    }
}
