<?php include 'includes/session.php'; 

    $conn = $pdo->open();

    $slug = $_GET['product'];
    
        try {
            $stmt = $conn->prepare("SELECT *, products.name AS prodname, categories.name AS catname, products.id AS prodid 
                                    FROM products LEFT JOIN categories
                                    ON categories.id = products.category_id 
                                    WHERE slug = :slug");
            $stmt->execute(['slug' => $slug]);
            $product = $stmt->fetch();

        } catch (PDOException $th) {
            echo 'There is some problem in connection: ' . $th->getMessage();
        }

        // Page view

        $now = date('Y-m-d');
        if ($product['date_view'] == $now) {
            $stmt = $conn->prepare("UPDATE products SET counter = counter+1 WHERE id = :id");
            $stmt->execute(['id' => $product['prodid']]);

        } else {
            $stmt = $conn->prepare("UPDATE products SET counter = 1, date_view = :now WHERE id = :id");
            $stmt->execute(['id' => $product['prodid'], 'now' => $now]);
        }

?>
<?php include 'includes/header.php'; ?>
    <body class="hold-transition skin-blue layout-top-nav">
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
                fjs.parentMode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <div class="wrapper">
            <?php include 'includes/navbar.php'; ?>

            <div class="content-wrapper">
                <div class="container">

                    <!-- Main Content -->
                    <section class="content">
                        <div class="row">

                             <!-- Sidebar -->
                            <div class="col-sm-3">
                                <?php include 'includes/sidebar.php'; ?>
                            </div>

                            <div class="col-sm-9">
                                <div class="callout" id="callout" style="display:none;">
                                    <button class="close"><span aria-hidden="true">&times;</span></button>
                                    <span class="message"></span>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <img class="zoom img-responsive" src="<?php echo (!empty($product['photo'])) ? 'images/' . $product['photo'] : 'images/noimage.jpg';?>" data-magnify-src="images/large=<?php echo $product['photo'];?>">
                                        <br><br>

                                        <form class="form-inline" id="productForm">
                                            <div class="form-group">
                                                <div class="input-group col-sm-5">
                                                    <span class="input-group-btn">
                                                        <button id="minus" class="btn btn-default btn-flat"><i class="fa fa-minus"></i></button>
                                                    </span>
                                                    <input type="text" name="quantity" id="quantity" class="form-control text-center" value="1">

                                                    <span class="input-group-btn">
                                                        <button id="add" class="btn btn-default btn-flat"><i class="fa fa-plus"></i></button>
                                                    </span>
                                                    <input type="hidden" name="id" value="<?php echo $product['prodid'];?>">
                                                </div>

                                                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="col-sm-6">
                                        <h1 class="page-header"><?php echo $product['prodname'] ?></h1>
                                        <h3><b>&#36;<?php echo number_format($product['price'], 2);?></b></h3>
                                        <p><b>Category:</b> <a href="category.php?category=<?php echo $product['cat_slug']; ?>"><?php echo $product['catname']; ?></a></p>
                                        <p><b>Description:</b></p>
                                        <p><?php echo $product['description'];?></p>
                                    </div>
                                </div>
                                <br>
                                <div class="fb-comments" data-href="?prodcut=<?php echo $slug; ?>" data-numposts="10" width="100%"></div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <?php $pdo->close(); ?>
            <?php include 'includes/footer.php'; ?>
            <script>
                $('#add').click(function(e) {
                    e.preventDefault();
                    var quantity = $('#quantity').val();
                    quantity++;
                    $('#quantity').val(quantity);
                });
                $('#minus').click(function(e) {
                    e.preventDefault();
                    var quantity = $('#quantity').val();
                    if (quantity > 1) {
                        quantity--;
                    }
                    $('#quantity').val(quantity);
                });

            </script>
        </div>
    </body>
</html>