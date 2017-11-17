<?php
include '../models/user_model.php';
include '../views/log_in.php';
include '../languages/spanish.php';


// Function for seeing if the data form login are correct
function checkData($username, $contrasenha)
{
    include '../languages/spanish.php';

    $mysqli = connect();
    $sql = "SELECT * FROM usuarios";

    // Checking the DB connection
    if (!$result = $mysqli->query($sql))
    {
        $toret = $strings['ConnectionDBError'];

    }else {

        // Checking if the username exists
        $sql = "SELECT * FROM usuarios WHERE login = '".$username."'";
        $result = $mysqli->query($sql);

        if ($result->num_rows == 0)
        {
            $toret = $strings['UserNotExist'];

        } else {
            // Checking if the username and password are correct
            /*$sql = "SELECT * FROM usuarios WHERE login = '".$username."' AND contrasenha = '".$contrasenha."'";
            $result = $mysqli->query($sql);

            if ($result->num_rows == 0)
            {
                $toret = $strings['IncorrectPassword'];

            } else {
                $toret = true;
            }*/
            $data = array();
            $data[0] = $result->fetch_array();

            if (password_verify($contrasenha, $data[0]['contrasenha']))
            {
                $toret = true;

            } else {
                $toret = $strings['IncorrectPassword'];
            }
        }
    }

    return $toret;
}


// Function for getting the user´s data
function getData($username)
{
    include '../languages/spanish.php';

    $mysqli = connect();

    $sql = "SELECT * FROM usuarios WHERE login = '".$username."'";

    if (!$result = $mysqli->query($sql))
    {
        $toret = $strings['ConnectionDBError'];

    } else {

        if ($result->num_rows == 1)
        {
            $toret = array();
            $toret[0] = $result->fetch_array();

        } else {
            $toret = $strings['ErrorNotExist'];;
        }
    }

    return $toret;
}

    // Process for verifying the login
	if (isset($_REQUEST['action']))
	{
	    // View if action exists
        if ($_REQUEST['action'] == $strings['Enter'])
        {
            $username = $_REQUEST['login'];
            $contrasenha = $_REQUEST['contrasenha'];
            unset($_REQUEST['login']);
            unset($_REQUEST['contrasenha']);

            $reply = checkData($username, $contrasenha); // Check the the login and password

            // If '$reply' is true, redirect to home.php
            if ($reply == 'true')
            {
                // Get the user's data, it can be a query result or a string
                $user = getData($username);

                if (!is_string($user))
                {
                    unset($username);
                    unset($contrasenha);
                    session_start();
                    $_SESSION['userId'] = $user[0]['id'];
                    $_SESSION['userType'] = $user[0]['tipo'];

                    header('Location:../views/home.php');

                } else {
                    unset($username);
                    unset($contrasenha);
                    new LogIn($user);
                }
            }
            // If not redirect to log_in.php sending an error message
            else {
                unset($username);
                unset($contrasenha);
                new LogIn($reply);
            }

        // If action doesn't exist, redirect to log_in.php
        } else {
            unset($username);
            unset($contrasenha);
            new LogIn('');
        }
    }
?>