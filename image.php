<?php

 $id = "aaa";
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
    $stmt5 = $pdo->query("SELECT * FROM post_table WHERE auther='$id'");
    foreach($stmt5 as $row){
    $ext = $row["ext"];
    $file = $row["contents"];

    }
      echo $ext;
mb_http_output("pass");
header("Content-type: image/jpg");
echo $file;

$pdo = null;
?>
