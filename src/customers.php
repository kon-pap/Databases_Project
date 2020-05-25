<?php session_start();?>

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
 <div class="col - 9">
            <table  class="table table-hover" style = "width:1000px; margin-left:auto; margin-right:auto;">
                <thead>
                    <tr>
                        <th scope="col">Customers</th>
                                                
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($custom1 as $cust) { ?>
     <tr data-href="<?php echo 'customer_new.php?customerid=' . $cat['cardid'] ?>"> 
           <th scope="row"><?php echo $cat['name']?></th>
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

           
            <a href="<?php echo 'customer_new.php?customerid=' . $cat['cardid'] ?>"></a>
     </tr>
 <?php } ?>
                </tbody>
                    
            </table>
        </div>
</body>
</html>