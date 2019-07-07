<?php
    include 'includes/session.php';
    include 'includes/header.php';
?>
    <body class="hold-transition login-page">
        <div class="login-box">
            <?php
                if (isset($_SESSION['error'])) {
                    echo '
                        <div class="callout callout-danger text-center">
                            <p>' . $_SESSION['error'] . '</p>
                        </div>
                    ';
                    unset($_SESSION['error']);
                }

                if (isset($_SESSION['success'])) {
                    echo '
                        <div class="callout callout-danger text-center">
                            <p>' . $_SESSION['error'] . '</p>
                        </div>
                    ';
                    unset($_SESSION['success']);
                }
            ?>

            <div class="login-box-body">
                <p class="login-box-msg">Enter email associated with your account</p>
                <form action="reset.php" method="POST">
                    <div class="form-group has-feedback">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="col-xs-4">
                         <button type="submit" class="btn btn-primary btn-block btn-flat" name="reset"><i class="fa fa-mail-forward"></i> Send</button>
                    </div>
                </form>
                <hr>
                <div class="text-center">
                <b>Wait...</b> 
                    <a href="login.php">I rememberd my password</a><br>
                </div>
                <br>
                <a href="index.php"><i class="fa fa-home"></i> Home</a>
            </div>
        </div>
        <?php include 'includes/scripts.php'; ?>
    </body>
</html>
