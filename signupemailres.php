<html>
<head>
<meta charset="utf-8">
</head>
<body>
<h1>Pre-registration</h1>

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

if(isset($_POST["name"]) and $_POST["name"] != ""){
$id = uniqid();
$name = $_POST["name"];
$password = $_POST["pw"];
$email = $_POST["email"];
$date = date("Y/m/d H:i");
$flag = 'false';
$sql = "SELECT email FROM user_table WHERE email = '$email'";
$stmt = $pdo -> prepare($sql);
$stmt -> execute();
foreach($stmt as $row){
  $row_email = $row['email'];
  echo $row_email;
}
if(isset($row_email)){
  header("Location:signupmail.php?id=emailerror");
  exit;
}
else{
$sql2 = "INSERT INTO user_table (id,username,password,email,date,flag) VALUES('$id','$name','$password','$email','$date','$flag')";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();

$url = "http://co-752.99sv-coco.com/work3/registering.php?id=$id";

echo $email;
echo "</br>";
echo "This is pre-registration. A confirmation email has been sent to your email address.";
$subject = 'Registering';
$message = "Click the following URL. This registration will be invalidated after 24 hours.\r$url";
mail($email,$subject,$message);
}
}
$pdo = null;
?>
</body>
</html>
