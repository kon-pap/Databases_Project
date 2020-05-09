<?php
$conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');

if (!$conn) {
    echo 'Bad connection:' . mysqli_connect_error();
}

$sql = 'SELECT * FROM purchase WHERE purid <= 50';

$result = mysqli_query($conn, $sql);

$purs = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php include 'templates/header.php'; ?>
<div class="container-fluid">
    <div class="row my-3 mx-2" style="color:#354856;">
        <div class="h2">Purchase History</div>
    </div>
    <div class="row">
        <div class="col-3 justify-content-start">
            <div id="accordion" style="background-color:#e3e6e8;">
                <div class="card my-2">
                    <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="background-color:#c8cfd2;">
                        <h5 class="mb-0" style="color:#354856;">
                            Store
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            #All the Stores Here with checkboxes
                        </div>
                    </div>
                </div>

                <div class="card my-2">
                    <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background-color:#c8cfd2;">
                        <h5 class="mb-0" style="color:#354856;">
                            Date
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            Date Picker between two dates
                        </div>
                    </div>
                </div>
                <div class="card my-2">
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
                <div class="card my-2">
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
                <div class="card my-2">
                    <div class="card-header" id="headingFive" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" style="background-color:#c8cfd2;">
                        <h5 class="mb-0" style="color:#354856;">
                            Payment Method
                        </h5>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                        <div class="card-body">
                            Two checkboxes for card or credit
                        </div>
                    </div>
                </div>
                <div class="card my-2">
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
                <button type="button" class="btn btn-block" style="float: right; color:#e3e6e8; background-color:#354856;">Submit</button>
            </div>
        </div>
        <div class="col - 9">
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
                            <th scope="row"><?php echo $pur['purid']?></th>
                            <td><?php echo $pur['total']?> €</td>
                            <td><?php echo $pur['payment_method']?></td>
                            <td><?php echo $pur['date']?></td>
                        </tr>
                    <?php } ?>
            </table>
        </div>
    </div>
</div>

</body>

</html>