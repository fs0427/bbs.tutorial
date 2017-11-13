<html>
<head>
<meta charset="utf-16">
</head>
<body>
<h1>Registering</h1>
<br>
<br>
<?php
$dsn ='';
$user='';
$pasword='';

try{
  $pdo = new PDO($dsn,$user,$pasword);
}
catch (PDOException $e){
print "error".$e->getMessage()."<br/>";
die();
}
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $sql = "SELECT flag , email FROM user_table WHERE id = '$id'";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  foreach($stmt as $row){
    $flag = $row['flag'];
    $email = $row['email'];
}
$false = "0";
$true = "1";
  if($flag === $false){
    $new_flag = 'true';
  $sql ="UPDATE user_table SET flag = '1' WHERE id = '$id'";
  $stmt = $pdo->prepare($sql);
  $stmt -> execute();
  echo 'Registration conplete!';
  echo "</br>";
  echo "We sent email to your email address.";
  $url = "http://co-752.99sv-coco.com/work3/loginform.php";
  $subject = 'Registration conplete';
  $message = "Your ID is $email\rClick the following URL to login.\r$url";
  mail($email,$subject,$message);
  echo '</hr>';
}
elseif($flag === $true){
 header("Location:loginform.php");
 exit;
  }
  else{
    echo "Ragistration was invalidated..";
    echo '</br>';
    echo "<a href ='signupmail.php'>Signup</a>";
  }
}




$pdo = null;
?>
</body>
</html>
