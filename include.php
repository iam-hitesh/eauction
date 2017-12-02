<?php
function logout(){
    session_set();
    if(session_destroy())
    {
        header("Location: login.php");
    }
}
function session_set(){
    session_start();
    if(!isset($_SESSION["username"])){
        header('Location:login.php');
        exit(); }
}
?>