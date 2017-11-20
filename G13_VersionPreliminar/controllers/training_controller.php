<?php 

    include '../models/training_model.php';
    include '../views/training_default.php';
    include '../views/training_add.php';
	include '../views/training_table_add.php';
	include '../views/user_training_add.php';
    include '../views/training_consult.php';
    include '../languages/spanish.php';
    include '../views/log_in.php';
    session_start();

	// getting form's data
	function get_data_form()
    {

		$id = '';
		$nombre= '';
		$sesiones = '';

		if(isset($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			//unset($_REQUEST['id']);
		}
		if(isset($_REQUEST['nombre']))
		{
			$nombre = $_REQUEST['nombre'];
			unset($_REQUEST['nombre']);
		}
		if(isset($_REQUEST['sesiones']))
		{
		    $sesiones = $_REQUEST['sesiones'];
		    unset($_REQUEST['sesiones']);
		}		

		$training = new TrainingModel($id,$nombre,$sesiones);

		return $training;
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

				// selected add an training
				case $strings['Insert']:

					// looking for form's data
					if (!isset($_REQUEST['nombre']))
					{ // if not, the view is called
						$training = get_data_form(); // getting data
						//$listTables = $training->toListTables();
						//new TrainingAdd($listTables);
						new TrainingAdd();
					
					}else { // if we have form's data, we insert it
						$training = get_data_form(); // getting data
						$reply = $training->insert(); // trying insert
						$data = $training->toList(); // getting trainings list
						new TrainingDefault($data, $reply); // showing trainings list with a message
					}

					break;

				
				case $strings['InsertTables']:					
					// looking for form's data
					if (!isset($_REQUEST['nombre']))
					{ // if not, the view is called
						$training = get_data_form(); // getting data
						$reply = $training->insert(); // trying insert
						$data = $training->toList(); // getting trainings list
						new TrainingDefault($data, $reply); // showing trainings list with a message
					
					}else{ // if we have form's data, we insert it
						
						$training = get_data_form(); // getting data
						$data = $training->insert();
						$listTables = $training->toListTables();
						//new TrainingAdd($listTables);
						$training_id = $training->getTrainingId();
						if($data == $strings['InsertSuccess'])
						{
							new TrainingTableAdd($listTables,$training_id);
						}else{
							$list = $training->toList();
							new TrainingDefault($list, $data);
						}
					}

					break;			
				
				// selected delete an training
				
				case $strings['Delete']:

					// looking for form's data
					if (isset($_REQUEST['id']))
					{ // if exist, we try the deleting
						$training = get_data_form(); // getting data
						$reply = $training->delete(); // trying delete
						$data = $training->toList(); // getting trainings list
						new TrainingDefault($data, $reply); // showing trainings list with a message

					}else {
                        $training = get_data_form(); // getting data
                        $reply = $training->delete(); // trying delete
						$data = $training->toList(); // getting trainings list
						new TrainingDefault($data, $reply); // showing trainings list with a message
					}
					
					break;
					
				// selected delete an training
				case $strings['DeleteTable']:

					// looking for form's data
					if (isset($_REQUEST['id']))
					{ // if exist, we try the deleting
						$training = get_data_form(); // getting data
						$reply = $training->deleteTable(); // trying delete
						$data = $training->toList(); // getting trainings list
						new TrainingDefault($data, $reply); // showing trainings list with a message

					}else {
                        $training = get_data_form(); // getting data
                        $reply = $training->delete(); // trying delete
						$data = $training->toList(); // getting trainings list
						new TrainingDefault($data, $reply); // showing trainings list with a message
					}
					
					break;

				// selected modify an training
				case $strings['Modify']:

					// looking for form's data
					if (!isset($_REQUEST['nombre']))
					{ // if not, the view is called
                        $training = get_data_form(); // getting data
                        $data = $training->consult(); // trying consult
						new TrainingModify($data);

					}else { // if we have form's data, we modify it
						$training = get_data_form(); // getting data
						$reply = $training->modify(); // trying modify
						$data = $training->toList(); // getting trainings list
						new TrainingDefault($data, $reply); // showing trainings list with a message
					}

					break;

				// selected see training's details
				case $strings['See']:

					// looking for form's data
					if (isset($_REQUEST['id'])) // if we have form's data, we insert it
					{
						$training = get_data_form(); // getting data
						$data = $training->consult(); // trying consult
						$tables = $training->getTables();
						new TrainingConsult($data, $tables); // showing training data   
					
					}else { // if not, the view is called
						$training = get_data_form(); // getting data
                        $reply = $training->consult(); // trying consult
                        $data = $training->toList(); // getting trainings list
                        new TrainingDefault($data, $reply); // showing trainings list without a message
					}

					break;

                // selected something to find
                case $strings['Search']:

                    // looking for data
                    if (isset($_REQUEST['searchfield']))
                    {
                        $training = get_data_form(); // getting data
                        $reply = $training->search($_REQUEST['searchfield']); // getting reply
                        unset($_REQUEST['searchfield']);

                        if (is_string($reply))
                        {
                            $data = $training->toList(); // getting trainings list
                            new TrainingDefault($data, $reply); // showing an error message

                        }else {
                            new TrainingDefault($reply, ''); // showing trainings list without a message
                        }
                    }

                    break;
					
					
					// selected something to find
                case $strings['Assign']:

                    if (!isset($_REQUEST['training_id'])) // if we have form's data, we insert it
					{
						$user_id = $_REQUEST['user_id'];
						$training = get_data_form(); // getting data
						$listTrainings = $training->toListTrainings();
						new UserTrainingAdd($listTrainings, $user_id); // showing training data   
					
					}else { // if not, the view is called
						$training = get_data_form(); // getting data
						$user_id = $_REQUEST['user_id'];
						die($user_id);
                        $reply = $training->assign($user_id); // trying consult
                        $data = $training->toList(); // getting trainings list
                        new TrainingDefault($data, $reply); // showing trainings list without a message
					}

					break;
					
				case $strings['AssignTraining']:

                    if (isset($_REQUEST['user_id'])) // if we have form's data, we insert it
					{
						$training = get_data_form(); // getting data
						$user_id = $_REQUEST['user_id'];
						$training_id = $_REQUEST['Entrenamiento'];
                        $reply = $training->assign($user_id, $training_id);
                        $data = $training->toList();
                        new TrainingDefault($data, $reply);
					
					}else { // if not, the view is called
						$training = get_data_form(); // getting data						
                        $data = $training->toList();
                        new TrainingDefault($data, $reply);
					}

					break;	
				

                // selected order by something
                case $strings['Order']:

                     // looking for data
                     if (isset($_REQUEST['orderfield']))
                     {
                         $training = get_data_form(); // getting data
                         $reply = $training->order($_REQUEST['orderfield']); // getting reply
                         unset($_REQUEST['orderfield']);

                         if (is_string($reply))
                         {
                             $data = $training->toList(); // getting trainings list
                             new TrainingDefault($data, $reply); // showing an error message

                         }else {
                             new TrainingDefault($reply, ''); // showing trainings list without a message
                         }
                     }

                     break;


                default:
                	$training = get_data_form();
					$data = $training->toList(); // getting trainings list
					$reply = '';
					new TrainingDefault($data, $reply); // showing trainings list without a message

					break;
			}

		}elseif($_SESSION['userType'] == $strings['sportsman']) {

            if (isset($_REQUEST['action']))
            {
                $action = $_REQUEST['action'];
            } else {
                $action = '';
            }

            Switch ($action)
            {
                // selected see training's details
				case $strings['See']:

					// looking for form's data
					if (isset($_REQUEST['id'])) // if we have form's data, we insert it
					{
						$training = get_data_form(); // getting data
						$data = $training->consult(); // trying consult
						new TrainingConsult($data); // showing training data   
					
					}else { // if not, the view is called
						$training = get_data_form(); // getting data
                        $reply = $training->consult(); // trying consult
                        $data = $training->toList(); // getting trainings list
                        new TrainingDefault($data, $reply); // showing trainings list without a message
					}

					break;
				
				// selected something to find
                case $strings['Search']:

                    // looking for data
                    if (isset($_REQUEST['searchfield']))
                    {
                        $training = get_data_form(); // getting data
                        $reply = $training->search($_REQUEST['searchfield']); // getting reply
                        unset($_REQUEST['searchfield']);

                        if (is_string($reply))
                        {
                            $data = $training->toList(); // getting trainings list
                            new TrainingDefault($data, $reply); // showing an error message

                        }else {
                            new TrainingDefault($reply, ''); // showing trainings list without a message
                        }
                    }

                    break;

                // selected order by something
                case $strings['Order']:

                    // looking for data
                    if (isset($_REQUEST['orderfield']))
                    {
                        $training = get_data_form(); // getting data
                        $reply = $training->order($_REQUEST['orderfield']); // getting reply
                        unset($_REQUEST['orderfield']);

                        if (is_string($reply))
                        {
                            $data = $training->toList(); // getting trainings list
                            new TrainingDefault($data, $reply); // showing an error message

                        }else {
                            new TrainingDefault($reply, ''); // showing trainings list without a message
                        }
                    }

                    break;


                default:
                    header('Location: ../views/home.php');
					
                    break;
            }

        } else {
            header('Location: ../views/home.php');
        }

	}else {
		new LogIn('');
	}
?>