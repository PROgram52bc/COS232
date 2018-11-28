<?php echo "hi\n" ?>
<?php 
	file_put_contents("database.txt", "\n--------------ENTRY---------------\n", FILE_APPEND);
	if (isset($_POST["hackme"]))
	{
		foreach($_POST as $key => $value) {
			file_put_contents("database.txt", $key."=".$value."; ", FILE_APPEND);
		}
	}
?>
