<?php include "header.php"; ?>
<?php


if($_SESSION['role'] == 0 ){
  header("location:http://localhost/bacha_news_project/admin/post.php");
}


//////////// include connection ////////////////
include "config.php";
include "function.php";
//////////// retrive data from database ////////////

$select = "select * from users ORDER BY user_id DESC limit {$offset},{$limit}";
$query = mysqli_query($conn, $select) or die('select query faild:' . mysqli_error($conn));
?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1 class="admin-heading">All Users</h1>
      </div>
      <div class="col-md-2">
        <a class="add-new" href="1_add-user.php">add user</a>
      </div>
      <div class="col-md-12">
        <table class="content-table">
          <thead>
            <th>S.No.</th>
            <th>Full Name</th>
            <th>User Name</th>
            <th>Role</th>
            <th>Edit</th>
            <th>Delete</th>
          </thead>
          <tbody>
            <?php
            if (mysqli_num_rows($query) > 0) {
              $s=1;
              while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                <td class='id'><?php echo $s ?></td>
                  <td class='id' hidden><?php echo $row['user_id'] ?></td>
                  <td><?php echo $row['first_name'] . $row['last_name'] ?></td>
                  <td><?php echo $row['username']; ?></td>
                  <td><?php if ($row['role'] == 1) {
                        echo "admin";
                      } else {
                        echo "normal";
                      } ?></td>
                  <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-edit'></i></a></td>
                  <td class='delete'><a href='delete.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                </tr>
            <?php
            $s++;
              }
              
            }

            ?>
          </tbody>
        </table>
        <?php
        include "function.php";
        /////// find total record for pagination///////
        $select3 = "SELECT * from users order by user_id desc";
        $query3 = mysqli_query($conn, $select3) or die('select 3 query faild :');

if (mysqli_num_rows($query3) > 0) {
    $total_record = mysqli_num_rows($query3);

    $total_pages .= ceil($total_record / $limit);
}
    echo "<ul class='pagination admin-pagination'>";

        echo $pagination_control($page,$total_pages);

        echo " </ul>";

        ?>

      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>