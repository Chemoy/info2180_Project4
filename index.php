<?php  include "cheapomaildbConfig.php";
  session_start(); // Start Session
?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    	<title>CheapoMail_Alkemis</title>
      
    	<link rel="stylesheet" href="stylessheet.css">  

        <script> $(document).ready(function(){
        setInterval(function(){
          $("#userList").load("user_listing.php");
        }, 1000); //AUTO LOAD USER LIST every sec
        // Get userid of current logged in user
        var userID = document.getElementById("userID").value;
        
        // Get time user logged in
        //var loginTime = document.getElementById("loginTime").value;
        //var refresh = 0;
        setInterval(function(){
          /*// Get current time
          var time = new Date();
          var currentTime = time.getHours() + ":" + time.getMinutes(); + ":" + time.getSeconds();
          console.log(currentTime);
          
          console.log(refresh);
          if (refresh > 0)
          {
            // Get id of latest message --> idMsg10
            var lastID = document.getElementById("idMsg10").textContent;
          }
          else
          {
            var lastID = 2000;
          }
          // Create Datastring to be sent
          var dataString = '?id='+ userID + '&last=' + lastID + '&currentTime=' + currentTime;*/
          $("#inbox").load("cheapoInbox.php?id="+userID);
          //refresh++;
          
        }, 2000); // AUTO LoAD inbox messages
      }); 
    
  </script> 
  </head>

  <body>

    <div class="wrapper">
  		<form class="login" action = 'home-page.php' method = 'POST'>
    		<p class="title"> Welcome to CheapoMail. <br /> Log in </p>
    			<input type="text" placeholder="Username" name = "username" autofocus/>
    			<i class="fa fa-user"></i>
    			<input type="password" placeholder="Password" name = "password" />
    			<i class="fa fa-key"></i>
   			<a href="#">Forgot your password?</a>
    		<button>
      			<i class="spinner"></i>
      			<span class="state">Log in</span>
    		</button>
  		</form>
  			</p>
	</div>
   
  </body>
</html>