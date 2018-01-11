<?php

include '../functions/connectDB.php';

class StatisticModel
{
	function __construct($id)
    {
		$this->id = $id;

		$this->mysqli = connect();
	}

	function __destruct()
    {

	}


    // Secretary's statistics
    function generate()
    {
        include '../languages/spanish.php';

        $toret['numUsers'] = StatisticModel::getUsers();
        $toret['TDUUsers'] = StatisticModel::getTDUUsers();
        $toret['PEFUsers'] = StatisticModel::getPEFUsers();

        return $toret;
    }

    // Obtain the amount of users
    function getUsers()
    {
        include '../languages/spanish.php';

        $sql= "SELECT * FROM usuarios WHERE tipo = 'Deportista'";

        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
            $toret = $result->num_rows;
        }

        return $toret;
    }

    // Obtain the amount of TDU users
    function getTDUUSERS()
    {
        include '../languages/spanish.php';

        $sql= "SELECT id FROM usuarios WHERE tipo = 'Deportista' AND clase = 'TDU'";

        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
            $toret = $result->num_rows;
        }

        return $toret;
    }

    // Obtain the amount PEF users
    function getPEFUsers()
    {
        include '../languages/spanish.php';

        $sql= "SELECT id FROM usuarios WHERE tipo = 'Deportista' AND clase = 'PEF'";

        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
            $toret = $result->num_rows;
        }

        return $toret;
    }

    // Coach's statistics
    function generateCoach()
    {
        include '../languages/spanish.php';

        $toret['numExercises'] = StatisticModel::getExercises();
        $toret['numMuscular'] = StatisticModel::getMuscular();
        $toret['numCardio'] = StatisticModel::getCardio();
        $toret['numStretching'] = StatisticModel::getStretching();
        $toret['men'] = StatisticModel::getMen();
        $toret['women'] = StatisticModel::getWomen();
        $toret['otro'] = StatisticModel::getOther();

        return $toret;
    }

    // Obtain the amount of exercises
    function getExercises()
    {
        include '../languages/spanish.php';

        $sql= "SELECT id FROM ejercicios WHERE borrado = '0'";

        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
            $toret = $result->num_rows;
        }

        return $toret;
    }

    // Obtain the amount of muscular exercises
    function getMuscular()
    {
        include '../languages/spanish.php';

        $sql= "SELECT id FROM ejercicios WHERE tipo = 'Muscular' AND borrado = '0'";

        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
            $toret = $result->num_rows;
        }

        return $toret;
    }

    // Obtain the amount of cardivascular exercises
    function getCardio()
    {
        include '../languages/spanish.php';

        $sql= "SELECT id FROM ejercicios WHERE tipo = 'Cardiovascular' AND borrado = '0'";

        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
            $toret = $result->num_rows;
        }

        return $toret;
    }

    // Obtain the amount of cardivascular exercises
    function getStretching()
    {
        include '../languages/spanish.php';

        $sql= "SELECT id FROM ejercicios WHERE tipo = 'Estiramiento' AND borrado = '0'";

        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
            $toret = $result->num_rows;
        }

        return $toret;
    }

    // Obtain the percentage of men
    function getMen()
    {
        include '../languages/spanish.php';

        $sql= "SELECT id FROM usuarios WHERE tipo = 'Deportista' AND sexo = 'Hombre' AND borrado = '0'";

        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
            $num = $result->num_rows;
        }

        $sql= "SELECT id FROM usuarios WHERE tipo = 'Deportista'";

        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
            $tot = $result->num_rows;
        }

        $toret = ($num / $tot) * 100;

        return $toret;
    }

    function getWomen()
    {
        include '../languages/spanish.php';

        $sql= "SELECT id FROM usuarios WHERE tipo = 'Deportista' AND sexo = 'Mujer' AND borrado = '0'";

        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
            $num = $result->num_rows;
        }

        $sql= "SELECT id FROM usuarios WHERE tipo = 'Deportista'";

        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
            $tot = $result->num_rows;
        }

        $toret = ($num / $tot) * 100;

        return $toret;
    }

    function getOther()
    {
        include '../languages/spanish.php';

        $sql= "SELECT id FROM usuarios WHERE tipo = 'Deportista' AND sexo = 'Otro' AND borrado = '0'";

        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
            $num = $result->num_rows;
        }

        $sql= "SELECT id FROM usuarios WHERE tipo = 'Deportista'";

        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
            $tot = $result->num_rows;
        }

        $toret = ($num / $tot) * 100;

        return $toret;
    }

	// listing all users
	function toList()
    {
		include '../languages/spanish.php';

        $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND ORDER BY nombre";

        // checking DB connection
		if (!$result = $this->mysqli->query($sql))
		{
			$toret = $strings['connectionDBError'];
		}else {
			
			// checking that at least one user exists
			if ($result->num_rows != 0)
			{

				$toret=[];
				$i=0;

				// introducing all users into an array
				while ($row = $result->fetch_array())
                {

					$toret[$i] = $row;
					$i++;
				}						

			}else {
				$toret = $strings['ListErrorNotExist'];
			}
		}

		return $toret;

	}

    function toListUsersCoach($coachId)
    {

        include '../languages/spanish.php';

        $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND tipo = 'deportista' AND (entrenador_id = '$coachId' OR entrenador_id IS NULL) ORDER BY apellidos,nombre";

        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {
            
            // checking that at least one user exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all users into an array
                while ($row = $result->fetch_array())
                {

                    $toret[$i] = $row;
                    $i++;
                }                       

            }else {
                $toret = $strings['ListErrorNotExist'];
            }
        }
        return $toret;
    }

	// search users
    function search($word)
    {

        include '../languages/spanish.php';

        $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND ( nombre LIKE '%".$word."%' OR apellidos LIKE '%".$word."%')";

        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            // checking that at least one user exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all users into an array
                while ($row = $result->fetch_array())
                {

                    $toret[$i] = $row;
                    $i++;
                }

            }else {
                $toret = $strings['SearchErrorNotExist'];
            }
        }

        return $toret;

    }

    // order the element list
    function order($value)
    {

        include '../languages/spanish.php';
        $sql = '';

        // sql query depends on the value of the order by
        Switch ($value)
        {
            case 1: $sql = "SELECT * FROM usuarios WHERE borrado = '0' ORDER BY nombre";
                break;
            case 2: $sql = "SELECT * FROM usuarios WHERE borrado = '0' ORDER BY nombre DESC";
                break;
            case 3: $sql = "SELECT * FROM usuarios WHERE borrado = '0' ORDER BY apellidos";
                break;
            case 4: $sql = "SELECT * FROM usuarios WHERE borrado = '0' ORDER BY apellidos DESC";
                break;
        }

        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            // checking that at least one user exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all users into an array
                while ($row = $result->fetch_array())
                {

                    $toret[$i] = $row;
                    $i++;
                }

            }else {
                $toret = $strings['ListErrorNotExist'];
            }
        }

        return $toret;

    }


}

?>