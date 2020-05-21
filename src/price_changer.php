
<?php include 'products_sql.php';?>
<form>
<div class="row">
    <div class="col">
        <label for="inp">Insert New Price</label>
        <input type="text" class="form-control" id = "inp">
    </div>
    <div class="form-group col-md-3">
                <label for="inputStore">Pick Store</label>
                <select id="inputStore" class="form-control" name="storeid">
                    <?php foreach ($stores as $stor) { ?>
                        <option value="<?php echo $stor['storeid'] ?>"> <?php echo $stor['street_name'] . ' ' . $stor['street_number'] . ', ' . $stor['city'] ?>
                        </option>
                    <?php } ?>
                </select>
    </div>
 </div>
 <div class="col" style = "width:100px;">
 <button type="submit" name="change" value="change" class="btn btn-block" style="float: left; color:#e3e6e8; background-color:#354856; text-align:center;">Submit</button>
 </div>
</form>
