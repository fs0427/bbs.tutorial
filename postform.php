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

<script>
function submitChk () {
  var flag = confirm("本当によろしいですか？")
  return flag;
}
</script>
</head>
<body>
  <h2>
  Post Form
</h2>
<?php
session_start();
if(isset($_SESSION['visit']) and $_SESSION['visit'] !== ""){


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
$getid = $_GET["id"];
if(isset($getid) and $getid !== ""){
  $sql2 = "SELECT auther,bookdata,comment FROM post_table WHERE bookdata = '$getid'";
  $stmt2 = $pdo->query($sql2);
  foreach($stmt2 as $row){
 $auther = $row["auther"];
 $title = $row["bookdata"];
 $data = $row["comment"];
}
}
$sessionid = $_SESSION["visit"];
$sql = "SELECT username FROM user_table WHERE id = '$sessionid'";
$stmt = $pdo->query($sql);
foreach($stmt as $row){
 $row_name = $row["username"];
}
echo "logged in user's ".$row_name;
  }
else{
  header("Location:loginform.php");
  exit;
}
$pdo = null;
?>
<hr size="5" color="black">
<div class="center-block">
<form action="postres.php" method="post" class="form-horizontal" onsubmit="return submitChk()">
<div class="form-group">
  <label for="title" class="col-sm-2 control-label">Title</label>
  <div class="col-sm-10">
    <input type="text" name="id" id="title" class="form-control" placeholder="Title"  value = "<?php if(isset($getid) and $getid !== ''){
      echo $title;
    }?>" required>
  </div>
</div>
<input type="hidden" name="post" value = "post">
<div class="form-group">
  <label for="auther" class="col-sm-2 control-label">auther</label>
  <div class="col-sm-10">
    <input type="text" name="pw" id="auther" class="form-control" placeholder="Auther" value = "<?php if(isset($getid) and $getid !== ''){
      echo $auther;
    }?>" required>
  </div>
</div>
<div class="form-group">
  <label for="comment" class="col-sm-2 control-label">Comment</label>
  <div class="col-sm-10">
  <textarea name="comment" id ="comment" class="form-control" required><?php if(isset($getid) and $getid !== ''){
      echo $data;
    }?></textarea>
  </div>
</div>
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <input type = "hidden" name ="edit" value = "<?php if(isset($getid) and $getid !== ''){
      echo $getid;
    }?>" >
    <br>
    Select the file.(* only img,vid)
    <input type="file" name="file">
    <br>
    <button type="submit" value="submit" class="btn btn-default">POST</button>
  </div>
</div>
</form>
</div>
</body>
</html>
