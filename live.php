<?php
include'connection.php';
include 'include.php';
session_set();
error_reporting(0);
if(empty($_GET['id'])){
    header('Location: dashboard.php');
}
else {
    $id = mysqli_real_escape_string($conn,$_GET['id']);
    $auction_sql = "SELECT * FROM auction_table WHERE auction_id = '$id'";
    $auction_query = mysqli_query($conn,$auction_sql);
    $auction_product = mysqli_fetch_array($auction_query);

    if($auction_product['expired'] == 0){
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

            <title>Rajasthan E-Auction Bidding Portal</title>

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
            <h1 class="mt-4 mb-3" style="text-align: center;">
                Live Portal for <?php echo $auction_product['product_name']; ?> Bidding
            </h1>
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <?php
                    if(isset($_POST['bid'])){
                        $user_id = $user_data['user_id'];
                        $bid_amount = mysqli_real_escape_string($conn,$_POST['bid_amount']);

                        $bid_check_sql = "SELECT * FROM bidding where auction_id='$id' ORDER BY bid_time DESC";
                        $bid_check_query = mysqli_query($conn,$bid_check_sql);
                        $bid_check_data = mysqli_fetch_array($bid_check_query);

                        if($bid_amount > $bid_check_data['bid_amount']){
                            $bid_sql ="INSERT INTO bidding(user_id,auction_id,bid_amount) VALUES('$user_id','$id','$bid_amount')";
                            $bid_query = mysqli_query($conn,$bid_sql);
                        }
                        else{
                            echo "<script>alert('Your Bid is less than last bid, make Increses');</script>";
                        }
                    }
                    ?>
                    <form name="bid" id="bid" method="POST" action="live.php?id=<?php echo $id; ?>">
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Your Bid(Should be More than last maximum bid and minimum bid for the Product)</label>
                                <input type="number" name="bid_amount" class="form-control" id="number" required data-validation-required-message="Please enter a valid amount.">
                            </div>
                        </div>
                        <button type="submit" name="bid" class="btn btn-primary" id="bid">Bid</button>
                    </form>
                </div>

            </div>
            <h2>People's Bid</h2>
            <div class="row">
                <div class="col-lg-8 mb-8">
                    <div class="card h-100">
                        <ul class="list-group list-group-flush">
                            <?php
                            $bid_fetch_sql = "SELECT * FROM bidding WHERE auction_id='$id' LIMIT 15";
                            $bid_fetch_query = mysqli_query($conn,$bid_fetch_sql);
                            while($bid_fetch_data = mysqli_fetch_array($bid_fetch_query)){
                                $userid = $bid_fetch_data['user_id'];
                                $bid_user_sql = "SELECT * FROM users WHERE user_id='$userid'";
                                $bid_user_query = mysqli_query($conn,$bid_user_sql);
                                $bid_user_data = mysqli_fetch_array($bid_user_query);
                                echo "<li class=\"list-group-item\">".$bid_user_data['fname']." Bids for ".$bid_fetch_data['bid_amount']."</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
        <!-- Footer -->
<br/>
        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    }
    else{
        header('Location:dashboard.php');
    }
}
?>
