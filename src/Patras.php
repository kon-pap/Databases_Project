<?php
$conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');

if (!$conn) {
    echo 'Bad connection:' . mysqli_connect_error();
}

$sql = 'SELECT * FROM store WHERE city = "Patras"';

$result = mysqli_query($conn, $sql);

$reg = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php include 'templates/header.php';?>

<p><font size = "+2"><center>Patras</center></font></p>
<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
<a href="Athens.php" class="btn btn-secondary btn-sm active" role="button"style="background-color:#354856;">Athens</a>
<a href="Thessaloniki.php" class="btn btn-secondary btn-sm active" role="button"style="background-color:#354856;">Thessaloniki</a>
<a href="Patras.php" class="btn btn-secondary btn-sm active" role="button"style="background-color:#354856;">Patras</a>
<a href="stores_mod.php" class="btn btn-secondary btn-sm active" role="button"style="background-color:#354856;">Modify Stores</a>
</div>
<div class="col - 9">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Street</th>
                        <th scope="col">Number</th>
                        <th scope="col">ZIP Code</th>
                        <th scope="col">Capacity(m^2)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reg as $ath) { ?>
                        <tr>
                            <th scope="row"><?php echo $ath['street_name']?></th>
                            <td><?php echo $ath['street_number']?> </td>
                            <td><?php echo $ath['zip']?></td>
                            <td><?php echo $ath['sq_meters']?></td>
                        </tr>
                    <?php } ?>
            </table>
        </div>