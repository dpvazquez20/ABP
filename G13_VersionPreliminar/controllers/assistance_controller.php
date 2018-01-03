<?php 

    include '../models/assistance_model.php';
    include '../views/assistance_default.php';
    include '../views/assistance_consult.php';
    include '../languages/spanish.php';
    include '../views/log_in.php';
    session_start();

	// getting form's data
	function get_data_form()
    {

		$id = '';


		if(isset($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			//unset($_REQUEST['id']);
		}

		$assistance = new AssistanceModel($id);

		return $assistance;
	}

	// checking that assistance is logged
	if(isset($_SESSION['userType']))
	{
		// checking that assistance has permissions
		if($_SESSION['userType'] == $strings['coach'] && !isset($_SESSION['actID']))
	    {

			if (isset($_REQUEST['action']))
			{
				$action = $_REQUEST['action'];
			}else {
				$action = '';
			}

			Switch ($action)
            {
				// selected see assistance's details
				case $strings['See']:

					// looking for form's data
					if (isset($_REQUEST['id'])) // if we have form's data, we insert it
					{
                        $_SESSION['actID'] = $_REQUEST['id'];
						$assistance = get_data_form(); // getting data
						$data = $assistance->consult(); // trying consult
                        $reply = $assistance->consult();
                        if($reply != $strings['ErrorNoResults']){
                            $reply='';
                        }
						new AssistanceConsult($data,$reply); // showing assistance data
					
					}else { // if not, the view is called
                        if(isset($_SESSION['actID'])) {
                            unset($_SESSION['actID']);
                        }
						$assistance = get_data_form(); // getting data
                        $reply = $assistance->consult(); // trying consult
                        $data = $assistance->toList(); // getting assistances list
                        new AssistanceDefault($data, $reply); // showing assistances list without a message
					}

					break;

                // selected something to find
                case $strings['Search']:

                    // looking for data
                    if (isset($_REQUEST['searchfield']))
                    {
                        $assistance = get_data_form(); // getting data
                        $reply = $assistance->search($_REQUEST['searchfield'],$_SESSION['userId']); // getting reply
                        unset($_REQUEST['searchfield']);

                        if (is_string($reply))
                        {
                            $data = $assistance->toList($_SESSION['userId']); // getting assistances list
                            new AssistanceDefault($data, $reply); // showing an error message

                        }else {
                            new AssistanceDefault($reply, ''); // showing assistances list without a message
                        }
                    }

                    break;

                // selected order by something
                case $strings['Order']:

                     // looking for data
                     if (isset($_REQUEST['orderfield']))
                     {
                         $assistance = get_data_form(); // getting data
                         $reply = $assistance->order($_REQUEST['orderfield'],$_SESSION['userId']); // getting reply
                         unset($_REQUEST['orderfield']);

                         if (is_string($reply))
                         {
                             $data = $assistance->toList(); // getting assistances list
                             new AssistanceDefault($data, $reply); // showing an error message

                         }else {
                             new AssistanceDefault($reply, ''); // showing assistances list without a message
                         }
                     }

                     break;

                default:
                    if(isset($_SESSION['actID'])) {
                        unset($_SESSION['actID']);
                    }
                	$assistance = get_data_form();
					$data = $assistance->toList($_SESSION['userId']); // getting assistances list
					$reply = '';
					new AssistanceDefault($data, $reply); // showing assistances list without a message

					break;
			}

		}else if($_SESSION['userType'] == $strings['coach'] && isset($_SESSION['actID'])){
            if (isset($_REQUEST['action']))
            {
                $action = $_REQUEST['action'];
            }else {
                $action = '';
            }

            Switch ($action)
            {
                // selected see assistance's details
                case $strings['See']:

                    // looking for form's data
                    if (isset($_REQUEST['id'])) // if we have form's data, we insert it
                    {
                        $_SESSION['actID'] = $_REQUEST['id'];
                        $assistance = get_data_form(); // getting data
                        $data = $assistance->consult(); // trying consult
                        $reply = '';
                        new AssistanceConsult($data,$reply); // showing assistance data

                    }else { // if not, the view is called
                        if(isset($_SESSION['actID'])) {
                            unset($_SESSION['actID']);
                        }
                        $assistance = get_data_form(); // getting data
                        $reply = $assistance->consult(); // trying consult
                        $data = $assistance->toList(); // getting assistances list
                        new AssistanceDefault($data, $reply); // showing assistances list without a message
                    }

                    break;

                // selected something to find
                case $strings['Search']:

                    // looking for data
                    if (isset($_REQUEST['searchfield']))
                    {
                        $assistance = get_data_form(); // getting data
                        $reply = $assistance->searchUsers($_REQUEST['searchfield'],$_SESSION['actID']); // getting reply
                        unset($_REQUEST['searchfield']);

                        if (is_string($reply))
                        {
                            $data = $assistance->consult(); // getting assistances list
                            new AssistanceConsult($data, $reply); // showing an error message

                        }else {
                            new AssistanceConsult($reply, ''); // showing assistances list without a message
                        }
                    }

                    break;

                // selected order by something
                case $strings['Order']:

                    // looking for data
                    if (isset($_REQUEST['orderfield']))
                    {
                        $assistance = get_data_form(); // getting data
                        $reply = $assistance->orderUsers($_REQUEST['orderfield'],$_SESSION['actID']); // getting reply
                        unset($_REQUEST['orderfield']);

                        if (is_string($reply))
                        {
                            $data = $assistance->toList(); // getting assistances list
                            new AssistanceConsult($data, $reply); // showing an error message

                        }else {
                            new AssistanceConsult($reply, ''); // showing assistances list without a message
                        }
                    }

                    break;

                default:
                    if(isset($_SESSION['actID'])) {
                        unset($_SESSION['actID']);
                    }
                    $assistance = get_data_form();
                    $data = $assistance->toList($_SESSION['userId']); // getting assistances list
                    $reply = '';
                    new AssistanceDefault($data, $reply); // showing assistances list without a message

                    break;
            }

        }else {
			header('Location: ../views/home.php');
		}

	}else {
		new LogIn('');
	}
?>