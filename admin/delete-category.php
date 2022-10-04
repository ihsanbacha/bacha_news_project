<?php
include "config.php";

$id=$_GET['cat_id'];
$delete="delete from category where cat_id='$id'";
$query=mysqli_query($conn,$delete) or die('delete query faild :'.mysqli_error($conn));

header("location:http://localhost/bacha_news_project/admin/category.php");

?>