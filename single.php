<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                        
                        <div class="post-content single-post">

                        <?php
                        include "admin/config.php";
                        if(isset($_GET['id'])){
                            $id=$_GET['id'];
                        }
                             $select="SELECT 
                            *
                             FROM post_table p
                             LEFT JOIN category c
                             ON p.category=c.cat_id
                             LEFT JOIN users u
                             ON p.post_auther=u.user_id
                             WHERE p.post_id = '$id'
                             ORDER BY p.post_id DESC
                             ";
                             $query=$conn->query($select) or die("select query faild".mysqli_error($conn));
         
while ($row=$query->fetch_assoc()) {
    ?>
                   
                            <h3><?php echo $row['title'] ?></h3>
                            <div class="post-information">
                                
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row['post_date'] ?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img'] ?>" alt=""/>
                            <p class="description">
                            <?php echo $row['post_description'] ?>
                            </p>
                        </div>
                        <?php
}
                        ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
