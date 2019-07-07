<?php
    include 'includes/session.php';
    if (!isset($_GET['code']) || !isset($_GET['user'])) {
        header('location: index.php');
        exit(); 
    }
    include 'includes/header.php';
?>
    <body class="hold-transition login-page">
        <div class="login-box">
            <?php
                if (isset($_SESSION['error'])) {
                    echo '
                        <div class="callout callout-success text-center">
                            <p>' . $_SESSION['error'] . '</p>
                        </div>
                    ';
                    unset($_SESSION['error']);
                }
            ?>

            <div class="login-box-body">
                <p class="login-box-msg">Enter new password</p>
                <form action="password_new.php?code=<?php echo $_GET['code'];?>&user=<?php echo $_GET['user'];?>" method="POST">
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" placeholder="New Password" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name='repassword' placeholder="Retype password" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="col-xs-4">
                         <button type="submit" class="btn btn-primary btn-block btn-flat" name="reset"><i class="fa fa-mail-forward"></i> Reset</button>
                    </div>
                </form>
                <hr>
            </div>
        </div>
        <?php include 'includes/scripts.php'; ?>
    </body>
</html>