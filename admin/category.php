<?php include "header.php";

if($_SESSION['role'] == 0 ){
    header("location:http://localhost/bacha_news_project/admin/post.php");
  }

?>

<?php
//////////// include connection ////////////////
include "config.php";
//////////// retrive data from database ////////////

////// paginanation part 1////
include "function.php";
$select = "SELECT * FROM `category` ORDER BY cat_id DESC limit {$offset},{$limit}";
$query = mysqli_query($conn, $select) or die('select query faild:' . mysqli_error($conn));
?>


<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
<?php
                    if (mysqli_num_rows($query) > 0) {
              while ($row = mysqli_fetch_assoc($query)) {
            ?>

                        <tr>
                            <td class='id'><?php echo $row['cat_id'] ?></td>
                            <td><?php echo $row['cat_name'] ?></td>
                            <td><?php echo $row['post'] ?></td>
                            <td class='edit'><a href='update-category.php?cat_id=<?php echo $row['cat_id'] ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?cat_id=<?php echo $row['cat_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <tr>
                        <?php
              }
            }

            ?>
                  
                    </tbody>
                </table>

                <?php
        /////// find total record for pagination///////
        $select3 = "SELECT * from category order by cat_id desc";
        $query3 = mysqli_query($conn, $select3) or die('select 3 query faild :');

if (mysqli_num_rows($query3) > 0) {
    $total_record = mysqli_num_rows($query3);

    $total_pages = ceil($total_record / $limit);
}
          echo "<ul class='pagination admin-pagination'>";
         $pagination_control($page,$total_pages);
        echo " </ul>";

        ?>


                <!-- <ul class='pagination admin-pagination'>
                    <li class="active"><a>1</a></li>
                    <li><a>2</a></li>
                    <li><a>3</a></li>
                </ul> -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
