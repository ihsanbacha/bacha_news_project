<?php include "header.php"; ?>
<?php
///// 1 connection include /////
include "config.php";
//////// 2 this first query is just to get the total count of rows //////////
$select1="SELECT COUNT(user_id) from users ";
$query=mysqli_query($conn,$select1) or die('select 1 query faild'.mysqli_error($conn));
$row=mysqli_fetch_row($query);
// print_r($row);
// die();

////////3 here we have the total row count //////////
$rows=$row[0];
/////// 4 this is the number of results we want displayed per page //////
$page_rows=1; 
////// 5 this tells us the page number of our last page ///////
$last = ceil($rows/$page_rows);
////// 6 this make sure $last cannot be less than 1 ///////
if($last<1){
    $last=1;
}
///// 7 establish the $page_num variable //////
$page_num= 1;
///// 8 get page_num from url vars if it is present, else its is =1 /////////
if(isset($_GET['pn'])){
    $page_num = preg_replace('#[^0-9]#', '' , $_GET['pn']);
}
//// 9 this make s sure the page number isn't below 1 , or more than our $last page //////
if ($page_num < 1){
    $page_num =1 ;
}
else if($page_num>$last){
$page_num= $last;
}
///// 10 this sets the range of rows to query for the chosen $page_num //////
$limit=$page_rows;
$offsit =($page_num - 1) *$limit; 
/// 11 this is your query agian ti is for grabbing just one page worth of rows by applying $limit //////
$select2="SELECT COUNT(user_id) from users  order by user_id desc LIMIT {$offsit},{$limit}";
$query2=mysqli_query($conn,$select2) or die('select 2 query faild'.mysqli_error($conn));
// print_r($query2);
// die();
//// 12 this shows the user what page they are on, and the total number of page /////
$text_line1 = "users (<b>$rows</b>)";
$text_line2= "page <b>$page_num</b> of <b>$last</b>";
//// 13 establishment the $page_ctrl varible/////


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
              while ($row = mysqli_fetch_assoc($query2)) {
            ?>
                <tr>
                  <td class='id'><?php echo $row['user_id'] ?></td>
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
              }
            ?>
          </tbody>
        </table>
        <?php
                echo "<ul class='pagination admin-pagination'>";

                $page_ctrl = '';
                ////14 if there is more than 1 page worth of results ////
                if($last !=1){
                    // 15 first we check if we are on page one. if we are then we don't need a link
                    // to the previous page or the first page  so we do nothing . if we aren't the we
                    //generate links to the first page, and to the previous page.
                    if($page_num>1){
                        $previous = $page_num-1;
                       echo $page_ctrl.='<li class=""><a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">previous</a></li>';

                    }
                        ///// 16 render clickable number links that should appear on the left of the target page number
                    //     for($i = $page_num-4; $i<$page_num; $i++){
                    //       if($i >0){
                    //          echo $page_ctrl.='<li class=""><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a></li>'; 
                    //       }
                      
                    //       }
                    // /// 17 render the target page number, but without it being link
                    // $page_ctrl .=''.$page_num;
                    //  ///// 18 render clickable number links that should appear on the right of the target page number
                    //  for ($i=$page_num; $i <=$last ; $i++) { 
                    //     echo $page_ctrl.='<li class=""><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a></li>'; 
                    //     if($i >=$page_num+4){
                    //         break;
                    //     }
                    // }
                    // this does the same as above only checking if we are on the last page,
                    // and then genrating the "next"
                    if($page_num !=$last){
                        $next=$page_num+1;
                       echo $page_ctrl.='<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">next</a></li>'; 
                
                    }
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