<?php
$conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');

if (!$conn) {
    echo 'Bad connection:' . mysqli_connect_error();
}
$custom = 'SELECT * FROM customer';

$cust1 =  mysqli_query($conn, $custom);

$custom1 = mysqli_fetch_all($cust1, MYSQLI_ASSOC);

?>