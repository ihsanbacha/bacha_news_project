<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

                    <?php

                    include "admin/config.php";
                    //  include "admin/function.php";
                     include "function_for_pid.php";



                    if(isset($_GET['pid'])){
                        
                        $pid=$_GET['pid'];

                        
                    }
                    $select = "SELECT *
                    FROM post_table p
                    LEFT JOIN category c
                    ON p.category=c.cat_id
                    LEFT JOIN users u
                    ON p.post_auther=u.user_id
                    WHERE username LIKE '%{$pid}%'
                    OR    cat_name LIKE'%{$pid}%'
                    OR    title LIKE'%{$pid}%'
                    OR    post_description LIKE'%{$pid}%'
                    ORDER BY p.post_id DESC
                    LIMIT {$offset},{$limit}
                    ";
    $query=$conn->query($select) or die("select query faild".mysqli_error($conn));
    $totol_result=mysqli_num_rows($query);

    echo" <h2 class='page-heading'>total result ($page => $totol_result)</h2>";

   
    while ($row = $query->fetch_assoc()) {
        ?>

                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>"><img src="admin/upload/<?php echo $row['post_img'] ?>" alt="" /></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $row['category'] ?>'><?php echo $row['cat_name'] ?></a>
                                            </span>
                                            <!-- remove auther -->
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date'] ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                            <?php echo substr($row['post_description'], 0, 130) ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                   }
                   /// find total record for pagination
                   $select2 = "SELECT *
                   FROM post_table p
                   LEFT JOIN category c
                   ON p.category=c.cat_id
                   LEFT JOIN users u
                   ON p.post_auther=u.user_id
                   WHERE username LIKE '%{$pid}%'
                   OR    cat_name LIKE'%{$pid}%'
                   OR    title LIKE'%{$pid}%'
                   OR    post_description LIKE'%{$pid}%'
                   ORDER BY p.post_id DESC
                   ";
                   $query2=mysqli_query($conn,$select2);
                   if(mysqli_num_rows($query2)>0){
                    $total_record=mysqli_num_rows($query2);
                    $total_pages=ceil($total_record/$limit);
                    //// echo ul tag
                    echo"<ul class='pagination admin-pagination'>";
               
                    $pagination_control($total_pages,$page,$pid);
                    echo"</ul>";
                   }
                  ?>
                  

                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>