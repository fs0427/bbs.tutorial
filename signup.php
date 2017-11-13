<html>
<head>
<meta charset="utf-16">
</head>
<body>
  <h1>Sign up</h1>
  <script>
  function submitChk () {
    var flag = confirm("本当によろしいですか？")
    return flag;
  }
  </script>

<form action="signupres.php" method="post" onsubmit="return submitChk()">
<h5>
Username
<input type="text" name="name">
<br>
password
<input type="password" name="pw" minlength="8" required/>
<br>
<input type="submit" value="submit" />
<br><br>
</h5>
</form>
<p>
</p>
<hr>
</body>

</html>
