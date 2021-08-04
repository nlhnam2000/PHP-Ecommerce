<?php

class Invoice
{
    public $db;

    public function __construct()
    {
        $this->db = DBConnection::getDBConnection();
    }

    public function getInvoice($userId)
    {
        $sql = "SELECT * FROM Invoice WHERE user_id = {$userId}";
        $query = $this->db->query($sql);

        $response = array();
        while ($data = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $response[] = $data;
        }

        return $response;
    }

    public function getInvoiceLine($invoiceID)
    {
        $sql = "SELECT * FROM InvoiceLine WHERE InvoiceID = {$invoiceID}";
        $query = $this->db->query($sql);

        $response = array();
        while ($data = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $response[] = $data;
        }

        return $response;
    }
}
