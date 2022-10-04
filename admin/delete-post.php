<?php
include "config.php";
$post_id=$_GET['p_id'];
$cat_id=$_GET['c_id'];

//// 1 select data from database and unlink data from folder///
$select="select * from post_table where post_id='$post_id'";
$query=$conn->query($select) or die('$select faild'.mysqli_error($conn));
$row=mysqli_fetch_assoc($query);

////image unlink from folder///
if($row){
    unlink("upload/".$row['post_img']);
}


//// delete record  from database
$delete_update="delete from post_table where post_id='$post_id';";
$delete_update.="UPDATE `category`
                 SET `post`= `post`-1
                 WHERE `cat_id`='$cat_id'";



$query2=mysqli_multi_query($conn,$delete_update) or die('$delete faild'.mysqli_error($conn));

if($query2){
    
    header("location:http://localhost/bacha_news_project/admin/post.php");
    
}








?>