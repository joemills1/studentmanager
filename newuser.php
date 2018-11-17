<?php 
session_start();

if(!isset($_SESSION['loggedInUser'])){
    header("Location: index.php");
    
}

// connect to db
include('includes/connection.php');

// functions file
include('includes/functions.php');

// process form data
if ( isset($_POST['registerUser']) ){
    
    $firstName = $lastName = $email = $password = $confirmedPassword = $formInputError = "";
    // check if inputs are empty
    // create variables with form data
    if( !$_POST["userFirstName"]){
        $formInputError = "Please enter a first name<br>";
    }else{
        $firstName = validateFormData($_POST['userFirstName']);
    }
    
    if( !$_POST["userLastName"] ){
        $formInputError = $formInputError."Please enter a last name<br>";
    } else {
        $lastName = validateFormData($_POST['userLastName']);
    }
    
    if( !$_POST["userEmail"] ){
        $formInputError = $formInputError."Please enter an email address<br>";
    } else {
        $email = validateFormData($_POST['userEmail']);
    }
    
    if( !$_POST["userPassword"] ){
        $formInputError = $formInputError."Please enter a Password<br>";
    } else {
        $password = validateFormData($_POST['userPassword']);
    }
    
    if( !$_POST["confirmPassword"] ){
        $formInputError = $formInputError."Please confirm entered password";
    } else {
        $confirmedPassword = validateFormData($_POST['confirmPassword']);
    }
    
    // check if password and confirmed password match
    if( ($firstName && $lastName && $email && $password && $confirmedPassword) && ($password == $confirmedPassword) ){
        
        // hash entered password
        $hashedPassword = encryptUserPassword($password);
        
        // create query
        $query = "insert into users(id, firstname, lastname, email, password, datecreated) values (null, '$firstName','$lastName','$email','$hashedPassword',CURRENT_TIMESTAMP)";
        
        $result = mysqli_query($conn, $query);
        
        //check query success
        if($result){
            header("Location: users.php?alert=success");
        } else {
            echo "Error: ".$query."<br>".mysqli_error($conn);
        }
        
    } elseif ($password != $confirmedPassword) {
        $formInputError = "Password mismatch! Ensure entered password match";
    }
}

//close db connection
if(isset($conn)){
    mysqli_close($conn);
}

include('includes/header.php'); 

?>

<div class="container">
    <h1>New User</h1>
    <p class="lead">Create new user account.</p>
    
    <?php 
    if( isset($formInputError) ){
        echo "<div class='alert alert-danger'>$formInputError<a class='close' data-dismiss='alert'>&times;</a></div>";
    }
    ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="row">
        <div class="form-groupc col-sm-6">
            <label for="userfname" class="sr-only">First Name *</label>
            <input type="text" name="userFirstName" placeholder="First Name" id="userfname" class="form-control" value="<?php if( isset($firstName) ) echo $firstName; ?>">
        </div>
        <div class="form-group col-sm-6">
            <label for="userlname" class="sr-only">Last Name *</label>
            <input type="text" name="userLastName" placeholder="Last Name" id="userlname" class="form-control" value="<?php if( isset($lastName) ) echo $lastName; ?>">
        </div>
        <div class="form-group col-sm-6">
            <label for="useremail" class="sr-only">Email *</label>
            <input type="text" name="userEmail" placeholder="Email" id="useremail" class="form-control" value="<?php if( isset($email) ) echo $email; ?>">
        </div>
        <div class="form-group col-sm-6">
            <label for="userpw" class="sr-only">Password *</label>
            <input type="password" name="userPassword" placeholder="Password" id="userpw" class="form-control" >
        </div>
        <div class="form-group col-sm-6">
            <label for="userpw2" class="sr-only">Confirm Password *</label>
            <input type="password" name="confirmPassword" placeholder="Confirm Password" id="userpw2" class="form-control">
        </div>
        <div class="form-group col-sm-12">
            <a href="users.php" type="button" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-primary pull-right" name="registerUser">Create Account</button>
        </div>
        
    </form>

</div>

<?php include('includes/footer.php'); ?>