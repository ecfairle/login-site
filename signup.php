<?php
    session_start();
    $username_error = '';
    if(isset($_POST['sub'])) {
        include_once("db.php");
        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);
 
        $username = stripslashes($username);
        $password = stripslashes($password);
       
        $username = mysqli_real_escape_string($db, $username);
        $password = mysqli_real_escape_string($db, $password);
        $hashed_pw = password_hash($password,PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($db, $sql);
        if($username == ''){
            $username_error = 'Invalid username';
        }
        else if(mysqli_num_rows($result) > 0){
            $username_error = "username already in use";
        }
        else{
            $query = "INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, '$username','$hashed_pw');";
            mysqli_query($db, $query);
            header("Location: login.php");
        }
    }
?>
 
<html>
<head>
    <title>Sign Up</title>  
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'> 
</head>
<body>
    <form action="login.php" method="post" enctype="multipart/form-data">
    <a href="login.php">
    <div class="headerMenu">
        <h1>Sign Up</h1>
    </div>
    </a>
    </form>
    <div class="frm">
        <form action="signup.php" method="post" enctype="multipart/form-data">
            <div class="container">
            <div class="side"></div>
            <div class="b_area"> <input class="textbox" placeholder="Username" name="username" type="text" autofocus></div>

            <div><?php echo $username_error?></div>

            </div>
            <div class="container">
            <div class="side"></div>
            <div class="b_area"><input class="textbox" placeholder="Password" name="password" type="password"></div>
            </div>
            <button name="sub" class="button" style="vertical-align:middle">Submit</button>
        </form>
    </div>
    
</body>
</html>