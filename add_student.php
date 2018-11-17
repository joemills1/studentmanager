<?php 
session_start();

include('includes/connection.php');
include('includes/functions.php');

if(!isset($_SESSION['loggedInUser'])){
    header("Location: index.php?access=denied");
}

// process form
if (isset( $_POST['addStudent']) ){
    $studentFirstName = $studentLastName = $studentDob = $studentPhone = $studentEmail = $studentAddress = $formInputError = "";
    
    // required fields first
    // first name 
    if (!$_POST["studentFname"]){
        $formInputError = $formInputError."Please enter student's first name<br>";
    } else {
        $studentFirstName = validateFormData($_POST['studentFname']);
    }
    
    // last name
    if(!$_POST["studentLname"]){
        $formInputError = $formInputError."Please enter student's last name<br>";
    } else {
        $studentLastName = validateFormData($_POST['studentLname']);
    }
    
    // dob
    if(!$_POST["studentDob"]){
        $formInputError = $formInputError."Please enter student's date of birth<br>";
    } else {
        $studentDob = validateFormData($_POST['studentDob']);
    }
    
    // phone
    if(!$_POST["studentPhone"]){
        $formInputError = $formInputError."Please enter a contact phone number";
    } else {
        $studentPhone = validateFormData($_POST['studentPhone']);
    }
    
    // these inputs are not required
    // so we'll just store whatever was entered 
    $studentEmail = validateFormData($_POST['studentEmail']);
    $studentAddress = validateFormData($_POST['studentAddress']);
    
    
    if($studentFirstName && $studentLastName && $studentDob && $studentPhone){
        
        // save data in database
        $query = "INSERT INTO student(id, first_name, last_name, dob, phone, email, address, date_registered) VALUES (null, '$studentFirstName','$studentLastName','$studentDob','$studentPhone','$studentEmail','$studentAddress',CURRENT_TIMESTAMP)";
        
        $result = mysqli_query($conn, $query);
        
        // if query was successful
        if ($result){
            // return to strudent list with query string
            header("Location: students.php?alert=success");
        } else {
            // something went wrong
            echo "Error: ".$query."<br>".mysqli_error($conn);
        }
        
    }
}

// close connection
if(isset($conn)) { mysqli_close($conn); }

include('includes/header.php');

?>

<div class="container">
    <h1>New Student</h1>
    <p class="lead">Add new student details.</p> 
    
    <?php 
    if( isset($formInputError) ){
        echo "<div class='alert alert-danger'>$formInputError<a class='close' data-dismiss='alert'>&times;</a></div>";
    }
    ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="row">
        
        <small class="col-sm-12" style="color: red;">Fields marked with (*) are required</small>
        
        <div class="form-group col-sm-6">
            <label for="student-fname">First Name<small style="color: red;">*</small></label>
            <input type="text" class="form-control input-lg" id="student-fname" name="studentFname" value="<?php if(isset($studentFirstName)) echo $studentFirstName; ?> ">
        </div>
        <div class="form-group col-sm-6">
            <label for="student-lname">Last Name<small style="color: red;">*</small></label>
            <input type="text" class="form-control input-lg" id="student-lname" name="studentLname" value="<?php if(isset($studentLastName)) echo $studentLastName; ?> ">
        </div>
        <div class="form-group col-sm-6">
            <label for="student-dob">Date of Birth<small style="color: red;">*</small></label>
            <input type="date" class="form-control input-lg" id="student-dob" name="studentDob" value="<?php if(isset($studentDob)) echo $studentDob; ?> ">
        </div>
        <div class="form-group col-sm-6">
            <label for="student-phone">Phone<small style="color: red;">*</small></label>
            <input type="text" class="form-control input-lg" id="student-phone" name="studentPhone" value="<?php if(isset($studentPhone)) echo $studentPhone; ?>">
        </div>
        <div class="form-group col-sm-6">
            <label for="student-email">Email</label>
            <input type="email" class="form-control input-lg" id="student-email" name="studentEmail" value="<?php if(isset($studentEmail)) echo $studentEmail; ?>">
        </div>
        <div class="form-group col-sm-6 ">
            <label for="student-address">Address</label>
            <textarea type="text" class="form-control input-lg" id="student-address" name="studentAddress"><?php if(isset($studentAddress)) echo $studentAddress; ?></textarea>
        </div>
        <div class="form-group col-sm-12">
            <a href="students.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <button type="submit" name="addStudent" class="btn btn-success pull-right">Add Student</button>
        </div>
        
    </form>
    
    <?php 
    include('includes/footer.php');
    ?>
    
</div>