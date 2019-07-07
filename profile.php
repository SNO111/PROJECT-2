<?php 
    include 'includes/session.php';

    if (!isset($_SESSION['user'])) {
       header('location index.php');
    }

    include 'includes/header.php';
?>
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">
            <?php include 'includes/navbar.php'; ?>

            <div class="content-wrapper">
                
                <div class="container">

                <!-- Main Content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-9">
                        <?php
                            if (isset($_SESSION['error'])) {
                            echo '
                                    <div class="callout callout-danger">
                                        ' .  $_SESSION['error'] . '
                                    </div>
                            ';
                            unset($_SESSION['error']);
                            }
                            if (isset($_SESSION['success'])) {
                                echo '
                                    <div class="callout callout-success">
                                        ' .  $_SESSION['success'] . '
                                    </div>
                                ';
                                unset($_SESSION['success']);
                            }
                        ?>
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="col-sm-3">
                                        <img class="img-responsive" src="<?php echo (!empty($user['photo'])) ? 'images/' . $user['photo'] : 'images/profile.jpg';?>" width="Your profile image">
                                    </div>
                                    <div class="col-sm-9">
                                        <ul class="list-unstyled">
                                            <li>
                                                <span class="pull-right">
                                                    <a href="#edit" class="btn btn-success btn-flat btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
                                                </span>
                                                <h4><span>Name:</span>  <?php echo $user['firstname'] . ' ' . $user['lastname'];?></h4>
                                            </li>
                                            <li>
                                                <h4><span>Email:</span>  <?php echo $user['email'];?></h4>
                                            </li>
                                            <li>
                                                <h4><span>Contact Info:</span>  <?php echo $user['contact_info'];?></h4>
                                            </li>
                                            <li>
                                                <h4><span>Address:</span>   <?php echo $user['address'];?></h4>
                                            </li>
                                            <li>
                                                <h4><span>Member Since:</span>  <?php echo date('M d, Y', strtotime($user['created_on']));?></h4>
                                            </li>
                                        </ul>
                                    </div>                         
                                </div>                        
                            </div>


                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h4 class="box-title"><i class="fa fa-calendar"></i> <b>Transaction History</b></h4>
                                </div>
                                <div class="box-body">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <th class="hidden"></th>
                                        <th>Date</th>
                                        <th>Transaction#</th>
                                        <th>Amount</th>
                                        <th>Full Details</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $conn = $pdo->open();

                                                try {
                                                    $stmt = $conn->prepare("SELECT * FROM sales WHERE user_id = :userid ORDER BY sales_date DESC");
                                                    $stmt->execute(['userid' => $user['id']]);
                                                    foreach ($stmt as $row) {
                                                        $stmt2 = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id = details.product_id WHERE sales_id = :id");
                                                        $stmt2->execute(['id' => $row['id']]);
                                                        $total = 0;
                                                        foreach ($stmt2 as $row2) {
                                                            $subtotal = $row2['price']*$row2['quantity'];
                                                            $total += $subtotal;
                                                        }
                                                        echo '
                                                            <tr>
                                                                <td class="hidden"></td>
                                                                <td>' . date('M d, Y', strtotime($row['sales_date'])) . '</td>
                                                                <td>' . $row['pay_id'] . '</td>
                                                                <td>' . number_format($total, 2) . '</td>
                                                                <td><button class="btn btn-flat btn-info btn-sm transact" data-id="' . $row['id'] . '"><i class="fa fa-search"> View</i></button>
                                                            </tr>
                                                        ';
                                                    }
                                                } catch (PDOException $th) {
                                                    echo 'There is some problem in connetion ' . $th->getMessage();
                                                }

                                            $pdo->close();
                                        ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- Side Bar -->
                            <?php include 'includes/sidebar.php'; ?>
                        </div>
                    </section>
                </div>
            </div>
            <?php include 'includes/footer.php'; ?>
             <?php include 'includes/profile_modal.php'; ?>
        </div>
    
        <script>
        $(function() {
            // -- Profile Modal  -- >
            $(document).on('click', '.transact', function(e) {
                e.preventDefault();
                $('#transaction').modal('show');
                var id = $(this).data('id');

                $.ajax({
                    type: 'POST',
                    url: 'transaction.php',
                    data: {id:id},
                    dataType: 'json',
                    success: function(response) {
                        $('#date').html(response.date);
                        $('#transid').html(response.transaction);
                        $('#detail').html(response.list);
                        $('#total').html(response.total);
                    }
                });
            });

            $('#transaction').on('hidden.bs.modal', function () {
                $('.prepend_items').remove();
            });
 
        });
        </script>
        
    </div>
    </body>
</html>
       

