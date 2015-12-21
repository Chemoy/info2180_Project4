<?php

	include "cheapomaildbConfig.php"; # opens the connection to MYSQL

	session_start(); # starts a active session

	$row = null;
	$counter = 0;

	$user_id = $_GET["id"];

	$sql = "SELECT * FROM message ORDER BY id DESC LIMIT 11";

	$query = mysql_query($sql);

	if ($query === False) {
		echo "Unfortunately the query request could not be completed. Please try again!";
		echo "Error ID: " . mysql_error();
		exit;
	}

	#if there is a query
	if (mysql_num_rows($query) > 0) {
		
		$nrows = mysql_num_rows($query);

		echo "<table class='table' id='msgInbox'>";
		echo "<tbody>";
		echo "<td style = 'display: none' id = 'numrows'> $nrows </td>";

		while ($row = mysql_fetch_array($query)) {
			
			$recipient = explode(";", $row["recipient_ids"]);

			foreach ($recipient as $receive) {
				
				if($receive == $user_id) {

					$counter++;

					?><tr class ="tr" <?php

					$sqli = "SELECT date FROM message_read WHERE message_id = '$row[id]'";
					$result = mysql_query($sqli);

					if ($result === False) {
						echo "Query: " .$sqli . " could not be opened! ". mysql_error();
						exit;
					}
					elseif (!mysql_num_rows($result) > 0) {
						$unread = true;
						echo "not_read"; #unread class imn code
					}

							#msg$count
					?>"id = mess$count" ><?php
											#check-mail
						echo "<td class = 'checkmsg'>";
							echo "<div>";							#box$count
								echo "<input type = 'checkbox' id = 'b$count' name = 'check' />";
								echo "<label for = 'b$count'></label>";
							echo "</div>";
						echo "</td>";
					echo "<td style = 'display: none' id = 'idmess$count'> $row[id]</td>";

					#***********************************************************************************************
					// I have the userid need to now search user table for a matching username
                        $mysqli = "SELECT username FROM user WHERE id = '{$row['user_id']}'";
                        $quer = mysql_query($mysqli);

                        if ($quer === false) {
                            echo "Could not successfully run query ". ($mysql). " "mysql_error();
                            exit;
                        }

                        else if (mysql_num_rows($quer) > 0) {
                            $dataSet = mysql_fetch_array($quer);
                            // print corresponding username
                            echo "<td class='mail-contact' id= 'sender$count'><a href='#' onclick='readMsg($count);'>$data[username]</a></td>"; // Sender
                        }

                        else { echo "User not found";}
                        echo "<td class='mail-subject' id= 'subject$count'><a href='#' onclick='readMsg($count);'>$row[subject]</a></td>"; // Subject
                        echo "<td class style='width: 30px'></td>";
                        
                        ?>

                        <td class="mail-date <?php if (($row[id] > 10) && ($not_read)){ echo " new";}?>" id= "statusMsg$count"><a href="#" onclick="readMsg(<?php echo $counter; ?>);">
                        <?php //Determine record status
                                 $esql = "SELECT date FROM message_read WHERE message_id = '$row[id]'";

                                 $results = mysql_query($esql);

                                 if ($results === false) {
                                    echo "Could not successfully run query " .($esql) " " . mysql_error();
                                    exit;
                                 }

                                else if (mysql_num_rows($results) > 0) {
                                        // Record found therefore message has been read before
                                        echo "READ";
                                    } else{ echo "UNREAD";}
                        ?><?php // Status
                        echo "</a></td>"; 
                        echo "</tr>";
					#***********************************************************************************************
				}
			}
		}

		echo "</table";
	}
	else {
		echo "Indox Empty";
	}
?>