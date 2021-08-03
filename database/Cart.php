<?php


class Cart
{
    public $db = null;

    public function __construct()
    {
        $this->db = DBConnection::getDBConnection();
    }

    public function getData()
    {
        $sql = "SELECT * FROM Cart";
        $query = $this->db->query($sql);

        $data = array();

        while ($item = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $data[] = $item;
        }

        return $data;
    }

    public function countSubtotal($priceArray)
    {
        $sum = 0;
        foreach ($priceArray as $arr) {
            $sum += $arr[0];
        }

        return $sum;
    }


    public function createInvoice($user_id, $address, $phone, $totalPrice)
    {
        // $dateOfBill = date('Y-m-d H:i:s');
        $sql = "INSERT INTO Invoice(`user_id`, `address`, `phone`, `dateOfBill`, `totalPrice`, `status`) VALUES({$user_id}, '{$address}', '{$phone}', NOW(), {$totalPrice}, N'Chờ xác nhận')";
        $query = $this->db->query($sql);

        if ($query) { // insert Invoice successfully, create InvoiceLine

            // get previous invoiceID
            $sql_tmp = "SELECT invoiceID FROM Invoice ORDER BY invoiceID DESC LIMIT 1";
            $query_tmp = $this->db->query($sql_tmp);
            $lastInvoiceID = mysqli_fetch_array($query_tmp)[0];

            $sql2 = "INSERT INTO InvoiceLine(`invoiceID`, `product_id`, `product_price`, `quantity`, `price`)
            SELECT I.invoiceID, C.product_id, C.product_price, C.quantity, C.cart_price FROM Cart C
            JOIN Invoice I ON I.invoiceID = $lastInvoiceID;";
            $sql2 .= "DELETE FROM Cart WHERE user_id = {$user_id};";
            $query2 = $this->db->multi_query($sql2);

            return $query2;
        }
    }
}
