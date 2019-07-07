<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand"><b> [ PROJECT 2 ] </b> eCommerce</a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#">About us</a>
                    </li>
                    <li class="nav-item">
                        <a href="#">Contact us</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <?php

                                $conn = $pdo->open();
                                try {
                                    $stmt = $conn->prepare("SELECT * FROM categories");
                                    $stmt->execute();
                                    $rows =  $stmt->fetchAll();

                                    foreach ($rows as $row) {
                                        echo '<li class="nav-item"><a href="category.php?category=' . $row['cat_slug'] . '">' . $row['name'] . '</a></li>';
                                    }
                                } catch (PDOThrowable $th) {
                                    echo 'There is some problem in connection' . $th->getMessage();
                                }

                                $pdo->close();

                            ?>
                        </ul>
                    </li>
                </ul>
                <form method="POST" class="navbar-form navbar-left" action="search.php">
                    <div class="input-group">
                        <input type="text" class="form-control" id="navbar-search-input" name="keyword" placeholder="Search for Product" required>
                        <span class="input-group-btn" id="searchBtn" style="display:none;">
                            <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i> </button>
                        </span>
                    </div>
                </form>
            </div>
            <!-- /. End navbar-collapse -->
            <!-- Navbar right Menu -->
            <div class="navbar-custom-menu">
                 <ul class="nav navbar-nav">
                    <li class="dropdown messages-menu">
                     <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="label label-success cart_count"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You Have <span class="cart_count"></span> Item(s) In Your Cart</li>
                            <li><ul class="menu" id="cart_menu"></ul></li>
                            <li class="footer"><a href="cart_view.php">Go To Cart</a></li>
                        </ul>
                    </li>
                    <?php
                    if(isset($_SESSION['user'])) {
                        $image = (!empty($user['photo'])) ? 'images/' . $user['photo'] : 'images/profile.jpg'; ?>

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo $image; ?>" alt="Your Image" class="user-image">
                                <span class="hidden-xs"><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                 <!-- User image -->
                                 <li class="user-header">
                                     <img src="<?php echo $image; ?>" alt="" class="img-circle">
                                     <p>
                                        <?php echo $user['firstname'] . ' ' . $user['lastname']; ?>
                                        <small>Member since <?php echo date('M. Y', strtotime($user['created_on'])); ?></small>
                                     </p>
                                 </li>
                                 <li class="user-footer">
                                     <div class="pull-left">
                                         <a href="profile.php" class="btn btn-default btn-flat">Proflie</a>
                                     </div>
                                     <div class="pull-right">
                                         <a href="logout.php" class="btn btn-default btn-flat">Sign Out</a>
                                     </div>
                                 </li>
                            </ul>
                        </li>
                    <?php } else {
                        echo '
                            <li><a href="login.php">LOGIN</a></li>
                            <li><a href="signup.php">SIGNUP</a></li>
                        ';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>