<?php 

    include '../models/resource_model.php';
    include '../views/resource_default.php';
    include '../views/resource_add.php';
    include '../views/resource_modify.php';
    include '../views/resource_consult.php';
    include '../languages/spanish.php';
    include '../views/log_in.php';
    session_start();

	// getting form's data
	function get_data_form()
    {

		$id = '';
		$nombre = '';
		$aforo = '';
		$descripcion = '';

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
		if(isset($_REQUEST['aforo']))
		{
			$aforo = $_REQUEST['aforo'];
			unset($_REQUEST['aforo']);
		}
		if(isset($_REQUEST['descripcion']))
		{
			$descripcion = $_REQUEST['descripcion'];
			unset($_REQUEST['descripcion']);
		}
		

		$resource = new ResourceModel($id,$nombre,$aforo,$descripcion);

		return $resource;
	}

	// checking that resource is logged
	if(isset($_SESSION['userType']))
	{

		// checking that resource has permissions
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

				// selected add an resource
				case $strings['Insert']:

					// looking for form's data
					if (!isset($_REQUEST['nombre']))
					{ // if not, the view is called
						new ResourceAdd();
					
					}else { // if we have form's data, we insert it
						$resource = get_data_form(); // getting data
						$reply = $resource->insert(); // trying insert
						$data = $resource->toList(); // getting resources list
						new ResourceDefault($data, $reply); // showing resources list with a message
					}

					break;

				// selected delete an resource
				case $strings['Delete']:

					// looking for form's data
					if (isset($_REQUEST['id']))
					{ // if exist, we try the deleting
						$resource = get_data_form(); // getting data
						$reply = $resource->delete(); // trying delete
						$data = $resource->toList(); // getting resources list
						new ResourceDefault($data, $reply); // showing resources list with a message

					}else {
                        $resource = get_data_form(); // getting data
                        $reply = $resource->delete(); // trying delete
						$data = $resource->toList(); // getting resources list
						new ResourceDefault($data, $reply); // showing resources list with a message
					}
					
					break;

				// selected modify an resource
				case $strings['Modify']:

					// looking for form's data
					if (!isset($_REQUEST['nombre']))
					{ // if not, the view is called
                        $resource = get_data_form(); // getting data
                        $data = $resource->consult(); // trying consult
						new ResourceModify($data);

					}else { // if we have form's data, we modify it
						$resource = get_data_form(); // getting data
						$reply = $resource->modify(); // trying modify
						$data = $resource->toList(); // getting resources list
						new ResourceDefault($data, $reply); // showing resources list with a message
					}

					break;

				// selected see resource's details
				case $strings['See']:

					// looking for form's data
					if (isset($_REQUEST['id'])) // if we have form's data, we insert it
					{
						$resource = get_data_form(); // getting data
						$data = $resource->consult(); // trying consult
						new ResourceConsult($data); // showing resource data   
					
					}else { // if not, the view is called
						$resource = get_data_form(); // getting data
                        $reply = $resource->consult(); // trying consult
                        $data = $resource->toList(); // getting resources list
                        new ResourceDefault($data, $reply); // showing resources list without a message
					}

					break;

                // selected something to find
                case $strings['Search']:

                    // looking for data
                    if (isset($_REQUEST['searchfield']))
                    {
                        $resource = get_data_form(); // getting data
                        $reply = $resource->search($_REQUEST['searchfield']); // getting reply
                        unset($_REQUEST['searchfield']);

                        if (is_string($reply))
                        {
                            $data = $resource->toList(); // getting resources list
                            new ResourceDefault($data, $reply); // showing an error message

                        }else {
                            new ResourceDefault($reply, ''); // showing resources list without a message
                        }
                    }

                    break;

                // selected order by something
                case $strings['Order']:

                     // looking for data
                     if (isset($_REQUEST['orderfield']))
                     {
                         $resource = get_data_form(); // getting data
                         $reply = $resource->order($_REQUEST['orderfield']); // getting reply
                         unset($_REQUEST['orderfield']);

                         if (is_string($reply))
                         {
                             $data = $resource->toList(); // getting resources list
                             new ResourceDefault($data, $reply); // showing an error message

                         }else {
                             new ResourceDefault($reply, ''); // showing resources list without a message
                         }
                     }

                     break;


                default:
                	$resource = get_data_form();
					$data = $resource->toList(); // getting resources list
					$reply = '';
					new ResourceDefault($data, $reply); // showing resources list without a message

					break;
			}
		}else {
			header('Location: ../views/home.php');
		}

	}else {
		new LogIn('');
	}
?>