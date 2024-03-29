<?php include 'includes/session.php';

        if (isset($_SESSION['user'])) {
            header('location: cart_view.php');
        }?>
        <?php include 'includes/header.php'; ?>
        <body class="hold-transition login-page">
            
            <div class="login-box">
                <?php
                    if (isset($_SESSION['error'])) {
                        echo '<div class="callout callout-danger text-center">';
                        echo '<p> ' . $_SESSION['error'] . '</p>';
                        echo '</div>';
                        unset($_SESSION['error']);
                    }
                    if (isset($_SESSION['success'])) {
                        echo '<div class="callout callout-success text-center">';
                        echo '<p> ' . $_SESSION['success'] . '</p>';
                        echo '</div>';
                        unset($_SESSION['success']);
                    }
                ?>
                <div class="login-box-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form action="verify.php" method="POST">
                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <button class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a href="password_forgot.php">I forgot my password</a><br>
                        <a href="signup.php">Register a new membership</a><br>
                    </div>
                    <br>
                    <a href="index.php"><i class="fa fa-home"></i> Home</a>
                </div>
            </div>


        <?php include 'includes/scripts.php';?>
    </body>
</html>

