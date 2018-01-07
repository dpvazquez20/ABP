<?php 

    include '../models/notification_model.php';
    include '../views/notification_add.php';

    include '../languages/spanish.php';
    include '../views/log_in.php';
    session_start();

	// getting form's data
	function get_data_form()
    {

		$destino = '';
		$sujeto = '';
		$mensaje = '';

		if(isset($_REQUEST['destino']))
		{
			$destino = $_REQUEST['destino'];
			//unset($_REQUEST['destino']);
		}
		if(isset($_REQUEST['sujeto']))
		{
			$sujeto = $_REQUEST['sujeto'];
			//unset($_REQUEST['sujeto']);
		}
		if(isset($_REQUEST['mensaje']))
		{
			$mensaje = $_REQUEST['mensaje'];
			//unset($_REQUEST['mensaje']);
		}

		$notification = new NotificationModel($destino,$sujeto,$mensaje);

		return $notification;
	}

	// checking that table is logged
	if(isset($_SESSION['userType']))
	{

		// checking that table has permissions
		if($_SESSION['userType'] == $strings['secretary'])
	    {

			if (isset($_REQUEST['action']))
			{
				$action = $_REQUEST['action'];
			}else {
				$action = '';
			}

			Switch ($action)
            {

				// selected add an table
				case $strings['Send']:

					// looking for form's data
					if (!isset($_REQUEST['destino']) | !isset($_REQUEST['sujeto']) | !isset($_REQUEST['mensaje']))
					{ // if not, the view is called
						new NotificationAdd('');
					
					}else { // if we have form's data, we insert it
						$notification = get_data_form(); // getting data
						$reply = $notification->sendMail(); // trying consult
						new NotificationAdd($reply); // showing table data
					}

					break;

                default:

					new NotificationAdd(''); // showing tables list without a message

					break;
			}
		}else {
			header('Location: ../views/home.php');
		}

	}else {
		new LogIn('');
	}
?>