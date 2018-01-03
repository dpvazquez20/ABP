<?php 

    include '../models/activity_model.php';
    include '../views/activity_default.php';
    include '../views/activity_add.php';
    include '../views/activity_modify.php';
    include '../views/activity_consult.php';
    include '../languages/spanish.php';
    include '../views/log_in.php';
    session_start();

	// getting form's data
	function get_data_form()
    {

		$id = '';
		$nombre = '';
		$descripcion = '';
        $resource='';
        $act_coach='';
        $frecuencia = '';
        $horaInicio = '';
        $horaFin = '';
        $fechaInicio='';
        $fechaFin='';
        $tipo = '';
		$numMaxParticipantes = '';

		$aux = '';

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
        if(isset($_REQUEST['resource']))
        {
            $resource = $_REQUEST['resource'];
            unset($_REQUEST['resource']);
        }
        if(isset($_REQUEST['act_coach']))
        {
            $act_coach = $_REQUEST['act_coach'];
            unset($_REQUEST['act_coach']);
        }
        if(isset($_REQUEST['frecuencia']))
        {
            $frecuencia = $_REQUEST['frecuencia'];
            unset($_REQUEST['frecuencia']);
        }
        if(isset($_REQUEST['horaInicio']))
        {
            $horaInicio = $_REQUEST['horaInicio'] . ':00';
            unset($_REQUEST['horaInicio']);
        }
        if(isset($_REQUEST['horaFin']))
        {
            $horaFin = $_REQUEST['horaFin'] . ':00';
            unset($_REQUEST['horaFin']);
        }
        if(isset($_REQUEST['fechaInicio']))
        {
            $fechaInicio = $_REQUEST['fechaInicio'];
            unset($_REQUEST['fechaInicio']);
        }
        if(isset($_REQUEST['fechaFin']))
        {
            $fechaFin = $_REQUEST['fechaFin'];
            unset($_REQUEST['fechaFin']);
        }
        if(isset($_REQUEST['tipo']))
        {
            $tipo = $_REQUEST['tipo'];
            unset($_REQUEST['tipo']);
        }
		if(isset($_REQUEST['numMaxParticipantes']))
		{
			$numMaxParticipantes = $_REQUEST['numMaxParticipantes'];
			unset($_REQUEST['numMaxParticipantes']);
		}

		$activity = new ActivityModel($id,$nombre,$descripcion,$frecuencia,$resource,$act_coach,$horaInicio,$horaFin,$fechaInicio,$fechaFin,$tipo,$numMaxParticipantes);

		return $activity;
	}

	// checking that activity is logged
	if(isset($_SESSION['userType']))
	{

		// checking that activity has permissions
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

				// selected add an activity
				case $strings['Insert']:

					// looking for form's data
					if (!isset($_REQUEST['nombre']))
					{ // if not, the view is called
                        $activity = get_data_form();
                        $resources = $activity->getResources();
                        $coaches = $activity->getCoaches();
						new ActivityAdd($resources,$coaches,'');
					
					}else { // if we have form's data, we insert it
						$activity = get_data_form(); // getting data
						$reply = $activity->insert(); // trying insert
						$data = $activity->toList(); // getting activitys list
						new ActivityDefault($data, $reply); // showing activitys list with a message
					}

					break;

				// selected delete an activity
				case $strings['Delete']:

					// looking for form's data
					if (isset($_REQUEST['id']))
					{ // if exist, we try the deleting
						$activity = get_data_form(); // getting data
						$reply = $activity->delete(); // trying delete
						$data = $activity->toList(); // getting activitys list
						new ActivityDefault($data, $reply); // showing activitys list with a message

					}else {
                        $activity = get_data_form(); // getting data
                        $reply = $activity->delete(); // trying delete
						$data = $activity->toList(); // getting activitys list
						new ActivityDefault($data, $reply); // showing activitys list with a message
					}
					
					break;

				// selected modify an activity
				case $strings['Modify']:

					// looking for form's data
					if (!isset($_REQUEST['nombre']))
					{ // if not, the view is called
                        $activity = get_data_form(); // getting data
                        $resources = $activity->getResources();
                        $coaches = $activity->getCoaches();
                        $res = $activity->getActualResource($_REQUEST["id"]);
                        $coa = $activity->getActualCoach($_REQUEST["id"]);
                        $data = $activity->consult(); // trying consult
						new ActivityModify($data,$resources,$coaches,$res,$coa);

					}else { // if we have form's data, we modify it
						$activity = get_data_form(); // getting data
						$reply = $activity->modify(); // trying modify
						$data = $activity->toList(); // getting activitys list
						new ActivityDefault($data, $reply); // showing activitys list with a message
					}

					break;

				// selected see activity's details
				case $strings['See']:

					// looking for form's data
					if (isset($_REQUEST['id'])) // if we have form's data, we insert it
					{
						$activity = get_data_form(); // getting data
						$data = $activity->consult(); // trying consult
                        $data2 = $activity->getActualResource($_REQUEST['id']);
                        $data3 = $activity->getActualCoach($_REQUEST['id']);
						new ActivityConsult($data,$data2,$data3); // showing activity data
					
					}else { // if not, the view is called
						$activity = get_data_form(); // getting data
                        $reply = $activity->consult(); // trying consult
                        $data = $activity->toList(); // getting activitys list
                        new ActivityDefault($data, $reply); // showing activitys list without a message
					}

					break;

                // selected something to find
                case $strings['Search']:

                    // looking for data
                    if (isset($_REQUEST['searchfield']))
                    {
                        $activity = get_data_form(); // getting data
                        $reply = $activity->search($_REQUEST['searchfield']); // getting reply
                        unset($_REQUEST['searchfield']);

                        if (is_string($reply))
                        {
                            $data = $activity->toList(); // getting activitys list
                            new ActivityDefault($data, $reply); // showing an error message

                        }else {
                            new ActivityDefault($reply, ''); // showing activitys list without a message
                        }
                    }

                    break;

                // selected order by something
                case $strings['Order']:

                     // looking for data
                     if (isset($_REQUEST['orderfield']))
                     {
                         $activity = get_data_form(); // getting data
                         $reply = $activity->order($_REQUEST['orderfield']); // getting reply
                         unset($_REQUEST['orderfield']);

                         if (is_string($reply))
                         {
                             $data = $activity->toList(); // getting activitys list
                             new ActivityDefault($data, $reply); // showing an error message

                         }else {
                             new ActivityDefault($reply, ''); // showing activitys list without a message
                         }
                     }

                     break;

                default:
                	$activity = get_data_form();
					$data = $activity->toList(); // getting activitys list
					$reply = '';
					new ActivityDefault($data, $reply); // showing activitys list without a message

					break;
			}
		}else {
			header('Location: ../views/home.php');
		}

	}else {
		new LogIn('');
	}
?>