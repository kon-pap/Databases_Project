
<?php include 'templates/header.php'; ?>
<?php include 'customer_sql.php';?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const rows = document.querySelectorAll("tr[data-href]");
        rows.forEach(row => {
            row.addEventListener("click", () => {
                window.location.href = row.dataset.href;
            })
        });
    });
</script>

<div style = "text-align :center"><font size = "350px"><?php
$conn = mysqli_connect('192.168.99.100', 'root', 'root', 'supermarketdb');

if (!$conn) {
    echo 'Bad connection:' . mysqli_connect_error();
}


if(isset($_GET['customerid'])){
    $myvar = $_GET['customerid']  ;
    $sql = 'SELECT * FROM customer WHERE cardid = '.$myvar; 
    
    $result =mysqli_query($conn, $sql);

    $reg = mysqli_fetch_array($result, MYSQLI_ASSOC);
}
?>

</div>
<p><font size = "+2"><center>Customers</center></font></p>

</div>
    <div class="col - 9">
            <table  class="table table-hover" style = "width:1000px; margin-left:auto; margin-right:auto;">
                <thead>
                    <tr>
                        <th scope="col">Card Expiration Date</th>
                        <th scope="col">Current Points</th>
                        <th scope="col">Points_Redeemed</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Street Name</th>
                        <th scope="col">Street Number</th>
                        <th scope="col">Apartment Floor</th>
                        <th scope="col">City</th>
                        <th scope="col">ZIP Code</th>
                        <th scope="col">Realationship Status</th>
                        <th scope="col">Number of Kids</th>
                        <th scope="col">Date of Birth</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reg as $cus) { ?>
                        <tr> 
                            <th scope="row"><?php echo $cus['card_exp_date']?></th>
                            <td><?php echo $cus['current_points']?> </td>
                            <td><?php echo $cus['points_redeemed']?></td>
                            <td><?php echo $cus['first_name']?></td>
                            <td><?php echo $cus['last_name']?></td>
                            <td><?php echo $cus['street_name']?></td>
                            <td><?php echo $cus['street_number']?></td>
                            <td><?php echo $cus['apt_floor']?></td>
                            <td><?php echo $cus['city']?></td>
                            <td><?php echo $cus['zip']?></td>
                            <td><?php echo $cus['relationship_status']?></td>
                            <td><?php echo $cus['number_of_kids']?></td>
                            <td><?php echo $cus['date_of_birth']?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                    
            </table>
        </div>
        