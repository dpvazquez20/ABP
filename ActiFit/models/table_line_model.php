<?php

include '../functions/connectDB.php';

class TableLineModel
{
	function __construct($id, $idTabla,$ejercicio,$series,$repeticiones,$duracion,$descanso)
    {
		$this->id = $id;
		$this->idTabla = $idTabla;
		$this->ejercicio = $ejercicio;
		$this->series = $series;
		$this->repeticiones = $repeticiones;
		$this->duracion = $duracion;
		$this->descanso = $descanso;

		$this->mysqli = connect();
	}

	function __destruct()
    {

	}

	/*function lastModify(){

		if($this->id <> '')
		{
			$toret = "id";
		}
		if($this->nombre <> '')
		{
			$toret = "nombre";
		}

		return $toret;
	}*/

	// insert new table
	function insert()
    {
        include '../languages/spanish.php';

		$sql = "INSERT INTO lineasdetabla (";

		$arrayName = array();
		$arrayValue = array();
		if($this->idTabla <> '')
		{
			array_push($arrayName,'tabla_id');
			array_push($arrayValue,$this->idTabla);
		}
		if($this->ejercicio <> '')
		{
			array_push($arrayName,'ejercicio_id');
			array_push($arrayValue,$this->ejercicio);
		}
		if($this->series <> '')
		{
			array_push($arrayName,'series');
			array_push($arrayValue,$this->series);
		}
		if($this->repeticiones <> '')
		{
			array_push($arrayName,'repeticiones');
			array_push($arrayValue,$this->repeticiones);
		}
		if($this->duracion <> '')
		{
			array_push($arrayName,'duracion');
			array_push($arrayValue,$this->duracion);
		}
		if($this->descanso <> '')
		{
			array_push($arrayName,'descanso');
			array_push($arrayValue,$this->descanso);
		}

		$primero = true;
		foreach ($arrayName as $value)
		{
			if($primero)
			{
				$sql = $sql . $value;
				$primero = false;
			}else{
				$sql = $sql . ",". $value;
			}

		}
		$sql = $sql . ") VALUES (";
		$primero = true;
		foreach ($arrayValue as $value)
		{
			if($primero)
			{
				$sql = $sql . "'" . $value . "'";
				$primero = false;
			}else{
				$sql = $sql . ",'". $value . "'";
			}

		}
		$sql = $sql . ")";

        if ($result = $this->mysqli->query($sql))
        {
            $toret = $strings['InsertSuccess'];
        }else {
            $toret = $strings['InsertError'];
            die("ERROR | slq: $sql"); // ---------------------------------------------------------------------------------- CONTROLAR
        }

		return $toret;
	}

	// delete table
	function delete(){

        include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{
	        $sql = "DELETE FROM lineasdetabla WHERE id = '".$this->id."'";

	        // deleting table line
			if ($result = $this->mysqli->query($sql))
			{
				$toret = $strings['DeleteSuccess'];
			}else {
				$toret = $strings['DeleteError'];
			}

		}else {
	    	$toret = $strings['DeleteErrorForm'];
		}

		return $toret;

	}

	// modify table
	function modify()
    {

		include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{

	        $sql = "SELECT * FROM lineasdetabla WHERE id = '".$this->id."'";

	        // checking DB connection
			if (!$result = $this->mysqli->query($sql))
			{
				$toret = $strings['ConnectionDBError'];
			}else {

				// checking that the table exists
				if ($result->num_rows == 1)
				{
					$sql = "UPDATE lineasdetabla SET ";
					
					$arrayName = array();
					$arrayValue = array();
					/*if($this->idTabla <> '')
					{
						array_push($arrayName,'tabla_id');
						array_push($arrayValue,$this->idTabla);
					}
					if($this->ejercicio <> '')
					{
						array_push($arrayName,'ejercicio_id');
						array_push($arrayValue,$this->ejercicio);
					}*/
					if($this->series <> '')
					{
						array_push($arrayName,'series');
						array_push($arrayValue,$this->series);
					}
					if($this->repeticiones <> '')
					{
						array_push($arrayName,'repeticiones');
						array_push($arrayValue,$this->repeticiones);
					}
					if($this->duracion <> '')
					{
						array_push($arrayName,'duracion');
						array_push($arrayValue,$this->duracion);
					}
					if($this->descanso <> '')
					{
						array_push($arrayName,'descanso');
						array_push($arrayValue,$this->descanso);
					}

					$max = count($arrayName);
					
					// if exists modification
					if($max > 0)
					{
						for($i = 0; $i < ($max - 1); $i++)
						{
							$sql = $sql . $arrayName[$i] . "='" . $arrayValue[$i] . "', ";
						}

						$sql = $sql . $arrayName[$max-1] . "='" . $arrayValue[$max-1] . "' ";

						$sql = $sql . "WHERE id ='" . $this->id . "'";

						$this->mysqli->query($sql);

						// updating table
						if ($result = $this->mysqli->query($sql))
						{
							$toret = $strings['UpdateSuccess'];
						}else {
							$toret = $strings['UpdateError'];
						}
					}else{
						$toret = $strings['UpdateNoModify'];
					}
					

				}else {
					$toret = $strings['ErrorNotExist'];
				}
			}
	    }else {
	    	$toret = $strings['UpdateErrorForm'];
		}

		return $toret;

	}

	// consulting table
	function consult()
    {

        include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{

	        $sql = "SELECT * FROM lineasdetabla WHERE id = '".$this->id."'";

	        // checking DB connection
			if (!$result = $this->mysqli->query($sql))
			{
				$toret = $strings['ConnectionDBError'];
			}else {
				
				// checking that the table exists
				if ($result->num_rows == 1)
				{
					$toret = array();
					$toret[0] = $result->fetch_array();							

				}else {
					$toret = $strings['ErrorNotExist'];
				}
			}
	    }else {
	    	$toret = $strings['ConsultErrorForm'];
		}

		return $toret;

	}

	// listing all tables
	function toList()
    {

		include '../languages/spanish.php';

        $sql = "SELECT * FROM lineasdetabla WHERE borrado = '0' AND tabla_id = '" . $this->idTabla . "' ORDER BY nombre";

        // checking DB connection
		if (!$result = $this->mysqli->query($sql))
		{
			$toret = $strings['connectionDBError'];
		}else {
			
			// checking that at least one table exists
			if ($result->num_rows != 0)
			{

				$toret=[];
				$i=0;

				// introducing all tables into an array
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

	function toListExercises()
    {

		include '../languages/spanish.php';

        $sql = "SELECT * FROM ejercicios WHERE borrado = '0' ORDER BY nombre";

        // checking DB connection
		if (!$result = $this->mysqli->query($sql))
		{
			$toret = $strings['connectionDBError'];
		}else {
			
			// checking that at least one table exists
			if ($result->num_rows != 0)
			{

				$toret=[];
				$i=0;

				// introducing all tables into an array
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

	/*
	// search tables
    function search($word)
    {

        include '../languages/spanish.php';

        $sql = "SELECT * FROM tablas WHERE borrado = '0' AND ( nombre LIKE '%".$word."%')";

        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            // checking that at least one table exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all tables into an array
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

    }*/


    /*
    // order the element list
    function order($value)
    {

        include '../languages/spanish.php';
        $sql = '';

        // sql query depends on the value of the order by
        Switch ($value)
        {
            case 1: $sql = "SELECT * FROM tablas WHERE borrado = '0' ORDER BY nombre";
                break;
            case 2: $sql = "SELECT * FROM tablas WHERE borrado = '0' ORDER BY nombre DESC";
                break;
        }

        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            // checking that at least one table exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all tables into an array
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
    */


}

?>