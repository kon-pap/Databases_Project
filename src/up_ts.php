<?php session_start();?>
<?php include 'templates/header.php';?>
<p><font size = "350px"><center>Change Timeslot</center></font></p>
<?php include 'op1.php';?>
<?php  
$myvar = $_SESSION['storeid']; 
echo $myvar;
?>
<form action = '/up_ts.php' method = "GET">
    <div class="col" style = "width:100px;">
 <button type="submit" name="submit" value="submit" class="btn btn-block" style="float: left; color:#e3e6e8; background-color:#354856; text-align:center;">Submit</button>
    </div>
    </form>
    
    <?php #var_dump (isset($_GET['submit42']));
     if (isset($_GET['submit'])):
    
    $conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');
    $open11 = $_GET['open11'];
    echo $open11;
    $close11 = $_GET['close11'];
    $open21 = $_GET['open21'];
    $close21 = $_GET['close21'];
    $open31 = $_GET['open31'];
    $close31 = $_GET['close31'];
    $open41 = $_GET['open41'];
    $close41 = $_GET['close41'];
    $open51 = $_GET['open51'];
    $close51 = $_GET['close51'];
    $open61 = $_GET['open61'];
    $close61 = $_GET['close61'];
        
    $op11 = 'UPDATE opening_hours SET start_time= "'.$open11. ':00"'.' AND end_time ="'.$close11.':00" WHERE storeid='.$myvar.'AND day= "Monday"';
    mysqli_query($conn, $op11);
    echo 'UPDATE opening_hours SET start_time= "'.$open11. ':00" '.'AND end_time ="'.$close11.':00" WHERE storeid='.$myvar.'AND day= "Monday"';
     
    ?>
    <?php endif ?>
 