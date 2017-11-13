<html>
<head>
<meta charset="utf-16">
</head>
<body>
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
$sql = 'ALTER TABLE user_table ADD flag boolean';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$pdo = null;
 ?>
</body>
</html>
