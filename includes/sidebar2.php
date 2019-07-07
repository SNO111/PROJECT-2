<div class="row">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Top Category</b></h3>
        </div>
        <div class="box-body">
            <!-- Category -->
            <ul class="list-unstyled">
                 <?php

                    $conn = $pdo->open();
                    try {
                        $stmt = $conn->prepare("SELECT * FROM categories LIMIT 10");
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
        </div>
    </div>
</div>

<!-- Sidebar -->
 <?php include 'includes/sidebar.php'?>

 <div class="row">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Ads</b></h3>
        </div>
        <div class="box-body">
            <!-- Ads -->
            <div id="ads">
                <a href="images/ads.jpg" target="_blank">
                    <img class="img-responsive thumbnail" src="images/ads.jpg" alt="">
                </a>
            </div>
        </div>
    </div>
</div>