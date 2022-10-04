<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
              <?php
                           include "config.php";
                           //// include pagination function 
                           include "function.php";
                           $s_user_id= $_SESSION['user_id'];

if ($_SESSION['role']==1) {


    ///// data select from post table and category table and user table;
    $select="SELECT 
                                           p.post_id,   
                                           p.title,
                                           p.post_description,
                                           p.post_date,
                                           p.post_auther,
                                           u.username,
                                           c.cat_name,
                                           c.cat_id
                                           FROM post_table p
                                           LEFT JOIN category c
                                           ON p.category=c.cat_id
                                           LEFT JOIN users u
                                           ON p.post_auther=u.user_id
                                           ORDER BY p.post_id DESC
                                           LIMIT {$offset},{$limit}";
    $query=$conn->query($select) or die("select query faild".mysqli_error($conn));
}elseif ($_SESSION['role']==0) {
    $select="SELECT 
    p.post_id,   
    p.title,
    p.post_description,
    p.post_date,
    p.post_auther,
    u.username,
    c.cat_name,
    c.cat_id
    FROM post_table p
    LEFT JOIN category c
    ON p.category=c.cat_id
    LEFT JOIN users u
    ON p.post_auther=u.user_id
    where p.post_auther= '$s_user_id'
    ORDER BY p.post_id DESC
    LIMIT {$offset},{$limit}";
$query=$conn->query($select) or die("select query faild".mysqli_error($conn));
}
                         ?>

                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                        $s=1;
                    while ($row=$query->fetch_assoc()) {
                        ?>
                          <tr>
                              <td hidden><?php echo $row['post_id']; ?></td>
                              <td><?php echo $row['title']; ?></td>
                              <td class='serial'><?php echo $s; ?></td>
                              <td><?php echo $row['cat_name']; ?></td>
                              <td><?php echo $row['post_date']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td class='edit'><a href='update-post.php?p_id=<?php echo $row['post_id']; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?p_id=<?php echo $row['post_id']; ?> & c_id= <?php echo $row['cat_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                            <?php
                             $s++;
                            }
                         $pid="$row{['post_id']}";
                            $pid=$_SERVER['PHP_SELF'];
                            ?>
                         
                      </tbody>
                  </table>

                  <?php
                   $select3 = "SELECT * from post_table where post_auther='$s_user_id' order by post_id desc";
                   $query3 = mysqli_query($conn, $select3) or die('select 3 query faild :');
           
           if (mysqli_num_rows($query3) > 0) {
               $total_record = mysqli_num_rows($query3);
           
               $total_pages .= ceil($total_record / $limit);
           }

                echo"<ul class='pagination admin-pagination'>";
                 
                echo $pagination_control($page,$total_pages);
                  
                 echo"</ul>";
                  ?>
                  
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
