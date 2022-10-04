



<?php include "header.php"; ?>
<?php
  //////////// include connection ////////////////
  include "config.php";
  //////////// retrive data from database ////////////

  ////// paginanation part 1////
  $i=0;
  $no=0;
  $hal = $_GET['hal'];
  if(!isset($_GET['hal']))
  {
      $page = 1;
  }
  else
  {
      $page = $_GET['hal'];
  }

  $max_show = 2;// this is the option that how many items do you want to show each page

  $from     = (($page * $max_show) - $max_show);
  $query_banner = "SELECT * FROM users
                   ORDER BY `user_id` DESC
                  LIMIT {$from},{$max_show}" or die(mysqli_error($conn));
                  $query1=mysqli_query($conn,$query_banner);

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
                    if(mysqli_num_rows($query1)>0){
                        while($row=mysqli_fetch_assoc($query1)){

                  
                    ?>
                        <tr>
                            <td class='id'><?php echo $row['user_id'] ?></td>
                            <td><?php echo $row['first_name'].$row['last_name'] ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php if(  $row ['role'] ==1){
                                 echo"admin";
                              } 
                              else{
                                echo"normal";
                              }
                              ?></td>
                            <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id']; ?>'><i
                                        class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete.php?id=<?php echo $row['user_id']; ?>'><i
                                        class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php
                               }
                            }
                           
                         ?>
                    </tbody>
                </table>



                <?php
 /////// find total record for pagination///////
 $total_results = "SELECT COUNT(*)  FROM users"; 
                $query2=mysqli_query($conn,$total_results);
                  $row=mysqli_num_rows($query2);
                $total_pages = ceil($row / $max_show); 

 echo"<ul class='pagination admin-pagination'>";

 if($hal > 1){ 
  $prev = ($page - 1); 
  echo "<li><a href=$_SERVER[PHP_SELF]?hal=$prev>← Previous </a></li> "; 
} 

for($i = 1; $i <= $total_pages; $i++){ 
  if($hal == $i){ 
      echo "$i "; 
  } else { 
      echo'<li class=""><a href="users copy.php?hal='.$i.'">'.$i.'</a></li>';
} 
}
// Build Next Link 
if($hal < $total_pages){ 
  $next = ($page + 1); 
  echo '<li><a href=<a href="users copy.php?hal='.$next.'">Next →</a></li>'; 
  
} 
 
   echo"</ul>";

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