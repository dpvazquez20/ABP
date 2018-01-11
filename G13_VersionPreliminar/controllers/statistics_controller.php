<?php 

    include '../models/statistic_model.php';
    include '../views/statistic_default.php';
    include '../views/statistic_consult.php';
    include '../languages/spanish.php';
    include '../views/log_in.php';
    session_start();

	// getting form's data
	function get_data_form()
    {
        include '../languages/spanish.php';

		$id = '';

        if ($_SESSION['userType'] == $strings['sportsman'])
        {
            $id = $_SESSION['userId'];

        } elseif(isset($_REQUEST['id'])) {
                $id = $_REQUEST['id'];
                //unset($_REQUEST['id']);
        }

		$statistic = new StatisticModel($id);

		return $statistic;
	}

	// checking that user is logged
	if(isset($_SESSION['userType']))
	{

		// checking that user has permissions
		if($_SESSION['userType'] == $strings['secretary']) // --------------- SECRETARY -----------------
	    {
            $statistic = get_data_form();
            $data = $statistic->generate(); // getting secretary's statistics
            $reply = '';
            $list = '';
            new StatisticDefault($data, $reply, $list); // showing secretary's statistics

		} elseif($_SESSION['userType'] == $strings['coach']) { //------------INCOMPLETE------------

            if (isset($_REQUEST['action']))
            {
                $action = $_REQUEST['action'];
            } else {
                $action = '';
            }

            Switch ($action)
            {
                // selected see user's details
                case $strings['See']:

                    if (isset($_REQUEST['id']))
                    {
                        $statistic = get_data_form(); // getting data
                        $data = $statistic->generateUser(); // getting user's statistics
                        new StatisticConsult($data); // showing statistics

                    }else { // if not, the view is called
                        $statistic = get_data_form(); // getting data
                        $reply = $statistic->generateUser(); // getting user's statistics
                        $list = $statistic->toList(); // getting users list
                        $data = $statistic->generateCoach();
                        new StatisticDefault($data, $reply, $list); // showing users list with the coach's statistics
                    }

                    break;

                // selected something to find
                case $strings['Search']:

                    // looking for data
                    if (isset($_REQUEST['searchfield']))
                    {
                        $statistic = get_data_form(); // getting data
                        $reply = $statistic->search($_REQUEST['searchfield']); // getting reply
                        unset($_REQUEST['searchfield']);

                        if (is_string($reply))
                        {
                            $list = $statistic->toList(); // getting users list
                            $data = $statistic->generateCoach(); // getting coach's statistics
                            new StatisticDefault($data, $reply, $list); // showing an error message with the coach's statistics

                        }else {
                            $data = $statistic->generateCoach();
                            new StatisticDefault($data, '', $reply); // showing users list with the coach's statistics
                        }
                    }

                    break;

                // selected order by something
                case $strings['Order']:

                    // looking for data
                    if (isset($_REQUEST['orderfield']))
                    {
                        $statistic = get_data_form(); // getting data
                        $reply = $statistic->order($_REQUEST['orderfield']); // getting reply
                        unset($_REQUEST['orderfield']);

                        if (is_string($reply))
                        {
                            $data = $statistic->generateCoach(); // getting the coach's statistics
                            $list = $statistic->toList(); // getting users list
                            new StatisticDefault($data, $reply, $list); // showing an error message with the coach's statistics

                        }else {
                            $data = $statistic->generateCoach(); // getting the coach's statistics
                            new StatisticDefault($data, '', $reply); // showing users list with the coach's statistics
                        }
                    }

                    break;


                default:
                    $statistic = get_data_form();
                    $data = $statistic->generateCoach(); // getting coach's statistic
                    $list = $statistic->toListUsersCoach($_SESSION['userId']); // getting users list
                    $reply = '';
                    new StatisticDefault($data, $reply, $list); // showing users list without a message

                    break;
            }

        } elseif ($_SESSION['userType'] == $strings['sportsman']) { //------------INCOMPLETE------------

            $statistic = get_data_form(); // getting data
            $data = $statistic->generateUser(); // getting user's statistics
            new StatisticConsult($data); // showing statistics


        } else {
            header('Location: ../views/home.php');
        }

	} else {
		new LogIn('');
	}
?>