<?php
session_start();
include('header.php');
$Product = new Product();
$User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email'], $_SESSION['isAdmin']);
$ownedCart = $User->getOwnedCart();
?>

<main>
    <section id="payment-confirm">
        <div class="delivery-info p-5">
            <h2>Please confirm and fill in your infomation: </h2>
            <form action="" method="POST" class="my-3">
                <div class="form-group">
                    <h5>Your name:</h4>
                        <input type="text" class="form-control" name="customer-fullname-invoice" value="<?php echo $_SESSION['fullname'] ?>" required>
                </div>
                <div class="form-group">
                    <h5>Phone number:</h5>
                    <input type="text" class="form-control" name="customer-phone-invoice" value="<?php echo $_SESSION['phone'] ?>" required>
                </div>
                <div class="form-group">
                    <h5>Address:</h5>
                    <input type="text" class="form-control" name="customer-address-invoice" required>
                </div>

                <div class="delivery-cart-info" style="margin-bottom: 20px;">
                    <div class="row my-2">
                        <div class="col-9">
                            <h3>Your cart</h3>
                            <?php foreach ($ownedCart as $item) {
                                $carts = $Product->getProduct($item['product_id']);
                                array_map(function ($cart) {
                            ?>
                                    <div class="d-flex flex-row" style="align-items: center; justify-content:flex-start; margin-bottom: 20px">
                                        <img src="<?php echo $cart['product_image'] ?>" alt="">
                                        <p style="align-self: center; font-size:large; margin-left:20px; margin-top: 20px"><?php echo $cart['product_name'] ?></p>
                                    </div>
                            <?php
                                }, $carts);
                            } ?>
                        </div>
                        <div class="col-3 row">
                            <?php foreach ($ownedCart as $item) {
                                $carts = $Product->getProduct($item['product_id']);
                                array_map(function ($cart) use ($item) {
                            ?>
                                    <div class="col-4 d-flex flex-column justify-content-center">
                                        <h6>Unit price</h6>
                                        <p><?php echo $cart['product_price'] ?></p>
                                    </div>
                                    <div class="col-4 d-flex flex-column justify-content-center">
                                        <h6>Quantity</h6>
                                        <p><?php echo $item['quantity'] ?></p>
                                    </div>
                                    <div class="col-4 d-flex flex-column justify-content-center">
                                        <h6>Subtotal</h6>
                                        <p><small>₫</small><?php echo number_format($item['cart_price']);  ?></p>
                                    </div>
                            <?php
                                }, $carts);
                            } ?>
                        </div>
                    </div>
                    <div class="total-money-delivery d-flex" style="justify-content:flex-end;">
                        <h4 class="mx-2">Total: </h4>
                        <h4 class="text-danger"><small>₫</small><?php echo number_format($_POST['total-money-payment']) ?></h4>
                    </div>
                </div>
                <hr>
                <input type="hidden" name="customer-id-invoice" value="<?php echo $_SESSION['user_id'] ?>">
                <input type="hidden" name="total-price-invoice" value="<?php echo $_POST['total-money-payment'] ?>">
                <input type="submit" class="btn btn-danger form-control" name="payemnt-confirm-submit" value="Confirm and buy">
            </form>

        </div>
    </section>
</main>

<?php
include('footer.php');
?>