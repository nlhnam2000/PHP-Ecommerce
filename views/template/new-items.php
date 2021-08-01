<?php
$User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email']); ?>

<section id="new-items">
    <h2>New items</h2>
    <hr>
    <div class="owl-carousel olw-theme" style="padding: 30px 50px 30px 50px;">
        <?php foreach ($productShuffled as $item) { ?>
            <div class="item">
                <div class="product">
                    <a href="product.php?product_id=<?php echo $item['product_id'] ?>"><img src="<?php echo $item['product_image'] ?>" alt=""></a>
                    <div class="text-left p-2 m-3">
                        <h5><?php echo $item['product_name'] ?></h5>
                        <p class="text-uppercase"><?php echo $item['product_description'] ?></p>
                        <p class="price"><?php echo $item['product_price'] ?> VND</p>
                        <form action="" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $item['product_id'] ?>">
                            <input type="hidden" name="product_price" value="<?php echo $item['product_price'] ?>">

                            <?php
                            if (in_array($item['product_id'], $User->getCartId($User->getOwnedCart()))) {
                                echo "<button disabled type='submit' name='new-items-submit' class='btn btn-primary text-center' style='justify-self: center;'>In the cart</button>";
                            } else {
                                echo "<button type='submit' name='new-items-submit' class='btn btn-primary text-center' style='justify-self: center;'>Add to cart</button>";
                            }
                            ?>
                            <!-- <button type="submit" class="btn btn-primary text-center' style='justify-self: center;" name="new-items-submit">Add to cart</button> -->
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>