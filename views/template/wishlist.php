<?php

session_start();

$User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email'], $_SESSION['isAdmin']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete-cart-submit'])) {
        $User->deleteCart($_POST['product_id'], 'Wishlist');
    }
}

?>

<section id="cart" class="container-fluid">
    <h2>Wishlist</h2>
    <div class="row w-75">
        <div class="col-9 bg-light cart-list">
            <div class="cart-item">
                <?php foreach ($User->getOwnedCart('Wishlist') as $item) {
                    $carts = $Product->getProduct($item['product_id']); // this is an array, have to loop through it
                    $prices[] = array_map(function ($cart) { // this is for returning cart_price for each cart in a loop
                ?>
                        <div class="row border-top pt-2">
                            <div class="col-2">
                                <img src="<?php echo $cart['product_image'] ?>" class="cart-img img-fluid">
                            </div>
                            <div class="col-8">
                                <h4 class="text-capitalize"><?php echo $cart['product_name'] ?></h4>
                                <p class="text-capitalize">By <?php echo $cart['product_brand'] ?></p>
                                <div class="group-landscape">
                                    <div class="quantity d-flex flex-row">
                                        <button class="qty-down">-</button>
                                        <input type="text" class="quantity-input text-center" maxlength="2" size="6" value="0" style="border: 1px solid rgba(0, 0, 0, 0.125);" />
                                        <button class="qty-up">+</button>
                                    </div>
                                    <form method="post">
                                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                                        <input type="hidden" name="product_id" value="<?php echo $cart['product_id'] ?>">
                                        <button type="submit" name="cart-submit" class="btn text-danger border-right">Add to cart</button>
                                    </form>
                                    <form method="post">
                                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                                        <input type="hidden" name="product_id" value="<?php echo $cart['product_id'] ?>">
                                        <button type="submit" name="delete-cart-submit" class="btn text-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-2">
                                <p class="text-right text-danger"><?php echo number_format($cart['product_price']) ?> VND</p>
                            </div>
                        </div>
                <?php
                        return $cart['product_price'];
                    }, $carts); // end cart loop
                } // end whole loop 
                ?>
            </div>
        </div>
        <div class="col-3">

        </div>
</section>