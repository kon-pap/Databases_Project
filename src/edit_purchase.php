<?php
$conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');

if (!$conn) {
    echo 'Bad connection:' . mysqli_connect_error();
}

/* Show the Stores in the collapse */
$sql = 'SELECT * FROM store ORDER BY city ASC';

$result = mysqli_query($conn, $sql);

$stores = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php include 'templates/header.php'; ?>

<div class="container-fluid">
    <div class="row my-3 mx-2" style="color:#354856;">
        <div class="h2">New Purchase</div>
    </div>
    <form>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputname">Name</label>
                <input type="text" class="form-control" id="inputname">
            </div>
            <div class="form-group col-md-3">
                <label for="inputsurname">Surname</label>
                <input type="text" class="form-control" id="inputsurname">
            </div>
            <div class="d-flex h5 mx-5 align-self-center pt-3"> Or </div>
            <div class="form-group col-md-3">
                <label for="inputcardid">Card ID</label>
                <input type="text" class="form-control" id="inputcardid">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputStore">Store</label>
                <select id="inputStore" class="form-control">
                    <?php foreach ($stores as $stor) { ?>
                        <option> <?php echo $stor['street_name'] . ' ' . $stor['street_number'] . ', ' . $stor['city'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="paymethopt" id="paymeth1" value="option1">
                <label class="form-check-label" for="paymeth1">Cash</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="paymethopt" id="paymeth2" value="option2">
                <label class="form-check-label" for="paymeth2">Credit Card</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">New Purchase</button>
    </form>
</div>