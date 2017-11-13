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

session_start();
$sessionid = $_SESSION["visit"];
$sql = "UPDATE user_table SET cookieid = NULL WHERE id = '$sessionid'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
setcookie('cookieid', '', time() - 1800);

if (isset($_SESSION["visit"])) {
    $errorMessage = "Logout successfuly";
} else {
    $errorMessage = "session timeout";
}
$_SESSION = array();


@session_destroy();
$pdo = null;
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Logout</title>
    </head>
    <body>
        <h1>Logout</h1>
        <div><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
        <ul>
            <li><a href="loginform.php">Back to login menu</a></li>
        </ul>
    </body>
</html>
