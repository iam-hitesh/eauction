<?php
include 'connection.php';
include 'include.php';
session_set();
error_reporting(0);
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

<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">
        <?php
        $username = $_SESSION['username'];
        $user_sql = "SELECT * FROM users where username='$username'";
        $user_query = mysqli_query($conn,$user_sql);
        $user_data = mysqli_fetch_array($user_query);

        echo "Welcome to Rajasthan E-Auction Portal(Prototype) ";
        echo $user_data['fname'];
        ?>
    </h1>
    <!-- Content Row -->
    <br/>
    <div class="row">
        <div class="col-lg-6 mb-6">
            <div class="card h-100">
                <h3 class="card-header">Upcoming Auctions</h3>
                <ul class="list-group list-group-flush">
                    <?php
                    $user_id = $user_data['user_id'];
                    $participated_auctions_sql = "SELECT * FROM auction_participation WHERE user_id='$user_id' LIMIT 10";
                    $participated_auctions_query = mysqli_query($conn,$participated_auctions_sql);
                    while($participated_auctions = mysqli_fetch_array($participated_auctions_query)){
                        $participated_auctions_id = $participated_auctions['auction_id'];

                        $upcoming2_auctions_sql = "SELECT * FROM auction_table WHERE auction_id='$participated_auctions_id'";
                        $upcoming2_auctions_query = mysqli_query($conn,$upcoming2_auctions_sql);
                        $upcoming2_auctions = mysqli_fetch_array($upcoming2_auctions_query);

                        echo "<li class=\"list-group-item\">";
                        echo "<a href='auction.php?id=".$upcoming2_auctions['auction_id']."'>";
                        echo $upcoming2_auctions['product_name'];
                        echo "</a>";
                        echo "</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 mb-6">
            <div class="card card-outline-primary h-100">
                <h3 class="card-header bg-primary text-white">Participated Auctions</h3>
                <ul class="list-group list-group-flush">
                    <?php
                    $upcoming_auctions_sql = "SELECT * FROM auction_table ORDER BY bid_date ASC LIMIT 10";
                    $upcoming_auctions_query = mysqli_query($conn,$upcoming_auctions_sql);
                    while($upcoming_auctions = mysqli_fetch_array($upcoming_auctions_query)){
                        echo "<li class=\"list-group-item\">";
                        echo "<a href='auction.php?id=".$upcoming_auctions['auction_id']."'>";
                        echo $upcoming_auctions['product_name'];
                        echo "</a>";
                        echo "</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <br/>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<?php
include 'footer.php';
?>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
