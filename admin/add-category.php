<?php include "header.php"; ?>

<?php
///////////// include connection //////////  
include "config.php";
///////////// retrive data from data from form ///////////////
if (isset($_POST['save'])) {
    $cat_name=mysqli_real_escape_string($conn, $_POST['cat']);
    /////////////// don't save duplicate data /////////////
    $select="SELECT`cat_name`FROM `category` WHERE cat_name='$cat_name'";
    $query=mysqli_query($conn, $select) or die('select query faild');
    if (mysqli_num_rows($query)>0) {
        echo"username already exist in database";
    } else {
        $insert="INSERT INTO `category`(`cat_name`)
             VALUES ('$cat_name')";
        $query2=mysqli_query($conn, $insert) or die('insert query faild :'.mysqli_error($conn));
    }
    header("location:http://localhost/bacha_news_project/admin/category.php");
}

?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
