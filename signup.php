<?php
    session_start();
    $THE_BEST_COLOR = 'black';
    $username_error = '';
    if(isset($_POST['sub'])) {
        include_once("db.php");
        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);
        $color    = strip_tags($_POST['color']);

 
        $username = stripslashes($username);
        $password = stripslashes($password);
        $color = stripslashes($color);

        $username = mysqli_real_escape_string($db, $username);
        $password = mysqli_real_escape_string($db, $password);
        $color = mysqli_real_escape_string($db, $color);
        
        $hashed_pw = password_hash($password,PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($db, $sql);
        if($color != $THE_BEST_COLOR){
            $username_error = 'wrong color!';
        }
        else if($username == ''){
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
        <h1>don't hate me</h1>
    </div>
    </a>
    </form>
    <div class="frm">
        <form action="signup.php" method="post" enctype="multipart/form-data">
            <div class="b_area"> <input class="textbox" placeholder="Username" name="username" type="text" autocomplete="off" autofocus></div>

            
            <div class="b_area"><input class="textbox" placeholder="Password" name="password" type="password" autocomplete="off"></div>
            <div class="b_area">
                <input class="textbox" placeholder="favorite color" name="color" type="text" autocomplete="off">
                
            </div>
            <div><?php echo $username_error?></div>
            <div class="b_area"><input name="sub" type="submit" class="button" style="vertical-align:middle"></div>
        </form>
    </div>
    
</body>
</html>