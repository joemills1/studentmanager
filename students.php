<?php 
session_start();

include('includes/header.php'); 

// if user is not logged in, deny access to page
// redirect to index page
if( !isset($_SESSION['loggedInUser']) ){
    header("Location: index.php?access=denied");
}

if (isset($_GET['alert'])){
    if($_GET['alert'] == 'success'){
        $alertMessage = "New student information saved successfully";
    }
    
    if($_GET['alert'] == 'updatesuccess'){
        $alertMessage = "Student information updated successfully";
    }
    
    if($_GET['alert'] == 'deleted'){
        $alertMessage = "Student information deleted successfully";
    }
}

//connect to database
include('includes/connection.php');

// query and result
$query = "select * from student";
$result = mysqli_query( $conn, $query );


//close connection
mysqli_close($conn);

?>

<div>
    
    <h1>Student Management</h1>
    <?php 
    // alert message
    if( isset($alertMessage) ){
        echo "<div class='alert alert-success'>$alertMessage <a class='close' data-dismiss='alert'>&times;</a></div>";
    }
    ?>
    
    <table class="table table-striped table-bordered">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Date Registered</th>
            <th>Edit</th>
        </tr>
        <?php 
        
        if( mysqli_num_rows($result) > 0 ){
            while ( $row = mysqli_fetch_assoc($result) ){
                echo "<tr>";
                
                echo "<td>".$row['first_name']."</td>".
                    "<td>".$row['last_name']."</td>".
                    "<td>".$row['dob']."</td>".
                    "<td>".$row['phone']."</td>".
                    "<td>".$row['email']."</td>".
                    "<td>".$row['address']."</td>".
                    "<td>".$row['date_registered']."</td>";
                
                echo '<td><a href="edit_student.php?id='.$row['id'].'" type="button" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-edit"></span>
                <a/></td>';
                
                echo "</tr>";
            }
        } else {
            //no enteries found
            echo "<div class='alert alert-warning'>You have no student data!</div>";
        }
        
        ?>
        
        <tr>
            <td colspan="7"><div class="text-center"><a href="add_student.php" type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span>Add Student</a></div></td>
        </tr>
    </table>
    
</div>

<?php include('includes/footer.php'); ?>