<?php
session_start();
include('header.php');
$Product = new Product();
$User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email']);
$ownedCart = $User->getOwnedCart();
?>

<main>
    <section id="payment-confirm">
        <div class="delivery-info p-5">
            <h2>Please confirm and fill in your infomation: </h2>
            <form action="" method="POST" class="my-3">
                <div class="form-group">
                    <h5>Your name:</h4>
                        <input type="text" class="form-control" name="customer-fullname" value="<?php echo $_SESSION['fullname'] ?>">
                </div>
                <div class="form-group">
                    <h5>Phone number:</h5>
                    <input type="text" class="form-control" name="customer-phone" value="<?php echo $_SESSION['phone'] ?>">
                </div>
                <div class="form-group">
                    <h5>Address:</h5>
                    <input type="text" class="form-control" name="customer-address">
                </div>
                <input type="submit" class="form-control btn btn-primary" name="delivery-submit" value="Buy now">
            </form>
            <hr>
            <div class="delivery-cart-info">
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
                                    <h6>Đơn giá</h6>
                                    <p><?php echo $cart['product_price'] ?></p>
                                </div>
                                <div class="col-4 d-flex flex-column justify-content-center">
                                    <h6>Số lượng</h6>
                                    <p><?php echo $item['quantity'] ?></p>
                                </div>
                                <div class="col-4 d-flex flex-column justify-content-center">
                                    <h6>Thành tiền</h6>
                                    <p>₫<?php echo number_format($item['cart_price']);  ?></p>
                                </div>
                        <?php
                            }, $carts);
                        } ?>
                    </div>
                </div>
                <div class="total-money-delivery float-right d-flex">
                    <h4 class="mx-2">Tổng tiền: </h4>
                    <h4 class="text-danger">₫<?php echo number_format($_POST['total-money-payment']) ?></h4>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include('footer.php');
?>