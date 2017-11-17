<?php

include '../functions/connectDB.php';

class TableModel
{
	function __construct($id, $nombre)
    {
		$this->id = $id;
		$this->nombre = $nombre;
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

		return $toret;
	}

	function getNombre(){
		return $this->nombre;
	}

	function getId(){
		/*if(isset($this->id))
		{
			$toret = $this->id;
		}else{*/
			$sql = "SELECT id FROM tablas WHERE nombre = '".$this->nombre."'";
			$result = $this->mysqli->query($sql);
			$row = $result->fetch_array();
			$toret = $row['id'];
		//}
		return $toret;
	}

	// insert new table
	function insert()
    {
        include '../languages/spanish.php';

		// checking form's data

        if ($this->nombre <> '' )
        {
            $sql = "SELECT * FROM tablas WHERE nombre = '".$this->nombre."'";

            // checking DB connection
            if (!$result = $this->mysqli->query($sql))
            {
                $toret = $strings['ConnectionDBError'];

            }else {

                // checking that the table doesn't exist
                if ($result->num_rows == 0)
                {

                    $sql = "INSERT INTO tablas (nombre,borrado) 
							VALUES('" . $this->nombre . "','0')";

                    // inserting new table
                    if ($result = $this->mysqli->query($sql))
                    {
                        $toret = $strings['InsertSuccess'];
                    }else {
                        $toret = $strings['InsertError'];
                    }

                }else {

                    // seeing if the table had been created before
                    $sql = "SELECT * FROM tablas WHERE nombre = '".$this->nombre."' AND borrado='1'";
                    $result = $this->mysqli->query($sql);

                    if ($result->num_rows == 1)
                    {
                        $sql = "UPDATE tablas SET borrado ='0' WHERE nombre = '" . $this->nombre ."'";
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

	// delete table
	function delete(){

        include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{
	        $sql = "SELECT * FROM tablas WHERE id = '".$this->id."'";

	        // checking DB connection
	        if (!$result = $this->mysqli->query($sql))
	        {
				$toret = $strings['ConnectionDBError'];
			}else {
		
				// checking that the table exists
				if ($result->num_rows == 1)
				{

					$sql = "UPDATE tablas SET borrado ='1' WHERE id = '" . $this->id ."'";

					$this->mysqli->query($sql);

					// deleting table
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

	// modify table
	function modify()
    {

		include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{

	        $sql = "SELECT * FROM tablas WHERE id = '".$this->id."'";

	        // checking DB connection
			if (!$result = $this->mysqli->query($sql))
			{
				$toret = $strings['ConnectionDBError'];
			}else {
				
				// checking that the table exists
				if ($result->num_rows == 1)
				{
					$modify = false;
					$lastModify = $this->lastModify(); 
					$sql = "UPDATE tablas SET ";
					
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

					$sql = $sql . "WHERE id ='" . $this->id . "'";

					// if exists modification
					if($modify)
					{
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

	        $sql = "SELECT * FROM tablas WHERE id = '".$this->id."'";

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

	function getLines()
	{
		include '../languages/spanish.php';
		
		if ($this->id <> '' )
		{

	        $sql = "SELECT * FROM lineasdetabla WHERE tabla_id = '".$this->id."'";

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

					// introducing all tables into an array
					while ($row = $result->fetch_array())
	                {
	                	$sql = "SELECT * FROM ejercicios WHERE id = '".$row['ejercicio_id']."'";
	                	$result2 = $this->mysqli->query($sql);
	                	$row2 = $result2->fetch_array();
	                	$name = $row2['nombre'];
	                	$imagen = $row2['imagen'];

	                	/*
	                	//------------------------

	                	$sql = "SELECT id FROM tablas WHERE nombre = '".$this->nombre."'";
						$result = $this->mysqli->query($sql);
						$row = $result->fetch_array();
						$toret = $row['id'];

	                	//-------------------------
	                	id
						repeticiones
						duracion
						descanso
						series
						tabla_id
						ejercicio_id
						*/
						$array = array(
							"imagen" => $imagen, 
							"ejercicio" => $name, 
							"series" => $row['series'], 
							"repeticiones" => $row['repeticiones'], 
							"duracion" => $row['duracion'], 
							"descanso" => $row['descanso'],
							"id" => $row['id']
						);
						//$row['ejercicio_id'] = $name;	
						$toret[$i] = $array;
						$i++;
					}						

				}else {
					$toret = $strings['ListErrorNotExist'];
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

        $sql = "SELECT * FROM tablas WHERE borrado = '0' ORDER BY nombre";

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

    }

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


}

?>