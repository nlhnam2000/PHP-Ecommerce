<?php
session_start();
include('header.php');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['search-submit'])) {
        $Product = new Product();
        $searchResult = $Product->searchProduct($_GET['search']);
    } else if (!isset($_GET['search-submit'])) {
        echo "no";
    }
}
?>

<main>
    <section id="search-result" class="d-flex flex-column flex-wrap">
        <?php foreach ($searchResult as $item) { ?>
            <div class="card d-flex flex-row">
                <a href="product.php?product_id=<?php echo $item['product_id'] ?>">
                    <img src="<?php echo $item['product_image'] ?>" alt="">
                </a>
                <div class="card-body">
                    <a href="product.php?product_id=<?php echo $item['product_id'] ?>">
                        <h4 class="card-title"><?php echo $item['product_name'] ?></h4>
                    </a>
                    <p><?php echo $item['product_description'] ?></p>
                    <p><?php echo number_format($item['product_price']) ?></p>
                </div>
            </div>
        <?php } ?>

    </section>
</main>

<?php
include('footer.php');
?>