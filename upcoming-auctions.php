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

    <title>Rajasthan Government's Upcoming Auctions</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>
<?php
include 'nav.php';
?>
<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">
        Rajasthan Government's Upcoming Auctions
    </h1>

    <ol class="breadcrumb">

    </ol>

    <!-- Image Header -->
    <img class="img-fluid rounded mb-4" src="http://placehold.it/1200x300" alt="">

    <!-- Marketing Icons Section -->
    <div class="row">
        <?php
        $auction_sql = "SELECT * FROM auction_table";
        $auction_query = mysqli_query($conn,$auction_sql);
        while($auction = mysqli_fetch_array($auction_query)) {
            ?>
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <h4 class="card-header"><?php echo $auction['product_name']; ?></h4>
                    <div class="card-body">
                        <p class="card-text"><?php echo $auction['product_details']; ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="auction.php?id=<?php echo $auction['auction_id']; ?>" class="btn btn-primary">Know More</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
