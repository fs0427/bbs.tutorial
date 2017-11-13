<?php
$dsn ='';
$user='';
$password='';

try{
  $pdo = new PDO($dsn,$user,$password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

   }
catch (PDOException $e){
print "error".$e->getMessage()."<br/>";
die();
}
  $now = date("Y/m/d H:i");
$sql ="SELECT date,flag,email FROM user_table";
$stmt = $pdo->query($sql);
foreach ($stmt as $row){
  $date = $row["date"];
  $flag = $row["flag"];
  $email = $row["email"];
  $strnow = strtotime($now);
  $strdate = strtotime($date);
  $diff = ($strnow - $strdate)/3600;
  $false = '0';
  $day = 24;
    if($flag === $false){
    if($diff >= $day){
      $sql = "DELETE FROM user_table WHERE email = '$email'";
      $stmt = $pdo->query($sql);
    }
  }
}



 ?>
