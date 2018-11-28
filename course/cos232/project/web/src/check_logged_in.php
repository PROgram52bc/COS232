<?php /* To use this file: 
include it, and call check_logged_in() when needed. 
Return true if everything is alright.
Return false if the user credential in cookies do not match the database.
 */
	function logged_in($DB) 
	{
		if (!isset($_COOKIE['hackme']) || !isset($_COOKIE['hackme_pass'])) return false;
		$stmt = mysqli_stmt_init($DB);
		mysqli_stmt_prepare($stmt, "SELECT * FROM users WHERE username = ?") &&
			mysqli_stmt_bind_param($stmt, "s", $_COOKIE['hackme']) &&
			mysqli_stmt_execute($stmt) || die(mysqli_stmt_error($stmt));
		$userquery = mysqli_stmt_get_result($stmt);
		$userinfo = mysqli_fetch_assoc($userquery); // get an assoc array for the user
		if ($userinfo && isset($_COOKIE['hackme_pass']) && $userinfo['pass'] == $_COOKIE['hackme_pass']) 
			return true;
		else
			return false;
	}
?>	
