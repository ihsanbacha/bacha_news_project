<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">



        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
    <?php
include "config.php";
$id=$_GET['p_id'];
$select2="SELECT * FROM `post_table` WHERE post_id=$id";
$query2=$conn->query($select2);

while($row2=mysqli_fetch_assoc($query2)){


?>
        <!-- Form for show edit-->
        <form action="save_upadate_post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row2['post_id'] ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row2['title'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                <?php echo $row2['post_description'] ?>
                </textarea>
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
                            <?php while ($row=$query->fetch_assoc()) {
                              if($row2['category']==$row['cat_id']){
                                $selected="selected";
                              }
                              else{
                                $selected="";
                              }
                              
                              ?>
                              
                              <option value="<?php echo $row['cat_id'] ?>" $selected><?php echo $row['cat_name'] ?></option>
                              <?php
                                }
                                ?>
                          </select>
                          <input type="hidden" name="old_category" value="<?php echo $row2['category']; ?>">
                      </div>
            <div class="form-group">
                <label for="">Post image</label>
             
              <input type="file" name="img_uploade">
               <img  src="upload/<?php echo $row2['post_img']; ?>" height="150px">
               <input type="" name="old_image" value="<?php echo $row2['post_img']; ?>">

               
               
            </div>
            <input type="submit" name="save" class="btn btn-primary" value="Update" />
        </form>
        <?php }?>
        <!-- Form End ---

      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
