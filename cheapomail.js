function compose()
{
	// Get data entered into form
	var recipients = document.getElementById("recipients").value;
	var subject = document.getElementById("subject").value;
	var body = document.getElementById("body").value;

	// Returns successful data submission message when the entered information is stored in database.
	var dataString = 'recipients=' + recipients + '&subject=' + subject + '&body=' + body;

	// Validation [if not done by REQUIRED]
	if (recipients == '' || subject == '' || body == '') {
		alert("Please Fill All Fields");
	} else {

		// AJAX code to submit form using Jquery
		$.ajax({
			type: "POST",
			url: "composeMessage.php",
			data: dataString,
			cache: false,
			success: function(html) {
						alert(html);
					}
		});
	}
	return false;
}


function replyTo()
{
	// Get data entered into form
	var receiver = document.getElementById("receiver").value;
	var msgSubject = document.getElementById("msgSubject").value;
	var message = document.getElementById("message").value;

	// Returns successful data submission message when the entered information is stored in database.
	var dataString = 'receiver=' + receiver + '&msgSubject=' + msgSubject + '&message=' + message;

	// Validation [if not done by REQUIRED]
	if (message == '') {
		alert("Please Fill All Fields");
	} else {

		// AJAX code to submit form using Jquery
		$.ajax({
			type: "POST",
			url: "replyTo.php",
			data: dataString,
			cache: false,
			success: function(html) {
						alert(html);
					}
		});
	}
	return false;
}

function replyPopup(to,subject)
{
	// replyPopup(<?php echo $row['user_id'].",".$row[subject];?>)
	var dataString = '?to=' + from + '&subject=' + subject;
	setTimeout(function(){
		$("#popup-box2").load("genReply.php"+dataString);
	}, 1000); // AUTO LoAD reply popup

	toggle_visibility('popup-box2');
}

function readMsg(row)
{
	var i = row;
	
	// Mark msg as read
	$('#msg'+i).removeClass("unread");
	$('#statusMsg'+i).text("READ");

	// Create message_read record
	// Get message id
	var msgID = document.getElementById("idMsg"+i).textContent;
	var dataString = 'id=' + msgID;
	// AJAX code using Jquery
	$.ajax({
	type: "POST",
	url: "msgRead.php",
	data: dataString,
	cache: false,
	success: null
	});					

	// View the message
	// AJAX code using Jquery
	setTimeout(function(){
		$("#msgView").load("viewMessage.php?id="+msgID);
		}, 1000);

}
