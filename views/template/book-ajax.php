<?php
session_start();

require('../../database/DBConnection.php');
require('../../database/Product.php');
require('../../database/User.php');

$product = new Product();
$User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email']);

$output = "";
$book_page = '';

if (isset($_POST['book_page'])) {
    $book_page = $_POST['book_page'];
} else {
    $book_page = 1;
}


$number_of_books = $product->getTotalProduct("N'Tú Stationary'");
$total_book_page = $product->getTotalPage("N'Tú Stationary'");
$books = $product->pagination("N'Tú Stationary'", $book_page);

$output .= "
    <div class='row my-3 mx-3'>
";

foreach ($books as $book) {

    $output .= "
        <div class='col-3'>
            <div class='card'>
                <a href='product.php?product_id=" . $book['product_id'] . "'>
                    <img src='" . $book['product_image'] . "' class='card-img-top'>
                </a>
                <div class='card-body'>
                    <h4 class='card-title'>" . $book['product_name'] . "</h4>
                    <p class='text-uppercase'>" . number_format($book['product_price']) . " VND</p>
                    <form method='POST'>
                        <input type='hidden' name='product_id' value=" . $book['product_id'] . ">
                        <input type='hidden' name='product_price' value=" . $book['product_price'] . ">";

    // check if the product is in the cart                    
    if (in_array($book['product_id'], $User->getCartId($User->getOwnedCart()))) {
        $output .= "<button disabled type='submit' name='book-submit' class='btn btn-primary text-center' style='justify-self: center;'>In the cart</button>
                    </form>
                </div>
            </div>
        </div>
    ";
    } else {
        $output .= "<button type='submit' name='book-submit' class='btn btn-primary text-center' style='justify-self: center;'>Add to cart</button>
                </form>
            </div>
        </div>
    </div>
    ";
    }
}

$output .= "</div>";
if ($number_of_books > 4) {
    $output .= "
        <ul class='pagination-form list-unstyled d-flex flex-row flex-wrap'>
    ";
    for ($i = 1; $i <= $total_book_page; $i++) {
        $output .= "
            <li>
                <span class='book-pagination-link btn btn-outline-primary' id='book-page-" . $i . "'>" . $i . "</span>
            </li>
        ";
    }
}
$output .= "</ul>";

echo $output;
