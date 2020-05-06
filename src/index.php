<?php
/*$conn = mysqli_connect('192.168.99.100', 'root', 'root', 'SuperMarketDB');

    if (!$conn){
        echo 'Bad connection:' . mysqli_connect_error();
    }

    $sql = 'SELECT * FROM Product';

    $result = mysqli_query($conn, $sql);

    $prods = mysqli_fetch_all($result, MYSQLI_ASSOC);
    <?php foreach($prods as $prod){ ?>
        <h6><?php echo $prod['productID'].' '.$prod['name'].' '.$prod['brand'].' '.$prod['catID']; ?></h6>
    <?php } ?> color:#fefefe*/

?>

<?php include 'header.php'; ?>
<div class="d-flex justify-content-center py-4">

    <a class="card m-4 text-center btn" style="width: 350px; background-color:#c8cfd2; padding-top: 80px; padding-bottom: 80px;" href="purchases.php">
        <div class="card-body h4" style="color:#2b3c42">
            Purchases
        </div>
    </a>

    <a class="card m-4 text-center btn" style="width: 350px; background-color:#c8cfd2; padding-top: 80px; padding-bottom: 80px;" href="customers.php">
        <div class="card-body h4" style="color:#2b3c42">
            Customers
        </div>
    </a>

    <a class="card m-4 text-center btn" style="width: 350px; background-color:#c8cfd2; padding-top: 80px; padding-bottom: 80px;" href="preferences.php">
        <div class="card-body h4" style="color:#2b3c42">
            Preferences
        </div>
    </a>
</div>
<div class="d-flex justify-content-center pb-4 pt-2" style="background-color:#e3e6e8;">
    <a class="card m-4 text-center btn" style="width: 350px; background-color:#c8cfd2; padding-top: 80px; padding-bottom: 80px;" href="stores.php">
        <div class="card-body h4" style="color:#2b3c42">
            Stores
        </div>
    </a>

    <a class="card m-4 text-center btn" style="width: 350px; background-color:#c8cfd2; padding-top: 80px; padding-bottom: 80px;" href="products.php">
        <div class="card-body h4" style="color:#2b3c42">
            Products
        </div>
    </a>

</div>
</body>

</html>