<?php session_start();?>
<?php include 'products_sql.php';?>
<?php include 'templates/header.php';?>

<div style = "text-align :center"><font size = "350px">
<?php
$conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');
if (isset($_GET['submit'])){
    
    $myvar = $_SESSION['prod']; #productid
    $mystore = $_GET['storeid'];
    $_SESSION['val'] = $mystore;

    $val = $_GET['inp']; #input
    
    $up = 'UPDATE offers SET current_price = ' .$val .' WHERE (productid = '. $myvar.' AND storeid= '.$mystore.')';
    #echo $myvar,'####', $mystore, '#####',$val;
    mysqli_query($conn, $up);
    $_SESSION['timh'] = $val;
    
    $sq = 'SELECT * FROM pricehistory WHERE ( storeid= '.$mystore.' AND productid = '. $myvar.')';
    $sq1 =mysqli_query($conn, $sq);
    $dates = mysqli_fetch_all($sq1, MYSQLI_ASSOC);
}
 #$date = date("Y/m/d");
 
 $myvar = $_SESSION['prod'];
 $sqli = 'SELECT * FROM product WHERE productid = '.$myvar; 
 $Name =mysqli_query($conn, $sqli);
 $names = mysqli_fetch_array($Name, MYSQLI_ASSOC);
 echo $names['name'].'('.$names['brand'].')';
?>
 
 
</font>
</div>
<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
            <a href="hist.php" class="btn btn-secondary btn-lg active" role="button"style="background-color:#354856;">Price History</a>
            <a href="current_prices.php" class="btn btn-secondary btn-lg active" role="button"style="background-color:#354856;">Current Prices</a>
            <a href="price_changer.php" class="btn btn-secondary btn-lg active" role="button"style="background-color:#354856;">Price Changer</a>

            </div>
   
<form action = '/price_changer.php' method="GET" >
<div class="row">
    <div class="col">
        <label for="inp">Insert New Price</label>
        <input type="text" class="form-control" name = "inp" value = "<?php if (isset($_GET['inp'])) echo $_GET['inp'];?>" Placeholder = "Insert New Price">
    </div>
    <div class="form-group col-md-3">
                <label for="inputStore">Pick Store</label>
                <select id="inputStore" class="form-control" name="storeid">
                    <?php foreach ($stores as $stor) { ?>
                        <option value="<?php echo $stor['storeid'] ?>"> <?php echo $stor['street_name'] . ' ' . $stor['street_number'] . ', ' . $stor['city'] ?>
                        </option>
                    <?php } ?>
                </select>
    </div>
 </div>
 <div>
 
 <div class="col" style = "width:100px;">
 <button type="submit" name="submit" value="submit" class="btn btn-block" style="float: left; color:#e3e6e8; background-color:#354856; text-align:center;">Submit</button>
 </div>
</form>

<!-- finds max date -->
 <?php
 $conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');
 if(isset($_GET['submit']))
 {
                    
     foreach ($dates as $dat) { 
         $max = 0;
         if ($dat['date']> $max) 
        {
         $max = $dat['date'];
         $kati = $dat['issales'];
        }
 }

$hmer = date("Y-m-d");

$kiouri =  "INSERT INTO pricehistory (storeid, productid, date, issales, newprice) VALUES (". $mystore . ','. $myvar. ',"' . $hmer . '",' . $kati . ','. $val.')';
if(mysqli_query($conn, $kiouri)){
    echo "Price changed successfully";
}
else{
    echo "Something is wrong";
}
 }
?>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const rows = document.querySelectorAll("tr[data-href]");
        rows.forEach(row => {
            row.addEventListener("click", () => {
                window.location.href = row.dataset.href;
            })
        });
    });
</script>
