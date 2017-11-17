<?php 

    include '../models/table_line_model.php';
    //include '../views/table_line_default.php';
    include '../views/table_line_add.php';
    include '../views/table_line_modify.php';
    include '../views/table_line_consult.php';
    include '../languages/spanish.php';
    include '../views/log_in.php';
    session_start();

	// getting form's data
	function get_data_form()
    {

		include '../languages/spanish.php';

		$id = '';
		$idTabla = '';
    	$ejercicio = '';
    	$series = '';
    	$repeticiones = '';
    	$duracion = '';
    	$descanso = '';

    	if(isset($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			//unset($_REQUEST['id']);
		}
    	if(isset($_REQUEST['idTabla']))
		{
			$idTabla = $_REQUEST['idTabla'];
			//unset($_REQUEST['idTabla']);
		}
		if(isset($_REQUEST[$strings['Exercise']]))
		{
			$ejercicio = $_REQUEST[$strings['Exercise']];
			unset($_REQUEST[$strings['Exercise']]);
		}
		if(isset($_REQUEST['series']))
		{
			$series = $_REQUEST['series'];
			unset($_REQUEST['series']);
		}
		if(isset($_REQUEST['repeticiones']))
		{
			$repeticiones = $_REQUEST['repeticiones'];
			unset($_REQUEST['repeticiones']);
		}
		if(isset($_REQUEST['duracion']))
		{
			$duracion = $_REQUEST['duracion'];
			unset($_REQUEST['duracion']);
		}
		if(isset($_REQUEST['descanso']))
		{
			$descanso = $_REQUEST['descanso'];
			unset($_REQUEST['descanso']);
		}

		$line = new TableLineModel($id,$idTabla,$ejercicio,$series,$repeticiones,$duracion,$descanso);
		return $line;
	}

	// checking that user is logged
	if(isset($_SESSION['userType']))
	{

		// checking that user has permissions
		if($_SESSION['userType'] == $strings['coach'])
	    {

			if (isset($_REQUEST['action']))
			{
				$action = $_REQUEST['action'];
			}else {
				$action = '';
			}

			Switch ($action)
            {

				// selected add an table_line
				case $strings['Insert']:

					// looking for form's data
					if (!isset($_REQUEST['series']))
					{ // if not, the view is called
						$line = get_data_form(); // getting data
						$data = $line->toListExercises(); // getting exercices list
						new TableLineAdd($data,$_REQUEST['idTabla'],'');
					
					}else { // if we have form's data, we insert it
						$line = get_data_form(); // getting data
						$reply = $line->insert(); // trying insert
						$data = $line->toListExercises(); // getting exercices list
						new TableLineAdd($data, $_REQUEST['idTabla'],$reply);
					}

					break;

				// selected delete a table_line
				case $strings['Delete']:

					// looking for form's data
					if (isset($_REQUEST['id']))
					{ // if exist, we try the deleting
						$line = get_data_form(); // getting data
						$reply = $line->delete(); // trying delete
						$data = $line->toList();
						//die("DIE: message: " . $reply . "<br> ID: " . $_REQUEST['idLinea']);
						// looking for form's data
						//die("DIE: idTabla: " . $_REQUEST['idTabla']);
						if (isset($_REQUEST['idTabla'])) // if we have form's data, we insert it
						{
							$textLocation = 'Location: table_controller.php?id=' . $_REQUEST['idTabla'] . '&action=' . $strings['See'] . '&message=' . $reply;
							header($textLocation);
						
						}else { // if not, the view is called
							$textLocation = 'Location: table_controller.php';
							header($textLocation);
						}
						//new UserDefault($data, $reply); 

					}else {
                        $textLocation = 'Location: table_controller.php';
						header($textLocation);
					}
					
					break;

				// selected modify a line
				case $strings['Modify']:

					// looking for form's data
					if (isset($_REQUEST['id']))
					{ // if not, the view is called

						$line = get_data_form(); // getting data

						if(isset($_REQUEST['idTabla'])){
							
							$reply = $line->modify(); // trying modify
							$textLocation = 'Location: table_controller.php?id=' . $_REQUEST['idTabla'] . '&action=' . $strings['See'] . '&message=' . $reply;
							header($textLocation);

						}else{
							$data = $line->consult();
							$listExercises = $line->toListExercises();
							new TableLineModify($data,$listExercises);
						}

					}else { // if we have form's data, we modify it
						$textLocation = 'Location: table_controller.php';
						header($textLocation);
					}

					break;

				// selected see user's details
				case $strings['See']:

					// looking for form's data
					if (isset($_REQUEST['idTabla'])) // if we have form's data, we insert it
					{
						$textLocation = 'Location: table_controller.php?id=' . $_REQUEST['idTabla'] . '&action=' . $strings['See'];
						header($textLocation);
					
					}else { // if not, the view is called
						$textLocation = 'Location: table_controller.php';
						header($textLocation);
					}

					break;

                // selected something to find
                case $strings['Search']:

                    // looking for data
                    if (isset($_REQUEST['searchfield']))
                    {
                        $line = get_data_form(); // getting data
                        $reply = $line->search($_REQUEST['searchfield']); // getting reply
                        unset($_REQUEST['searchfield']);

                        if (is_string($reply))
                        {
                            $data = $line->toList(); // getting lines list
                            new UserDefault($data, $reply); // showing an error message

                        }else {
                            new UserDefault($reply, ''); // showing lines list without a message
                        }
                    }

                    break;

                // selected order by something
                case $strings['Order']:

                     // looking for data
                     if (isset($_REQUEST['orderfield']))
                     {
                         $line = get_data_form(); // getting data
                         $reply = $line->order($_REQUEST['orderfield']); // getting reply
                         unset($_REQUEST['orderfield']);

                         if (is_string($reply))
                         {
                             $data = $line->toList(); // getting lines list
                             new UserDefault($data, $reply); // showing an error message

                         }else {
                             new UserDefault($reply, ''); // showing lines list without a message
                         }
                     }

                     break;


                default:
                	// looking for form's data
					if (isset($_REQUEST['idTabla'])) // if we have form's data, we insert it
					{
						$textLocation = 'Location: table_controller.php?id=' . $_REQUEST['idTabla'] . '&action=' . $strings['See'];
						header($textLocation);
					
					}else { // if not, the view is called
						$textLocation = 'Location: table_controller.php';
						header($textLocation);
					}
			}
		}else {
			header('Location: ../views/home.php');
		}

	}else {
		new LogIn('');
	}
?>