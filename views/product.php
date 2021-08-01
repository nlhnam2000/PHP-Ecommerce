<?php
include('header.php');
if (isset($_GET['product_id'])) {
    $book_id = $_GET['product_id'];
} else {
    $book_id = 1;
}
$detailedProduct = $Product->getProduct($book_id);
?>

<main>
    <section id="product m-4">
        <div class="row p-3 m-auto">
            <?php foreach ($detailedProduct as $item) { ?>
                <div class="col-6">
                    <img src="<?php echo $item['product_image'] ?>" class="img-fluid" id="product-img" alt="">
                </div>
                <div class="col-6 p-5">
                    <div class="product-info d-flex flex-column">
                        <h2 class="text-capitalize"><?php echo $item['product_name'] ?></h2>
                        <h5>By <?php echo $item['product_brand'] ?></h5>
                        <p><?php echo $item['product_description'] ?></p>
                        <p><?php echo $item['product_price'] ?> VND</p>
                        <p>Choose quantity:</p>
                        <div class="quantity d-flex flex-row">
                            <button class="qty-down">-</button>
                            <input type="text" class="quantity-input text-center" maxlength="2" size="6" value="0" style="border: 1px solid rgba(0, 0, 0, 0.125);" />
                            <button class="qty-up">+</button>
                        </div>
                        <span class="btn btn-primary my-3">Add to cart</span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</main>

<?php
include('footer.php');
?>