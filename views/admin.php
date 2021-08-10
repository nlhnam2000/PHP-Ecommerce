<?php
session_start();
if ($_SESSION['isAdmin'] != 1) {
    header("Location: index.php");
}
include('header.php');
$User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email'], $_SESSION['isAdmin']);
// $orderList = $Invoice->getInvoiceStatus();

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
if (isset($_POST['detail-invoice-submit'])) {
    print_r($Invoice->getInvoiceLine($_POST['invoice-id']));
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
                    <button class="btn btn-light form-control" style="font-size: large;">All</button>
                    <button class="btn btn-light form-control" style="font-size: large;">Waiting</button>
                    <button class="btn btn-light form-control" style="font-size: large;">Confirmed</button>
                    <button class="btn btn-light form-control" style="font-size: large;">In delivery</button>
                    <button class="btn btn-light form-control" style="font-size: large;">Shipped</button>
                    <button class="btn btn-light form-control" style="font-size: large;">Canceled</button>

                </div>
                <div id="invoice-status-content">

                </div>
            </div>
        </div>
    </section>
</main>

<?php include('footer.php');  ?>