<?php 

    include '../models/training_table_model.php';
    include '../views/training_table_add.php';
	include '../views/training_table_edit.php';
	include '../views/training_default.php';
    include '../languages/spanish.php';
    include '../views/log_in.php';
    session_start();

	// getting form's data
	function get_data_form()
    {

		include '../languages/spanish.php';

		$tabla_id = '';
		$entrenamiento_id = '';
    	$orden_sesion = '';

    	if(isset($_REQUEST['tabla_id']))
		{
			$tabla_id = $_REQUEST['tabla_id'];
			//unset($_REQUEST['tabla_id']);
		}
    	if(isset($_REQUEST['entrenamiento_id']))
		{
			$entrenamiento_id = $_REQUEST['entrenamiento_id'];
			//unset($_REQUEST['entrenamiento_id']);
		}
		if(isset($_REQUEST['orden_sesion']))
		{
			$orden_sesion = $_REQUEST['orden_sesion'];
			//unset($_REQUEST['orden_sesion']);
		}

		$trainingTable = new TrainingTableModel($entrenamiento_id,$tabla_id,$orden_sesion);
		return $trainingTable;
	}

	// checking that resource is logged
	if(isset($_SESSION['userType']))
	{
		// checking that resource has permissions
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

				
				case $strings['Insert']:

					
					if (!isset($_REQUEST['orden_sesion']))
					{ 
						$trainingTable = get_data_form(); 
						$data = $trainingTable->toListTables(); // getting tables list
						new TrainingTableAdd($data,$_REQUEST['entrenamiento_id'],'');					
					}else { // if we have form's data, we insert it						
						$trainingTable = get_data_form(); // getting data						
						$reply = $trainingTable->insert(); // trying insert						
						$data = $trainingTable->toListTables(); // getting table list
						if($reply == $strings['InsertMaxInfo'])
						{
							$data2 = $trainingTable->toList();
							new TrainingDefault($data2,$reply);
						}else{
							$trainid = $_REQUEST['entrenamiento_id'];
							new TrainingTableAdd($data,$trainid,$reply);
						}
					}

					break;
					
				case $strings['Add']:

					
					if (!isset($_REQUEST['orden_sesion']))
					{ 
						$trainingTable = get_data_form(); 
						$data = $trainingTable->toListTables(); // getting tables list
						new TrainingTableEdit($data,$_REQUEST['entrenamiento_id'],'');
					}else { // if we have form's data, we insert it						
						$trainingTable = get_data_form(); // getting data						
						$reply = $trainingTable->add(); // trying insert		
						if($reply == $strings['InsertSuccess'])
						{
							$data2 = $trainingTable->toList();
							new TrainingDefault($data2,$reply);
						}else{
							$data3 = $trainingTable->toList();
							new TrainingDefault($data3,$reply);
						}
					}

					break;

                default:
                	header('Location: ../views/home.php');

					break;
			}
			
		}else{
			header('Location: ../views/home.php');
		}	

	}else{
		new LogIn('');
	}
?>