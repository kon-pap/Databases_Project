<?php
$conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');

if (!$conn) {
    echo 'Bad connection:' . mysqli_connect_error();
}

if (isset($_GET['purid'])) {
    $purid = $_GET['purid'];
}
/* purch_prod list */
$sql = 'SELECT (SELECT name FROM product WHERE purch_prod.productid = product.productid) as name, (SELECT brand FROM product WHERE purch_prod.productid = product.productid) as brand, amount,cost FROM purch_prod WHERE purid =' . $purid;

$result = mysqli_query($conn, $sql);

$rcpt_items = mysqli_fetch_all($result, MYSQLI_ASSOC);

/* Purchase info */
$sql2 = 'SELECT * FROM purchase WHERE purid =' . $purid;

$result2 = mysqli_query($conn, $sql2);
$rcpt_info = mysqli_fetch_array($result2, MYSQLI_ASSOC);

/*Customer Info */
$sql3 = 'SELECT first_name, last_name FROM customer WHERE cardid =' . $rcpt_info['cardid'];

$result3 = mysqli_query($conn, $sql3);
$customer = mysqli_fetch_array($result3, MYSQLI_ASSOC);

/*Store Info */
$sql4 = 'SELECT street_name, street_number, city FROM store WHERE storeid =' . $rcpt_info['storeid'];

$result4 = mysqli_query($conn, $sql4);
$stor = mysqli_fetch_array($result4, MYSQLI_ASSOC);
?>
<?php include 'templates/header.php'; ?>
<div class="row my-3 mx-2" style="color:#354856;">
    <div class="h2">Receipt Info</div>
</div>
<div class="d-flex my-3 mx-2 justify-content-around" style="color:#354856;">
    <div class="h5">Date: <?php echo $rcpt_info['date']; ?></div>
    <div class="h5">Time: <?php echo $rcpt_info['time']; ?></div>
    <div class="h5">Store: <?php echo $stor['street_name'] . ' ' . $stor['street_number'] . ', ' . $stor['city'] ?></div>
    <div class="h5">Customer: <?php echo $customer['first_name'].' '.$customer['last_name']; ?></div>
</div>

<div class="m-3" id="purtable">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Brand</th>
                <th scope="col">Amount</th>
                <th scope="col">Cost</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rcpt_items as $it) { ?>
                <tr>
                    <th scope="row"><?php echo $it['name'] ?></th>
                    <td><?php echo $it['brand'] ?></td>
                    <td><?php echo $it['amount'] ?></td>
                    <td><?php echo $it['cost'] * $it['amount'] ?> €</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="d-flex my-3 mx-2 justify-content-end" style="color:#354856;">
    <div class="h4 mr-5">Total: <?php echo $rcpt_info['total']; ?> €</div>
</div>
<div class="d-flex mx-2 justify-content-end" style="color:#354856;">
    <div class="h5 mr-5">Payment Method: <?php echo $rcpt_info['payment_method']; ?></div>
</div>