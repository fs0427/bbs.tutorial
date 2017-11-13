<html>
<head>
<meta charset="utf-16">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="boostrap/js/bootstrap.min.js"></script>
<style type="text/css">
h1{
  position:relative;
  left:15px;
}
a{
  position:relative;
  left:15px;
}
</style>
</head>
<body>
  <h1>Login</h1>
    <br>
  <script>
  function submitChk () {
    var flag = confirm("本当によろしいですか？")
    return flag;
  }
  </script>
  <div class="center-block">
<form action="loginform.php" method="post" class="form-horizontal" onsubmit="return submitChk()">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" name="id" id="inputEmail3" class="form-control" placeholder="Email" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="pw" id="inputPassword3" class="form-control" placeholder="Password" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" value="submit" class="btn btn-default">Log in</button>
    </div>
  </div>
</form>
</div>
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
   if(isset($_COOKIE['cookieid'])){
    $cookieid = $_COOKIE['cookieid'];
    $sql2 = "SELECT COUNT(cookieid) FROM user_table WHERE cookieid = '$cookieid'";
    $stmt2 = $pdo->query($sql2);
    $sql4 = "SELECT id FROM user_table WHERE cookieid = '$cookieid'";
    $stmt4 = $pdo->query($sql4);
    foreach($stmt4 as $row){
      $id = $row["id"];
    }
    if($stmt2!==0){
      session_start();
      $_SESSION['visit'] = $id;
      header("Location: bbsindex.php");
      exit;
    }
    else{
      session_start();
      $_SESSION['visit'] = $id;
      header("Location: bbsindex.php");
      exit;
      }

  }
  if(isset($_POST["pw"]) and $_POST["pw"]!=""){
    $post_pw = $_POST["pw"];
    $post_id = $_POST["id"];
  $sql = "SELECT password,flag,id FROM user_table WHERE email = '$post_id'";
  $stmt = $pdo->query($sql);
  foreach ($stmt as $row) {
    $row_pw = $row["password"];
    $row_flag = $row["flag"];
    $id = $row["id"];
    }
    $true = '1';
    if($row_flag === $true){
  if($row_pw == $post_pw){
    session_start();
    $_SESSION['visit'] = $id;
    $cookie = md5(uniqid(rand(),1));
    setcookie('cookieid',$cookie,time()+60*60*24*7);
    $sql3 = "UPDATE user_table SET cookieid = :cookieid WHERE email = :id";
    $stmt3 = $pdo->prepare($sql3);
    $params = array(':cookieid' => $cookie, ':id'=> $post_id);
    $stmt3->execute($params);
      header("Location: bbsindex.php");
      exit;
}
elseif(isset($_POST["pw"]) and $_POST["pw"]!==""){
  echo "The username or password you entered is incorrect";
  echo "</br>";
}}
else{
  echo "Registration have not completed yet!! Please check email.";
  echo "</br>";
}

}

$pdo = null;
?>
<a href="signupmail.php">Sign up</a>
</form>
<hr>
</body>
</html>
