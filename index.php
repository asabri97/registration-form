<!--
Second page that displays database after registration
 -->   

<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome - Database Page</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
</head>
<body>

<h1 align="center">WELCOME - HERE IS YOUR DATABASE</h1>
<div class="contact-form">
<?php

$mysqli = new mysqli("localhost",$db_user,$db_pass,$db_name);
$query = "SELECT * FROM users";


echo '<table border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td><td> <font face="Arial"><b>ID</b></font> </td> 
          <td><td> <font face="Arial"><b>Username</b></font> </td> 
          <td> <td><font face="Arial"><b>Email</b></font> </td> 
      </tr>';
 
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $id= $row["id"];
        $name = $row["name"];
        $email = $row["email"];
 
        echo '<tr> 
                  <td><td><b>'.$id.'</td></td>  
                  <td><td>'.$name.'</td> </td> 
                  <td><td>'.$email.'</td> </td> 
                 
              </tr>';
    }
    $result->free();
}
?>
</div>
</body>
</html>