<!DOCTYPE html>

<html>
    <head>
        <title>StudentManager</title>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
        
    </head>
    
    <body style="padding-top: 60px;">
        
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
            <div class="container-fluid">
                
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="dashboard.php">STUDENT<strong>MANAGER</strong></a>  
                </div>
                
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    
                    <?php
                    // display menu only when logged in
                    if( isset($_SESSION['loggedInUser']) ){
                    ?>
                    <ul class="nav navbar-nav">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="students.php">Students</a></li>
                        <li><a href="#">Assessment</a></li>
                    </ul>
                    <!-- drop down menu instead here -->
                    <ul class="nav navbar-nav navbar-right">
                        <p class="navbar-text">Welcome: <?php echo $_SESSION['loggedInUser']; ?></p>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="menu1"><span class="glyphicon glyphicon-cog"></span> Settings<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <li role="presentation"><a role="menuitem" href="users.php"><span class="glyphicon glyphicon-user"></span> Users</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                    
                    <!--<div class="dropdown">
                        <button class="btn dropdown-toggle  navbar-btn navbar-right" type="button" data-toggle="dropdown" id="menu1">Settings<span class="caret"></span></button>
                                                
                        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="menu1">
                            <li role="presentation"><a role="menuitem" href="users.php">Users</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" href="logout.php">Log out <span class="glyphicon glyphicon-log-out"></span></a></li>
                        </ul>
                        
                    </div> -->            
                    
                    <?php } else { ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
                    </ul>
                    <?php } ?>
                    
                </div>
            
            </div>
        </nav>
           
        <!-- jquery for bootstrap -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
    </body>
</html>