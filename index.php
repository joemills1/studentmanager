<?php 
include('includes/header.php');
?>

<h1>Student Manager System</h1>
<p class="lead">Log in to your account.</p>

<form>
    <div class="form-group">
        <label for="login-email" class="sr-only">Email</label>
        <input type="text" class="form-control" id="login-email" placeholder="email" name="email" value="">
    </div>
    <div class="form-group">
        <label for="login-password" class="sr-only">Password</label>
        <input type="password" class="form-control" id="login-password" placeholder="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="login">Login!</button><br><br>
    <a href="signup.php">Create a new account</a>
</form>

<?php include('includes/footer.php'); ?>
