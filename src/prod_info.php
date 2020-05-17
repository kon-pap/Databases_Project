
<?php include 'templates/header.php'; ?>
<?php include 'products_sql.php';?>


<div style = "text-align :center"><font size = "350px">
<?php
$conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');

if (!$conn) {
    echo 'Bad connection:' . mysqli_connect_error();
}

if(isset($_GET['productid'])){
    $myvar = $_GET['productid']  ;
    $sqli = 'SELECT * FROM product WHERE productid = '.$myvar; 
    $Name =mysqli_query($conn, $sqli);
    $names = mysqli_fetch_array($Name, MYSQLI_ASSOC);

    $quer = 'SELECT * FROM pricehistory WHERE productid ='. $myvar;
    $hist1 =mysqli_query($conn, $quer);
    $history = mysqli_fetch_all($hist1, MYSQLI_ASSOC);

}
    echo $names['name'].'('.$names['brand'].')';
    
?> 
</font>
</div>

<div class="col - 9">
            <table  class="table" style = "width:1000px; margin-left:auto; margin-right:auto;">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Price</th>
                        <th scope="col">Store</th>
                        
                    </tr>
                </thead>
                <tbody>
             
                    <?php foreach ($history as $hist) { ?>
                        <tr>
                            <th scope="row"><?php echo $hist['date']?></th>
                            <td><?php echo $hist['newprice']?> € </td>
                            <?php $market =$hist['storeid'];?>
                           <td> <?php 
                            $erwt='SELECT * FROM store WHERE storeid='.$market;
                            $store = mysqli_query($conn, $erwt);
                            $mymarket = mysqli_fetch_array($store, MYSQLI_ASSOC);
                            echo $mymarket['street_name'].' '.$mymarket['street_number'].', '.$mymarket['city']?></td>

                        </tr>
                    <?php } ?>
                    
                </tbody>
                    
            </table>

        </div>


