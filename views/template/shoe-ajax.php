<?php
session_start();
require('../../database/DBConnection.php');
require('../../database/Product.php');
require('../../database/User.php');

$product = new Product();
$User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email']);

$output = "";

$shoe_page = '';

if (isset($_POST['shoe_page'])) {
    $shoe_page = $_POST['shoe_page'];
} else {
    $shoe_page = 1;
}

$number_of_shoes = $product->getTotalProduct("N'The Min''s'");
$total_shoes_page = $product->getTotalPage("N'The Min''s'");
$shoes = $product->pagination("N'The Min''s'", $shoe_page);

$output .= "
    <div class='row my-3 mx-3'>
";

foreach ($shoes as $shoe) {

    $output .= "
        <div class='col-3'>
            <div class='card'>
                <a href='product.php?product_id=" . $shoe['product_id'] . "'>
                    <img src='" . $shoe['product_image'] . "' class='card-img-top'>
                </a>
                <div class='card-body'>
                    <h4 class='card-title'>" . $shoe['product_name'] . "</h4>
                    <p class='text-uppercase'>" . number_format($shoe['product_price']) . " VND</p>
                    <form method='POST'>
                        <input type='hidden' name='product_id' value=" . $shoe['product_id'] . ">
                        <input type='hidden' name='product_price' value=" . $shoe['product_price'] . ">";


    // check if the product is in the cart                    
    if (in_array($shoe['product_id'], $User->getCartId($User->getOwnedCart()))) {
        $output .= "<button disabled type='submit' name='shoe-submit' class='btn btn-primary text-center' style='justify-self: center;'>In the cart</button>
                </form>
            </div>
        </div>
    </div>
    ";
    } else {
        $output .= "<button type='submit' name='shoe-submit' class='btn btn-primary text-center' style='justify-self: center;'>Add to cart</button>
            </form>
        </div>
    </div>
    </div>
    ";
    }
}

$output .= "</div>";
if ($number_of_shoes > 4) {
    $output .= "
        <ul class='pagination-form list-unstyled d-flex flex-row flex-wrap'>
    ";
    for ($i = 1; $i <= $total_shoes_page; $i++) {
        $output .= "
            <li>
                <span class='shoe-pagination-link btn btn-outline-primary' id='shoe-page-" . $i . "'>" . $i . "</span>
            </li>
        ";
    }
}
$output .= "</ul>";

echo $output;
