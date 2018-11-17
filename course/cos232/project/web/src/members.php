<?php
	// Connects to the Database 
	include('connect.php');
	$DB = connect();
	
	//if the login form is submitted 
	if (isset($_POST['submit'])) {
		
		$_POST['username'] = trim($_POST['username']);
		if(!$_POST['username'] | !$_POST['password']) {
			die('<p>You did not fill in a required field.
			Please go back and try again!</p>');
		}
		
		$password = hash("sha256", $_POST['password']);
		$password = substr($password, 0, 40);
		
		$check = mysqli_query($DB, "SELECT * FROM users WHERE username = '".$_POST['username']."'")or die(mysqli_error($DB));
		
 		//Gives error if user already exist
 		$check2 = mysqli_num_rows($check);
		if ($check2 == 0) {
			die("<p>Sorry, user name does not exisits.</p>");
		}
		else
		{
			$userquery = mysqli_query($DB, "SELECT * FROM users WHERE username = '".$_POST['username']."'")or die(mysqli_error($DB));
			$userinfo = mysqli_fetch_assoc($userquery); // get an assoc array for the user
			// if attempt more than 3 times
			if ($userinfo["num_attempt"] >= 3) {
				$previousTime = strtotime($userinfo["false_try_time_stamp"]." UTC");
				$currentTime = strtotime(time());
				$diffInSec = $currentTime - $previousTime;
				// and if 10+ minutes passed since last try, reset num_attempt
				if ($diffInSec > 10 * 60) {
					mysqli_query($DB, "UPDATE users SET num_attempt = 0 " .
						"WHERE username = '" .
						$userinfo["username"] . 
					   	"'");
				}
				else // if failed 3 times within last 10 minutes, abort
				{
					die ("You failed too many times, please retry later.");
				}
			}

			while($info = mysqli_fetch_array($check )) 	{
			 	//gives error if the password is wrong
				if ($password != $info['pass']) {
					// update the count
					mysqli_query($DB, "UPDATE users SET num_attempt = " . 
						($userinfo["num_attempt"] + 1) . 
						" WHERE username = '" . 
						$userinfo["username"] . 
						"'");
					die('Incorrect password, please try again.');
				}
			}
			// on success login, reset the num_attempt to 0
			mysqli_query($DB, "UPDATE users SET num_attempt = 0 " .
				"WHERE username = '" .
				$userinfo["username"] . 
				"'");
			$hour = time() + 3600; 
			setcookie('hackme', $_POST['username'], $hour); 
			setcookie('hackme_pass', $password, $hour);
			header("Location: members.php");
		}
	}
		?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>hackme</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<?php
	include('header.php');
?>
<div class="post">
	<div class="post-bgtop">
		<div class="post-bgbtm">
        <h2 class = "title">hackme bulletin board</h2>
        	<?php
            if(!isset($_COOKIE['hackme'])){
				 die('Why are you not logged in?!');
			}else
			{
				print("<p>Logged in as <a>$_COOKIE[hackme]</a></p>");
			}
			?>
        </div>
    </div>
</div>

<?php
	$threads = mysqli_query($DB, "SELECT * FROM threads ORDER BY date DESC")or die(mysqli_error($DB));
	while($thisthread = mysqli_fetch_array( $threads )){
?>
	<div class="post">
	<div class="post-bgtop">
	<div class="post-bgbtm">
		<h2 class="title"><a href="show.php?pid=<?php echo $thisthread['id'] ?>"><?php echo $thisthread['title']?></a></h2>
							<p class="meta"><span class="date"> <?php echo date('l, d F, Y',$thisthread['date']) ?> - Posted by <a href="#"><?php echo $thisthread['username'] ?> </a></p>

	</div>
	</div>
	</div> 

<?php
}
	include('footer.php');
?>
</body>
</html>
