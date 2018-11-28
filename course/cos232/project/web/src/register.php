<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>hackme</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<?php
	include('connect.php');
	include('header.php');
	$DB = connect();
	$stmt = mysqli_stmt_init($DB);
?>
<div class="post">
	<div class="post-bgtop">
		<div class="post-bgbtm">
        <h2 class = "title">hackme Registration</h2>
        <?php
		//if the registration form is submitted 
		if (isset($_POST['submit'])) {
			
			$_POST['uname'] = trim($_POST['uname']);
			if(!$_POST['uname'] | !$_POST['password'] |
				!$_POST['fname'] | !$_POST['lname']) {
 				die('<p>You did not fill in a required field.
				Please go back and try again!</p>');
 			}
			include ("get_password.php");
			$password = getPlainPassWord($_POST['encrypted-password']);

			// This does not work, because the pspell module was not loaded.
			// $pspell = pspell_new('en', '', '', '', PSPELL_NORMAL);
			// if(pspell_check($pspell, $password)) {
			//	die('<p>Your password should not be a dictionary word. </p>');
			// }

			// check password length
			if(strlen($password) <= 8) 
				die('<p>Your password should be longer than 8 chars,
				Please go back and try again!</p>');

			$dictionary = fopen("dict.txt", "r");
			if ($dictionary) {
				while (($line = fgets($dictionary)) !== false) {
					$line = trim($line);
					if (strcmp($line, $password) == 0)
						die("<p>Password cannot be a dictionary word!</p>");
				}
			}
			else {
				error_log("Dictionary file not found.", 0);
			}

			$password = hash("sha256",$password);
			$password = substr($password, 0, 40);

			
			mysqli_stmt_prepare($stmt, "SELECT * FROM users WHERE username = ?") &&
				mysqli_stmt_bind_param($stmt, "s", $_POST['uname']) &&
				mysqli_stmt_execute($stmt) || die(mysqli_stmt_error($stmt));
			$check = mysqli_stmt_get_result($stmt);
 
 		//Gives error if user already exist
 		$check2 = mysqli_num_rows($check);
		if ($check2 != 0) {
			die('<p>Sorry, user name already exisits.</p>');
		}
		else
		{

		mysqli_stmt_prepare($stmt, "INSERT INTO users (username, pass, fname, lname) VALUES(?,?,?,?)") &&
			mysqli_stmt_bind_param($stmt, "ssss", $_POST['uname'], $password, $_POST['fname'], $_POST['lname']) &&
			mysqli_stmt_execute($stmt) || die(mysqli_stmt_error($stmt));
			
			echo "<h3> Registration Successful!</h3> <p>Welcome ". $_POST['fname'] ."! Please log in...</p>";
		} 
        ?>    
        <?php
		}else{
        ?>
        	<form id="userform" method="post" action="register.php">
            <table>
                <tr>
                    <td> Username </td> 
                    <td> <input type="text" name="uname" maxlength="20"/> </td>
                    <td> <em>choose a login id</em> </td>
                </tr>
                <tr>
                    <td> Password </td>
                    <td> <input type="password" name="password" maxlength="40" /> </td>
                </tr>
                <tr>
                    <td> First Name </td>
                    <td> <input type="text" name="fname" maxlength="25"/> </td>
                </tr>
                 <tr>
                    <td> Last Name </td>
                    <td> <input type="text" name="lname" maxlength="25"/> </td>
                </tr>
                <tr>
                    <td> <input type="submit" name="submit" value="Register" /> </td>
                </tr>
            </table>
            </form>
        <?php
			include("encrypt_password_field.php");
		}
		?>
        </div>
    </div>
</div>
<?php
	include('footer.php');
?>
</body>
</html>
