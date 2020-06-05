<?php

    include('customer-db-connect.php');
    
    // check POST for DELETION
    if(isset($_POST['delete'])){

		$cardid_to_delete = mysqli_real_escape_string($conn, $_POST['cardid_to_delete']);

		$sql = "DELETE FROM customer WHERE cardid = $cardid_to_delete";

		if(mysqli_query($conn, $sql)){
            // success
            header('Location: customers.php');
		} else {
            // failure
			echo 'query error: '. mysqli_error($conn);
		}

	}


    // check GET request cardid param
	if(isset($_GET['cardid'])){

        // escape sql chars
        $cardid = mysqli_real_escape_string($conn, $_GET['cardid']);
        
        // make sql
        $sql = "SELECT * FROM customer WHERE cardid = $cardid";
        
        // get the query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
        $customer = mysqli_fetch_assoc($result);
        
        // free the $result from memory (good practise)
        mysqli_free_result($result);
        
        // close connection
        mysqli_close($conn);
        
        // print_r($customer);

    }

?>

<!DOCTYPE html>
<html>

    <?php include('templates/header.php'); ?>

	<?php include('customer-header.php'); ?>

	<div class="container center">
        <?php if($customer): ?>
            
            <h4><?php echo htmlspecialchars($customer['cardid']); ?></h4>
            <h4><?php echo htmlspecialchars($customer['first_name']); ?></h4>
            <h4><?php echo htmlspecialchars($customer['last_name']); ?></h4>
            
            <h5>Card Details: </h5>
            <p>Card's Expiration Date: <?php echo date($customer['card_exp_date']); ?></p>
            <p>Current Points: <?php echo htmlspecialchars($customer['current_points']); ?></p>
            <p>Points Redeemed: <?php echo htmlspecialchars($customer['points_redeemed']); ?></p>
            
            <h5>Address Details:</h5>
            <p>City: <?php echo htmlspecialchars($customer['city']); ?></p>
            <p>Street Name: <?php echo htmlspecialchars($customer['street_name']); ?></p>
            <p>Street Number: <?php echo htmlspecialchars($customer['street_number']); ?></p>
            <p>ZIP: <?php echo htmlspecialchars($customer['zip']); ?></p>
            <p>Apartment's Floor: <?php echo htmlspecialchars($customer['apt_floor']); ?></p>
            
            <h5>Personal Details:</h5>
            <p>Number of Kids: <?php echo htmlspecialchars($customer['number_of_kids']); ?></p>
            <p>Date of Birth: <?php echo date($customer['date_of_birth']); ?></p>
            <p>Relationship Status: <?php echo htmlspecialchars($customer['relationship_status']); ?></p>
            
            <!-- DELETE FORM -->
            <form>
            <form action="customer-details.php" method="POST">
				<input type="hidden" name="cardid_to_delete" value="<?php echo $customer['cardid']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
            </form>

		<?php else: ?>
			<h5>No such Customer exists.</h5>
		<?php endif ?>
	</div>

	<?php include('customer-footer.php'); ?>

</html>