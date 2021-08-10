<?php
session_start();

require('../../database/DBConnection.php');
require('../../database/Product.php');
require('../../database/User.php');
require('../../database/Invoice.php');

// $User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email'], $_SESSION['isAdmin']);
$Invoice = new Invoice();
$Product = new Product();

$orderList = '';
if (isset($_POST['status']))
    $orderList = $Invoice->getInvoiceStatus($_POST['status']);
else {
    $orderList = $Invoice->getInvoiceStatus('Waiting');
}

$output = '';
foreach ($orderList as $i) {
    $output .= "
        <div class='bg-light mb-3 p-4'>
            <div class='d-flex flex-row' style='justify-content: space-between;'>
                <h6 class='text-secondary'>" . explode(" ", $i['dateOfBill'])[0] . "</h6>
                <h6 class='text-primary mt-1'>" . $i['status'] . "</h6>
            </div>
    ";
    // foreach ($Invoice->getInvoiceLine($i['invoiceID']) as $item) {
    //     $products = $Product->getProduct($item['product_id']);
    //     array_map(function ($product) use ($output, $item) {
    //         $output .= "
    //         <div class='my-3'>
    //             <div class='order-content d-flex flex-row border-top p-2'>
    //                 <div class='order-info'>
    //                     <img src=" . $product['product_image'] . " width='10%' />
    //                     <div class='ml-3 mt-3'>
    //                         <h5 class='text-left'>" . $product['product_name'] . "</h5>
    //                         <p>x" . $item['quantity'] . "</p>
    //                     </div>
    //                 </div>
    //                 <p><small>₫</small>" . number_format($item['price']) . "</p>
    //             </div>
    //         </div>
    //         ";
    //     }, $products);
    // }

    $output .= "
            <div class='customer-info d-flex flex-row flex-wrap' style='align-items: center; justify-content: space-between'>
                <h6>Customer: " . $i['fullname'] . "</h6>
                <h6>Phone: " . $i['phone'] . "</h6>
                <h6>Delivery to: " . $i['address'] . "</h6>
                <h5>Total:
                    <span class='text-danger'><small>₫</small>" . number_format($i['totalPrice']) . "</span>
                    </h6>
            </div>
            <div class='confirm-button d-flex flex-row mt-3 w-100' style='justify-content: flex-end'>
                <form action='' method='POST'>
                    <input type='hidden' name='invoice-id' value='" . $i['invoiceID'] . "'>
                    <button class='btn btn-primary mr-3' name='detail-invoice-submit'>Detail</button>
                </form>
                <form action='' method='POST'>
                    <input type='hidden' name='invoice-id' value='" . $i['invoiceID'] . "'>
                    <button class='btn btn-danger mr-3' name='cancel-invoice-submit'>Cancel</button>
                </form>
                <form action='' method='POST'>
                    <input type='hidden' name='invoice-id' value='" . $i['invoiceID'] . "'>
                    <button class='btn btn-success' name='confirm-invoice-submit'>Confirm</button>
                </form>
            </div>
        </div>
";
}

echo $output;
