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
            
            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
            <a href="hist.php" class="btn btn-secondary btn-lg active" role="button"style="background-color:#354856;">Price History</a>
            <a href="current_prices.php" class="btn btn-secondary btn-lg active" role="button"style="background-color:#354856;">Current Prices</a>
            <a href="price_changer.php" class="btn btn-secondary btn-lg active" role="button"style="background-color:#354856;">Price Changer</a>

            </div>
           
                
               
            </div>
            
        

