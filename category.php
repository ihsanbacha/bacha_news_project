<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

                    <?php
                    /// include connection
                    include "admin/config.php";
                    /// include get id
                    if (isset($_GET['pid'])) {
                        $cat_id = $_GET['pid'];
                    }
                    //// select data from tables
                    $limit=3;
                    $select = "SELECT * FROM `post_table`p
                      LEFT JOIN users u
                      ON p.post_auther=u.user_id
                      LEFT JOIN category c
                      ON p.category=c.cat_id
                      WHERE p.category='$cat_id' 
                      limit {$limit}";
                    $query = $conn->query($select) or die("select query faild:"
                        . mysqli_error($conn));
                    
                        $row = mysqli_fetch_assoc($query);
                        //// show cat_name on heading
                        echo "<h2 class='page-heading'>{$row['cat_name']}</h2>";
                    
                    //// take while loop 
                    while ( $row = mysqli_fetch_assoc($query)) {
                       
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
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row['post_auther'] ?>'><?php echo $row['username'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date'] ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo substr( $row['post_description'],0,130)."...." ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>
                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <ul class='pagination'>
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                    </ul>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>