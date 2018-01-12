<?php 

    include '../models/event_model.php';
    include '../views/event_default.php';
    include '../views/event_add.php';
    include '../views/event_modify.php';
    include '../views/event_consult.php';
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
		$fechaInicio = '';
		$fechaFin = '';		
		$horaInicio = '';
		$horaFin = '';

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
                $directory = '../images/events/';
                $uploaded_file = $directory . basename($_FILES['imagen']['name']);
                copy($_FILES['imagen']['tmp_name'], $uploaded_file);

                $imagen = basename($_FILES['imagen']['name']);
                unset($_FILES['imagen']);
            }
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

		$event = new EventModel($id,$nombre,$descripcion,$imagen,$fechaInicio,$fechaFin,$horaInicio,$horaFin);

		return $event;
	}

	// checking that event is logged
	if(isset($_SESSION['userType']))
	{

		// checking that event has permissions
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

				// selected add an event
				case $strings['Insert']:

					// looking for form's data
					if (!isset($_REQUEST['nombre']))
					{ // if not, the view is called
						new EventAdd();
					
					}else { // if we have form's data, we insert it
						$event = get_data_form(); // getting data
						$reply = $event->insert(); // trying insert
						$data = $event->toList(); // getting events list
						new EventDefault($data, $reply); // showing events list with a message
					}

					break;

				// selected delete an event
				case $strings['Delete']:

					// looking for form's data
					if (isset($_REQUEST['id']))
					{ // if exist, we try the deleting
						$event = get_data_form(); // getting data
						$reply = $event->delete(); // trying delete
						$data = $event->toList(); // getting events list
						new EventDefault($data, $reply); // showing events list with a message

					}else {
                        $event = get_data_form(); // getting data
                        $reply = $event->delete(); // trying delete
						$data = $event->toList(); // getting events list
						new EventDefault($data, $reply); // showing events list with a message
					}
					
					break;

				// selected modify an event
				case $strings['Modify']:

					// looking for form's data
					if (!isset($_REQUEST['nombre']))
					{ // if not, the view is called
                        $event = get_data_form(); // getting data
                        $data = $event->consult(); // trying consult
						new EventModify($data);

					}else { // if we have form's data, we modify it
						$event = get_data_form(); // getting data
						$reply = $event->modify(); // trying modify
						$data = $event->toList(); // getting events list
						new EventDefault($data, $reply); // showing events list with a message
					}

					break;

				// selected see event's details
				case $strings['See']:

					// looking for form's data
					if (isset($_REQUEST['id'])) // if we have form's data, we insert it
					{
						$event = get_data_form(); // getting data
						$data = $event->consult(); // trying consult
						new EventConsult($data); // showing event data   
					
					}else { // if not, the view is called
						$event = get_data_form(); // getting data
                        $reply = $event->consult(); // trying consult
                        $data = $event->toList(); // getting events list
                        new EventDefault($data, $reply); // showing events list without a message
					}

					break;

                // selected something to find
                case $strings['Search']:

                    // looking for data
                    if (isset($_REQUEST['searchfield']))
                    {
                        $event = get_data_form(); // getting data
                        $reply = $event->search($_REQUEST['searchfield']); // getting reply
                        unset($_REQUEST['searchfield']);

                        if (is_string($reply))
                        {
                            $data = $event->toList(); // getting events list
                            new EventDefault($data, $reply); // showing an error message

                        }else {
                            new EventDefault($reply, ''); // showing events list without a message
                        }
                    }

                    break;

                // selected order by something
                case $strings['Order']:

                     // looking for data
                     if (isset($_REQUEST['orderfield']))
                     {
                         $event = get_data_form(); // getting data
                         $reply = $event->order($_REQUEST['orderfield']); // getting reply
                         unset($_REQUEST['orderfield']);

                         if (is_string($reply))
                         {
                             $data = $event->toList(); // getting events list
                             new EventDefault($data, $reply); // showing an error message

                         }else {
                             new EventDefault($reply, ''); // showing events list without a message
                         }
                     }

                     break;

                default:
                	$event = get_data_form();
					$data = $event->toList(); // getting events list
					$reply = '';
					new EventDefault($data, $reply); // showing events list without a message

					break;
			}
		}else {
			header('Location: ../views/home.php');
		}

	}else {
		new LogIn('');
	}
?>