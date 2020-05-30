<?php session_start();?>
<?php include 'templates/header.php';?>
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
<?php function numberOfDecimals($value)
{
    if ((int)$value == $value)
    {
        return 0;
    }
    else if (! is_numeric($value))
    {
        // throw new Exception('numberOfDecimals: ' . $value . ' is not a number!');
        return false;
    }

    return strlen($value) - strrpos($value, '.') - 1;
}?>
<?php
    $conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');
    $myvar = $_SESSION['cat'];
    #selects products from a specific category($myvar)
    $sql1i = 'SELECT * FROM product WHERE catid = '.$myvar; 
    $Name1 =mysqli_query($conn, $sql1i);
    $pro1 = mysqli_fetch_all($Name1, MYSQLI_ASSOC);
    #selects store
    $sql = 'SELECT * FROM store ';
    $result = mysqli_query($conn, $sql);
    $reg = mysqli_fetch_all($result, MYSQLI_ASSOC);
    #selects corridor
    $sql2 = 'SELECT DISTINCT corridor FROM offers ';
    $result2 = mysqli_query($conn, $sql2);
    $cors = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    #select shelves
    $sql21 = 'SELECT DISTINCT shelve FROM offers ';
    $result2 = mysqli_query($conn, $sql21);
    $shelves = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    #finds specific category 
    $sqla = 'SELECT * FROM category WHERE catid = '.$myvar; 
    $Namea1 =mysqli_query($conn, $sqla);
    $cat = mysqli_fetch_array($Namea1, MYSQLI_ASSOC);
    #select all products
    $sqla1 = 'SELECT * FROM product'; 
    $Namea11 =mysqli_query($conn, $sqla1);
    $pros = mysqli_fetch_all($Namea11, MYSQLI_ASSOC);
?>

<?php 
    $megisto = 0;
    foreach($pros as $pro)
        {
            if($pro['productid'] > $megisto)
            {
                $megisto = $pro['productid'];
            }

        }
?>
<style>
    .line {
    position:absolute;
    width:100%;
    top: 190px;
    }
    .line2 {
    position:absolute;
    width:100%;
    top: 117px;
    }
    .line3 {
    position:absolute;
    width:100%;
    top: 460px;
    }
    .msg1 
     {
     margin: 30px auto; 
     padding: 10px; 
     border-radius: 5px; 
     color: #8B0000; 
     background: #ff7d66; 
     border: 1px solid #8B0000;
     width: 50%;
     text-align: center;
     top: 100px;
    }   
    .msg 
    {
    margin: 30px auto; 
    padding: 10px; 
    border-radius: 5px; 
    color: #3c763d; 
    background: #dff0d8; 
    border: 1px solid #3c763d;
    width: 50%;
    text-align: center;
    } 
                
</style>
<form action = '/prod_mod.php' method="GET" >

    <hr class ="line2">
        <div style = "text-align :center">
            <font size = "150px">
                <?php echo 'Add new product in '.$cat['name']; ?>
            </font>
        </div>
    </hr>
        <div class="row" style ="width:1200px; margin:0;[B]padding:20px 0;[/B];padding-bottom: 8px;">
            <div class="col " style ="width:500px; margin:0;[B]padding:20px 0;[/B];">
                <label for="inpo1">Product Name</label>
                <input type="text" class="form-control" name = "inpo1" value = "<?php if (isset($_GET['inpo1'])) echo $_GET['inpo1'];?>" Placeholder = " ">
            </div>
            <div class="col " style ="width:500px; margin:0;[B]padding:20px 0;[/B];">
                <label for="inpo11">Brand</label>
                <input type="text" class="form-control" name = "inpo11" value = "<?php if (isset($_GET['inpo11'])) echo $_GET['inpo11'];?>" Placeholder = " ">
            </div>
            <div class="col " style ="width:500px; margin:0;[B]padding:20px 0;[/B];">
                <label for="pin">Price</label>
                <input type="text" class="form-control" name = "pin" value = "<?php if (isset($_GET['pin'])) echo $_GET['pin'];?>" Placeholder = " ">
            </div>
            <div class="form-group col-md-3">
                <label for="inputStore">
                    Choose Store
                </label>
                    <select id="inputStore" class="form-control" name="storeid">
                        <?php foreach ($reg as $st) { ?>
                            <option value="<?php echo $st['storeid'] ?>"> <?php echo $st['street_name'].' '.$st['street_number'].', '.$st['city'];?>
                            
                            </option>
                        <?php } ?>
                </select>
            </div>
                
        </div>
        <div class="row" style ="width:1200px; margin:0;[B]padding:20px 0;[/B];padding-bottom: 8px;">
            <div class="form-group col-md-3">
                <label for="inputStore">
                    Choose Corridor
                </label>
                    <select id="inputStore" class="form-control" name="corridor">
                        <?php foreach ($cors as $cor) { ?>
                            <option value="<?php echo $cor['corridor'] ?>"> <?php echo $cor['corridor'];?>
                            
                            </option>
                        <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputStore">
                    Choose Shelve
                </label>
                    <select id="inputStore" class="form-control" name="shelve">
                        <?php foreach ($shelves as $shel) { ?>
                            <option value="<?php echo $shel['shelve'] ?>"> <?php echo $shel['shelve'];?>
                            
                            </option>
                        <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputStore">
                    Is Sales?
                </label>
                    <select id="inputStore" class="form-control" name="val">
                    
                            <option value="1"> <?php echo 'Yes';?>
                            </option>
                            <option value="0"> <?php echo 'No';?>
                            </option>                       
                </select>
            </div>
            <div class="col " style ="width:500px; margin:0;[B]padding:20px 0;[/B];">
                <label for="inpo">Quantity</label>
                <input type="number" min ="1" class="form-control" name = "input1" value = "<?php if (isset($_GET['input1'])) echo $_GET['input1'];?>" Placeholder = " ">
            </div>   
        </div>   
        <div class="row" style = "width:150px; margin:0 ;[B]padding:200px 0;[/B];padding-bottom: 50px; padding-left:15px;">
            <button type="submit" name="submit1" value="submit1" class="btn btn-block" style="float: left; color:#e3e6e8; background-color:#354856; text-align:center;">Add Product</button>
        </div>

        <!--DELETE-->
    <hr class ="line3">
        <div style = "text-align :center">
            <font size = "150px">
                <?php echo 'Delete Product from '. $cat['name']; ?>
            </font>
        </div>
    </hr>
        <div class="form-group col-md-3">
            <label for="inputStore">
                Choose Product
            </label>
                <select id="inputStore" class="form-control" name="catid">
                        <?php foreach ($pro1 as $pro) { ?>
                            <option value="<?php echo $pro['pro'] ?>"> <?php echo $pro['name'].','.$pro['brand'];?>
                            </option>
                        <?php } ?>
                </select>
        </div>
        <div class="row" style = "width:200px; margin:0 ;[B]padding:200px 0;[/B];padding-bottom: 50px; padding-left:15px;">
            <button type="submit" name="delete" value="delete" class="btn btn-block" style="float: left; color:#e3e6e8; background-color:#354856; text-align:center;">Delete Category</button>
        </div>
</form>

    <?php 
        $conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');
        $proname =  $_GET['inpo1'];
        $brand =  $_GET['inpo11'];
        $price = $_GET['pin'];
        $store = $_GET['storeid'];
        $cor = $_GET['corridor'];
        $shel = $_GET['shelve'];
        $issales = $_GET['val'];
        $quantity = $_GET['input1'];
    ?>
    <?php 
    $flag = false;
    foreach($pro1 as $pro)
    {
        if((strcasecmp($pro['name'], $proname)===0 ) and (strcasecmp($pro['brand'], $brand === 0) ))
        {
            $flag = true;
        }
    }
        ?>
    <?php if (isset($_GET['submit1'])):?>
        <?php if($flag === true):?>
            <div class="msg1"><?php echo strtolower($proname).'/'.strtolower($brand)." Already exists. To change it's price go to price changer"?></div>
        <?php endif?>
        <?php if(is_numeric($proname) or $proname === ''):?>
            <div class="msg1">Product name can't be neither a number nor empty</div>
        <?php endif?>
        <?php if(!is_numeric($price) and $price !== ''):?>
            <div class="msg1">Do not use characters. A number with maximum two decimals is required!</div>
        <?php endif?>
        <?php if(is_numeric($price) and numberOfDecimals($price) !== 2  ):?>
            <div class="msg1">Two decimals are required!</div>
        <?php endif ?>
        <?php if($price === ''):?>
            <div class="msg1">Price field can't be empty</div>     
        <?php endif?>

        <?php if(!(is_numeric($proname)) and $proname !== '' and numberOfDecimals($price)===2 and $price !== '' and $flag === false):?>
        <?php
            $hmer = date("Y-m-d");
            $maxim = $megisto+1;
            if($brand === '')
            {
                $brand = "Super Market's";
                $islabel = 1;
            }
            else
            {
            $islabel = 0;
            }
        $proins = "INSERT INTO product (productid, name, islabel, brand,catid) VALUES (". $maxim . ',"'. $proname. '",' . $islabel . ',"' . $brand . '",'. $myvar.')';
        mysqli_query($conn, $proins);
        
        if ($issales === 1)
        {
            $issales = 1;
        }
        else {$issales = 0;}
        $ph ="INSERT INTO pricehistory (storeid, productid, date, issales, newprice) VALUES (". $store . ','. $maxim. ',"' . $hmer. '",' . $issales . ','. $price.')';
        
        mysqli_query($conn, $ph);
        $offs = "INSERT INTO offers (storeid, productid, current_price, quantity,corridor, shelve) VALUES (". $store . ','. $maxim. ',' . $price . ',' . $quantity . ',"'. $cor.'",'.$shel.')';
        mysqli_query($conn, $offs);
        ?>
        <div class="msg"><?php echo $proname.'  added';?></div> 
        <?php endif?>
     
        

    <?php endif?>
    
