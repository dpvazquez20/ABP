<?php
//Application start file

include '../views/log_in.php';

$redirect = false;
$redirect = $_REQUEST['redirect'];

	if ($redirect == 'true')
	{
		if (!isset($_SESSION['show']))
		{
            new LogIn('');
		}
		else
		{
            header('Location:../views/home.php');
        }
	}
	else
	{
		header('Location:../views/home.php');
	}
?>
