<?php include 'includes/session.php';

    $output = '';
    if (!isset($_GET['code']) || !isset($_GET['user'])) {
        $output .= '
                <div class="alert alert-danger">
                    <h4><i class="icon fa fa-warning"></i> Error!</h4>
                    Code to activate account not found.
                </div>
                <h4> You may <a href="signup.php">Sign Up</a> or back to <a href="index.php">Homepage</a></h4>
        ';
    } else {
        $conn = $pdo->open();

        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE activate_code = :code AND id = :id");
        $stmt->execute(['code' => $_GET['code'], 'id' => $_GET['user']]);
        $row = $stmt->fetch();

        if($row['numrows'] > 0 ) {
            if($row['status']) {
                $output .= '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-warning"></i> Error!</h4>
                        Account already activated.
                    </div>
                    <h4> You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a></h4>
                ';
            } else {

                try {
                    $stmt = $conn->prepare("UPDATE users SET status = :status WHERE id = :id");
                    $stmt->execute(['status' => 1, 'id' => $row['id']]);
                    $output .= '
                        <div class="alert alert-success">
                            <h4><i class="icon fa fa-warning"></i> Error!</h4>
                            Account activated - Email <b> ' . $row['email'] . '</b>.
                        </div>
                        <h4> You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a></h4>
                    ';
                } catch (PDOThrowable $th) {
                    $output .= '
                        <div class="alert alert-danger">
                            <h4><i class="icon fa fa-warning"></i> Error!</h4>
                            ' . $th->getMessage() . '
                        </div>
                        <h4> You may <a href="signup.php">Sign Up</a> or back to <a href="index.php">Homepage</a></h4>
                    ';
                }
                
            }

        } else {
            $output .= '
                <div class="alert alert-danger">
                    <h4><i class="icon fa fa-warning"></i> Error!</h4>
                    Connot activate account. Wrong code!
                </div>
                <h4> You may <a href="signup.php">Sign Up</a> or back to <a href="index.php">Homepage</a></h4>
            ';
        }

        $pdo->close();
        
    }

?>
<?php include 'includes/header.php';?>
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">
            <?php include 'includes/navbar.php';?>
            <div class="wrapper-content">
                <div class="container">
                    <section class="content">
                        <div class="row">
                            <div class="col-sm-10">
                                <?php echo $output; ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
            <?php include 'includes/footer.php';?>
    </body>
</html>