<?php
include'connection.php';
include 'include.php';
session_set();
error_reporting(0);
if(empty($_GET['id'])){
    header('Location: dashboard.php');
}
else{
    $id = mysqli_real_escape_string($conn,$_GET['id']);
    $auction_sql = "SELECT * FROM auction_table WHERE auction_id = '$id'";
    $auction_query = mysqli_query($conn,$auction_sql);
    $auction_product = mysqli_fetch_array($auction_query);

    $username = $_SESSION['username'];
    $user_sql = "SELECT * FROM users where username='$username'";
    $user_query = mysqli_query($conn,$user_sql);
    $user_data = mysqli_fetch_array($user_query);
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Rajasthan E-Auction Portal</title>

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

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3"><?php echo $auction_product['product_name']; ?>
        </h1>

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8">
                <img class="img-fluid" src="http://placehold.it/750x500" alt="">
            </div>

            <div class="col-md-4">
                <h3 class="my-3">Project Description</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.</p>
                <h3 class="my-3">Project Details</h3>
                <ul>
                    <li>Lorem Ipsum</li>
                    <li>Dolor Sit Amet</li>
                    <li>Consectetur</li>
                    <li>Adipiscing Elit</li>
                </ul>
                <?php
                $user_id = $user_data['user_id'];

                $part_sql = "SELECT * FROM auction_participation WHERE user_id='$user_id' and auction_id='$id'";
                $part_query = mysqli_query($conn,$part_sql);
                $part_data = mysqli_fetch_array($part_query);
                if(empty($part_data)){
                    echo "<form method='post' action='' name='auction_reg'><button name=\"auction_reg\" class=\"btn btn-lg btn-success btn-block\">Register</button></form>";
                }
                else{
                    echo "<a href=\"auctionlive.php?id=".$id."\"><button class=\"btn btn-lg btn-success btn-block\">Go to Bidding Page</button></a>";
                }
                ?>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php
    include "footer.php";
    ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>

    </html>

    <?php
}
?>
<?php
if(isset($_POST['auction_reg'])){
    $reg_auction_sql = "INSERT INTO auction_participation(id,user_id,auction_id,paid_caution) VALUES('NULL','$user_id','$id','yes')";
    $reg_auction_query = mysqli_query($conn,$reg_auction_sql);
    if($reg_auction_query){
        echo "<script>alert('Registered Successfully')</script>";
        header('Location:auction.php?id='.$id);
    }else{
        echo "<script>alert('Try Again')</script>";
        header('Location:auction.php?id='.$id);
    }
}
?>
