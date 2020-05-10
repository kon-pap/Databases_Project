<?php include 'purchase_sql.php' ?>
<?php include 'templates/header.php'; ?>
<div class="container-fluid">
    <div class="row my-3 mx-2" style="color:#354856;">
        <div class="h2">Purchase History</div>
    </div>
    <div class="row">
        <form class="col-3 justify-content-start" action="/purchases.php" method="GET">
            <div id="accordion" style="background-color:#e3e6e8;">
                <div class="card my-2 border-0">
                    <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="background-color:#c8cfd2;">
                        <h5 class="mb-0" style="color:#354856;">
                            Store
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body p-0 overflow-auto" id="scrolli">
                            <ul class="list-group px-0" style="max-height: 300px;">
                                <?php foreach ($stores as $stor) { ?>
                                    <li class="list-group-item rounded-0" style="border-bottom:1px dashed #354856;">
                                        <div class="custom-control custom-checkbox" style="padding-left: 1.75rem">
                                            <input class="custom-control-input mr-2" type="checkbox" value="1" <?php if (isset($_GET['storch' . '' . $stor['storeid']])) echo "checked='checked'"; ?> id="storch<?php echo $stor['storeid'] ?>" name="storch<?php echo $stor['storeid'] ?>">
                                            <label class="custom-control-label" for="storch<?php echo $stor['storeid'] ?>">
                                                <?php echo $stor['street_name'] . ' ' . $stor['street_number'] . ', ' . $stor['city'] ?>
                                            </label>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card my-2 border-0">
                    <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background-color:#c8cfd2;">
                        <h5 class="mb-0" style="color:#354856;">
                            Date
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <?php include 'datepicker.php' ?>
                        </div>
                    </div>
                </div>
                <div class="card my-2 border-0">
                    <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="background-color:#c8cfd2;">
                        <h5 class="mb-0" style="color:#354856;">
                            Total Amount
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            Bar with two sides based on purchases highest and lowest amount
                        </div>
                    </div>
                </div>
                <div class="card my-2 border-0">
                    <div class="card-header" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="background-color:#c8cfd2;">
                        <h5 class="mb-0" style="color:#354856;">
                            Total Cost
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body">
                            Bar with two sides based on purchases highest and lowest amount
                        </div>
                    </div>
                </div>
                <div class="card my-2 border-0">
                    <div class="card-header" id="headingFive" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" style="background-color:#c8cfd2;">
                        <h5 class="mb-0" style="color:#354856;">
                            Payment Method
                        </h5>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                        <div class="card-body d-flex justify-content-between mx-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="paymentradio" class="custom-control-input" value="0" <?php if (isset($_GET['paymentradio']) && $_GET['paymentradio'] === '0') echo "checked='checked'"; ?>>
                                <label class="custom-control-label" for="customRadioInline1">Cash</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="paymentradio" class="custom-control-input" value="1" <?php if (isset($_GET['paymentradio']) && $_GET['paymentradio'] === '1') echo "checked='checked'"; ?>>
                                <label class="custom-control-label" for="customRadioInline2">Credit Card</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card my-2 border-0">
                    <div class="card-header" id="headingSix" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix" style="background-color:#c8cfd2;">
                        <h5 class="mb-0" style="color:#354856;">
                            Categories
                        </h5>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                        <div class="card-body">
                            Checkboxes for Categories
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <button type="submit" name="submit" value="submit" class="btn btn-block" style="float: right; color:#e3e6e8; background-color:#354856;">Submit</button>
            </div>
        </form>
        <div class="col-9">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">purID</th>
                        <th scope="col">Total</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($purs as $pur) { ?>
                        <tr>
                            <th scope="row"><?php echo $pur['purid'] ?></th>
                            <td><?php echo $pur['total'] ?> €</td>
                            <td><?php echo $pur['payment_method'] ?></td>
                            <td><?php echo $pur['date'] ?></td>
                        </tr>
                    <?php } ?>
            </table>
        </div>
    </div>
</div>

</body>

</html>