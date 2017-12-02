<?php
include'connection.php';
include 'include.php';
session_start();
if(isset($_SESSION["username"])){
    header('Location:dashboard.php');
}
error_reporting(0);
if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $enc_password = md5($password);

    $login_sql = "SELECT username,password from users where username='$username' and password = '$enc_password' or email='$username' and password='$enc_password'";
    $login_query = mysqli_query($conn,$login_sql);
    $num_rows = mysqli_num_rows($login_query);

    if($num_rows == 1){
        $login_user = mysqli_fetch_array($login_query);
        $_SESSION['username'] = $login_user['username'];
        header("Location: dashboard.php");
    }
    else{
        echo "<script>alert('Password Doesn\'t Match')</script>";
        header('Location: login.php?action=wrong');
    }
}
else{
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Rajasthn Eauction Portal</title>

        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/modern-business.css" rel="stylesheet">

    </head>

    <body>

    <!-- Navigation -->
    <?php
    include 'nav.php';
    ?>
    <!-- /.container -->
    <div class="container" style="margin:100px">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" name="login" method="post" action="">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail or Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button name="login" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-5 bg-dark" style="position:absolute;bottom:0;width:100%;height:60px;">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Rajasthan Governement</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>

    </html>
    <?php
}
?>