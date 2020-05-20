<?php
$conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');

if (!$conn) {
    echo 'Bad connection:' . mysqli_connect_error();
}

/* Show the Stores in the collapse */
$sql = 'SELECT * FROM store ORDER BY city ASC';

$result = mysqli_query($conn, $sql);

$stores = mysqli_fetch_all($result, MYSQLI_ASSOC);
$sub = 0;
if (isset($_GET['submit'])) {
    $sub = 1;
    $error = false;
    #Checking the customer data
    if (($_GET['name'] !== '' && $_GET['surname'] !== '' && $_GET['cardid'] === '') ||
        ($_GET['name'] === '' && $_GET['surname'] === '' && $_GET['cardid'] !== '')
    ) {
        if ($_GET['name'] !== '') {
            $sqlname = "SELECT first_name, last_name FROM customer where upper(first_name) LIKE '%" .
                strtoupper($_GET['name']) . "%' AND upper(last_name) LIKE '%" . strtoupper($_GET['surname']) . "%' ";
            if (mysqli_query($conn, $sqlname)->num_rows == 0) {
                $error = true;
                $error_name = 'Customer not found! Please enter a valid name.';
            }
        } else {
            $sqlid = "SELECT cardid FROM customer where cardid=" . $_GET['cardid'];
            if (mysqli_query($conn, $sqlid)->num_rows == 0) {
                $error = true;
                $error_name = 'CardID not valid!';
            }
        }
    } else {
        $error = false;
        $error_name = 'Please insert: 1) First name and Last name or 2) CardID';
    }
}

/* Show the products in the chosen store */
if (isset($_GET['seeprod']) || $sub == 1) {
    $storeid = $_GET['storeid'];
    $sqlprod = 'SELECT product.name as prname, category.name as catname, quantity, brand 
    FROM offers,product,category 
    WHERE product.catid = category.catid AND offers.productid = product.productid and offers.storeid =' . $storeid . ' ORDER BY product.catid';

    $resprod = mysqli_query($conn, $sqlprod);
    $prods = mysqli_fetch_all($resprod, MYSQLI_ASSOC);
}
?>

<?php include 'templates/header.php'; ?>
<style>
    .form-control:focus {
        box-shadow: 0 0 0 3px rgb(247, 172, 21, 0.3);
        border-color: #f7ac15 !important;
        box-shadow: none;
    }
</style>
<div class="container-fluid">
    <div class="row my-3 mx-2" style="color:#354856;">
        <div class="h2">New Purchase</div>
    </div>
    <form>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputname">First Name</label>
                <input type="text" class="form-control" id="inputname" name="name" value="<?php if (isset($_GET['name'])) echo $_GET['name']; ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="inputsurname">Last Name</label>
                <input type="text" class="form-control" id="inputsurname" name="surname" value="<?php if (isset($_GET['surname'])) echo $_GET['surname']; ?>">
            </div>
            <div class="d-flex h5 mx-5 align-self-center pt-3"> Or </div>
            <div class="form-group col-md-3">
                <label for="inputcardid">Card ID</label>
                <input type="text" class="form-control" id="inputcardid" name="cardid" value="<?php if (isset($_GET['cardid'])) echo $_GET['cardid']; ?>">
            </div>
        </div>
        <div style="color:red;" class="mb-3"><?php echo $error_name; ?></div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputStore">Pick Store</label>
                <select id="inputStore" class="form-control" name="storeid">
                    <?php foreach ($stores as $stor) { ?>
                        <option value="<?php echo $stor['storeid'] ?>"> <?php echo $stor['street_name'] . ' ' . $stor['street_number'] . ', ' . $stor['city'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="d-flex col-md-3 align-items-end">
                <button type="submit" name="seeprod" value="1" class="btn mb-3" style="color:#e3e6e8; background-color:#354856; width: 117.6px; height: 38px;">See Products</button>
            </div>
            <div class="d-flex h5 mx-5 align-self-center pt-3" style="width: 22.53px;"> </div>
            <fieldset class="form-group col-md-3">
                <legend class="col-form-label mb-1">Payment Method</legend>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="paymentradio" class="custom-control-input" value="0" <?php if (isset($_GET['paymentradio']) && $_GET['paymentradio'] === '0') echo "checked='checked'"; ?>>
                    <label class="custom-control-label" for="customRadioInline1">Cash</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="paymentradio" class="custom-control-input" value="1" <?php if (isset($_GET['paymentradio']) && $_GET['paymentradio'] === '1') echo "checked='checked'"; ?>>
                    <label class="custom-control-label" for="customRadioInline2">Credit Card</label>
                </div>
            </fieldset>
        </div>
        <div class="p-0 overflow-auto mb-2" id="scrolli">
            <ul class="list-group px-0" style="max-height: 340px;">
                <?php foreach ($prods as $prod) { ?>
                    <li class="list-group-item rounded-0" style="border-bottom:1px dashed #354856;">
                        <div class="custom-control custom-checkbox" style="padding-left: 1.75rem">
                            <label class="custom-control-label" for="prod<?php echo $prod['prodid'] ?>">
                                <?php echo $prod['prname'] . ' ' . $prod['brand'] . ', ' . $prod['catname'] . ' ' . $prod['quantity'] ?>
                            </label>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <button type="submit" name="submit" class="btn" style="color:#e3e6e8; background-color:#354856;">New Purchase</button>
    </form>
    <script type="text/javascript">
        document.getElementById('inputStore').value = "<?php echo $_GET['storeid']; ?>";
    </script>

</div>