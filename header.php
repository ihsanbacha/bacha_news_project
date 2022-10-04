<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>News</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">

                    <a href="index.php" id="logo"><img src="images/BACHA.png"></a>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <?php
                include "admin/config.php";
                $select = "SELECT * FROM `category`where post > 0";
                $query = mysqli_query($conn, $select) or die('select query faild:' . mysqli_error($conn));
                if (mysqli_num_rows($query) > 0) {
                    $active = "";
                ?>
                    <div class="col-md-12">
                        <ul class='menu'>
                        <?php
                        if (isset($_GET['cid'])) {
                            $cat_id = $_GET['cid'];
                        }
                        echo "<li><a  class='{$active}' href='http://localhost/bacha_news_project/index.php'>Home</a></li>";
                        while ($row = mysqli_fetch_assoc($query)) {
                            if (isset($_GET['cid'])) {
                                if ($row['cat_id'] == $cat_id) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                            }
                        echo "<li><a class='{$active}'; href='category.php?cid={$row['cat_id']}'>{$row['cat_name']}</a></li>";
                        }
                    }



                        ?>


                        </ul>
                    </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->