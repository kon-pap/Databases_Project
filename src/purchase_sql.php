<?php
$conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');

if (!$conn) {
    echo 'Bad connection:' . mysqli_connect_error();
}

/* Show the Stores in the collapse */
$sql1 = 'SELECT * FROM store ORDER BY city ASC';
$sql = 'SELECT * FROM purchase WHERE purid <= 50';

$result1 = mysqli_query($conn, $sql1);

$stores = mysqli_fetch_all($result1, MYSQLI_ASSOC);

/* Initializations */
$stores_sel = '';
$startdate = '2018-01-01';
$enddate = '2018-05-31';

if (isset($_GET['submit'])) {
    $store_check = false;
    foreach ($stores as $stor) {
        if ($_GET['storch' . '' . $stor['storeid']]) {
            if ($store_check == false) {
                $store_check = true;
                $stores_sel = '(';
            }
            $stores_sel = $stores_sel . $stor['storeid'] . ', ';
        };
    }
    if ($store_check == true) {
        $stores_sel = substr($stores_sel, 0, -2);
        $stores_sel = $stores_sel . ')';
        $sql = 'SELECT * FROM purchase WHERE storeid IN' . ' ' . $stores_sel . '';
    }

    if($_GET['paymentradio'] === '0'){
        $sql = $sql." AND payment_method = 'cash'";
    }
    if($_GET['paymentradio'] === '1'){
        $sql = $sql." AND payment_method = 'credit card'";
    }

    $daterange =  $_GET['daterange'];
    $startdate = substr($daterange, 0, 10);
    $enddate = substr($daterange, 13, 24);

    if (isset($_GET['dateswitch']))
    {
        $sql = $sql." AND purchase.date between '".$startdate."' and '".$enddate."'";
        
    }

    $result = mysqli_query($conn, $sql);

    $purs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo $sql;
}

$result = mysqli_query($conn, $sql);

$purs = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
