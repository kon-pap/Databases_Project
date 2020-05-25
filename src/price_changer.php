
<?php session_start();?>
<?php include 'products_sql.php';?>

<div style = "text-align :center"><font size = "350px">
<?php
$conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');
if (isset($_GET['submit'])){
    
    $myvar = $_SESSION['prod']; #productid
    $mystore = $_GET['storeid'];
    $val = $_GET['inp']; #input
    
    $quer = 'SELECT * FROM pricehistory  WHERE (productid = '. $myvar.' AND storeid= '.$mystore.' AND newprice= '.$myvar.')';
    $hist1 =mysqli_query($conn, $quer);
    $history = mysqli_fetch_all($hist1, MYSQLI_ASSOC);
    $up = 'UPDATE offers SET current_price = ' .$val .' WHERE (productid = '. $myvar.' AND storeid= '.$mystore.')';
    #echo $myvar,'####', $mystore, '#####',$val;
    mysqli_query($conn, $up);
    
    header("Location: prod_info.php");
    
}
 #$date = date("Y/m/d");
 

?>
 
 
</font>
</div>

   
<form action = '' method="GET" >
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
