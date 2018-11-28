<?php
// Connects to the Database 
	include('connect.php');
	$DB = connect();
	
	//if the login form is submitted 
	if (isset($_POST['post_submit'])) {
		$magicToken = mysqli_query($DB, 
			"SELECT pass FROM users WHERE username = '" .
			$_COOKIE['hackme'] . 
			"';"); 
		$magicToken = mysqli_fetch_array($magicToken)[0];
		if (!array_key_exists('token', $_POST) || $_POST['token'] != $magicToken) {
			include('header.php');
			die("<p>You were targeted by a CSRF attack, and I saved you. You are welcome.</p>");
		}

		
		
		$_POST['title'] = trim($_POST['title']);
		if(!$_POST['title'] | !$_POST['message']) {
			include('header.php');
			die('<p>You did not fill in a required field.
			Please go back and try again!</p>');
		}
		
		mysqli_query($DB, "INSERT INTO threads (username, title, message, date) VALUES('".$_COOKIE['hackme']."', '". $_POST['title']."', '". $_POST[message]."', '".time()."')")or die(mysqli_error($DB));
		
		header("Location: members.php");
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
				// check if the user exists in database and if the password in cookie is correct
				$userquery = mysqli_query($DB, "SELECT * FROM users WHERE username = '".$_COOKIE['hackme']."'") or die(mysqli_error($DB));
				// assuming there is only one result with one username
				$userinfo = mysqli_fetch_assoc($userquery); // get an assoc array for the user
				// if the user doesn't exist in database OR
				// if there is no password hash in the cookie OR
				// if the password hash is not correct
				if ($userinfo == null || !isset($_COOKIE['hackme_pass']) || $userinfo["pass"] != $_COOKIE['hackme_pass']) die("<p>Sorry, invalid credentials.</p>");
				print("<p>Logged in as <a>$_COOKIE[hackme]</a></p>");
			}
			?>
            
            <h2 class="title">NEW POST</h2>
            <p class="meta">by <a href="#"><?php echo $_COOKIE['hackme'] ?> </a></p>
            <p> do not leave any fields blank... </p>
            
            <form method="post" action="post.php">
            Title: <input type="text" name="title" maxlength="50"/>
            <br />
            <br />
            Posting:
            <br />
            <br />
            <textarea name="message" cols="120" rows="10" id="message"></textarea>
            <br />
            <br />
            <input name="post_submit" type="submit" id="post_submit" value="POST" />
			<input type="hidden" name="token" value="<?php $magicToken = 
			mysqli_query($DB, 
			"SELECT pass FROM users WHERE username = '" .
			$_COOKIE['hackme'] . 
			"';"); 
			echo mysqli_fetch_array($magicToken)[0] ?>">
            </form>
        </div>
    </div>
</div>

<?php
	include('footer.php');
?>
</body>
</html>
