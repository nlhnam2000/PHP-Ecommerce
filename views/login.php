<?php
session_start();
if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
    header("Location: index.php");
    // exit;
}

include('header.php');
?>

<main>
    <section id='login-section' class='container-fluid'>
        <div class='row w-75'>
            <div class='col-7'>
                <img src='../img/bg.svg' class='img-fluid' alt=''>
            </div>
            <div class='col-5 login-form p-5 d-flex flex-column'>
                <form method='POST'>
                    <h2 class='text-center text-uppercase text-success'>Login</h2>
                    <div class='form-group'>
                        <label for='username'>Username: </label>
                        <input type='text' name='username' placeholder='Username' class='form-control'>
                    </div>
                    <div class='form-group'>
                        <label for='password'>Password: </label>
                        <input type='password' name='password' placeholder='Password' class='form-control'>
                    </div>
                    <div class='form-group'>
                        <button class='btn btn-success form-control' name='login-submit' type='submit'>Login</button>
                    </div>
                    <?php echo "<p class='text-center text-danger'>" . $message_error . "</p>" ?>
                </form>
                <hr style='color: black;'>
                <div>
                    <p class='text-center'>Don't have account yet ? <a href='signup.php'>Create account</a></p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php';  ?>