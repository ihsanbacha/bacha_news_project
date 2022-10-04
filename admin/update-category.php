<?php include "header.php"; ?>

<?php ///////// include connection //////////////
       include "config.php";
      //////////// fatch data ///////////////
      $id=$_GET['cat_id'];
      $select="select * from category where cat_id='$id'";
      $query = mysqli_query($conn,$select) or die('select query faild :'.mysqli_error($conn)); 


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">

              <?php
              ////////////// while loop for fetch data
                     if(mysqli_num_rows($query)>0){

              while ($row=mysqli_fetch_assoc($query)) {
    ?>

                  <form action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="1" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['cat_name'] ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Update" required />
                  </form>
<?php
}
//// end while loop
}
?>

                  <?php
                  ////////////// update data
if (isset($_POST['save'])) {
    $cat_name=mysqli_real_escape_string($conn, $_POST['cat_name']);
   
$id=$_GET['cat_id'];

$update="UPDATE `category`
         SET`cat_name`='$cat_name'
         WHERE cat_id=$id";

//    $update1="UPDATE `category`
//    SET`cat_name`='$cat_name'
//    WHERE cat_id='$id'";
   $query2=mysqli_query($conn,$update) or die('update query faild:'.mysqli_error($conn));

   if($query2){
    header("location:http://localhost/bacha_news_project/admin/category.php");
   }

}
                  ?>
                </div>
              </div>
            </div>
          </div>


<?php include "footer.php"; ?>
