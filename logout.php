<?php 

// check browser cookie
if( isset($_COOKIE[session_name()]) ){
    // empty the cookie
    setcookie( session_name(), '', time()-86400, '/');
}

if(!isset($_SESSION)){
    session_start();
}

// clear all session variables
session_unset();

//destroy session
session_destroy();

include('includes/header.php'); 
?>

<div class="container">
    
    <h1>Logged Out!</h1>
    <p class="lead">You've been logged out. See you next time!</p>
    
</div>

<?php include('includes/footer.php'); ?>