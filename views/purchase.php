<?php 
    session_start(); 
    include ('header.php'); 

?>

<main>
    <section id="order-history">
        <div class="row">
            <div class="sidebar col-3 d-flex flex-column">
                <div class="user-profile-wrapper d-flex flex-row">
                    <div class="avatar-wrapper">
                        <i class="far fa-user fa-2x"></i>
                    </div>
                    <div class="user-profile d-flex flex-column">
                        <h5><?php echo $_SESSION['username'] ?></h5>
                        <a href="">
                            <h6 class="text-secondary"><i class="far fa-edit"></i> Edit profile</h5>
                        </a>
                    </div>
                </div>
                <ul class="list-unstyled side-menu">
                    <li><a href="">
                        <div class="menu-item">
                            <i class="far fa-user"></i>
                            <p>Account information</p>
                        </div>
                    </a></li>
                    <li><a href="">
                        <div class="menu-item">
                            <i class="fas fa-file-invoice"></i>
                            <p>Order history</p>
                        </div>
                    </a></li>
                    <li><a href="">
                        <div class="menu-item">
                            <i class="far fa-bell"></i>
                            <p>Notification</p>
                        </div>
                    </a></li>
                    <li><a href="">
                        <div class="menu-item">
                            <i class="fas fa-ad"></i>
                            <p>Voucher</p>
                        </div>
                    </a></li>
                </ul>
            </div>
            <div class="order-content col-9 bg-light">
                
            </div>
        </div>
    </section>
</main>
