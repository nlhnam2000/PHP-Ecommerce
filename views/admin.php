<?php
session_start();
if ($_SESSION['isAdmin'] != 1) {
    header("Location: index.php");
}
include('header.php');
$User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email'], $_SESSION['isAdmin']);
$orderList = $Invoice->getAllInvoices();

if (isset($_POST['cancel-invoice-submit'])) {
    $result = $User->updateInvoiceStatus($_POST['invoice-id'], 'Cancel');
    if ($result) {
        header("Location: " . $_SERVER['PHP_SELF']);
    } else {
        echo 'No';
    }
}
if (isset($_POST['confirm-invoice-submit'])) {
    $result = $User->updateInvoiceStatus($_POST['invoice-id']);
    if ($result) {
        header("Location: " . $_SERVER['PHP_SELF']);
    } else {
        echo 'No';
    }
}


?>

<main style="width: 100%;">
    <section id="admin-dashboard">
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
                                <p>User account</p>
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
                <div class="invoice-status d-flex flex-row" style="align-items: center; justify-content: space-between; margin-bottom: 15px">
                    <button class="btn btn-light active" style="width: 30%;">All</button>
                    <button class="btn btn-light" style="width: 30%;">Waiting</button>
                    <button class="btn btn-light" style="width: 30%;">Confirmed</button>
                    <button class="btn btn-light" style="width: 30%;">In delivery</button>
                    <button class="btn btn-light" style="width: 30%;">Shipped</button>
                    <button class="btn btn-light" style="width: 30%;">Canceled</button>
                </div>
                <?php foreach ($orderList as $i) { ?>
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
                                        <p><small>₫</small><?php echo number_format($item['price']) ?></p>
                                    </div>
                                </div>
                        <?php
                            }, $products);
                        } ?>
                        <div class="customer-info d-flex flex-row flex-wrap" style="align-items: center; justify-content: space-between">
                            <h6>Customer: <?php echo $i['fullname'] ?></h6>
                            <h6>Phone: <?php echo $i['phone'] ?></h6>
                            <h6>Delivery to: <?php echo $i['address'] ?></h6>
                            <h5>Total:
                                <span class="text-danger"><small>₫</small><?php echo number_format($i['totalPrice']) ?></span>
                                </h6>
                        </div>
                        <div class="confirm-button d-flex flex-row mt-3 w-100" style="justify-content: flex-end">
                            <form action="" method="POST">
                                <input type="hidden" name="invoice-id" value="<?php echo $i['invoiceID'] ?>">
                                <button class="btn btn-danger mr-3" name="cancel-invoice-submit">Cancel</button>
                            </form>
                            <form action="" method="POST">
                                <input type="hidden" name="invoice-id" value="<?php echo $i['invoiceID'] ?>">
                                <button class="btn btn-success" name="confirm-invoice-submit">Confirm</button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>