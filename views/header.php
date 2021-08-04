<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Owl-carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <title>Document</title>

    <?php
    require('functions.php');


    ?>

</head>

<body>

    <nav class="menubar bg-dark">
        <a href="index.php" class="logo">
            <!-- <img src="../img/logo.png" alt=""> -->
            <h1 class="text-light">LOGO</h1>
        </a>
        <ul class="links list-unstyled m-0">
            <li class="nav-item">
                <a href="#" class="nav-link">Link 1</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Link 2</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Link 3</a>
            </li>
        </ul>
        <form action="search.php" class="form-inline" method="GET">
            <input type="text" class="form-control mr-2" name="search" placeholder="Search">
            <input type="submit" name="search-submit" value="Search" class="btn btn-primary" />
        </form>

        <!-- <form action="" class="form-inline cart-icon">
            <a href="#" class="rounded-pill" style="background: rgb(255, 241, 237); padding: 5px 10px">
                <span><i class="fas fa-shopping-cart text-dark"></i></span>
                <span class="rounded-pill bg-light text-dark">0</span>
            </a>
        </form> -->
        <ul class="button-group list-unstyled m-0 float-right">
            <?php
            if ($_SESSION['logged'] === true) {
                echo " <li class='dropdown'>
                <button class='btn btn-success mr-3 text-white dropdown-toggle' data-toggle='dropdown'>
                    Hi " . $_SESSION['username'] . "
                </button>
                <div class='dropdown-menu dropdown-menu-right'>
                    <a class='dropdown-item' href='logout.php'>Logout</a>
                    <a class='dropdown-item' href='purchase.php'>My order</a>
                </div>
            </li>";
            } else {
                echo "<li?>
                <a href='login.php' class='btn btn-success mr-3'>Login</a>
            </li?>
            <li>
                <a href='signup.php' class='btn btn-success'>Sign up</a>
            </li>";
            }

            ?>
        </ul>

    </nav>