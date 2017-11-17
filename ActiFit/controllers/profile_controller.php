<?php 

    include '../models/user_model.php';
    include '../views/profile.php';
    include '../languages/spanish.php';
    include '../views/log_in.php';
    session_start();

	// getting form's data
	function get_data_form()
    {

		$id = $_SESSION['userId'];
		$login= '';
		$contrasenha = '';
		$nombre = '';
		$apellidos = '';
		$dni = '';
		$email = '';
		$tipo = '';
		$imagen = '';

		if(isset($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			//unset($_REQUEST['id']);
		}
		if(isset($_REQUEST['login']))
		{
			$login = $_REQUEST['login'];
			unset($_REQUEST['login']);
		}
		if(isset($_REQUEST['contrasenha']))
		{
		    if($_REQUEST['contrasenha'] <> '')
		    {
                $contrasenha = password_hash($_REQUEST['contrasenha'], PASSWORD_DEFAULT, ['cost' => 15]);
                unset($_REQUEST['constrasenha']);
            }
		}
		if(isset($_REQUEST['nombre']))
		{
			$nombre = $_REQUEST['nombre'];
			unset($_REQUEST['nombre']);
		}
		if(isset($_REQUEST['apellidos']))
		{
			$apellidos = $_REQUEST['apellidos'];
			unset($_REQUEST['apellidos']);
		}
		if(isset($_REQUEST['dni']))
		{
			$dni = $_REQUEST['dni'];
			//unset($_REQUEST['dni']);
		}
		if(isset($_REQUEST['email']))
		{
			$email = $_REQUEST['email'];
			unset($_REQUEST['email']);
		}
		if(isset($_REQUEST['tipo']))
		{
			$tipo = $_REQUEST['tipo'];
			unset($_REQUEST['tipo']);
		}
        if(isset($_FILES['imagen']))
        {
            if ($_FILES['imagen']['size'] > 0)
            {
                $directory = '../images/profiles/';
                $uploaded_file = $directory . basename($_FILES['imagen']['name']);
                copy($_FILES['imagen']['tmp_name'], $uploaded_file);

                $imagen = basename($_FILES['imagen']['name']);
                unset($_FILES['imagen']);
            }
        }

		$user = new UserModel($id,$login,$contrasenha,$nombre,$apellidos,$dni,$email,$tipo,$imagen);

		return $user;
	}

	// checking that user is logged
	if(isset($_SESSION['userType']))
	{

		// checking that user has permissions
		if($_SESSION['userType'] == $strings['admin'] || $_SESSION['userType'] == $strings['secretary'] || $_SESSION['userType'] == $strings['coach'] || $_SESSION['userType'] == $strings['sportsman'])
	    {

			if (isset($_REQUEST['action']))
			{
				$action = $_REQUEST['action'];
			}else {
				$action = '';
			}

			Switch ($action)
            {
				// selected modify an user
				case $strings['Modify']:
	
					$user = get_data_form(); // getting data
					$reply = $user->modify(); // trying modify
					$data = $user->consult(); // getting users list
					new ProfileDefault($data, $reply); // showing users list with a message				

					break;


                default:
                	$user = get_data_form();
					$data = $user->consult(); // getting users list
					$reply = '';
					new ProfileDefault($data, $reply); // showing users list without a message

					break;
			}

		} else {
            header('Location: ../views/home.php');
        }

	}else {
		new LogIn('');
	}
?>