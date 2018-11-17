<?php 
session_start();

if( !isset($_SESSION['loggedInUser']) ){
    header("Location: index.php?access=denied");
}

if( isset($_GET['alert']) ){
    if($_GET['alert'] == 'success'){
        $alertMessage = "<div class='alert alert-success'>New User Added! <a class='close' data-dismiss='alert'>&times;</a></div>";
    }
}

include('includes/connection.php');

// get all users from db
$query = "select id, firstname, lastname, email from users";
$result = mysqli_query($conn,$query);

include('includes/header.php');
?>

<div class="container">
    <h1>User Management</h1>

    <?php if( isset( $alertMessage) ) { echo $alertMessage; } ?>
    <table class="table table-striped table-bordered">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Edit</th>
        </tr>
        <?php 
        if( mysqli_num_rows($result) > 0 ){
            // data present in db
            // display in table rows
            while ( $row = mysqli_fetch_assoc($result) ){
                echo "<tr>";
                //main data columns
                echo "<td>".$row['firstname']."</td><td>".$row['lastname']."</td><td>".$row['email']."</td>";

                //edit button columns
                echo '<td><a href="#?id='.$row['id'].'" type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span></a></td>';
            }
        }
        ?>

        <tr>
            <td colspan="7">
                <div class="text-center"><a href="newuser.php" type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add User</a></div>
            </td>
        </tr> 
    </table>
</div>
<?php include('includes/footer.php'); ?>