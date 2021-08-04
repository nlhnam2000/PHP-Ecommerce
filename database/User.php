<?php

class User
{
    public $db = null;
    public $user_id;
    public $username;
    public $fullname;
    public $phone;
    public $email;

    private function __construct()
    {
        $this->db = DBConnection::getDBConnection();
    }

    // constructor 1 just for login and signup (Factory design pattern)
    public static function UserInitialized()
    {
        return new User();
    }

    // complete User object when logged in (Factory design pattern)
    public static function UserLogged($user_id, $username, $fullname, $phone, $email)
    {
        $userObj = new User();
        // self::$user_id = $user_id;
        // self::$username = $username;
        // self::$fullname = $fullname;
        // self::$phone = $phone;
        // self::$email = $email;

        $userObj->user_id = $user_id;
        $userObj->username = $username;
        $userObj->fullname = $fullname;
        $userObj->phone = $phone;
        $userObj->email = $email;

        return $userObj;
    }

    public function login($username, $password)
    {
        $sql = "SELECT * From User_DB WHERE username = '{$username}'";
        $query = $this->db->query($sql);

        if ($query) {
            $data = array();
            while ($item = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $data[] = $item;
            }

            $hashed_password = $data[0]['user_password'];
            if (password_verify($password, $hashed_password)) {

                $this->username = $data[0]['username'];
                $this->user_id = $data[0]['user_id'];
                $this->fullname = $data[0]['fullname'];
                $this->phone = $data[0]['phone'];
                $this->email = $data[0]['email'];
                return true;
            }
            // return $resultArray;
        }
        return false;
    }
    public function signup($fullname, $username, $phone, $email, $hashed_password)
    {
        $sql = "INSERT INTO User_DB (fullname, username, phone, user_password, email) VALUES ('$fullname', '$username', '$phone', '$hashed_password', '$email')";
        $query = $this->db->query($sql);

        if ($query) {
            $msg = "Sign up successfully ! Please log in your account";
            echo "<script type='text/javascript'>
                    alert('$msg'); 
                    window.location.href='login.php'; 
                </script>";
            // header("Location: login.php");

            return true;
        }
        return false;
    }

    public function insertToCart($data = null, $table = 'Cart')
    {
        if ($this->db != null) {
            if ($data != null) {
                $columns = implode(",", array_keys($data)); // get the columns to query with comma
                $values = implode(",", array_values($data)); // get the values to query with comma

                // make a query string
                $sql = sprintf("INSERT INTO %s(%s) VALUES (%s)", $table, $columns, $values);

                // execute query
                $result = $this->db->query($sql);
                return $result; // to sign that insert query is success
            }
        }
    }

    public function addToCart($productId, $productPrice)
    {
        if (isset($productId)) {
            $data = array(
                "user_id" => $this->user_id,
                "product_id" => $productId,
                "product_price" => $productPrice,
                "quantity" => 1,
                "cart_price" => $productPrice
            );
            $result = $this->insertToCart($data);
            if ($result) { // if the query is success
                // reload the page
                header("Location: " . $_SERVER['PHP_SELF']);
            }
        }
    }

    public function deleteCart($productId, $table = 'Cart')
    {
        if (isset($productId)) {
            $result = $this->db->query("DELETE From {$table} WHERE `user_id` = {$this->user_id} AND `product_id` = {$productId}");
            if ($result) {
                header("Location: " . $_SERVER['PHP_SELF']);
            }
        }
    }

    public function saveForLater($productId, $fromTable = 'Cart', $toTable = 'Wishlist')
    {
        $sql = "INSERT INTO {$toTable} SELECT * FROM {$fromTable} WHERE `product_id` = {$productId};";
        $sql .= "DELETE FROM {$fromTable} WHERE `product_id` = {$productId};";

        $result = $this->db->multi_query($sql);

        if ($result) {
            header("Location: " . $_SERVER['PHP_SELF']);
        }
        echo 'cannot save for later';
    }

    public function getOwnedCart($table = 'Cart')
    {
        $sql = "SELECT * FROM {$table} WHERE user_id = {$this->user_id}";
        $query = $this->db->query($sql);

        $data = array();

        while ($item = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $data[] = $item;
        }

        return $data;
    }

    public function getCartId($carts, $key = 'product_id')
    {
        $result = array_map(function ($value) use ($key) {
            return $value[$key];
        }, $carts); // loop through $carts then push the product_id to $result

        return $result; // return array which stores product_id from Cart table
    }

    public function updateCart($productId, $quantity)
    {
        if (isset($productId)) {
            $product = new Product();
            $cartPrice = $product->getPrice($productId) * $quantity;
            return $this->db->query("UPDATE Cart SET quantity = {$quantity}, cart_price = {$cartPrice} WHERE product_id = {$productId} AND user_id = {$this->user_id}");
        }
    }
}
