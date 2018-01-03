<?php

include '../functions/connectDB.php';

class AssistanceModel
{
	function __construct($id)
    {
		$this->id = $id;

		$this->mysqli = connect();
	}

	function __destruct()
    {

	}

	function lastModify(){

		if($this->id <> '')
		{
			$toret = "id";
		}

		return $toret;
	}

	// consulting assistance
	function consult()
    {

        include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{
	        $sql = "SELECT * FROM usuarios WHERE id IN (
                        SELECT usuario_id FROM inscripciones WHERE id IN (
                          SELECT inscripciones_id FROM inscripciones_has_actividades WHERE actividades_id = '".$this->id."') AND borrado='0')";

	        // checking DB connection
			if (!$result = $this->mysqli->query($sql))
			{
				$toret = $strings['ConnectionDBError'];
			}else {
				
				// checking that the assistance exists
				if ($result->num_rows != 0)
				{
                    $toret=[];
                    $i=0;

                    // introducing all assistances into an array
                    while ($row = $result->fetch_array())
                    {

                        $toret[$i] = $row;
                        $i++;
                    }

                }else {
					$toret = $strings['ErrorNoResults'];
				}
			}
	    }else {
	    	$toret = $strings['ConsultErrorForm'];
		}

		return $toret;

	}

	// listing all activities
	function toList($coach_id)
    {

		include '../languages/spanish.php';

        $sql = "SELECT * FROM actividades WHERE borrado = '0' AND coach_id='$coach_id' ORDER BY nombre";

        // checking DB connection
		if (!$result = $this->mysqli->query($sql))
		{
			$toret = $strings['connectionDBError'];
		}else {
			
			// checking that at least one assistance exists
			if ($result->num_rows != 0)
			{

				$toret=[];
				$i=0;

				// introducing all assistances into an array
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

	// search assistances
    function search($word,$coach_id)
    {

        include '../languages/spanish.php';

        $sql = "SELECT * FROM actividades WHERE borrado = '0'  AND coach_id='$coach_id' AND nombre LIKE '%".$word."%'";

        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            // checking that at least one assistance exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all assistances into an array
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
    function order($value,$coach_id)
    {

        include '../languages/spanish.php';
        $sql = '';

        // sql query depends on the value of the order by
        Switch ($value)
        {
            case 1: $sql = "SELECT * FROM actividades WHERE borrado = '0' AND coach_id='$coach_id' ORDER BY nombre";
                break;
            case 2: $sql = "SELECT * FROM actividades WHERE borrado = '0' AND coach_id='$coach_id' ORDER BY nombre DESC";
                break;
            case 3: $sql = "SELECT * FROM actividades WHERE borrado = '0' AND coach_id='$coach_id' ORDER BY tipo";
                break;
        }

        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            // checking that at least one assistance exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all assistances into an array
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


    // search assistances
    function searchUsers($word,$actID)
    {

        include '../languages/spanish.php';

        $sql = "SELECT * FROM usuarios WHERE id IN (
                        SELECT usuario_id FROM inscripciones WHERE id IN (
                          SELECT inscripciones_id FROM inscripciones_has_actividades WHERE actividades_id = '".$actID."') AND borrado='0') AND nombre LIKE '%".$word."%'";
        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            // checking that at least one assistance exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all assistances into an array
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
    function orderUsers($value,$actID)
    {

        include '../languages/spanish.php';
        $sql = '';

        // sql query depends on the value of the order by
        Switch ($value)
        {
            case 1: $sql = "SELECT * FROM usuarios WHERE id IN (
                        SELECT usuario_id FROM inscripciones WHERE id IN (
                          SELECT inscripciones_id FROM inscripciones_has_actividades WHERE actividades_id = '".$actID."') AND borrado='0') ORDER BY nombre";
                break;
            case 2: $sql = "SELECT * FROM usuarios WHERE id IN (
                        SELECT usuario_id FROM inscripciones WHERE id IN (
                          SELECT inscripciones_id FROM inscripciones_has_actividades WHERE actividades_id = '".$actID."') AND borrado='0')ORDER BY nombre DESC";
                break;
        }

        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            // checking that at least one assistance exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all assistances into an array
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

    // Search resources
    function getResources()
    {
        include '../languages/spanish.php';

        $sql = "SELECT * FROM recursos WHERE borrado = '0'";

        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            // checking that at least one resource exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all resources into an array
                while ($row = $result->fetch_array())
                {

                    $toret[$i] = $row;
                    $i++;
                }

            }else {
                $toret = $strings['ConsultErrorForm'];
            }
        }

        return $toret;
    }

    // Search coaches
    function getCoaches()
    {
        include '../languages/spanish.php';

        $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND tipo='Entrenador'";

        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            // checking that at least one resource exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all resources into an array
                while ($row = $result->fetch_array())
                {

                    $toret[$i] = $row;
                    $i++;
                }

            }else {
                $toret = $strings['ConsultErrorForm'];
            }
        }

        return $toret;
    }
}

?>