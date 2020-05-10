<?php
$conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');

if (!$conn) {
    echo 'Bad connection:' . mysqli_connect_error();
}

/* Show the Stores in the collapse */
$sql1 = 'SELECT * FROM store ORDER BY city ASC';

/* Show purchases when visiting for first time or not picked restrictions */
$sql = 'SELECT * FROM purchase WHERE purid <= 50';

$result1 = mysqli_query($conn, $sql1);

$stores = mysqli_fetch_all($result1, MYSQLI_ASSOC);

/* Initializations */
$stores_sel = '';
$startdate = '2018-01-01';
$enddate = '2018-05-31';

if (isset($_GET['submit'])) {
    $first = false;

    /*Creating part of the query that chooses stores */
    foreach ($stores as $stor) {
        if ($_GET['storch' . '' . $stor['storeid']]) {
            if ($first == false) {
                $first = true;
                $stores_sel = '(';
            }
            $stores_sel = $stores_sel . $stor['storeid'] . ', ';
        };
    }
    if ($first == true) {
        $stores_sel = substr($stores_sel, 0, -2);
        $stores_sel = $stores_sel . ')';
        $sql = 'SELECT * FROM purchase WHERE ' . 'storeid IN' . ' ' . $stores_sel . '';
    }

    /*Creating part of the query that chooses payment method */
    if ($_GET['paymentradio'] === '0') {
        if ($first == false) {
            $first = true;
            $sql = 'SELECT * FROM purchase WHERE ' . "payment_method = 'cash'";
        } else {
            $sql = $sql . " AND payment_method = 'cash'";
        }
    } elseif ($_GET['paymentradio'] === '1') {
        if ($first == false) {
            $first = true;
            $sql = 'SELECT * FROM purchase WHERE ' . "payment_method = 'credit card'";
        } else {
            $sql = $sql . " AND payment_method = 'credit card'";
        }
    }

    /*Creating part of the query that chooses total amount of products */
    if ($_GET["minamount"] !== '' && $_GET["maxamount"] !== '') {
        $minamount = (float) $_GET["minamount"];
        $maxamount = (float) $_GET["maxamount"];
        if ($first == false) {
            $first = true;
            $sql = 'SELECT * FROM purchase WHERE ' . "(SELECT SUM(amount) FROM purch_prod WHERE purchase.purid = purch_prod.purid) between " . $minamount . " and " . $maxamount;
        } else {
            $sql = $sql . "AND (SELECT SUM(amount) FROM purch_prod WHERE purchase.purid = purch_prod.purid) between " . $minamount . " and " . $maxamount;
        }
    } elseif ($_GET["minamount"] !== '') {
        $minamount = (float) $_GET["minamount"];
        $maxamount = mysqli_fetch_array(mysqli_query($conn, 'SELECT MAX((SELECT SUM(amount) FROM purch_prod WHERE purchase.purid = purch_prod.purid)) as max_amount FROM purchase'));
        $maxamount = (float) $maxamount['max_amount'];
        if ($first == false) {
            $first = true;
            $sql = 'SELECT * FROM purchase WHERE ' . "(SELECT SUM(amount) FROM purch_prod WHERE purchase.purid = purch_prod.purid) between " . $minamount . " and " . $maxamount ;
        } else {
            $sql = $sql . "AND (SELECT SUM(amount) FROM purch_prod WHERE purchase.purid = purch_prod.purid) between " . $minamount . " and " . $maxamount;
        }
    } elseif ($_GET["maxamount"] !== '') {
        $maxamount = (float) $_GET["maxamount"];
        $minamount = mysqli_fetch_array(mysqli_query($conn, 'SELECT MIN((SELECT SUM(amount) FROM purch_prod WHERE purchase.purid = purch_prod.purid)) as min_amount FROM purchase'));
        $minamount = (float) $minamount['min_amount'];
        if ($first == false) {
            $first = true;
            $sql = 'SELECT * FROM purchase WHERE ' . "(SELECT SUM(amount) FROM purch_prod WHERE purchase.purid = purch_prod.purid) between " . $minamount . " and " . $maxamount;
        } else {
            $sql = $sql . "AND (SELECT SUM(amount) FROM purch_prod WHERE purchase.purid = purch_prod.purid) between " . $minamount . " and " . $maxamount;
        }
    }

    /*Creating part of the query that chooses total cost of purchse */
    if ($_GET["mincost"] !== '' && $_GET["maxcost"] !== '') {
        $mincost = (float) $_GET["mincost"];
        $maxcost = (float) $_GET["maxcost"];
        if ($first == false) {
            $first = true;
            $sql = 'SELECT * FROM purchase WHERE ' . "total between " . $mincost . " and " . $maxcost;
        } else {
            $sql = $sql . " AND total between " . $mincost . " and " . $maxcost;
        }
    } elseif ($_GET["mincost"] !== '') {
        $maxcost = mysqli_fetch_array(mysqli_query($conn, 'SELECT MAX(total) FROM purchase'));
        $maxcost = (float) $maxcost['MAX(total)'];
        $mincost = (float) $_GET["mincost"];
        if ($first == false) {
            $first = true;
            $sql = 'SELECT * FROM purchase WHERE ' . "total between " . $mincost . " and " . $maxcost;
        } else {
            $sql = $sql . " AND total between " . $mincost . " and " . $maxcost;
        }
    } elseif ($_GET["maxcost"] !== '') {
        $mincost = mysqli_fetch_array(mysqli_query($conn, 'SELECT MIN(total) FROM purchase'));
        $mincost = (float) $mincost['MIN(total)'];
        $maxcost = (float) $_GET["maxcost"];
        if ($first == false) {
            $first = true;
            $sql = 'SELECT * FROM purchase WHERE ' . "total between " . $mincost . " and " . $maxcost;
        } else {
            $sql = $sql . " AND total between " . $mincost . " and " . $maxcost;
        }
    }


    /*Creating part of the query that chooses date range */
    $daterange =  $_GET['daterange'];
    $startdate = substr($daterange, 0, 10);
    $enddate = substr($daterange, 13, 24);

    if (isset($_GET['dateswitch'])) {
        if ($first == false) {
            $first = true;
            $sql = 'SELECT * FROM purchase WHERE ' . "purchase.date between '" . $startdate . "' and '" . $enddate . "'";
        } else {
            $sql = $sql . " AND purchase.date between '" . $startdate . "' and '" . $enddate . "'";
        }
    }

    $result = mysqli_query($conn, $sql);

    $purs = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

$result = mysqli_query($conn, $sql);

$purs = mysqli_fetch_all($result, MYSQLI_ASSOC);
