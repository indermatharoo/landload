<?php session_start();
$_SESSION['user'] ='manpreet';
?>

<!DOCTYPE html>
<html>
 <body>
    <div style="color:white;"><br><br>
     <div style="margin-left: 40%;">
         <img alt="Desktopdeli" src="image/dlogo.png">
    </div>
</div><br>
  
<div style="margin-left: 400px;border:2px solid #5581BA; height:110px; width:500px; padding:30px; text-align:center;">
    
    <form id="login" action="login_check.php" method="post" >
<spam style="font-family: Calibri;">Username</spam>&nbsp;&nbsp;&nbsp;&nbsp; <input style="box-shadow: 0 0 6px #89C341;" type="text" name="username" ><br><br>
&nbsp;&nbsp;<spam style="font-family: Calibri;">Password</spam>&nbsp;&nbsp;&nbsp; <input style="box-shadow: 0 0 6px #89C341;" type="password" name="password" ><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
<input style="box-shadow: 0 0 6px #89C341;" type="submit" value="Login">
</form>
    

        
        
</div>
</body>
</html>
   