<?php include "header.php"; ?>
<?php ///////// include connection //////////////
       include "config.php";
      //////////// fatch data ///////////////
      $id=$_GET['id'];
      $select="select * from users where user_id='$id'";
      $query = mysqli_query($conn,$select) or die('select query faild :'.mysqli_error($conn)); 


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                <?php
                     if(mysqli_num_rows($query)>0){

                        while($row=mysqli_fetch_assoc($query)){
                        
                    
                ?>
                  <!-- Form Start -->
                  <form  action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id'] ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                          <?php
                          if($row['role']==1 ){
                             echo '<option value="1">Admin</option>';
                          }  
                          elseif($row['role']==0)
                          {
                             echo'<option value="0">normal User</option>';
                          }
                          
                          
                          
                          ?>
                              
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->
                  <?php
          
        }
    }
                  ?>
                  <?php
if (isset($_POST['submit'])) {
    $f_name=mysqli_real_escape_string($conn, $_POST['f_name']);
    $l_name=mysqli_real_escape_string($conn, $_POST['l_name']);
    $username=mysqli_real_escape_string($conn, $_POST['username']);
    $role=mysqli_real_escape_string($conn, $_POST['role']);


   $update="UPDATE `users`
   SET`first_name`='$f_name',`last_name`='$l_name',`username`='$username',`role`='$role'
   WHERE user_id='$id'";
   $query2=mysqli_query($conn,$update) or die('update query faild:'.mysqli_error($conn));

}
                  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
