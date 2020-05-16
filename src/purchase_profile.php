<?php
$conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');

if (!$conn) {
    echo 'Bad connection:' . mysqli_connect_error();
}

if(isset($_GET['purid'])){
    echo $_GET['purid'];
}

?>
<?php include 'templates/header.php'; ?>