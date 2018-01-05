<?php 

    include '../models/table_model.php';
    include '../views/table_default.php';
    include '../views/table_add.php';
    include '../views/table_modify.php';
    include '../views/table_consult.php';

    include '../languages/spanish.php';
    include '../views/log_in.php';
    session_start();

	// getting form's data
	function get_data_form()
    {

		$id = '';
		$nombre = '';
		$tipo = '';

		if(isset($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			//unset($_REQUEST['id']);
		}
		if(isset($_REQUEST['nombre']))
		{
			$nombre = $_REQUEST['nombre'];
			//unset($_REQUEST['nombre']);
		}
		if(isset($_REQUEST['tipo']))
		{
			$tipo = $_REQUEST['tipo'];
			unset($_REQUEST['tipo']);
		}

		$table = new TableModel($id,$nombre,$tipo);

		return $table;
	}

	function get_line($idTabla)
    {
    	include '../languages/spanish.php';

    	$idLinea = '';
    	$ejercicio = '';
    	$series = '';
    	$repeticiones = '';
    	$duracion = '';
    	$descanso = '';

    	if(isset($_REQUEST['idLinea']))
		{
			$idLinea = $_REQUEST['idLinea'];
			//unset($_REQUEST['idLinea']);
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

		$lineas = new TableLineModel($idLinea,$idTabla,$ejercicio,$series,$repeticiones,$duracion,$descanso);
		return $lineas;
	}

	// checking that table is logged
	if(isset($_SESSION['userType']))
	{

		// checking that table has permissions
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

				// selected add an table
				case $strings['Insert']:

					// looking for form's data
					if (!isset($_REQUEST['nombre']))
					{ // if not, the view is called
						new TableAdd();
					
					}else { // if we have form's data, we insert it

						$table = get_data_form(); // getting data
						$reply = $table->insert(); // trying insert

						//$data = $table->toList(); // getting tables list
						//new TableDefault($data, $reply); // showing tables list with a message

						$tableId = $table->getId();
						$textLocation = 'Location: table_line_controller.php?idTabla=' . $tableId . '&action=' . $strings['Insert'];
						header($textLocation);
					}

					break;
					
				/*case $strings['addLine']:

					$table = get_data_form(); // getting data
					$tableId = $_SESSION["idTabla"];
					$line = get_line($tableId);
					$reply = $line->insert();
					$listExercise = $table->toListExercises();
					new TableLineAdd($listExercise,$tableId);

					break;*/

				// selected delete an table
				case $strings['Delete']:

					// looking for form's data
					if (isset($_REQUEST['id']))
					{ // if exist, we try the deleting
						$table = get_data_form(); // getting data
						$reply = $table->delete(); // trying delete
						$data = $table->toList(); // getting tables list
						new TableDefault($data, $reply); // showing tables list with a message

					}else {
                        $table = get_data_form(); // getting data
                        $reply = $table->delete(); // trying delete
						$data = $table->toList(); // getting tables list
						new TableDefault($data, $reply); // showing tables list with a message
					}
					
					break;

				// selected modify an table
				case $strings['Modify']:

					// looking for form's data
					if (isset($_REQUEST['id']))
					{ // if not, the view is called
						if(isset($_REQUEST['nombre'])){
							$table = get_data_form(); // getting data
							$reply = $table->modify(); // trying consult
							$table = get_data_form(); // getting data
							$data = $table->consult(); // trying consult
							$lines = $table->getLines();
							new TableConsult($data,$lines,$reply,$_REQUEST['id']); // showing table data
						}else{
							$table = get_data_form(); // getting data
                       		$data = $table->consult(); // trying consult
							new TableModify($data);
						}
                        

					}else { // if we have form's data, we modify it
						$table = get_data_form(); // getting data
						$reply = $table->modify(); // trying modify
						$data = $table->toList(); // getting tables list
						new TableDefault($data, $reply); // showing tables list with a message
					}

					break;

				// selected see table's details
				case $strings['See']:

					// looking for form's data
					if (isset($_REQUEST['id'])) // if we have form's data, we insert it
					{
						if($_REQUEST['id'] <> 'undefined')
						{
							$table = get_data_form(); // getting data
							$data = $table->consult(); // trying consult
							$lines = $table->getLines();
							$reply = '';
							if(isset($_REQUEST['message'])){
								$reply = $_REQUEST['message'];
							}
							new TableConsult($data,$lines,$reply,$_REQUEST['id']); // showing table data
						}else{
							$table = get_data_form();
							$data = $table->toList(); // getting tables list
							$reply = '';
							new TableDefault($data, $reply); // showing tables list without a message
						}   
					
					}else { // if not, the view is called
						$table = get_data_form(); // getting data
                        $reply = $table->consult(); // trying consult
                        $data = $table->toList(); // getting tables list
                        new TableDefault($data, $reply); // showing tables list without a message
					}

					break;

                // selected something to find
                case $strings['Search']:

                    // looking for data
                    if (isset($_REQUEST['searchfield']))
                    {
                        $table = get_data_form(); // getting data
                        $reply = $table->search($_REQUEST['searchfield']); // getting reply
                        unset($_REQUEST['searchfield']);

                        if (is_string($reply))
                        {
                            $data = $table->toList(); // getting tables list
                            new TableDefault($data, $reply); // showing an error message

                        }else {
                            new TableDefault($reply, ''); // showing tables list without a message
                        }
                    }

                    break;

                // selected order by something
                case $strings['Order']:

                     // looking for data
                     if (isset($_REQUEST['orderfield']))
                     {
                         $table = get_data_form(); // getting data
                         $reply = $table->order($_REQUEST['orderfield']); // getting reply
                         unset($_REQUEST['orderfield']);

                         if (is_string($reply))
                         {
                             $data = $table->toList(); // getting tables list
                             new TableDefault($data, $reply); // showing an error message

                         }else {
                             new TableDefault($reply, ''); // showing tables list without a message
                         }
                     }

                     break;


                default:
                	$table = get_data_form();
					$data = $table->toList(); // getting tables list
					$reply = '';
					new TableDefault($data, $reply); // showing tables list without a message

					break;
			}
		}else {
			header('Location: ../views/home.php');
		}

	}else {
		new LogIn('');
	}
?>