<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("Location: login.php");
	}

	if(isset($_POST['logout'])){
		session_destroy();
		header("Location: login.php");
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Chat</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
</head>
<body bgcolor="#9b2f1b">
	<div id="outside">

		<div id="clr">
		<form id="clear">
			<button class="button">Clear Chat</button>
		</form>
		</div>

		<div id="title">
			<h1>gr8 chat</h1>
		</div>

		<div id="logout">
		<p>Logged in as <?php echo $_SESSION['username'] ?></p>
		<form method="post" enctype="form-data">
			<input type="submit" name="logout" class="button" value="Log Out">
		</form>
		</div>

	</div>
	
		
	<div id="chatarea">	
	</div>
	<form id="btUpdateMessage">
		<input type="text" id="txtNewMessage" class="messagebox"></input>
		<button class="button">Send</button>
	</form>
	<script src="firebase.js"></script>
	<script type="text/javascript">
	  // Initialize Firebase
	  var config = {
	    apiKey: "AIzaSyAK9yq6vo71h315ZBjyURjdToCs1rMR4qQ",
	    authDomain: "login-42354.firebaseapp.com",
	    databaseURL: "https://login-42354.firebaseio.com",
	    storageBucket: "login-42354.appspot.com",
	  };
	  firebase.initializeApp(config);
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript">
		
	</script>
	<script>
		Date.prototype.timeNow = function () {
    		 return ((this.getHours() < 10)?"0":"") + ((this.getHours()>12)?this.getHours()-12:this.getHours()) +":"+ ((this.getMinutes() < 10)?"0":"") + this.getMinutes() 
    		 + ((this.getHours()>12)?"PM":"AM");
		}
		 $(document).ready(function(){
			var trigger = $('#btUpdateMessage');

				var rootRef = new Firebase("https://login-42354.firebaseio.com/"),
				currentMessageRef = rootRef.child('messages');

			trigger.on('submit', function(){
				$this = $('#txtNewMessage');
				if($this.val() == "") return false;
				currentMessageRef.push($this.val());

				var user = "<?php  Print($_SESSION['username']) ?>";
				
				var curDate = new Date();

				var div = '<div class="post"><p>' +  curDate.timeNow() + '</p><div class="talk-bubble tri-right round border right-top"><div class="talktext"><p>'+ '<b>' + user + ': </b>' + $this.val() + '</p></div></div></div>';
				$chatarea = $('#chatarea');
				$chatarea.append(div);
				$chatarea.animate({ scrollTop: $chatarea[0].scrollHeight }, "slow");

				$('#txtNewMessage').val("");
				return false;
			});

			$('#form').on('click', function(){
				$('#chatarea').html("");
			});

			
		});
	</script>
</body>
</html>