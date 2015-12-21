<?php
   
	include "cheapomaildbConfig.php";

	session_start(); // Start Session
	$message = "";
	$error = array(); // list of error messages
	$recipient = null; // list of message recipient
	$recipient_ids = array(); // list of message recipient ids
    	
    	// Get entered field data
		$subject = $_POST["subject"];
		//for($i=0; $i < count($_POST["recipient"]); $i++){
		$recipient = explode(";",$_POST["recipient"]); // delimiter to separate each recipient ';'
		
		$body = $_POST["body"];
		
		// Validation - remember to use required or JS
		foreach ($recipient as $recipient)
		 {
			// Check to see if recipient selected exists as a user within the system
			$sql = "SELECT * FROM  User WHERE username = '$recipient'";
        	$query = mysql_query($sql);
        	if ($query === false) {
            	echo "Could not successfully run query ($sql) from DB: " . mysql_error();
            	exit;
            }
        	if (mysql_num_rows($query) > 0) { //If they match
        		// Get recipient id
            	$recipient_ids[] = mysql_fetch_array($query)["id"];
            }
            else // Recipient not found
			{
				$error[] = "Recipient ".$recipient." not found";
			}
		 }
		// If user exists, insert new message into database
		if (empty($error))
		{
			// Convert array of recipient ids to string
			$recipient_ids_data = implode(";",$recipient_ids);
			$mysql = "INSERT INTO Message (body,subject,user_id,recipient_ids) VALUES ('$body','$subject','{$_SESSION['userID']}','$recipient_ids_data')";
			$querry = mysql_query($mysql);
			if ($querry === false) {
            	echo "Could not successfully run query ($mysql) from DB: " . mysql_error();
            	exit;
            }
            else
            {
            	$message = "Message sent succesfully to recipient(s) ".$_POST["recipient"];
            	echo $message;
            }
		}
		else
		{
			foreach ($error as $error){
        		echo $error. "\n";
        	}
     
		}
        
	
							
?>