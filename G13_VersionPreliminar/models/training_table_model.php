<?php

include '../functions/connectDB.php';

class TrainingTableModel
{
	function __construct($entrenamiento_id, $tabla_id, $orden_sesion)
    {
		$this->entrenamiento_id = $entrenamiento_id;
		$this->tabla_id = $tabla_id;
		$this->orden_sesion = $orden_sesion;
		$this->mysqli = connect();
	}

	function __destruct()
    {

	}

	function lastModify(){

		if($this->entrenamiento_id <> '')
		{
			$toret = "entrenamiento_id";
		}
		if($this->tabla_id <> '')
		{
			$toret = "tabla_id";
		}
		if($this->orden_sesion <> '')
		{
			$toret = "orden_sesion";
		}

		return $toret;
	}

	// insert new TrainingTable
	/*function insert()
    {
        include '../languages/spanish.php';

		// checking form's data

        if ($this->orden_sesion <> '' )
        {
            $sql = "SELECT * FROM entrenamientos_has_tablas WHERE entrenamiento_id = '".$this->entrenamiento_id."'
															AND tabla_id = '".$this->tabla_id."'";

            // checking DB connection
            if (!$result = $this->mysqli->query($sql))
            {
                $toret = $strings['ConnectionDBError'];

            }else {

                // checking that the TrainingTable doesn't exist
                if ($result->num_rows == 0)
                {

                    $sql = "INSERT INTO entrenamientos_has_tablas (entrenamiento_id,tabla_id,orden_sesion) 
							VALUES('" . $this->entrenamiento_id . "','" . $this->tabla_id . "','" . $this->orden_sesion . "')";

					die($sql);
                    // inserting new TrainingTable
                    if ($result = $this->mysqli->query($sql))
                    {
                        $toret = $strings['InsertSuccess'];
                    }else {
                        $toret = $strings['InsertError'];
                    }

                }
                
            }
        }else {
            $toret = $strings['InsertErrorForm'];
        }

		return $toret;
	}*/
	
	function insert()
    {
		
        include '../languages/spanish.php';

        $sql1 = "SELECT orden_sesion FROM entrenamientos_has_tablas
				WHERE entrenamiento_id = '" . $this->entrenamiento_id . "'
				ORDER BY orden_sesion DESC LIMIT 1";
					
		$result = $this->mysqli->query($sql1);	

		if ($result->num_rows == 0)
		{
			$number = 1;
		}else{
			$row = $result->fetch_array();
			$number = $row['orden_sesion'];
			$number = $number + 1;
		}
		
		$sql2= "UPDATE entrenamientos SET sesiones= " . $number . " WHERE id = '" . $this->entrenamiento_id . "'";
		
		$sql3 = "INSERT INTO entrenamientos_has_tablas (tabla_id,entrenamiento_id,orden_sesion) 
					VALUES('" . $this->tabla_id . "','" . $this->entrenamiento_id . "','" . $number . "')";				
				
			// inserting new TrainingTable
			if (($result = $this->mysqli->query($sql2))&($result = $this->mysqli->query($sql3)))
			{
				$toret = $strings['InsertSuccess'];
			}else {
				$toret = $strings['InsertError'];
			}
		

		return $toret;
	}
	
	
	function add()
    {
		
        include '../languages/spanish.php';

        $sql1 = "SELECT orden_sesion FROM entrenamientos_has_tablas
				WHERE entrenamiento_id = '" . $this->entrenamiento_id . "'
				ORDER BY orden_sesion DESC LIMIT 1";
					
		$result = $this->mysqli->query($sql1);	

		if ($result->num_rows == 0)
		{
			$number = 1;
		}else{
			$row = $result->fetch_array();
			$number = $row['orden_sesion'];
			$number = $number + 1;
		}
		
		//die($this->entrenamiento_id);
		
		$sql2 = "UPDATE entrenamientos SET sesiones=sesiones+1 WHERE id = '" . $this->entrenamiento_id . "'";
		
		//die($this->entrenamiento_id);
		
		$sql3 = "INSERT INTO entrenamientos_has_tablas (tabla_id,entrenamiento_id,orden_sesion) 
				VALUES('" . $this->tabla_id . "','" . $this->entrenamiento_id . "','" . $number . "')";				
				
			// inserting new TrainingTable
		if (($result = $this->mysqli->query($sql3))&($result = $this->mysqli->query($sql2)))
		{
			$toret = $strings['InsertSuccess'];
		}else {
			$toret = $strings['InsertError'];
		}
		
		return $toret;
	}

	function toList()
    {

		include '../languages/spanish.php';

        $sql = "SELECT * FROM entrenamientos WHERE borrado = '0' ORDER BY nombre";

        // checking DB connection
		if (!$result = $this->mysqli->query($sql))
		{
			$toret = $strings['connectionDBError'];
		}else {
			
			// checking that at least one Training exists
			if ($result->num_rows != 0)
			{

				$toret=[];
				$i=0;

				// introducing all Trainings into an array
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


	function toListTables()
    {

		include '../languages/spanish.php';

        $sql = "SELECT * FROM tablas WHERE borrado = '0' ORDER BY nombre";

        // checking DB connection
		if (!$result = $this->mysqli->query($sql))
		{
			$toret = $strings['connectionDBError'];
		}else {
			
			// checking that at least one Training exists
			if ($result->num_rows != 0)
			{

				$toret=[];
				$i=0;

				// introducing all Trainings into an array
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
	
	function toListTduTables()
    {

		include '../languages/spanish.php';

        $sql = "SELECT * FROM tablas WHERE borrado = '0' AND tipo = 'Normal' ORDER BY nombre";

        // checking DB connection
		if (!$result = $this->mysqli->query($sql))
		{
			$toret = $strings['connectionDBError'];
		}else {
			
			// checking that at least one Training exists
			if ($result->num_rows != 0)
			{

				$toret=[];
				$i=0;

				// introducing all Trainings into an array
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
	
	function trainingConsult()
    {

        include '../languages/spanish.php';

		// checking form's data
		

	        $sql = "SELECT * FROM entrenamientos WHERE id = '".$this->entrenamiento_id."'";

	        // checking DB connection
			if (!$result = $this->mysqli->query($sql))
			{
				$toret = $strings['ConnectionDBError'];
			}else {
				
				// checking that the Training exists
				if ($result->num_rows == 1)
				{
					$toret = array();
					$toret[0] = $result->fetch_array();							

				}else {
					$toret = $strings['ErrorNotExist'];
				}
			}

		return $toret;

	}
	
	function getTrainingTables()
	{
		include '../languages/spanish.php';
			
			// get the id of the tables in the training
	        $sql = "SELECT tabla_id, orden_sesion
					FROM entrenamientos_has_tablas 
					WHERE entrenamiento_id= '".$this->entrenamiento_id."'";

	        // checking DB connection
			if (!$result = $this->mysqli->query($sql))
			{
				$toret = $strings['ConnectionDBError'];
			}else {
				
				// checking that at least one table line exists
				if ($result->num_rows != 0)
				{

					$toret=[];
					$i=0;

					// introducing all tables id into an array
					while ($row = $result->fetch_array())
	                {
	                	$sql = "SELECT * FROM tablas WHERE id = '".$row['tabla_id']."'";
	                	$result2 = $this->mysqli->query($sql);
	                	$row2 = $result2->fetch_array();
	                	$name = $row2['nombre'];
	                	
						$array = array(
							"tabla" => $name, 
							"orden_sesion" => $row['orden_sesion'],
							"id" => $row['tabla_id']
						);
						$toret[$i] = $array;
						$i++;
					}						

				}else {
					$toret = $strings['ListErrorNotExist'];
				}
			}
		return $toret;	
	}
	
	function getTipo($id_entrenamiento){
			$sql = "SELECT * FROM entrenamientos WHERE id = '" . $id_entrenamiento . "'";
			
			$result = $this->mysqli->query($sql);
	        $row = $result->fetch_array();
	        $tipo = $row['tipo'];
			
			return $tipo;
	}
	
}

?>