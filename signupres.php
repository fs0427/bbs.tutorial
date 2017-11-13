<html>
<head>
<meta charset="utf-8">
</head>
<body>
<h1>Registration successful</h1>

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



echo "Username  "."$name";
echo nl2br("\n");
echo "ID  "."$id";
echo nl2br("\n");
echo "Please keep the ID";
echo "</br>";


$stmt = $pdo->prepare("INSERT INTO user_table (id,username,password)VALUES ('$id','$name','$password')");
$stmt->execute();
}
  else{header("Location:signup.php");
  exit;}
$pdo = null;
?>
<a href="loginform.php">Sign In</a>
</body>
</html>
