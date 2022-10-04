<?php
include "config.php";

$id=$_GET['id'];
$delete="delete from users where user_id='$id'";
$query=mysqli_query($conn,$delete) or die('delete query faild :'.mysqli_error($conn));

header("location:http://localhost/bacha_news_project/admin/users.php");

?>