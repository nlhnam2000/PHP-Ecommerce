  
<?php
// ob_start();
session_start();
if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header("Location: login.php");
    // exit;
}

include('header.php');
?>

<?php
include('template/banner.php');
include('template/new-items.php');
include('template/books.php');
include('template/shoes.php');
?>

<?php
include('footer.php');
?>