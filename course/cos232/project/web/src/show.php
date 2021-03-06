<?php
	// Connects to the Database 
	include('connect.php');
	$DB = connect(); 
	$stmt = mysqli_stmt_init($DB);
	
	//if the login form is submitted 
	if (!isset($_GET['pid'])) {
		if (isset($_GET['delpid'])){
			// get the username of the post
			mysqli_stmt_prepare($stmt, "SELECT username FROM threads WHERE id = ?") &&
				mysqli_stmt_bind_param($stmt, "s", $_GET['delpid']) &&
				mysqli_stmt_execute($stmt) || die(mysqli_stmt_error($stmt));
			$username = mysqli_stmt_get_result($stmt);
			$username = mysqli_fetch_array($username)['username'];

			// get the correct credential of that user
			mysqli_stmt_prepare($stmt, "SELECT pass FROM users WHERE username = ?") &&
				mysqli_stmt_bind_param($stmt, "s", $username) &&
				mysqli_stmt_execute($stmt) || die(mysqli_stmt_error($stmt));
			$pass = mysqli_stmt_get_result($stmt);
			$pass = mysqli_fetch_array($pass)['pass'];

			// compare the credential against the current user's cookies
			// if no user found OR if password cookie not set OR if cookie in password doesn't match password in database
			if (!$username || !isset($_COOKIE['hackme_pass']) || $pass != $_COOKIE['hackme_pass'])
				die("Only user who posted the thread can delete it.");
			mysqli_stmt_prepare($stmt, "DELETE FROM threads WHERE id = ?") &&
				mysqli_stmt_bind_param($stmt, "s", $_GET['delpid']) &&
				mysqli_stmt_execute($stmt) || die(mysqli_stmt_error($stmt));
		}
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
	include('check_logged_in.php');
	if(!logged_in($DB)){
		 die('Why are you not logged in?!');
	}else
	{
		print("<p>Logged in as <a>$_COOKIE[hackme]</a></p>");
	}
?>
<?php
	mysqli_stmt_prepare($stmt, "SELECT * FROM threads WHERE id = ?") &&
		mysqli_stmt_bind_param($stmt, "s", $_GET['pid']) &&
		mysqli_stmt_execute($stmt) || die(mysqli_stmt_error($stmt));
	$threads = mysqli_stmt_get_result($stmt);
	while($thisthread = mysqli_fetch_array( $threads )){
?>
	<div class="post">
	<div class="post-bgtop">
	<div class="post-bgbtm">
		<h2 class="title"><a href="show.php?pid=<?php echo $thisthread['id'] ?>"><?php echo $thisthread['title']?></a></h2>
							<p class="meta"><span class="date"> <?php echo date('l, d F, Y',$thisthread['date']) ?> - Posted by <a href="#"><?php echo $thisthread['username'] ?> </a></p>
         
         <div class="entry">
			
            <?php echo $thisthread['message'] ?>
            					
		 </div>
         
	</div>
	</div>
	</div>
    
    <?php
		if ($_COOKIE['hackme'] == $thisthread['username'])
		{
	?>
    	<a href="show.php?delpid=<?php echo $thisthread['id']?>">DELETE</a>
    <?php
		}
	?> 

<?php
}
	include('footer.php');
?>
</body>
</html>
