<?php 
session_start();

include('includes/header.php'); 

// if user is not logged in, deny access to page
// redirect to index page
if( !isset($_SESSION['loggedInUser']) ){
    header("Location: index.php");
}

//connect to database


?>

<div class="container">
    <h1 style="color:blue;">Dashboard</h1><hr>
    <p class="lead">System overview</p>
    
    
    <div class="row">
        <a class="card-link" href="students.php">
        <div class="col-sm-4">
            <div class="card">
                <img src="img/student_1.png" alt="avatar" class="center-image">
                <div class="mycontainer">
                    <h4><strong>Student Console</strong></h4>
                    <p>Manage student basic info</p>
                </div>
            </div>
        </div></a>
        <a href="#" class="card-link"><div class="col-sm-4">
            <div class="card">
                <img src="img/assessment_1.png" alt="avatar" class="center-image">
                <div class="mycontainer">
                    <h4><strong>Assessment Console</strong></h4>
                    <p>Manage assessment info</p>
                </div>
            </div>
        </div></a>
        <a href="users.php" class="card-link"><div class="col-sm-4">
            <div class="card">
                <img src="img/user_mgt.png" alt="avatar" class="center-image">
                <div class="mycontainer">
                    <h4><strong>User Console</strong></h4>
                    <p>Regulate system access</p>
                </div>
            </div>
        </div></a>
    </div>
</div>

<?php include('includes/footer.php'); ?>