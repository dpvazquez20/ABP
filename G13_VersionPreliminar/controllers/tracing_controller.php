<?php 

    include '../models/tracing_model.php';
    include '../views/tracing_default.php';
    include '../views/tracing_list.php';
    include '../views/tracing_statistic.php';
    //include '../views/tracing_add.php';
    //include '../views/tracing_modify.php';
    include '../views/tracing_consult.php';
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

		$tracing = new TracingModel($id);

		return $tracing;
	}

	function get_data_form_sportsman()
    {

		$id = '';
		if(isset($_SESSION['userId']))
		{
			$id = $_SESSION['userId'];
		}

		$tracing = new TracingModel($id);

		return $tracing;
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

            	case $strings['Statistic']:

            		if (isset($_REQUEST['id'])) // if we have form's data, we insert it
					{
						$tracing = get_data_form(); // getting data
						$data1 = $tracing->getSessions($_REQUEST['id']);
						if($data1 == $strings['NoTrainingError'] || $data1 == $strings['TracingErrorNotStarted']){
							new TracingDefault($data1,$data1);
						}else{
							$data2 = $tracing->generateStaticsTracing($_REQUEST['id']);
							new TracingStatistic($data1, $data2, $_REQUEST['id']);
						}
					
					}else { // if not, the view is called
						$tracing = get_data_form(); // getting data
						$data = $tracing->toListSportsmans(); // trying consult
						new TracingDefault($data,''); // showing user data 
					}

            		break;

            	case $strings['List']:

            		if (isset($_REQUEST['id'])) // if we have form's data, we insert it
					{
						$tracing = get_data_form(); // getting data
						$data1 = $tracing->getSessions($_REQUEST['id']);
						if($data1 == $strings['NoTrainingError'] || $data1 == $strings['TracingErrorNotStarted']){
							new TracingDefault($data1,$data1);
						}else{
							new TracingList($data1, $_REQUEST['id']);
						}
					
					}else { // if not, the view is called
						$tracing = get_data_form(); // getting data
						$data = $tracing->toListSportsmans(); // trying consult
						new TracingDefault($data,''); // showing user data 
					}

            		break;

            	case $strings['SeeSession']:

            		// looking for form's data
					if (isset($_REQUEST['sesionId'])) // if we have form's data, we insert it
					{
						$tracing = get_data_form(); // getting data
						$data1 = $tracing ->headCoach($_REQUEST['sesionId']);
						$data2 = $tracing ->followSession($_REQUEST['sesionId']);
						if($data2 == $strings['NoTrainingError']){
							new TracingDefault($data1,$strings['NoTrainingError']);
						}else{
							new TracingConsult($data1, $data2,true);
						}
					
					}else { // if not, the view is called
						$tracing = get_data_form(); // getting data
						$data = $tracing->toListSportsmans(); // trying consult
						new TracingDefault($data,''); // showing user data 
					}

            		break;

				// selected see user's details
				case $strings['Follow']:

					// looking for form's data
					if (isset($_REQUEST['id'])) // if we have form's data, we insert it
					{
						$tracing = get_data_form(); // getting data
						$data1 = $tracing ->headCoach();
						$data2 = $tracing ->follow();
						if($data2 == $strings['NoTrainingError']){
								new TracingDefault($data1,$strings['NoTrainingError']);
						}else{
							new TracingConsult($data1, $data2,true);
						}
					
					}else { // if not, the view is called
						$tracing = get_data_form(); // getting data
						$data = $tracing->toListSportsmans(); // trying consult
						new TracingDefault($data,''); // showing user data 
					}

					break;

                // selected something to find
                case $strings['Search']:

                    // looking for data
                    if (isset($_REQUEST['searchfield']))
                    {
                        $tracing = get_data_form(); // getting data
                        $reply = $tracing->searchSportsman2($_REQUEST['searchfield']); // getting reply
                        unset($_REQUEST['searchfield']);

                        if (is_string($reply))
                        {
                            $data = $tracing->toListSportsmans(); // getting users list
                            new TracingDefault($data, $reply); // showing an error message

                        }else {
                            new TracingDefault($reply, ''); // showing users list without a message
                        }
                    }

                    break;

                // selected order by something
                case $strings['Order']:

                     // looking for data
                     if (isset($_REQUEST['orderfield']))
                     {
                        $tracing = get_data_form();
						$reply = $tracing->orderSportsman2($_REQUEST['orderfield']); // getting reply

                        unset($_REQUEST['orderfield']);

                        if (is_string($reply))
                        {
                            $data = $tracing->toListSportsmans(); // getting users list
                            new TracingDefault($data, $reply); // showing an error message

                        }else {
                            new TracingDefault($reply, ''); // showing users list without a message
                        }
                    }

                    break;


                default:
                	$tracing = get_data_form();
					$data = $tracing->toListSportsmans(); // getting users list
					$reply = '';
					new TracingDefault($data, $reply); // showing users list without a message

					break;
			}

		} else {
			if($_SESSION['userType'] == $strings['sportsman']){

				if (isset($_REQUEST['action']))
				{
					$action = $_REQUEST['action'];
				}else {
					$action = '';
				}

				Switch ($action)
	            {

	            	case $strings['completeLine']:

	            		if (isset($_REQUEST['lineaSesionesId'])) // if we have form's data, we insert it
						{
							$tracing = get_data_form_sportsman(); // getting data
							$tracing->changeComplete($_REQUEST['lineaSesionesId']); // trying consult
							$data1 = $tracing ->headSportsman();
							$data2 = $tracing ->follow();
							if($data1[0]['completado'] == 0 && $data1[0]['inicio'] <> '')
							{
								new TracingConsult($data1, $data2,false);
							}else{
								new TracingConsult($data1, $data2,true);
							}
						
						}else { // if not, the view is called
							header("Location: ../views/home.php");
						}

						break;

					case $strings['completeTable']:

						if (isset($_REQUEST['sesionId'])) // if we have form's data, we insert it
						{
							$tracing = get_data_form_sportsman(); // getting data
							$tracing->completeTable($_REQUEST['sesionId']); // trying consult
							$data1 = $tracing ->headSportsman();
							$data2 = $tracing ->follow();
							new TracingConsult($data1, $data2,false);
						
						}else { // if not, the view is called
							header("Location: ../views/home.php");
						}

						break;

					case $strings['previousTable']:

						if (isset($_REQUEST['sesionId'])) // if we have form's data, we insert it
						{
							$tracing = get_data_form_sportsman(); // getting data
							$data2 = $tracing ->followPrevious($_REQUEST['sesionId']);

							if(is_string($data2)){
								die("die: $data2");
								$data1 = $tracing->headSportsman();
								$data2 = $tracing->follow();
								new TracingConsult($data1, $data2,false);
							}else{
								$data1 = $tracing->headSportsmanIdPrevious($_REQUEST['sesionId']);
								if($data1[0]['completado'] == 0 && $data1[0]['inicio'] <> '')
								{
									new TracingConsult($data1, $data2,false);
								}else{
									new TracingConsult($data1, $data2,true);
								}
							}
						
						}else { // if not, the view is called
							header("Location: ../views/home.php");
						}

						break;

					case $strings['nextTable']:

						if (isset($_REQUEST['sesionId'])) // if we have form's data, we insert it
						{
							$tracing = get_data_form_sportsman(); // getting data
							$data2 = $tracing ->followNext($_REQUEST['sesionId']);

							if(is_string($data2)){
								die("die: $data2");
								$data1 = $tracing->headSportsman();
								$data2 = $tracing->follow();
								new TracingConsult($data1, $data2,false);
							}else{
								$data1 = $tracing->headSportsmanIdNext($_REQUEST['sesionId']);
								//die("die: " . $data1[0]['inicio']);
								if($data1[0]['completado'] == 0 && $data1[0]['inicio'] <> '')
								{
									new TracingConsult($data1, $data2,false);
								}else{
									new TracingConsult($data1, $data2,true);
								}
							}
						
						}else { // if not, the view is called
							header("Location: ../views/home.php");
						}

						break;

					case $strings['startTime']:

						if (isset($_REQUEST['sesionId'])) // if we have form's data, we insert it
						{
							$tracing = get_data_form_sportsman(); // getting data
							$tracing->startTime($_REQUEST['sesionId']); // trying consult
							$data1 = $tracing ->headSportsman();
							$data2 = $tracing ->follow();
							if($data1[0]['completado'] == 0 && $data1[0]['inicio'] <> '')
							{
								new TracingConsult($data1, $data2,false);
							}else{
								new TracingConsult($data1, $data2,true);
							}
						
						}else { // if not, the view is called
							header("Location: ../views/home.php");
						}

						break;
					
					case $strings['comment']:

						//die("die: |" . $_REQUEST['comment'] . "|");
						if (isset($_REQUEST['sesionId']) && isset($_REQUEST['comment'])) // if we have form's data, we insert it
						{
							$tracing = get_data_form_sportsman(); // getting data
							$tracing->comment($_REQUEST['sesionId'],$_REQUEST['comment']); // trying consult
							$data1 = $tracing->headSportsman();
							$data2 = $tracing->follow();
							if($data1[0]['completado'] == 0 && $data1[0]['inicio'] <> '')
							{
								new TracingConsult($data1, $data2,false);
							}else{
								new TracingConsult($data1, $data2,true);
							}
						
						}else { // if not, the view is called
							header("Location: ../views/home.php");
						}

						break;

					default:

	                	if (isset($_SESSION['userId'])) // if we have form's data, we insert it
						{
							//die("DIE");
							$tracing = get_data_form_sportsman(); // getting data
							$data1 = $tracing->headSportsman();
							$data2 = $tracing->follow();
							if($data2 == $strings['NoTrainingError']){
								new TracingDefault($data1,$strings['NoTrainingError']);
							}else{
								if($data1[0]['completado'] == 0 && $data1[0]['inicio'] <> '')
								{
									new TracingConsult($data1, $data2,false);
								}else{
									new TracingConsult($data1, $data2,true);
								}
							}

						}else { // if not, the view is called
							header("Location: ../views/home.php");
						}

						break;
				}	

			}else{
				header('Location: ../views/home.php');
			}
          }

	}else {
		new LogIn('');
	}
?>