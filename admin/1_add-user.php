<?php include "header.php"; ?>

<?php
///////////// include connection //////////  
include "config.php";
///////////// retrive data from data from form ///////////////
if (isset($_POST['save'])) {
    $f_name=mysqli_real_escape_string($conn, $_POST['fname']);
    $l_name=mysqli_real_escape_string($conn, $_POST['lname']);
    $username=mysqli_real_escape_string($conn, $_POST['user']);
    $pass=md5($_POST['password']);
    $role=mysqli_real_escape_string($conn, $_POST['role']);
    /////////////// don't save duplicate data /////////////
    $select="SELECT`username`FROM `users` WHERE username='$username'";
    $query=mysqli_query($conn, $select) or die('select query faild');
    if (mysqli_num_rows($query)>0) {
        echo"username already exist in database";
    } else {
        $insert="INSERT INTO `users`(`first_name`, `last_name`, `username`, `password`, `role`)
             VALUES ('$f_name','$l_name','$username','$pass','$role')";
        $query2=mysqli_query($conn, $insert) or die('insert query faild :'.mysqli_error($conn));
    }
    header("location:http://localhost/bacha_news_project/admin/users.php");
}

?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
   <?php

   ?>
   
<?php include "footer.php"; ?>
