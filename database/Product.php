<?php

class Product
{
    public $db = null;
    public function __construct()
    {
        $this->db = DBConnection::getDBConnection();
    }

    public function getData()
    {
        $sql = "SELECT * FROM Product";
        $query = $this->db->query($sql);

        $data = array();

        while ($item = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $data[] = $item;
        }

        return $data;
    }

    public function getRandomProduct($number = 8)
    {
        $sql = "SELECT * FROM Product ORDER BY RAND() LIMIT {$number}";
        $query = $this->db->query($sql);

        $data = array();

        while ($item = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $data[] = $item;
        }

        return $data;
    }

    // get products by brand
    public function getProductByBrand($product_brand)
    {
        $sql = "SELECT * FROM Product WHERE product_brand = {$product_brand}";
        $result = $this->db->query($sql);

        $resultArray = array();

        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    public function getProduct($product_id)
    {
        if (isset($product_id)) {
            $sql = "SELECT * From Product WHERE product_id = {$product_id}";
            $result = $this->db->query($sql);

            $resultArray = array();

            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }

    public function getTotalProduct($brand)
    {
        $sql = "SELECT COUNT(*) FROM Product WHERE product_brand = $brand";
        $result = $this->db->query($sql);
        $rows = mysqli_fetch_array($result)[0];

        return $rows;
    }

    public function getTotalPage($brand, $record = 4)
    {
        $rows = $this->getTotalProduct($brand);
        $total_page = ceil($rows / $record);

        return $total_page;
    }

    public function pagination($brand, $page, $record = 4)
    {
        $offset = ($page - 1) * $record;

        $sql = "SELECT * FROM Product WHERE product_brand = $brand LIMIT $record OFFSET $offset";
        $result = $this->db->query($sql);

        $resultArray = array();
        while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $data;
        }

        return $resultArray;
    }

    public function getPrice($product_id)
    {
        $result = $this->db->query("SELECT product_price FROM Product WHERE product_id = {$product_id}");

        return mysqli_fetch_array($result)[0];
    }

    public function getImage($product_id)
    {
        $result = $this->db->query("SELECT product_image FROM Product WHERE product_id = {$product_id}");

        return mysqli_fetch_array($result)[0];
    }

    public function searchProduct($key)
    {
        $sql = "SELECT * from Product WHERE LOWER(product_name) LIKE LOWER('%{$key}%')";
        $query = $this->db->query($sql);

        $resultArray = array();
        while ($data = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $resultArray[] = $data;
        }

        return $resultArray;
    }
}
