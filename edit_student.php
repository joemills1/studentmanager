<?php 
session_start();

include('includes/connection.php');
include('includes/functions.php');

if(!isset($_SESSION['loggedInUser'])){
    header("Location: index.php?access=denied");
}

// get id sent by GET collection
$studentId = $_GET['id'];

// get student details based on id
$query = "SELECT * FROM student where id='$studentId'";
$result = mysqli_query($conn, $query);

if( mysqli_num_rows($result) > 0) {
    // record present, get data values
    while($row = mysqli_fetch_assoc($result)){
        $studentFirstName = $row['first_name'];
        $studentLastName = $row['last_name'];
        $studentDob = $row['dob'];
        $studentPhone = $row['phone'];
        $studentEmail = $row['email'];
        $studentAddress = $row['address'];
    }
} else {
    // no record returned
    $alertMessage = "No data found. <a href='students.php'>Head back</a>";
}

if (isset( $_POST['updateStudent'] )){
    
    // ensure values 
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
    
    //update database record
    if($studentFirstName && $studentLastName && $studentDob && $studentPhone){
        
        $query = "UPDATE student SET
                first_name='$studentFirstName',
                last_name='$studentLastName',
                dob='$studentDob',
                phone='$studentPhone',
                email='$studentEmail',
                address='$studentAddress'
                WHERE id='$studentId'";
        
        $result = mysqli_query($conn, $query);
        
        if($result){
            // redirect to students page with query string
            header("Location: students.php?alert=updatesuccess");
        } else {
            // error updating
            echo "Error updating record: ".mysqli_error($conn);
        }
        
    }
}

//if delete button was submitted
if( isset($_POST['deleteStudent']) ) {
    
    $alertMessage = "<div class='alert alert-danger'>
    <p>Are you sure you want to delete this student? Operation cannot be undone!</p><br>
        <form action='".htmlspecialchars( $_SERVER["PHP_SELF"] )."?id=$studentId' method='post'>
            <input type='submit' class='btn btn-danger btn-sm' name='confirm-delete' value='Yes, delete!'>
            <a type='button' class='btn btn-default btn-sm' data-dismiss='alert'>Oops, no thanks!</a>
        </form>
    </div>";
        
}

// if confirm delete button was submitted
if (isset($_POST['confirm-delete'])){
    
    $query = "DELETE FROM student WHERE id='$studentId'";
    $result = mysqli_query($conn, $query);
    
    if($result){
        // redirect to student page with query string
        header("Location: students.php?alert=deleted");
    } else {
        echo "Error deleting record: ".mysqli_error($conn);
    }
}
// close the mysql connection
if (isset($conn)){
    mysqli_close($conn);
}

include('includes/header.php');

?>

<div class="container">
    <h1>Update Student</h1>
    <p class="lead">Update student details.</p> 
    
    <?php if (isset ($alertMessage) ){ echo $alertMessage; } ?>
    
    <?php 
    if( isset($formInputError) ){
        echo "<div class='alert alert-danger'>$formInputError<a class='close' data-dismiss='alert'>&times;</a></div>";
    }
    ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>?id=<?php echo $studentId; ?>" method="post" class="row">
        
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
            <input type="date" class="form-control input-lg" id="student-dob" name="studentDob" value="<?php if(isset($studentDob)) echo strftime('%d-%m-%Y', strtotime($studentDob)); ?> ">
        </div>
        <div class="form-group col-sm-6">
            <label for="student-phone">Phone<small style="color: red;">*</small></label>
            <input type="text" class="form-control input-lg" id="student-phone" name="studentPhone" value="<?php if(isset($studentPhone)) echo $studentPhone; ?>">
        </div>
        <div class="form-group col-sm-6">
            <label for="student-email">Email</label>
            <input type="email" class="m-wrap form-control input-lg" id="student-email" name="studentEmail" value="<?php if(isset($studentEmail)) echo $studentEmail; ?>">
        </div>
        <div class="form-group col-sm-6 ">
            <label for="student-address">Address</label>
            <textarea type="text" class="form-control input-lg" id="student-address" name="studentAddress"><?php if(isset($studentAddress)) echo $studentAddress; ?></textarea>
        </div>
        <div class="form-group col-sm-12">
            <hr>
            <button type="submit" class="btn btn-lg btn-danger pull-left" name="deleteStudent">Delete</button>
            
            <div class="pull-right">
                <a href="students.php" type="button" class="btn btn-lg btn-default">Cancel</a>
                <button type="submit" name="updateStudent" class="btn btn-lg btn-success pull-right">Update Student</button>
            </div>    
        </div>
        
    </form>
    
    <?php 
    include('includes/footer.php');
    ?>
    
</div>