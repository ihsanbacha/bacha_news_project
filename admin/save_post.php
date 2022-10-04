<?php
//// include connection 
// include "config.php";
// if (isset($_POST['save'])) {
//     if (isset($_FILES['img_uploade'])) {
//         $error=array();
//         ///// code for image ////
//         $file_name=$_FILES['img_uploade']['name'];
//         $tmp_name=$_FILES['img_uploade']['tmp_name'];
//         $file_size=$_FILES['img_uploade']['size'];
//         $file_type=$_FILES['img_uploade']['type'];

//         /// img extention
//         $explode=explode('.', $file_name);
//         $explode_name=end($explode);
//         $extention=array('jpeg','png','jpg');

//         if (in_array($explode_name, $extention)===false) {
//             $error[]="this extention file valid please upload jpeg,png,or jpg extention type";
            
//         }

//         //// img size
//         if ($file_size>2097152) {
//             $error[]="the file size must be 2mb or lower";
            
//         }

//         //// chanege file name add time funtion
//         $new_file_name=time()."-".basename($file_name);
//         $target_img="upload/".$new_file_name;

//         if (empty($error)===true) {
//             move_uploaded_file($tmp_name, $target_img);
//         } else {
//             print_r($error);
//             //// take die fuction for if image not upload dont save form data
//             die();
          
//         }

//         //     /// end image code ///
//          }

//         // other input data retrive from form for insertion
//         // and require aouther user_id from session
//         $p_t=mysqli_real_escape_string($conn, $_POST['post_title']);
//         $p_d=mysqli_real_escape_string($conn, $_POST['postdesc']);
//         $category=mysqli_real_escape_string($conn, $_POST['category']);
//         $date=date("d M,Y");

// $insert_update="insert into post_table(title,post_description,post_date,category,post_img)
//                 values('$p_t','$p_d=','$date',' $category','$new_file_name');";
// $insert_update.="upadate category
//                 set post=post +1 
//                 where cate_id='$category'";
//                 $query2=mysqli_multi_query($conn,$insert_update)or die('insert update  query faild:'.mysqli_error($conn));

// // $query2=$conn->multi_query($insert_update)or die('insert update  query faild:'.mysqli_error($conn));                
      

        
//         if ($query2) {
//             header("location:http://localhost/bacha_news_project/admin/post.php");
//         }
    
// }


?>
