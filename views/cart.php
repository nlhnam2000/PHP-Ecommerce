<?php
include('header.php');

// foreach ($Cart->getCartOfUser(10) as $item) {
//     print_r($item);
// }
$User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email'], $_SESSION['isAdmin']);
?>


<main>
    <section id="cart" class="container-fluid">
        <h2>Shopping cart</h2>
        <div class="row bg-light w-75">
            <div class="col-9 cart-list">
                <div class="cart-item">
                    <?php foreach ($User->getOwnedCart() as $item) {
                        $carts = $Product->getProduct($item['product_id']); // this is an array, have to loop through it
                        $prices[] = array_map(function ($cart) use ($item) { // this is for returning cart_price for each cart in a loop
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
                                            <button class="qty-down" data-id="<?php echo $cart['product_id'] ?>">-</button>
                                            <input type="text" disabled class="quantity-input text-center" maxlength="2" size="6" value="<?php echo $item['quantity'] ?>" style="border: 1px solid rgba(0, 0, 0, 0.125);" />
                                            <button class="qty-up" data-id="<?php echo $cart['product_id'] ?>">+</button>
                                        </div>
                                        <form method="post">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                                            <input type="hidden" name="product_id" value="<?php echo $cart['product_id'] ?>">
                                            <button type="submit" name="wishlist-submit" class="btn text-danger border-right">Save for later</button>
                                        </form>
                                        <form method="post">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                                            <input type="hidden" name="product_id" value="<?php echo $cart['product_id'] ?>">
                                            <button type="submit" name="delete-cart-submit" class="btn text-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <p class="cart-price text-right text-danger"><?php echo number_format($item['cart_price']) ?> VND</p>
                                </div>
                            </div>
                    <?php
                            return $item['cart_price'];
                        }, $carts); // end cart loop
                    } // end whole loop 
                    ?>
                </div>
            </div>
            <div class="col-3 subtotal d-flex flex-column">
                <form action="paymentConfirm.php" method="POST">
                    <div class="cart-shipping bg-light form-group">
                        <p class="heading">
                            <span><b>Delivery to</b></span>
                            <span><a href="">Modify</a></span>
                        </p>
                        <p class="title">
                            <span class="name border-right"><b><?php echo $_SESSION['fullname'] ?></b></span>
                            <span class="phone"><b><?php echo $_SESSION['phone'] ?></b></span>
                        </p>
                        <span class="address text-secondary">
                            135B Trần Hưng Đạo, Phường Cầu Ông Lãnh, Quận 1, Hồ Chí Minh
                        </span>
                    </div>
                    <div class="cart-promotion bg-light form-group">
                        <p class="heading">
                            <span style="font-size: 16px"><b>Promotion</b></span>
                        </p>
                        <span class="title">
                            <span><input width="100%" type="text" placeholder="Your voucher" class="form-control p-2"></span>
                        </span>
                    </div>
                    <div class="cart-subtotal bg-light form-group">
                        <p class="pre-money">
                            <span>Pre money</span>
                            <span id="premoney"><?php echo isset($prices) ? number_format($Cart->countSubtotal($prices)) : 0 ?> VND</span>
                        </p>
                        <p class="promotion-money border-bottom pb-4">
                            <span>By promotion</span>
                            <span>0 VND</span>
                        </p>
                        <p class="total-money">
                            <span style="font-size: 16px;">Total</span>
                            <span style="font-size: 22px;" class="text-right text-danger">
                                <b><?php echo isset($prices) ? number_format($Cart->countSubtotal($prices)) : 0 ?> VND</b> <br>
                                <i style="font-size: 13px;" class="text-secondary">(including VAT if exists)</i>
                            </span>
                            <input type="hidden" name="user-id-payment" value="<?php echo $_SESSION['user_id'] ?>">
                            <input type="hidden" name="total-money-payment" value="<?php echo isset($prices) ? $Cart->countSubtotal($prices) : 0 ?>" />
                        </p>
                    </div>
                    <input class="btn btn-danger form-control" type="submit" name="payment-submit" value="Proceed to buy">
                </form>
            </div>
        </div>
    </section>
    <?php include('template/wishlist.php') ?>
</main>

<?php include('template/new-items.php') ?>

<?php include('footer.php'); ?>