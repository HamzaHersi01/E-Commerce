<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["buy_now"])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_POST["user_id"];
        $item_list = $_POST["item_list"];
        $total_price = $_POST["total_price"];


        $mysqli = require __DIR__ . '/Scripts/database.php';
        $item_list_json = $mysqli->real_escape_string($item_list);

        $sql = "INSERT INTO invoice (user_id, items_list, total_price) VALUES ('$user_id', '$item_list_json', '$total_price')";
        $result = $mysqli->query($sql);

        if ($result) {
            $cart_clear_sql = "DELETE FROM cart WHERE user_id = $user_id";
            $mysqli->query($cart_clear_sql);
            header("Location: index.php");
            exit;
        } else {
            die($mysqli->error . " " . $mysqli->errno);
        }
    }
}
