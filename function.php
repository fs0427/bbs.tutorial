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
$post_pw = $_POST["pw"];
$post_id = $_POST["id"];

$sql = "SELECT password FROM user_table WHERE id = '$post_id'";
$stmt = $pdo->query($sql);
foreach ($stmt as $row) {
  $row_pw = $row["password"];}
if($row_pw == $post_pw){
  session_start();
  $_SESSION['visit'] = $post_id;
  header("Location: bbsindex.php");
  exit ;
}
else{
  header("Location: 3-2loginform.php");
  exit ;
}
?>
