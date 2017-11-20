<?php 

    include '../models/inscription_model.php';
    include '../views/inscription_default.php';
    include '../views/inscription_consult.php';
    include '../languages/spanish.php';
    include '../views/log_in.php';
    session_start();

	// getting form's data
	function get_data_form()
    {

		$id = '';
		$fecha = '';
		$usuario_id = '';

		if(isset($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			//unset($_REQUEST['id']);
		}
		if(true)
		{
            $fecha = date("Y-m-d");

		}
		if(isset($_SESSION['userId']))
		{
			$usuario_id = $_SESSION['userId'];
		}

		$inscription = new InscriptionModel($id,$fecha,$usuario_id);

		return $inscription;
	}


	// checking that inscription is logged
	if(isset($_SESSION['userType']))
	{

		// checking that inscription has permissions
		if($_SESSION['userType'] == $strings['secretary']) {
            if (isset($_REQUEST['action'])) {
                $action = $_REQUEST['action'];
            } else {
                $action = '';
            }

            Switch ($action) {
                //once an user is selected
                case $strings['See']:
                    $inscription = get_data_form();
                    $data1 = $inscription->getActivities($_REQUEST['id'], true); // inscripted activities
                    $data2 = $inscription->getActivities($_REQUEST['id'], false);
                    $reply = '';
                    new InscriptionConsult($data1, $data2,$_REQUEST['id'], $reply);
                    break;

                // selected add an inscription
                case $strings['Insert']:
                    $inscription = get_data_form();
                    $reply = $inscription->insert(); // trying insert
                    $data1 = $inscription->getActivities($_REQUEST['id'],true); // inscripted activities
                    $data2 = $inscription->getActivities($_REQUEST['id'],false);
                    $reply = '';
                    new InscriptionConsult($data1,$data2,$reply);

                    break;

                // selected delete an inscription
                case $strings['Delete']:

                    // looking for form's data
                    if (isset($_REQUEST['id'])) { // if exist, we try the deleting
                        $inscription = get_data_form(); // getting data
                        $reply = $inscription->delete(); // trying delete
                        $data1 = $inscription->getActivities($_REQUEST['id'],true); // inscripted activities
                        $data2 = $inscription->getActivities($_REQUEST['id'],false);
                        $reply = '';
                        new InscriptionConsult($data1,$data2,$reply);

                    } else {
                        $inscription = get_data_form();// getting data
                        $reply = $inscription->delete(); // trying delete
                        $data1 = $inscription->getActivities($_REQUEST['id'],true); // inscripted activities
                        $data2 = $inscription->getActivities($_REQUEST['id'],false);
                        $reply = '';
                        new InscriptionConsult($data1,$data2,$reply);
                    }

                    break;

                // selected something to find
                case $strings['Search']:

                    // looking for data
                    if(!isset($_REQUEST['id_u'])) {
                        if (isset($_REQUEST['searchfield'])) {
                            $inscription  = get_data_form();
                            $reply = $inscription->searchUsers($_REQUEST['searchfield']); // getting reply
                            unset($_REQUEST['searchfield']);

                            if (is_string($reply)) {
                                $data = $inscription->toList(); // getting inscriptions list
                                new InscriptionDefault($data, $reply); // showing an error message

                            } else {
                                new InscriptionDefault($reply, ''); // showing inscriptions list without a message
                            }
                        }
                    }else{
                        if (isset($_REQUEST['searchfield'])) {
                            $inscription = get_data_form();
                            $data1 = $inscription->search($_REQUEST['searchfield'],$_REQUEST['id_u'],true);
                            $data2 = $inscription->search($_REQUEST['searchfield'],$_REQUEST['id_u'],false);
                            $reply='';
                            unset($_REQUEST['searchfield']);

                            if (is_string($reply)) {
                                new InscriptionConsult($data1, $data2,$_REQUEST['id_u'], $reply); // showing an error message

                            } else {
                                new InscriptionConsult($data1, $data2,$_REQUEST['id_u'], $reply); // showing inscriptions list without a message
                            }
                        }
                    }
                    break;

                // selected order by something
                case $strings['Order']:

                    if(!isset($_REQUEST['id_u'])) {
                        if (isset($_REQUEST['orderfield'])) {
                            $inscription = get_data_form(); // getting data
                            $reply = $inscription->orderUsers($_REQUEST['orderfield']); // getting reply
                            unset($_REQUEST['orderfield']);

                            if (is_string($reply)) {
                                $data = $inscription->toList(); // getting inscriptions list
                                new InscriptionDefault($data, $reply); // showing an error message

                            } else {
                                new InscriptionDefault($reply, ''); // showing inscriptions list without a message
                            }
                        }
                    }else{
                        if (isset($_REQUEST['orderfield'])) {
                            $inscription = get_data_form(); // getting data
                            $data1 = $inscription->order($_REQUEST['orderfield'],$_REQUEST['id_u'],true);
                            $data2 = $inscription->order($_REQUEST['orderfield'],$_REQUEST['id_u'],false);// getting reply
                            $reply='';
                            unset($_REQUEST['orderfield']);

                            if (is_string($reply)) {
                                $data = $inscription->toList(); // getting inscriptions list
                                new InscriptionConsult($data1, $data2,$_REQUEST['id_u'], $reply); // showing an error message

                            } else {
                                new InscriptionConsult($data1, $data2,$_REQUEST['id_u'], $reply); // showing inscriptions list without a message
                            }
                        }
                    }

                    break;

                default:
                    $inscription = get_data_form();
                    $data = $inscription->getAllUsers(); // getting users list
                    $reply = '';
                    new InscriptionDefault($data, $reply); // showing users list without a message

                    break;
            }

		}else if($_SESSION['userType'] == $strings['sportsman']) {

            if (isset($_REQUEST['action']))
            {
                $action = $_REQUEST['action'];
            }else {
                $action = '';
            }

            Switch ($action) {

                // selected add an inscription
                case $strings['Insert']:
                        $inscription = get_data_form(); // getting data
                        $reply = $inscription->insert(); // trying insert
                        $data1 = $inscription->getActivities($_SESSION['userId'],true); // inscripted activities
                        $data2 = $inscription->getActivities($_SESSION['userId'],false);
                        $reply = '';
                        new InscriptionConsult($data1,$data2,$reply);

                    break;

                // selected delete an inscription
                case $strings['Delete']:

                    // looking for form's data
                    if (isset($_REQUEST['id'])) { // if exist, we try the deleting
                        $inscription = get_data_form(); // getting data
                        $reply = $inscription->delete(); // trying delete
                        $data1 = $inscription->getActivities($_SESSION['userId'],true); // inscripted activities
                        $data2 = $inscription->getActivities($_SESSION['userId'],false);
                        $reply = '';
                        new InscriptionConsult($data1,$data2,$reply);

                    } else {
                        $inscription = get_data_form(); // getting data
                        $reply = $inscription->delete(); // trying delete
                        $data1 = $inscription->getActivities($_SESSION['userId'],true); // inscripted activities
                        $data2 = $inscription->getActivities($_SESSION['userId'],false);
                        $reply = '';
                        new InscriptionConsult($data1,$data2,$reply);
                    }

                    break;

                // selected something to find
                case $strings['Search']:

                    // looking for data
                    if (isset($_REQUEST['searchfield'])) {
                        $inscription = get_data_form(); // getting data
                        $data1 = $inscription->search($_REQUEST['searchfield'],$_SESSION['userId'],true);
                        $data2 = $inscription->search($_REQUEST['searchfield'],$_SESSION['userId'],false);
                        $reply='';
                        unset($_REQUEST['searchfield']);

                        if (is_string($reply)) {
                            new InscriptionConsult($data1,$data2, $reply); // showing an error message

                        } else {
                            new InscriptionConsult($data1,$data2, ''); // showing inscriptions list without a message
                        }
                    }

                    break;

                // selected order by something
                case $strings['Order']:

                    // looking for data
                    if (isset($_REQUEST['orderfield'])) {
                        $inscription = get_data_form(); // getting data
                        $data1 = $inscription->order($_REQUEST['orderfield'],$_SESSION['userId'],true);
                        $data2 = $inscription->order($_REQUEST['orderfield'],$_SESSION['userId'],false);
                        $reply = '';
                        unset($_REQUEST['orderfield']);

                        if (is_string($reply)) {
                            new InscriptionConsult($data1,$data2, $reply); // showing an error message

                        } else {
                            new InscriptionConsult($data1,$data2,''); // showing inscriptions list without a message
                        }
                    }

                    break;

                default:
                    $inscription = get_data_form();
                    $data1 = $inscription->getActivities($_SESSION['userId'],true); // inscripted activities
                    $data2 = $inscription->getActivities($_SESSION['userId'],false);
                    $reply = '';
                    new InscriptionConsult($data1,$data2,$reply);

                    break;
            }
        }else {
                header('Location: ../views/home.php');
            }
    }else{
		new LogIn('');
	}
?>