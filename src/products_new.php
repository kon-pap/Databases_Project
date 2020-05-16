
<?php include 'templates/header.php'; ?>
<?php include 'products_sql.php';?>
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

if(isset($_GET['categoryid'])){
    $myvar = $_GET['categoryid']  ;
    $sqli = 'SELECT * FROM category WHERE catid = '.$myvar; 
    $Name =mysqli_query($conn, $sqli);
    $names = mysqli_fetch_array($Name, MYSQLI_ASSOC);
    $sqlq = 'SELECT * FROM product WHERE catid = '.$myvar; 
    $prod =mysqli_query($conn, $sqlq);
    $prods = mysqli_fetch_all($prod, MYSQLI_ASSOC);
}

    echo $names['name'];
    ?>
    </font>
</div>
    <div class="col - 9">
            <table  class="table table-hover" style = "width:1000px; margin-left:auto; margin-right:auto;">
                <thead>
                    <tr>
                        <th scope="col">Product/Brand</th>
                        <th scope="col">Cost</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prods as $pro) { ?>
                        <tr data-href="<?php echo 'prod_info.php?productid=' . $pro['productid'] ?>"> 
                            <th scope="row"><?php echo $pro['name']. ' / ' . $pro['brand']?></th>
                            <td><?php echo "--" ?></td>
                            <a href="<?php echo 'prod_info.php?productid=' . $pro['productid'] ?>"></a>
                        </tr>
                    <?php } ?>
                </tbody>
                    
            </table>
        </div>
        