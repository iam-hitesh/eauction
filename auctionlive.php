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
    <style>
        .timer{
            font-size: 4em;
            text-align: center;
            margin:100px 0px;
        }
        .countdown{
            margin:50px 0px;
        }

    </style>
    <body>

    <!-- Navigation -->
    <?php
    include 'nav.php';
    ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3" style="text-align: center;">
            Portal for <?php echo $auction_product['product_name']; ?> Bidding
        </h1>
        <div id="countdown" class="countdown col-md-12 col-md-offset-12"></div>
        <br/>
        <p>For details about Product <a href="auction.php?id=<?php echo $id; ?>">Click Here</a></p>
    </div>
    <!-- /.container -->
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
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("<?php echo date('m-d-Y H:i:s',strtotime($auction_product['bid_date'])); ?>").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now an the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("countdown").innerHTML =  "<div class='timer'>"+ days + "d " + hours + "h "
                + minutes + "m " + seconds + "s </div>";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "";
                window.location.href = 'live.php?id=<?php echo $id; ?>';
            }
        }, 1000);
    </script>
    </body>
    </html>
    <?php
}
else{
        header('Location:dashboard.php');
}
    }
    ?>