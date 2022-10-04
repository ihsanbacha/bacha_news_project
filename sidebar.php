<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="pid" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <?php
        $limit=4;
         $select = "SELECT *
         FROM post_table p
         LEFT JOIN category c
         ON p.category=c.cat_id
         LEFT JOIN users u
         ON p.post_auther=u.user_id
         ORDER BY p.post_id desc
         LIMIT {$limit}
         ";

$query=$conn->query($select) or die("select query faild".mysqli_error($conn));

echo"<h4>Recent Posts</h4>";
while ($row = $query->fetch_assoc()) {
    ?>
        
        
        <div class="recent-post">
            <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>">
                <img src="admin/upload/<?php echo $row['post_img'] ?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?id=<?php echo $row['post_id'] ?>"><?php echo $row['title'] ?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?pid=<?php echo $row['category'] ?>'><?php echo $row['cat_name'] ?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $row['post_date'] ?>
                </span>
                <a class="read-more" href="single.php?id=<?php echo $row['post_id'] ?>">read more</a>
            </div>
        </div>
        <?php
}
    ?>
   
    </div>
   
    <!-- /recent posts box -->
</div>
