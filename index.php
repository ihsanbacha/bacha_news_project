<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        
        
            <div class="row">
                <div class="col-md-8">
                <div class="post-container">
                    <?php

                    include "admin/config.php";
                    include "admin/function.php";


                    $select = "SELECT 
                    p.post_id,   
                    p.title,
                    p.post_description,
                    p.post_date,
                    p.post_auther,
                    p.post_img,
                    p.category,
                    u.username,
                    u.user_id,
                    c.cat_name,
                    c.cat_id
                    FROM post_table p
                    LEFT JOIN category c
                    ON p.category=c.cat_id
                    LEFT JOIN users u
                    ON p.post_auther=u.user_id
                    ORDER BY p.post_id DESC
                    LIMIT {$offset},{$limit}";
                    $query = $conn->query($select) or die("select query faild" . mysqli_error($conn));

                    while ($row = $query->fetch_assoc()) {
                    ?>

                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">

                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img'] ?>" alt="" /></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title'] ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?pid=<?php echo $row['category']?>'><?php echo $row['cat_name'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?pid=<?php echo $row['post_auther']; ?>'><?php echo $row['username'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date'] ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                            <?php echo substr($row['post_description'], 0, 130) . "....."; ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    $select3 = "SELECT * from post_table order by post_id desc";
                    $query3 = mysqli_query($conn, $select3) or die('select 3 query faild :');

                    if (mysqli_num_rows($query3) > 0) {
                        $total_record = mysqli_num_rows($query3);

                        $total_pages .= ceil($total_record / $limit);
                    }

                    echo "<ul class='pagination admin-pagination'>";

                    echo $pagination_control($page, $total_pages);

                    echo "</ul>";
                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>