
        <?php

///////////  

//// include connection 
include "config.php";


if (isset($_POST['save'])) {
  if(empty($_FILES['img_uploade']['name'])){
    $img_name=$_POST['old_image'];
  }else{
   
        $error=array();
        ///// code for image ////
        $file_name=$_FILES['img_uploade']['name'];
        $tmp_name=$_FILES['img_uploade']['tmp_name'];
        $file_size=$_FILES['img_uploade']['size'];
        $file_type=$_FILES['img_uploade']['type'];

        /// img extention
        $explode=explode('.', $file_name);
        $explode_name=end($explode);
        $extention=array('jpeg','png','jpg');

        if (in_array($explode_name, $extention)===false) {
            $error[]="this extention file valid please upload jpeg,png,or jpg extention type";
        }

        //// img size
        if ($file_size>2097152) {
            $error[]="the file size must be 2mb or lower";
        }

        //// chanege file name add time funtion
        $new_file_name=time()."-".basename($file_name);
        $target_img="upload/".$new_file_name;
        $img_name=$new_file_name;
        if (empty($error)===true) {
            move_uploaded_file($tmp_name, $target_img);
        } else {
            print_r($error);
            //// take die fuction for if image not upload dont save form data
            die();
        }
          //     /// end image code ///
}
    // other input data retrive from form for insertion
    // and require aouther user_id from session
    $id=$_POST['post_id'];
    $post_title=mysqli_real_escape_string($conn, $_POST['post_title']);
    $post_desc=mysqli_real_escape_string($conn, $_POST['postdesc']);
    $category=mysqli_real_escape_string($conn, $_POST['category']);
    $old_category=mysqli_real_escape_string($conn, $_POST['old_category']);
    $date=date("d m,y");


    //// insertion query
    $update1="UPDATE `post_table` SET
                      `title`=?,
                      `post_description`=?,
                      `post_date`=?,
                      `category`=?,
                      `post_img`=?
                 WHERE post_id=? ";

    //// for post record update
    $query1=$conn->prepare($update1) or die("update1 faild".mysqli_error($conn));
    $query1->bind_param("ssssss", $post_title,$post_desc,$date,$category,$img_name,$id);
    $query1->execute();

    ///// for update category
    if ($old_category!=$category) {

        //////////////// update for decrease record from old category ///////////
        $update2="UPDATE `category`
                      SET `post`= post - 1 
                      WHERE cat_id =?";
        $query2="";              
        $query2=$conn->prepare($update2) or die("update2 faild".mysqli_error($conn));
        $query2->bind_param("s", $old_category);
        $query2->execute();

        ///////////////// increase record for new category //////////////////
        $update3="UPDATE `category`
                      SET post = post + 1 
                      WHERE cat_id =? ";
        $query3=$conn->prepare($update3) or die("update3 faild".mysqli_error($conn));
        $query3->bind_param("s", $category);
        $query3->execute();
    }
    if ($query1) {
        header("location:http://localhost/bacha_news_project/admin/post.php");
    }
}

?>