<?php
include 'connection.php';
include 'include.php';
session_set();
error_reporting(0);
if(isset($_POST['bid'])){
    $user_id = $user_data['user_id'];
    $bid_amount = mysqli_real_escape_string($conn,$_POST['bid_amount']);

    $bid_sql ="INSERT INTO bidding(user_id,auction_id,bid_amount) VALUES('$user_id','$id','$bid_amount')";
    $bid_query = mysqli_query($conn,$bid_sql);
}
?>