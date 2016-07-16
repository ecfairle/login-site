<?php
    session_start();
    $error = '';
    if(isset($_POST['login'])) {
        include_once("db.php");
        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);
 
        $username = stripslashes($username);
        $password = stripslashes($password);
       
        $username = mysqli_real_escape_string($db, $username);
        $password = mysqli_real_escape_string($db, $password);
 

        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $query = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($query);
        $id = $row['id'];
        $db_password = $row['password'];
        if(mysqli_num_rows($query) == 0){
            $error = "yo that username don't exist";
        } 
        else if(password_verify($password, $db_password)) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id;
            header("Location: index.php");
        } else {
            $error = "<p>yo ur pw was off dawg!</p>";
        }
    }
?>
 
<html>
<head>
    <title>Login</title> 
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'> 
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <a href="login.php">
    <div class="headerMenu">
        <h1>don't hate me</h1>
    </div>
    </a>
    <div class="frm">
        <form action="login.php" method="post" enctype="multipart/form-data">
            <input placeholder="Username" name="username" type="text" class="textbox" autofocus autocomplete="off">
            <input placeholder="Password" name="password" type="password" class="textbox" autocomplete="off">
            <input name="login" type="submit" class="button" value="Log In">
        </form>
        <form action="signup.php" method="post" enctype="multipart/form-data">
        <?php echo $error?>
        <p>No Account?</p>
        <input value="Sign Up" type="submit" class="button" style="vertical-align:middle">
        </form>
    </div>
    
</body>
</html>