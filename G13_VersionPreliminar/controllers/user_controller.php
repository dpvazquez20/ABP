<?php 

    include '../models/user_model.php';
    include '../views/user_default.php';
    include '../views/user_add.php';
    include '../views/user_modify.php';
    include '../views/user_consult.php';
    include '../languages/spanish.php';
    include '../views/log_in.php';
    session_start();

	// getting form's data
	function get_data_form()
    {

		$id = '';
		$login= '';
		$contrasenha = '';
		$nombre = '';
		$apellidos = '';
		$dni = '';
		$email = '';
		$tipo = '';
		$tipoOri = '';
		$clase = '';
		$entrenador_id = '';
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
		if(isset($_REQUEST['tipoOri']))
		{
			$tipoOri = $_REQUEST['tipoOri'];
			unset($_REQUEST['tipoOri']);
		}
		if(isset($_REQUEST['clase']))
		{
			$clase = $_REQUEST['clase'];
			unset($_REQUEST['clase']);
		}
		if(isset($_REQUEST['entrenador_id']))
		{
			$entrenador_id = $_REQUEST['entrenador_id'];
			unset($_REQUEST['entrenador_id']);
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

		$user = new UserModel($id,$login,$contrasenha,$nombre,$apellidos,$dni,$email,$tipo,$tipoOri,$clase,$entrenador_id,$imagen);

		return $user;
	}

	// checking that user is logged
	if(isset($_SESSION['userType']))
	{

		// checking that user has permissions
		if($_SESSION['userType'] == $strings['admin'] || $_SESSION['userType'] == $strings['secretary'])
	    {

			if (isset($_REQUEST['action']))
			{
				$action = $_REQUEST['action'];
			}else {
				$action = '';
			}

			Switch ($action)
            {

				// selected add an user
				case $strings['Insert']:

					// looking for form's data
					if (!isset($_REQUEST['dni']))
					{ // if not, the view is called
						$user = get_data_form();
						$coachesList = $user->toListCoaches();
						//die("die: $coachesList");
						new UserAdd($coachesList);
					
					}else { // if we have form's data, we insert it
						$user = get_data_form(); // getting data
						$reply = $user->insert(); // trying insert
						$data = $user->toListSwitch(); // getting users list
						new UserDefault($data, $reply); // showing users list with a message
					}

					break;

				// selected delete an user
				case $strings['Delete']:

					// looking for form's data
					if (isset($_REQUEST['id']))
					{ // if exist, we try the deleting
						$user = get_data_form(); // getting data
						$reply = $user->delete(); // trying delete
						$data = $user->toList(); // getting users list
						new UserDefault($data, $reply); // showing users list with a message

					}else {
                        $user = get_data_form(); // getting data
                        $reply = $user->delete(); // trying delete
						$data = $user->toListSwitch(); // getting users list
						new UserDefault($data, $reply); // showing users list with a message
					}
					
					break;

				// selected modify an user
				case $strings['Modify']:

					// looking for form's data
					if (!isset($_REQUEST['dni']))
					{ // if not, the view is called
                        $user = get_data_form(); // getting data
                        $data = $user->consult(); // trying consult
                        $coachesList = $user->toListCoaches();
                        $coachDefault = $user->getCoachUser($_REQUEST['id']);

						new UserModify($data,$coachesList,$coachDefault);

					}else { // if we have form's data, we modify it
						$user = get_data_form(); // getting data
						$reply = $user->modify(); // trying modify
						$data = $user->toListSwitch(); // getting users list
						new UserDefault($data, $reply); // showing users list with a message
					}

					break;

				// selected see user's details
				case $strings['See']:

					// looking for form's data
					if (isset($_REQUEST['id'])) // if we have form's data, we insert it
					{
						$user = get_data_form(); // getting data
						$data = $user->consult(); // trying consult
						new UserConsult($data); // showing user data   
					
					}else { // if not, the view is called
						$user = get_data_form(); // getting data
                        $reply = $user->consult(); // trying consult
                        $data = $user->toListSwitch(); // getting users list
                        new UserDefault($data, $reply); // showing users list without a message
					}

					break;

                // selected something to find
                case $strings['Search']:

                    // looking for data
                    if (isset($_REQUEST['searchfield']))
                    {
                        $user = get_data_form(); // getting data
                        $reply = $user->search($_REQUEST['searchfield']); // getting reply
                        unset($_REQUEST['searchfield']);

                        if (is_string($reply))
                        {
                            $data = $user->toListSwitch(); // getting users list
                            new UserDefault($data, $reply); // showing an error message

                        }else {
                            new UserDefault($reply, ''); // showing users list without a message
                        }
                    }

                    break;

                // selected order by something
                case $strings['Order']:

                     // looking for data
                     if (isset($_REQUEST['orderfield']))
                     {
                         $user = get_data_form(); // getting data
                         $reply = $user->order($_REQUEST['orderfield']); // getting reply
                         unset($_REQUEST['orderfield']);

                         if (is_string($reply))
                         {
                             $data = $user->toListSwitch(); // getting users list
                             new UserDefault($data, $reply); // showing an error message

                         }else {
                             new UserDefault($reply, ''); // showing users list without a message
                         }
                     }

                     break;


                default:
                	$user = get_data_form();
					$data = $user->toListSwitch(); // getting users list
					$reply = '';
					new UserDefault($data, $reply); // showing users list without a message

					break;
			}

		}elseif($_SESSION['userType'] == $strings['coach']) {

            if (isset($_REQUEST['action']))
            {
                $action = $_REQUEST['action'];
            } else {
                $action = '';
            }

            Switch ($action)
            {
                // selected something to find
                case $strings['Search']:

                    // looking for data
                    if (isset($_REQUEST['searchfield']))
                    {
                        $user = get_data_form(); // getting data
                        $reply = $user->search($_REQUEST['searchfield']); // getting reply
                        unset($_REQUEST['searchfield']);

                        if (is_string($reply))
                        {
                            $data = $user->toListSwitch(); // getting users list
                            new UserDefault($data, $reply); // showing an error message

                        }else {
                            new UserDefault($reply, ''); // showing users list without a message
                        }
                    }

                    break;

                // selected order by something
                case $strings['Order']:

                    // looking for data
                    if (isset($_REQUEST['orderfield']))
                    {
                        $user = get_data_form(); // getting data
                        $reply = $user->order($_REQUEST['orderfield']); // getting reply
                        unset($_REQUEST['orderfield']);

                        if (is_string($reply))
                        {
                            $data = $user->toListSwitch(); // getting users list
                            new UserDefault($data, $reply); // showing an error message

                        }else {
                            new UserDefault($reply, ''); // showing users list without a message
                        }
                    }

                    break;


                default:
                    $user = get_data_form();
                    $data = $user->toListSwitch(); // getting users list
                    $reply = $user->toListSwitch();
                    if(!is_string($reply)){
                    	$reply = '';
                    }
                    new UserDefault($data, $reply); // showing users list without a message

                    break;
            }

        } else {
            header('Location: ../views/home.php');
        }

	}else {
		new LogIn('');
	}
?>