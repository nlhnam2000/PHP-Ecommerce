<?php
session_start();

include('header.php');
$User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email']);
$invoice = $Invoice->getInvoice($_SESSION['user_id']);
?>

<main>
    <section id="order-history">
        <div class="row">
            <div class="sidebar col-3 d-flex flex-column">
                <div class="user-profile-wrapper d-flex flex-row">
                    <div class="avatar-wrapper">
                        <i class="far fa-user fa-2x"></i>
                    </div>
                    <div class="user-profile d-flex flex-column">
                        <h5><?php echo $_SESSION['username'] ?></h5>
                        <a href="">
                            <h6 class="text-secondary"><i class="far fa-edit"></i> Edit profile</h5>
                        </a>
                    </div>
                </div>
                <ul class="list-unstyled side-menu">
                    <li><a href="">
                            <div class="menu-item">
                                <i class="far fa-user"></i>
                                <p>Account information</p>
                            </div>
                        </a></li>
                    <li><a href="">
                            <div class="menu-item">
                                <i class="fas fa-file-invoice"></i>
                                <p>Order history</p>
                            </div>
                        </a></li>
                    <li><a href="">
                            <div class="menu-item">
                                <i class="far fa-bell"></i>
                                <p>Notification</p>
                            </div>
                        </a></li>
                    <li><a href="">
                            <div class="menu-item">
                                <i class="fas fa-ad"></i>
                                <p>Voucher</p>
                            </div>
                        </a></li>
                </ul>
            </div>
            <div class="order-content-wrapper col-9 p-3">
                <?php foreach ($invoice as $i) { ?>
                    <div class="bg-light mb-3 p-4">
                        <div class="d-flex flex-row" style="justify-content: space-between;">
                            <h6 class="text-secondary"><?php echo explode(" ", $i['dateOfBill'])[0] ?></h6>
                            <h6 class="text-primary mt-1"><?php echo $i['status'] ?></h6>
                        </div>
                        <?php foreach ($Invoice->getInvoiceLine($i['invoiceID']) as $item) {
                            $products = $Product->getProduct($item['product_id']);
                            array_map(function ($product) use ($item) {
                        ?>
                                <div class="my-3">

                                    <div class="order-content d-flex flex-row border-top p-2">
                                        <div class="order-info">
                                            <img src="<?php echo $product['product_image'] ?>" width="10%">
                                            <div class="ml-3 mt-3">
                                                <h5 class="text-left"><?php echo $product['product_name'] ?></h5>
                                                <p>x<?php echo $item['quantity'] ?></p>
                                            </div>
                                        </div>
                                        <p><small>₫</small><?php echo $item['price'] ?></p>
                                    </div>
                                </div>
                        <?php
                            }, $products);
                        } ?>
                        <h4 class="text-right">Total:
                            <span class="text-danger"><small>₫</small><?php echo $i['totalPrice'] ?></span>
                        </h4>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>