<?php ?>

<!DOCTYPE html>

<html style="background-image:url(../Images/background.jpg);">

	<head>
		<title> DB 2019-20 </title>
		<meta charset="UTF-8">
		<link type="text/css" rel="stylesheet" href="../CSS/stylesheet_general.css"/>
		<link rel="icon" href="../Images/favicon.png"/>
		
	</head>

	<body>
		<form action="Customer-Insert1.php" method="GET" align="center">
			<legend><h1 style="font-family:Segoe UI;">Customer's Personal Details: </h1></legend>
            <!-- First Name -->
            <div>
				<label for="first_name">First Name: </label>
				<input type="text" name="first_name" id="first_name" 
				required autofocus placeholder="First Name" 
				pattern="[a-zA-Z]{1,20}" 
				title="Please enter more than 1 and less than 20 letters">
			</div>
            <br><br>
            <!-- Last Name -->
			<div>
				<label for="last_name">Last Name: </label>
				<input type="text" name="last_name" id="last_name" 
				required autofocus placeholder="Last Name"
				pattern="[a-zA-Z]{1,30}" 
				title="Please enter more than 1 and less than 30 letters">
			</div>
            <br><br>
            <!-- Card Expiration Date -->
			<div>
				<label for="card_exp_date">Card Expiration Date: </label>
				<input type="date" name="card_exp_date" id="card_exp_date" 
                required pattern="\d{4}-\d{2}-\d{2}">
                <span class="validity"></span>
			</div>
            <br><br>
            <!-- Current Points -->
			<div>
				<label for="current_points">Current Points: </label>
				<input type="text" name="current_points" id="current_points" 
				required autofocus placeholder="current_points"
                pattern="[0-9]{0,5}" 
				title="This should be a number with up to 5 digits.">
			</div>
            <br><br>
            <!-- Points Redeemed -->
			<div>
				<label for="points_redeemed">Points Redeemed: </label>
				<input type="text" name="points_redeemed" id="points_redeemed" 
				required autofocus placeholder="points_redeemed"
                pattern="[0-9]{0,11}" 
				title="This should be a number with up to 11 digits.">
			</div>
            <br><br>
            <!-- City -->
			<div>
				<label for="city">City: </label>
				<input type="text" name="city" id="city" 
                required autofocus placeholder="City"
                pattern="[a-zA-Z]{1,30}"
				title="Enter more than 3 and less than 30 letters">
			</div>
            <br><br>
            <!-- Street Name -->
			<div>
				<label for="street_name">Street Name: </label>
				<input type="text" name="street_name" id="street_name" 
				required autofocus placeholder="Street"
				pattern="[a-zA-Z]{1,30}"
				title="Enter more than 3 and less than 30 letters">
			</div>
            <br><br>
            <!-- Street Number -->
			<div>
				<label for="street_number">Street Number: </label>
				<input type="number" name="street_number" style="width:55%"id="street_number" 
				required autofocus placeholder="Street Number"
				pattern="[0-9]{0,3}"
				title="This should be a number with up to 3 digits.">
			</div>
            <br><br>
            <!-- Zip -->
			<div>
				<label for="zip">Zip: </label>
				<input type="text" name="zip" id="zip" 
				required autofocus placeholder="zip"
				pattern="[0-9]{0,5}" step="0.1" 
				title="This should be a number with up to 5 digits.">
			</div>
            <br><br>
            <!-- Apartment Floor -->
            <div>
				<label for="apt_floor">Apartment Floor: </label>
				<input type="text" name="apt_floor" id="apt_floor" 
				required autofocus placeholder="apt_floor"
				pattern="[0-9]{0,2}" 
				title="This should be a number with up to 5 digits.">
			</div>
            <br><br>
            <!-- Number of Kids -->
            <div>
				<label for="number_of_kids">Number of Kids: </label>
				<input type="text" name="number_of_kids" id="number_of_kids" 
				required autofocus placeholder="number_of_kids"
				pattern="[0-9]{0,2}" 
				title="This should be a number with up to 5 digits.">
			</div>
            <br><br>
             <!-- Date of Birth -->
			<div>
				<label for="date_of_birth">Date of Birth: </label>
				<input type="date" name="date_of_birth" id="date_of_birth" 
                required pattern="\d{4}-\d{2}-\d{2}">
                <span class="validity"></span>
			</div>
            <br><br>
            <!-- Relationship Status -->
            <div>
				<label for="relationship_status">Relationship Status: </label>
				<select name="relationship_status" required>
                    <option value=""> </option>
                    <option value="Single">Single</option>
                    <option value="In a relationship">In a relationship</option>
                    <option value="Engaged">Engaged</option>
                    <option value="Married">Married</option>
                    <option value="It's complicated">It's complicated</option>
                    <option value="In an open relationship">In an open relationship</option>
                    <option value="Widowed">Widowed</option>
                    <option value="Free">Free</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Other">Other</option>
                </select>
			</div>
            <br><br>
			<input type="submit" value="Submit">
		</form>
	</body>

</html>