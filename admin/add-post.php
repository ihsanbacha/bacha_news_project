<?php include "header.php";
////// add post


//// include connection 
include "config.php";
if (isset($_POST['save'])) {
    if (isset($_FILES['img_uploade'])) {
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
            $error[]="this extention file not  valid please upload jpeg,png,or jpg extention type";
            
        }

        //// img size
        if ($file_size>2097152) {
            $error[]="the file size must be 2mb or lower";
            
        }

        //// chanege file name add time funtion
        $new_file_name=time()."-".basename($file_name);
        $target_img="upload/".$new_file_name;

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
        $p_t=mysqli_real_escape_string($conn, $_POST['post_title']);
        $p_d=mysqli_real_escape_string($conn, $_POST['postdesc']);
        $category=mysqli_real_escape_string($conn, $_POST['category']);
        $date=date("d M,Y");
        $auther=$_SESSION['user_id'];
        

            $insert="INSERT INTO `post_table`(`title`, `post_description`, `post_date`, `category`,post_img,post_auther) 
                                            VALUES (?,?,?,?,?,?);";
            $query3=$conn->prepare($insert)or die('$insert query faild:'.mysqli_error($conn));
            $query3->bind_param("ssssss",$p_t,$p_d,$date,$category,$new_file_name,$auther);
            $query3->execute();

            ///// for update
            $update="UPDATE `category` SET`post`=post +1 WHERE `cat_id`=?";

            $query2=$conn->prepare($update)or die('$update query faild:'.mysqli_error($conn));
            $query2->bind_param("s",$category);
            $query2->execute();
            ////  

      
      

        
        if ($query2 and ($query3)) {
            header("location:http://localhost/bacha_news_project/admin/post.php");
        }
    
}

////////// end add post

?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <?php
                      ///// show category in option tag
                      include "config.php";
                      $select="SELECT * FROM `category`";
                      $query=$conn->query($select);
                      //// take while ioop for fetch data

    ?>
                  

                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control">
                            <?php while ($row=$query->fetch_assoc()) {?>
                              <option value="<?php echo $row['cat_id'] ?>" selected><?php echo $row['cat_name'] ?></option>
                              <?php
                                }
                                ?>
                          </select>
                         
                      </div>
                

      
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="img_uploade" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
