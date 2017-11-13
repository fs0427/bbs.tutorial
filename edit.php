<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
.nav{
  position:fixed;
  top:0;
  left:0;
  list-style: none;
  overflow: hidden;
}
.nav li{
  float:left;
}
.nav li a{
    padding: 10px 30px 10px 30px; background-color: black;
    display:inline-block;
    color:white;
    font-size: 18px;
    opacity: 0.5;
    text-align: center;

}
.nav li a:hover{
    opacity: 1;
}
body{
  margin-top:80px;
}
pre{
  /* Mozilla */
 white-space: -moz-pre-wrap;
 /* Opera 4-6 */
 white-space: -pre-wrap;
 /* Opera 7 */
 white-space: -o-pre-wrap;
 /* CSS3 */
 white-space: pre-wrap;
 /* IE 5.5+ */
 word-wrap: break-word;
 font-size: 20px;
}
</style>
</head>
<body onload="adustTextarea();">
  <nav>
  <ul class="nav">
    <li><a href="bbsindex.php">Home</a></li>
    <li><a href="postform.php">Post</a></li>
    <li><a href="edit.php">Edit</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</nav>
  <h2>
  Posts
</h2>
<?php
session_start();
if(isset($_SESSION['visit']) and $_SESSION['visit'] !== ""){
  $dsn ='';
  $user='';
  $password='';
  $id = $_SESSION['visit'];

  try{
    $pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_MAX_BUFFER_SIZE=>1024*1024*100));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
  catch (PDOException $e){
  print "error".$e->getMessage()."<br/>";
  die();
}
$sql = "SELECT username FROM user_table WHERE id = '$id'";
$stmt = $pdo->query($sql);
foreach($stmt as $row){
 $row_name = $row["username"];
}
echo "logged in user's "."<b>$row_name</b>";
}

else{
header("Location:loginform.php");
}
if(isset($_POST['id']) and $_POST['id'] !== ""){
$postid = $_POST['id'];
$sql = "DELETE FROM post_table WHERE bookdata ='$postid'";
$stmt = $pdo->query($sql);
}

$sql4 = "SELECT username,auther,bookdata,date,ext,comment,contents FROM post_table WHERE id = '$id'";
$stmt4 = $pdo->query($sql4);
foreach($stmt4 as $row){
  $comment = stripslashes($row["comment"]);
    echo "<hr>";
    if(strstr($row['ext'],"image")){
    if($row["ext"]=="image/jpg"){
    $img = $row["contents"];
    echo '<img src="data:image/jpg;base64,'.$img.'" "width="320" height="240">';}
    if($row["ext"]=="image/jpeg"){
    $img = $row["contents"];
    echo '<img src="data:image/jpeg;base64,'.$img.'" "width="320" height="240">';}
    if($row["ext"]=="image/gif"){
    $img = $row["contents"];
    echo '<img src="data:image/gif;base64,'.$img.'" "width="320" height="240">';}
    if($row["ext"]=="image/bmp"){
    $img = $row["contents"];
    echo '<img src="data:image/bmp;base64,'.$img.'" "width="320" height="240">';}}

    elseif(strstr($row['ext'],'video')){
    if($row["ext"]=="video/mp4"){
    $vid = $row["contents"];
    echo '<video src="data:video/mp4;base64,'.$vid.'" "width="320" height="240" controls></video>';}
    if($row["ext"]=="video/webm"){
    $vid = $row["contents"];
    echo '<video src="data:video/webm;base64,'.$vid.'" "width="320" height="240" controls></video>';}
    if($row["ext"]=="video/mpeg"){
    $vid = $row["contents"];
    echo '<video src="data:video/mpeg;base64,'.$vid.'" "width="320" height="240" controls></video>';}
    if($row["ext"]=="video/x-msvideo"){
    $vid = $row["contents"];
    echo '<video src="data:video/x-msvideo;base64,'.$vid.'" "width="320" height="240" controls></video>';}
    if($row["ext"]=="video/ogg"){
    $vid = $row["contents"];
    echo '<video src="data:video/ogg;base64,'.$vid.'" "width="320" height="240" controls></video>';}
  }
    echo "</br>";
    echo "reviewer ","<b>",$row['username'],"</b>","</br>";
    echo "date ","<b>",$row['date'],"</b>","</br>";
    echo "title ","<b>",$row['bookdata'],"</b>","</br>";
    echo "auther ","<b>",$row['auther'],"</b>","</br>";
    echo "<pre><b>$comment</b></pre>";
    echo "</br>";
    $title = $row['bookdata'];
    $link = "postform.php?id=$title";
    $link2 = "deletepost.php?id=$title";
    echo "<a href='$link'>EDIT</a>";
    echo "</br>";
    echo "<a href='$link2'>DELETE</a>";
}

$pdo = null;
?>
</body>
</html>
