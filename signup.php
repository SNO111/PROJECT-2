<?php include 'includes/session.php';
if (isset($_SESSION['user'])) {
   header('location: cart_view.php');
}
if (isset($_SESSION['captcha'])) {
    $now = time();
    if ($now >= $_SESSION['captcha']) {
        unset($_SESSION['captcha']);
    }
}
?>
<?php include 'includes/header.php'; ?>
    <body class="hold-transition register-page">
            <div class="register-box">
                <?php
                if (isset(($_SESSION['error']))) {
                    echo '<div class="callout callout-danger text-center">
                        <p>' . $_SESSION['error'] . '</p>
                    </div>';
                    unset($_SESSION['error']);
                }
                if (isset(($_SESSION['success']))) {
                    echo '<div class="callout callout-success text-center">
                        <p>' . $_SESSION['success'] . '</p>
                    </div>';
                    unset($_SESSION['success']);
                }
                ?>
                <div class="register-box-body">
                    <p class="register-box-msg">Register a new membership</p>

                    <form action="register.php" method=POST>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name='firstname' placeholder="First Name" value="<?php (isset($_SESSION['firstname'])) ? $_SESSION['firstname'] : '';?>" required>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name='lastname' placeholder="Last Name" value="<?php (isset($_SESSION['lastname'])) ? $_SESSION['lastname'] : '';?>" required>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" name='email' placeholder="Email" value="<?php (isset($_SESSION['email'])) ? $_SESSION['email'] : '';?>" required>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" name='password' placeholder="Password" required>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" name='repassword' placeholder="Retype password" required>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <?php
                        if (isset($_SESSION['captcha'])) { ?>
                            <di class="form-group" style="width: 100%;">
                                <div class="g-rechaptcha" data-sitekey="6LevO1IUAAAAAFX5PpmtEoCxwae-I8cCQrbhTfM6"></div>
                            </di>
                        <?php } ?>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-block btn-flat" name="signup"><i class="fa fa-pencil"></i> Sign Up</button>
                    </form>
                    <br>
                    <div class="text-center">
                        <a href="login.php">I already have a membership</a>
                    </div><br>
                    <a href="index.php"><i class="fa fa-home"></i> Home</a>
                </div>
            </div>

        <?php include 'includes/scripts.php'; ?>
    </body>
</html>