<?php 

session_start();

include('includes/connection.php');
include('includes/functions.php');
include('includes/header.php');

//check for query string
if( isset($_GET['access']) ){
    if( $_GET['access'] == 'denied') {
        $loginError = "Access Denied! Please provide login details to access page.";
    }
}

if ( isset($_POST['login']) ){
    // user attempt main
    $loginEmail = validateFormData( $_POST['email'] );
    $loginPassword = validateFormData( $_POST['password'] );
    
    // create query to get login details from db
    $query = "select firstname, lastname, password from users where email='$loginEmail'";
    
    $result = mysqli_query($conn, $query);
    
    // verify the results
    if( mysqli_num_rows($result) > 0 ){
        // get user name and password
        
        while($row = mysqli_fetch_assoc($result)){
            $firstName = $row['firstname'];
            $lastName = $row['lastname'];
            $hashedPassword = $row['password'];

        }
        
        // verify password entered with that from db
        if(verifyUserPassword($loginPassword, $hashedPassword)){
            // correct details
            // store data in session variable and redirect to dashboard
            $_SESSION['loggedInUser'] = $firstName." ".$lastName;
            
            header("Location: dashboard.php");
            
        } else {
            // password details didn't match
            $loginError = "Wrong email/password combination. Try Again.";
        }
        
    } else{
        //no result return
        $loginError = "User does not exist. Try Again.";
    }
    
}

// close connection
if(isset($conn)){
    mysqli_close($conn);
}

?>

<div class="container">
    <div class="center-div">
        <h1 style="color: #daa520;">Student Manager System</h1>
        <p class="lead">Log in to your account.</p>
        <img src="img/login2.jpg" alt="login">
        
        <?php 

        //display error message
        if( isset($loginError) )  
            echo "<div class='alert alert-danger'>$loginError<a class='close' data-dismiss='alert'>&times;</a></div>"; 
        ?>

        <form class="form-inline" method="post" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>">

            <div class="form-group">
                <label for="login-email" class="sr-only">Email</label>
                <input type="text" class="form-control" id="login-email" placeholder="email" name="email" value="">
            </div>
            <div class="form-group">
                <label for="login-password" class="sr-only">Password</label>
                <input type="password" class="form-control" id="login-password" placeholder="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login!</button><br><br>
            <!--<a href="newuser.php">Create a new account</a>-->

        </form>
    </div>
    
</div>

<?php include('includes/footer.php'); ?>

