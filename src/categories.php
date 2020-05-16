<?php session_start();?>
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
 <div class="col - 9">
            <table  class="table" style = "width:1000px; margin-left:auto; margin-right:auto;">
                <thead>
                    <tr>
                        <th scope="col">Category</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($categ1 as $cat) { ?>
     <tr data-href="<?php echo 'products_new.php?categoryid=' . $cat['catid'] ?>"> 
           <th scope="row"><?php echo $cat['name']?></th>
            
            <a href="<?php echo 'products_new.php?categoryid=' . $cat['catid'] ?>"></a>
     </tr>
 <?php } ?>
                </tbody>
                    
            </table>
        </div>
</body>
</html>