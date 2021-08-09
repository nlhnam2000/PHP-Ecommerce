<footer id="footer" class="bg-dark text-white py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <h4>Shopping web</h4>
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laborum ipsa,
                    quos ea distinctio magnam error, recusandae officiis dicta nobis corrupti nam nemo! Consequatur debitis dolore illum quis ipsum quaerat ullam.
                </p>
            </div>
            <div class="col-4">
                <h4>Feedback</h4>
                <form action="" class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Email">
                    </div>
                    <div class="col">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
            <div class="col-3">
                <div class="d-flex flex-column flex-wrap">
                    <a href="" class="text-white">About Us</a>
                    <a href="" class="text-white">Privacy Policy</a>
                    <a href="" class="text-white">Delivery Information</a>
                    <a href="" class="text-white">Terms & Conditions</a>
                </div>
            </div>
            <div class="col-2">
                <div class="d-flex flex-column flex-wrap">
                    <a href="" class="text-white">My Account</a>
                    <a href="" class="text-white">Order History</a>
                    <a href="" class="text-white">Wish List</a>
                    <a href="" class="text-white">Newslatter</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="row bg-dark">
    <div class="col-12 text-center text-white">
        <p>&copy; Copyright 2021. Design By <a href="">Nguyen Le Hoang Nam</a> </p>
    </div>
</div>

<!-- <form action="" class="cart-icon">
    <a href="" class="rounded-pill">
        <span><i class="fas fa-shopping-cart text-white"></i></span>
        <span class="rounded-pill bg-light">0</span>
    </a>
</form> -->
<?php
$User = User::UserLogged($_SESSION['user_id'], $_SESSION['username'], $_SESSION['fullname'], $_SESSION['phone'], $_SESSION['email'], $_SESSION['isAdmin']);
?>
<form action="" class="form-inline cart-icon">
    <a href="cart.php" class="rounded-pill" style="background: rgb(255, 241, 237); padding: 5px 10px">
        <span><i class="fas fa-shopping-cart text-dark"></i></span>
        <span class="rounded-pill bg-light text-dark"><?php echo count($User->getOwnedCart()) ?></span>
    </a>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!-- Owl Carousel Js file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>

<!--  isotope plugin cdn  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" integrity="sha256-CBrpuqrMhXwcLLUd5tvQ4euBHCdh7wGlDfNz8vbu/iI=" crossorigin="anonymous"></script>

<!-- Custom Javascript -->
<script type="text/javascript" src="../script.js?$$REVISION$$"></script>
</body>

</html>