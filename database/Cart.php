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
}
