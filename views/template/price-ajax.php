<?php
session_start();
require('../../database/DBConnection.php');
require('../../database/Product.php');
require('../../database/User.php');

// $db = new DbConnection();
$product = new Product();
$User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email'], $_SESSION['isAdmin']);

if (isset($_POST['productid']) && isset($_POST['quantity'])) { // if the quantity button is pressed (ajax method in index.js)

    $result = $product->getProduct($_POST['productid']);
    $User->updateCart($_POST['productid'], $_POST['quantity']);

    echo json_encode($result); // return the product encoded with specific productid sent from ajax call
}
