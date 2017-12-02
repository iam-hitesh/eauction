<?php
include'connection.php';
include 'include.php';
error_reporting(0);
if(isset($_SESSION["username"])){
    header('Location:dashboard.php');
}
if(isset($_POST['reg'])){
    $fname = mysqli_real_escape_string($conn,$_POST['fname']);
    $lname = mysqli_real_escape_string($conn,$_POST['lname']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $bhamashah = mysqli_real_escape_string($conn,$_POST['bhamashah']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $cpassword = mysqli_real_escape_string($conn,$_POST['cpassword']);
    if(($password) == ($cpassword)){
        $enc_password = md5($password);
        $reg_sql = "INSERT INTO users(fname,lname,username,email,phone,bhamashah,password) VALUES('$fname','$lname','$username','$email','$phone','$bhamashah','$enc_password')";
        $reg_query = mysqli_query($conn,$reg_sql);

        if($reg_query){
            echo "<script>alert('Successfully Registered')</script>";
            echo "<script>window.location = \"login.php\";</script>";
        }
        else{
            echo "<script>alert('Try Again')</script>";
            echo "<script>window.location = \"reg.php\";</script>";
        }
    }
    else{
        echo "<script>alert('Password Doesn\'t Match')</script>";
        echo "<script>window.location = \"reg.php\";</script>";
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

        <title>Modern Business - Start Bootstrap Template</title>
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
                        <h3 class="panel-title">Please Sign Up</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" name="reg" method="POST" action="">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="First Name" name="fname" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Last Name" name="lname" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contact No." name="phone" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Bhamashah No." name="bhamashah" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Confirm Password" name="cpassword" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button name="reg" class="btn btn-lg btn-success btn-block">SignUp</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php
    include 'footer.php';
    ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
}
?>
