<html>
<head>
<meta charset="utf-8">
<style type="text/css">
</style>
</head>
<body>
  <img src="test.php">
<?php
session_start();
if(isset($_POST['post'])){
if(isset($_SESSION['visit']) and $_SESSION['visit'] !== ""){

  $dsn ='';
  $user='';
  $password='';


  try{
    $pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_MAX_BUFFER_SIZE=>1024*1024*10));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
  catch (PDOException $e){
  print "error".$e->getMessage()."<br/>";
  die();
}}
if(isset($_POST["edit"]) and $_POST["edit"]!==""){
  $id = $_POST["edit"];
  $title = $_POST["bookdata"];
  $auther = $_POST["auther"];
  $comment = $_POST["comment"];
  $date = date("y/m/d");
  $sql2 = "UPDATE post_table set bookdata = :bookdata, auther = :auther, comment = :comment WHERE bookdata = '$id'";
  $stmt2 = $pdo -> prepare($sql2);
  $update = array(':bookdata' => $title, ':auther' => $title, ':comment'=> $comment);
  $stmt->execute($update);
}
else{
$sessionid = $_SESSION['visit'];
$sql = "SELECT username FROM user_table WHERE id = '$sessionid'";
$stmt = $pdo->query($sql);
foreach($stmt as $row){
 $row_name = $row["username"];
 }
 $title = $_POST["bookdata"];
 $auther = $_POST["auther"];
 $comment = $_POST["comment"];
 $date = date("y/m/d");

if(isset($_FILES['file'])){

  $path = $_FILES['file']['tmp_name'];
  $file = file_get_contents($path);
  $ext = $_FILES['file']['type'];
  echo $ext;
  $file_encoded = base64_encode($file);
}
$sql2 = "INSERT INTO post_table (comment,date,bookdata,auther,username,ext,id,contents) VALUES(:comment,:date,:bookdata,:auther,:username,:ext,:id,:contents)";
$stmt2 = $pdo->prepare($sql2);
$params = array(':comment'=>$comment,':date' =>$date,':bookdata'=>$title,':auther'=>$auther,':username'=>$row_name,':ext'=>$ext,'id'=>$sessionid,'contents'=>$file_encoded);
$stmt2->execute($params);
$pdo = null;
}
header("Location: bbsindex.php");
exit;
}
else{
  header("Location: bbsindex.php");
  exit;
}




?>
</body>
</html>
