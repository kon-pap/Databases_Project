<?php session_start();?>
<?php include 'templates/header.php'; ?>
<?php include 'products_sql.php';?>
<div style = "text-align :center"><font size = "350px">
<?php
 
if(isset($_GET['productid']))
{
    $myvar = $_GET['productid']  ;
    $_SESSION['prod'] = $myvar;
    $sqli = 'SELECT * FROM product WHERE productid = '.$myvar; 
    $Name =mysqli_query($conn, $sqli);
    $names = mysqli_fetch_array($Name, MYSQLI_ASSOC);

    $quer = 'SELECT * FROM pricehistory WHERE productid ='. $myvar;
    $hist1 =mysqli_query($conn, $quer);
    $history = mysqli_fetch_all($hist1, MYSQLI_ASSOC);

    $newq = 'SELECT * FROM offers WHERE productid =' .$myvar;
    $curpr =mysqli_query($conn, $newq);
    $price = mysqli_fetch_all($curpr, MYSQLI_ASSOC);
    echo $names['name'].'('.$names['brand'].')';

}

?> 
</font>
</div>

            <div class="col-9" id="purtable">
            <style>
                tr[data-href] {
                    cursor: pointer;
                    
                }

                /* Style the tab */
                .tab {
                    overflow: hidden;
                    /*border: 1px solid #ccc;
                    background-color: #f1f1f1;*/
                }

                /* Style the buttons that are used to open the tab content */
                .tab button {
                    background-color: inherit;
                    float: left;
                    border: none;
                    outline: none;
                    cursor: pointer;
                    padding: 8px 16px 8px 16px;
                    margin-left: 0.5rem;
                    margin-right: 0.5rem;
                    transition: 0.5s;
                }

                /* Change background color of buttons on hover */
                .tab button:hover {
                    background-color: #ddd;
                }

                /* Create an active/current tablink class */
                .tab button.active {
                    background-color: #f7ac15;
                    color: #354856;
                }

                /* Style the tab content */
                .tabcontent {
                    display: block;
                    padding: 6px 12px;
                    /*border: 1px solid #ccc;*/
                    border-top: none;
                }
            </style>
            <div class="tab d-flex justify-content-end" >
                <button class="tablinks active" onclick="opentab(event, 'gen')">Price History</button>
                <button class="tablinks" onclick="opentab(event, 'det')">Current Prices</button>
                <button class="tablinks" onclick="opentab(event, 'change')">Modify Current Price</button>

            </div>
            <div class="tabcontent" id="gen" >
                    <table  class="table" style = "width:1000px;" >
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Price</th>
                        <th scope="col">Store</th>
                        
                    </tr>
                </thead>
                <tbody>
             
                    <?php if (is_array($history) || is_object($history)){
                        foreach ($history as $hist) { ?>
                        <tr>
                            <th scope="row"><?php echo $hist['date']?></th>
                            <td><?php echo $hist['newprice']?> € </td>
                            <?php $market =$hist['storeid'];?>
                           <td> <?php 
                            $erwt='SELECT * FROM store WHERE storeid='.$market;
                            $store = mysqli_query($conn, $erwt);
                            $mymarket = mysqli_fetch_array($store, MYSQLI_ASSOC);
                            echo $mymarket['street_name'].' '.$mymarket['street_number'].', '.$mymarket['city']?></td>

                        </tr>
                    <?php } }?>
                    
                </tbody>
                    
            </table>
            </div>

            <div class="tabcontent" style="display: none;" id="det">
                
                    <table  class="table" style = "width:800px; margin-left:auto; margin-right:auto;">
                <thead>
                    <tr>
                        <th scope="col">Price</th>
                        <th scope="col">Store</th>
                        
                    </tr>
                </thead>
                <tbody>
             
                    <?php if (is_array($price) || is_object($price)){
                        foreach ($price as $pr) { ?>
                        <tr>
                            <th scope="row">
                            <?php echo $pr['current_price']?> € </th>
                            <?php $marketa =$pr['storeid'];?>
                           <td> <?php 
                            $erwtg='SELECT * FROM store WHERE storeid='.$marketa;
                            $stores = mysqli_query($conn, $erwtg);
                            $mymarkets = mysqli_fetch_array($stores, MYSQLI_ASSOC);
                            echo $mymarkets['street_name'].' '.$mymarkets['street_number'].', '.$mymarkets['city']?></td>

                        </tr>
                    <?php } } ?>
                </tbody>
                </table>
            </div>
            <div class="tabcontent" style="display: none;" id="change">
            
            <?php include 'price_changer.php';?>
            
            
            
            </div>


        </div>

        <script>
            function opentab(evt, tab) {
                // Declare all variables
                var i, tabcontent, tablinks;

                // Get all elements with class="tabcontent" and hide them
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }

                // Get all elements with class="tablinks" and remove the class "active"
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }

                // Show the current tab, and add an "active" class to the button that opened the tab
                document.getElementById(tab).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>

        </div>
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

     </body>
</html>


