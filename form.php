<?php
     session_start(); 
     if(isset($_SESSION['form_data']))
     { 
        $errors = $_SESSION['form_data'];
     }
     else
     {
        header('Location: login.php');      
     }

?>

<html>
<head>
    <title>Login</title> 
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'> 
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="headerMenu">
        <h1>don't hate me</h1>
    </div>
    <div class="frm">
        <form action="login.php" method="post" enctype="multipart/form-data">
            <input placeholder="Username" name="username" type="text" class="textbox" autofocus>
            <input placeholder="Password" name="password" type="password" class="textbox">
            <input name="login" type="submit" class="button" value="Log In">
        </form>
        <form action="signup.php" method="post" enctype="multipart/form-data">
        <label for="errors"><?php echo $errors ?></label> 
        <p>No Account?</p>
        <button name="signup" class="button" style="vertical-align:middle"><span>Sign Up </span></button>
        </form>
    </div>
    
</body>
</html>