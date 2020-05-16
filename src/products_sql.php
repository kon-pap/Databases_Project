<?php
$conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');

if (!$conn) {
    echo 'Bad connection:' . mysqli_connect_error();
}

$categ = 'SELECT * FROM category';
$fp = 'SELECT * FROM product WHERE catid = 1';
$rp = 'SELECT * FROM product WHERE catid = 2';
$cell = 'SELECT * FROM product WHERE catid = 3';
$toil = 'SELECT * FROM product WHERE catid = 4';
$home = 'SELECT * FROM product WHERE catid = 5';
$pet = 'SELECT * FROM product WHERE catid = 6';

$cat1 =  mysqli_query($conn, $categ);
$result1 = mysqli_query($conn, $fp);
$result2 = mysqli_query($conn, $rp);
$result3 = mysqli_query($conn, $cell);
$result4 = mysqli_query($conn, $toil);
$result5 = mysqli_query($conn, $home);
$result6 = mysqli_query($conn, $pet);

$fp1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
$rp1 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
$cell1 = mysqli_fetch_all($result3, MYSQLI_ASSOC);
$toil1 = mysqli_fetch_all($result4, MYSQLI_ASSOC);
$home1 = mysqli_fetch_all($result5, MYSQLI_ASSOC);
$pet1 = mysqli_fetch_all($result6, MYSQLI_ASSOC);
$categ1 = mysqli_fetch_all($cat1, MYSQLI_ASSOC);

// create a query that gives history for pets:
/*petstory = 'SELECT * FROM pricehistory WHERE productid >=125 AND productid <= 149';
$pethis1 =  mysqli_query($conn, $petstory);
$pets_history = mysqli_fetch_all($pethis1, MYSQLI_ASSOC);*/
?>
