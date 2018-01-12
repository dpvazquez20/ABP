<?php

include '../functions/connectDB.php';

class TrainingModel
{
	function __construct($id, $nombre, $tipo, $sesiones)
    {
		$this->id = $id;
		$this->nombre = $nombre;
		$this->tipo = $tipo;
		$this->sesiones = $sesiones;

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
		if($this->nombre <> '')
		{
			$toret = "nombre";
		}
		if($this->tipo <> '')
		{
			$toret = "tipo";
		}
		if($this->sesiones <> '')
		{
			$toret = "sesiones";
		}
		
		return $toret;
	}

	// insert new Training
	function insert()
    {
        include '../languages/spanish.php';

		// checking form's data

        if ($this->nombre <> '' )
        {
            $sql = "SELECT * FROM entrenamientos WHERE nombre = '".$this->nombre."'";

            // checking DB connection
            if (!$result = $this->mysqli->query($sql))
            {
                $toret = $strings['ConnectionDBError'];

            }else {

                // checking that the Training doesn't exist
                if ($result->num_rows == 0)
                {

                    $sql = "INSERT INTO entrenamientos (nombre,tipo,sesiones,borrado) 
							VALUES('" . $this->nombre . "','" . $this->tipo . "','0','0')";

                    // inserting new Training
                    if ($result = $this->mysqli->query($sql))
                    {
                        $toret = $strings['InsertSuccess'];
                    }else {
                        $toret = $strings['InsertError'];
                    }

                }else {

                    // seeing if the Training had been created before
                    $sql = "SELECT * FROM entrenamientos WHERE nombre = '".$this->nombre."' AND borrado='1'";
                    $result = $this->mysqli->query($sql);

                    if ($result->num_rows == 1)
                    {
                        $sql = "UPDATE entrenamientos SET borrado ='0' WHERE nombre = '" . $this->nombre ."'";
                        if ($result = $this->mysqli->query($sql))
                        {
                            $toret = $strings['InsertSuccess'];
                        }else {
                            $toret = $strings['InsertError'];
                        }

                    } else {
                        $toret = $strings['InsertErrorRepeat'];
                    }
                }
            }
        }else {
            $toret = $strings['InsertErrorForm'];
        }

		return $toret;
	}
	
	function insertTables()
    {
        include '../languages/spanish.php';

		// checking form's data

        if ($this->nombre <> '' )
        {
            $sql = "SELECT * FROM entrenamientos WHERE nombre = '".$this->nombre."'";

            // checking DB connection
            if (!$result = $this->mysqli->query($sql))
            {
                $toret = $strings['ConnectionDBError'];

            }else {

                // checking that the Training doesn't exist
                if ($result->num_rows == 0)
                {

                    $sql = "INSERT INTO entrenamientos_has_tablas (entrenamiento_id,tabla_id,orden_sesion) 
							VALUES('" . $this->id . "','" . $this->tabla_id . "','" . $this->orden_sesion . "')";
	
                    // inserting new Training
                    if ($result = $this->mysqli->query($sql))
                    {
                        $toret = $strings['InsertSuccess'];
                    }else {
                        $toret = $strings['InsertError'];
                    }

                }else {

                    // seeing if the Training had been created before
                    $sql = "SELECT * FROM entrenamientos WHERE nombre = '".$this->nombre."' AND borrado='1'";
                    $result = $this->mysqli->query($sql);

                    if ($result->num_rows == 1)
                    {
                        $sql = "UPDATE entrenamientos SET borrado ='0' WHERE nombre = '" . $this->nombre ."'";
                        if ($result = $this->mysqli->query($sql))
                        {
                            $toret = $strings['InsertSuccess'];
                        }else {
                            $toret = $strings['InsertError'];
                        }

                    } else {
                        $toret = $strings['InsertErrorRepeat'];
                    }
                }
            }
        }else {
            $toret = $strings['InsertErrorForm'];
        }

		return $toret;
	}

	// delete Training
	function deleteTable(){

        include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{
	        //die($this->id_entrenamiento);
			
			
			$sql = "DELETE FROM entrenamientos_has_tablas WHERE orden_sesion = '".$_REQUEST['orden_sesion']."' AND entrenamiento_id = '".$_REQUEST['id_entrenamiento']."'";
			$sql2 = "UPDATE entrenamientos SET sesiones=sesiones-1 WHERE id = '".$_REQUEST['id_entrenamiento']."'";
	        $sql3 = "UPDATE entrenamientos_has_tablas SET orden_sesion=orden_sesion-1 WHERE entrenamiento_id = '".$_REQUEST['id_entrenamiento']."' AND orden_sesion >'" .$_REQUEST['orden_sesion']. "'";
		
			
			if ((!$result = $this->mysqli->query($sql)) || (!$result2 = $this->mysqli->query($sql2)) || (!$result3 = $this->mysqli->query($sql3)))
	        {
				$toret = $strings['DeleteError'];
			}else {
				$toret = $strings['DeleteSuccess'];
			}

	    }else {
	    	$toret = $strings['DeleteErrorForm'];
		}

		return $toret;

	}
	
	// delete Training
	function delete(){

        include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{
	        $sql = "SELECT * FROM entrenamientos WHERE id = '".$this->id."'";

	        // checking DB connection
	        if (!$result = $this->mysqli->query($sql))
	        {
				$toret = $strings['ConnectionDBError'];
			}else {
		
				// checking that the Training exists
				if ($result->num_rows == 1)
				{

					$sql = "UPDATE entrenamientos SET borrado ='1' WHERE id = '" . $this->id ."'";
	
					$this->mysqli->query($sql);

					// deleting Training
					if ($result = $this->mysqli->query($sql))
					{
						$toret = $strings['DeleteSuccess'];
					}else {
						$toret = $strings['DeleteError'];
					}

				}else {
					$toret = $strings['ErrorNotExist'];
				}

			}

	    }else {
	    	$toret = $strings['DeleteErrorForm'];
		}

		return $toret;

	}

	// modify Training
	function modify()
    {

		include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{

	        $sql = "SELECT * FROM entrenamientos WHERE id = '".$this->id."'";

	        // checking DB connection
			if (!$result = $this->mysqli->query($sql))
			{
				$toret = $strings['ConnectionDBError'];
			}else {
				
				// checking that the Training exists
				if ($result->num_rows == 1)
				{
					$modify = false;
					$lastModify = $this->lastModify(); 
					$sql = "UPDATE entrenamientos SET ";
					
					if($this->nombre <> '')
					{
						$sql = $sql . "nombre ='" . $this->nombre . "'";
						if($lastModify <> "nombre")
						{
							$sql = $sql . ",";
						}
						$sql = $sql . " ";
						$modify = true;
					}
					
					if($this->tipo <> '')
					{
						$sql = $sql . "tipo ='" . $this->tipo . "'";
						if($lastModify <> "tipo")
						{
							$sql = $sql . ",";
						}
						$sql = $sql . " ";
						$modify = true;
					}
					
					$sql = $sql . "WHERE id ='" . $this->id . "'";

					// if exists modification
					if($modify)
					{
						$this->mysqli->query($sql);

						// updating Training
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

	// consulting Training
	function consult()
    {

        include '../languages/spanish.php';

		// checking form's data
		

	        $sql = "SELECT * FROM entrenamientos WHERE id = '".$this->id."'";

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

	// listing all Trainings
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
	
	function toListTrainings()
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
	
	function toListTduTrainings()
    {

		include '../languages/spanish.php';

        $sql = "SELECT * FROM entrenamientos WHERE borrado = '0' AND tipo = 'Normal' ORDER BY nombre";

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
	
	function getTables()
	{
		include '../languages/spanish.php';
			
			// get the id of the tables in the training
	        $sql = "SELECT tabla_id, orden_sesion
					FROM entrenamientos_has_tablas 
					WHERE entrenamiento_id= '".$this->id."'";

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

	// search Trainings
    function search($word)
    {

        include '../languages/spanish.php';

        $sql = "SELECT * FROM entrenamientos WHERE borrado = '0' AND ( nombre LIKE '%".$word."%')";

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
            case 1: $sql = "SELECT * FROM entrenamientos WHERE borrado = '0' ORDER BY nombre";
                break;
            case 2: $sql = "SELECT * FROM entrenamientos WHERE borrado = '0' ORDER BY nombre DESC";
                break;
        }

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
	
	function getTrainingId()
	{
		$sql = "SELECT id FROM entrenamientos WHERE nombre = '".$this->nombre."'";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_array();
		return $row['id'];	
	}
	
	function assign($user_id,$training_id)
	{
		include '../languages/spanish.php';
		
		$sql1 = "SELECT * FROM entrenamientos_has_usuarios 
				WHERE usuario_id = '".$user_id."'";
				
		$result = $this->mysqli->query($sql1);		
			
		if ($result->num_rows != 0)
		{
			$sql2 = "DELETE FROM entrenamientos_has_usuarios 
					WHERE usuario_id = '".$user_id."'";			
			
			if ($result = $this->mysqli->query($sql2))
			{
				$sql4 = "INSERT INTO entrenamientos_has_usuarios (entrenamiento_id,usuario_id) 
						VALUES('" . $training_id . "','" . $user_id . "')";
						
				if ($result = $this->mysqli->query($sql4))
				{
					$toret = $strings['AssingSuccess'];
				}else {
					$toret = $strings['InsertError'];
				}
			}else {
				$toret = $strings['InsertError'];
			}
		}else{		
		
			$sql3 = "INSERT INTO entrenamientos_has_usuarios (entrenamiento_id,usuario_id) 
					VALUES('" . $training_id . "','" . $user_id . "')";
			
			if ($result = $this->mysqli->query($sql3))
			{
				$toret = $strings['InsertSuccess'];
			}else {
				$toret = $strings['InsertError'];
			}
		}
		return $toret;		
	}


}

?>