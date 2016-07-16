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
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="wrapper">
	<div class="headerMenu">
		<h1>don't hate me</h1>
	</div>

	<div class="outside">
	
	<div id="logout">
		<p>Logged in as <?php echo $_SESSION['username'] ?></p>
		<form method="post" enctype="form-data">
			<input type="submit" name="logout" class="button1" value="Log Out">
		</form>
	</div>

	<div id="chatarea">	
	</div>

	<div id="clr">
		<form id="clear">
			<button class="button">Clear Chat</button>
		</form>
	</div>
	</div>
	<form id="btUpdateMessage">
		<div class="leftside"></div>
		<textarea rows="4" cols="50" id="txtNewMessage" class="messagebox" autocomplete="off" autofocus></textarea>
		<button class="button">Send</button>
	</form>
</div>
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
			var trigger = $('#btUpdateMessage'),
				rootRef = new Firebase("https://login-42354.firebaseio.com/"),
				currentMessageRef = rootRef.child('messages');

			var addMessage = function(event){
				
				$this = $('#txtNewMessage');
				if($this.val().trim().length == 0) return false;
				currentMessageRef.push($this.val());

				var user = "<?php  Print($_SESSION['username']) ?>";
				
				var curDate = new Date();
				var out_text = $this.val().replace(/\n/g,"</br>");
				var div = '<div class="post"><p>' +  curDate.timeNow() + '</p><div class="talk-bubble tri-right round border right-top"><div class="talktext"><p>'+ '<b>' + user + ': </b>' + out_text + '</p></div></div></div>';

				$chatarea = $('#chatarea');
				$chatarea.append(div);
				$chatarea.animate({ scrollTop: $chatarea[0].scrollHeight }, "slow");

				$('#txtNewMessage').val("");
				return false;
			};


			trigger.on('submit', addMessage);

			$("#txtNewMessage").keypress(function(event){
				if(event.which == 13 && !event.shiftKey){
					addMessage(event);
					return false;
				}
			});

			$('#form').on('click', function(){
				$('#chatarea').html("");
			});			
		});
	</script>
	<script type="text/javascript">
		
	</script>
</body>
</html>