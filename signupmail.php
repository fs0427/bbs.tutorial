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
  <h1>Sign up</h1>
  <script>
  function submitChk () {
    var flag = confirm("本当によろしいですか？")
    return flag;
  }
  </script>
  <br>
  <div class="center-block">
<form action="signupmailres.php" method="post" class="form-horizontal" onsubmit="return submitChk()">
  <div class="form-group">
    <label for="inputname" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <input type="email" name="id" id="inutname" class="form-control" placeholder="Username" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="pw" id="inputPassword3" class="form-control" placeholder="Password" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="password" name="pw" id="inputEmail" class="form-control" placeholder="Email" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" value="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
</div>
<br>
<br>
<?php
$id = $_GET['id'];
if(isset($id)){
  echo 'This email address entered is already registered.';
}
 ?>
 <hr>
