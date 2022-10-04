<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN | Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <img class="logo" src="images/BACHA.png">
                    <h3 class="heading">Admin</h3>
                    <!-- Form Start -->
                    <form action="" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="" required>
                        </div>
                        <input type="submit" name="login" class="btn btn-primary" value="login" />
                    </form>
                    <!-- /Form  End -->
                    <?php
                    if (isset($_POST['login'])) {
                        //// include connection 
                        include "config.php";
                        //// pick input data from form 
                        $username = mysqli_real_escape_string($conn, $_POST['username']);
                        $pass=md5($_POST['password']);
                        ///// select data from data base
                        $select = "SELECT * FROM `users` WHERE username=? AND `password`= ? ";
                        $query = $conn->prepare($select) or die("select query faild:" . mysqli_error($conn));
                        $query->bind_param("ss",$username,$pass);
                        $query->execute();
                        
                        $result=  $query->get_result();
                        if($result->num_rows>0){
                             ///// create a session and assign user data  
                            while($row=$result->fetch_assoc()){
                                session_start();
                                $_SESSION['username']=$row['username'];
                                $_SESSION['user_id']=$row['user_id'];
                                $_SESSION['role']=$row['role'];
    
                                  /// go to post page
                                  
    
                            }
                                    // header('location: http://' . $_SERVER['HTTP_HOST'] . '/admin/post.php');
                                 header("location:http://localhost/bacha_news_project/admin/post.php");
                         }else{
                            echo"username or password are  incorect";
                         }                        
                    }

                    ?>