<?php
session_start();
require('../database/DBConnection.php');
require('../database/Product.php');
require('../database/Cart.php');
require('../database/User.php');

$Product = new Product();
$productShuffled = $Product->getRandomProduct();

$Cart = new Cart();

// POST METHOD: 
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['login-submit'])) {
        $User = User::UserInitialized();
        $result = $User->login($_POST['username'], $_POST['password']);

        if ($result) {

            $_SESSION['logged'] = true;
            $_SESSION['username'] = $User->username;
            $_SESSION['user_id'] = $User->user_id;
            $_SESSION['fullname'] = $User->fullname;
            $_SESSION['phone'] = $User->phone;
            $_SESSION['email'] = $User->email;
            $User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email']);

            header("Location: index.php");
        } else {
            $message_error = 'Login failed';
        }
    }
    if (isset($_POST['signup-submit'])) {
        $User = User::UserInitialized();
        $result = $User->signup($_POST['fullname'], $_POST['username'], $_POST['phone'], $_POST['email'], password_hash($_POST['password1'], PASSWORD_DEFAULT));
    }
    if (isset($_POST['new-items-submit']) || isset($_POST['book-submit']) || isset($_POST['shoe-submit'])) {
        $User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email']);
        $User->addToCart($_POST['product_id'], $_POST['product_price']);
    }
    if (isset($_POST['wishlist-submit'])) {
        $User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email']);
        $User->saveForLater($_POST['product_id']);
    }
    if (isset($_POST['cart-submit'])) {
        $User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email']);
        $User->saveForLater($_POST['product_id'], 'Wishlist', 'Cart');
    }
    if (isset($_POST['delete-cart-submit'])) {
        $User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email']);
        $User->deleteCart($_POST['product_id']);
    }
    if (isset($_POST['payemnt-confirm-submit'])) {
        $result = $Cart->createInvoice(
            $_POST['customer-id-invoice'],
            $_POST['customer-address-invoice'],
            $_POST['customer-phone-invoice'],
            $_POST['total-price-invoice']
        );
        if ($result) {
            echo "<script type='text/javascript'>alert('success'); window.location.href='index.php';</script>";
        } else {
            echo 'no';
        }
    }
}
