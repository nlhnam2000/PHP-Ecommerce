<?php include('header.php'); ?>

<main>
    <section id='signup-section' class='container-fluid'>
        <div class='row w-75'>
            <div class='col-7'>
                <img src='../img/bg.svg' class='img-fluid' alt=''>
            </div>
            <div class='col-5 login-form'>
                <form method='POST'>
                    <h2 class='text-center text-uppercase text-success'>Sign up</h2>
                    <div class='form-group'>
                        <label for='fullname'>Full name: </label>
                        <input type='text' name='fullname' placeholder='Your fullname' class='form-control'>
                    </div>
                    <div class="form-group">
                        <label for='username'>Username: </label>
                        <input type='text' name='username' placeholder='Username' class='form-control'>
                    </div>
                    <div class='form-group'>
                        <label for='phone'>Phone number: </label>
                        <input type='text' name='phone' placeholder='Your phone number' class='form-control'>
                    </div>
                    <div class='form-group'>
                        <label for='email'>Email: </label>
                        <input type='email' name='email' placeholder='Email' class='form-control'>
                    </div>
                    <div class="input-group d-flex flex-row">
                        <div class='form-group'>
                            <label for='password'>Password: </label>
                            <input id="password" type='password' name='password1' placeholder='Password' class='form-control'>
                        </div>
                        <div class='form-group'>
                            <label for='confirm-password'>Confirm password: </label>
                            <input id="confirm-password" type='password' name='password2' placeholder='Password' class='form-control'>
                        </div>

                    </div>
                    <div class='form-group'>
                        <button class='btn btn-success form-control' id="signupBtn" name='signup-submit' type='submit'>Create account</button>
                    </div>
                    <p id="signup-verification" class="text-center text-danger"></p>
                    <?php echo "<p class='text-center text-danger'>" . $message_error . "</p>" ?>
                </form>
                <hr style='color: black;'>
                <div>
                    <p class='text-center'>Already have account ? <a href='login.php'>Login</a></p>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('footer.php') ?>