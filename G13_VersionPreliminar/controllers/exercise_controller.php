<?php 

    include '../models/exercise_model.php';
    include '../views/exercise_default.php';
    include '../views/exercise_add.php';
    include '../views/exercise_modify.php';
    include '../views/exercise_consult.php';
    include '../languages/spanish.php';
    include '../views/log_in.php';
    session_start();

	// getting form's data
	function get_data_form()
    {

		$id = '';
		$nombre = '';
		$descripcion = '';
		$imagen = '';
		$tipo = '';

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
		if(isset($_REQUEST['descripcion']))
		{
			$descripcion = $_REQUEST['descripcion'];
			unset($_REQUEST['descripcion']);
		}
		if(isset($_FILES['imagen']))
		{
		    if ($_FILES['imagen']['size'] > 0)
            {
                $directory = '../images/exercises/';
                $uploaded_file = $directory . basename($_FILES['imagen']['name']);
                copy($_FILES['imagen']['tmp_name'], $uploaded_file);

                $imagen = basename($_FILES['imagen']['name']);
                unset($_FILES['imagen']);
            }
		}
		if(isset($_REQUEST['tipo']))
		{
			$tipo = $_REQUEST['tipo'];
			unset($_REQUEST['tipo']);
		}

		$exercise = new ExerciseModel($id,$nombre,$descripcion,$imagen,$tipo);

		return $exercise;
	}

	// checking that exercise is logged
	if(isset($_SESSION['userType']))
	{

		// checking that exercise has permissions
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

				// selected add an exercise
				case $strings['Insert']:

					// looking for form's data
					if (!isset($_REQUEST['nombre']))
					{ // if not, the view is called
						new ExerciseAdd();
					
					}else { // if we have form's data, we insert it
						$exercise = get_data_form(); // getting data
						$reply = $exercise->insert(); // trying insert
						$data = $exercise->toList(); // getting exercises list
						new ExerciseDefault($data, $reply); // showing exercises list with a message
					}

					break;

				// selected delete an exercise
				case $strings['Delete']:

					// looking for form's data
					if (isset($_REQUEST['id']))
					{ // if exist, we try the deleting
						$exercise = get_data_form(); // getting data
						$reply = $exercise->delete(); // trying delete
						$data = $exercise->toList(); // getting exercises list
						new ExerciseDefault($data, $reply); // showing exercises list with a message

					}else {
                        $exercise = get_data_form(); // getting data
                        $reply = $exercise->delete(); // trying delete
						$data = $exercise->toList(); // getting exercises list
						new ExerciseDefault($data, $reply); // showing exercises list with a message
					}
					
					break;

				// selected modify an exercise
				case $strings['Modify']:

					// looking for form's data
					if (!isset($_REQUEST['nombre']))
					{ // if not, the view is called
                        $exercise = get_data_form(); // getting data
                        $data = $exercise->consult(); // trying consult
						new ExerciseModify($data);

					}else { // if we have form's data, we modify it
						$exercise = get_data_form(); // getting data
						$reply = $exercise->modify(); // trying modify
						$data = $exercise->toList(); // getting exercises list
						new ExerciseDefault($data, $reply); // showing exercises list with a message
					}

					break;

				// selected see exercise's details
				case $strings['See']:

					// looking for form's data
					if (isset($_REQUEST['id'])) // if we have form's data, we insert it
					{
						$exercise = get_data_form(); // getting data
						$data = $exercise->consult(); // trying consult
						new ExerciseConsult($data); // showing exercise data   
					
					}else { // if not, the view is called
						$exercise = get_data_form(); // getting data
                        $reply = $exercise->consult(); // trying consult
                        $data = $exercise->toList(); // getting exercises list
                        new ExerciseDefault($data, $reply); // showing exercises list without a message
					}

					break;

                // selected something to find
                case $strings['Search']:

                    // looking for data
                    if (isset($_REQUEST['searchfield']))
                    {
                        $exercise = get_data_form(); // getting data
                        $reply = $exercise->search($_REQUEST['searchfield']); // getting reply
                        unset($_REQUEST['searchfield']);

                        if (is_string($reply))
                        {
                            $data = $exercise->toList(); // getting exercises list
                            new ExerciseDefault($data, $reply); // showing an error message

                        }else {
                            new ExerciseDefault($reply, ''); // showing exercises list without a message
                        }
                    }

                    break;

                // selected order by something
                case $strings['Order']:

                     // looking for data
                     if (isset($_REQUEST['orderfield']))
                     {
                         $exercise = get_data_form(); // getting data
                         $reply = $exercise->order($_REQUEST['orderfield']); // getting reply
                         unset($_REQUEST['orderfield']);

                         if (is_string($reply))
                         {
                             $data = $exercise->toList(); // getting exercises list
                             new ExerciseDefault($data, $reply); // showing an error message

                         }else {
                             new ExerciseDefault($reply, ''); // showing exercises list without a message
                         }
                     }

                     break;


                default:
                	$exercise = get_data_form();
					$data = $exercise->toList(); // getting exercises list
					$reply = '';
					new ExerciseDefault($data, $reply); // showing exercises list without a message

					break;
			}
		}else {
			header('Location: ../views/home.php');
		}

	}else {
		new LogIn('');
	}
?>