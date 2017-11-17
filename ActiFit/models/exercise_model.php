<?php

include '../functions/connectDB.php';

class ExerciseModel
{
	function __construct($id, $nombre, $descripcion, $imagen, $tipo)
    {
		$this->id = $id;
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
		$this->imagen = $imagen;
		$this->tipo = $tipo;

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
		if($this->descripcion <> '')
		{
			$toret = "descripcion";
		}
		if($this->imagen <> '')
		{
			$toret = "imagen";
		}
		if($this->tipo <> '')
		{
			$toret = "tipo";
		}

		return $toret;
	}

	// insert new exercise
	function insert()
    {
        include '../languages/spanish.php';

		// checking form's data

        if ($this->nombre <> '' )
        {
            $sql = "SELECT * FROM ejercicios WHERE nombre = '".$this->nombre."'";

            // checking DB connection
            if (!$result = $this->mysqli->query($sql))
            {
                $toret = $strings['ConnectionDBError'];

            }else {

                // checking that the exercise doesn't exist
                if ($result->num_rows == 0)
                {

                    $sql = "INSERT INTO ejercicios (nombre,descripcion,imagen,tipo,borrado) 
							VALUES('" . $this->nombre . "','" . $this->descripcion . "','" . $this->imagen . "','"  . $this->tipo . "','0')";

                    // inserting new exercise
                    if ($result = $this->mysqli->query($sql))
                    {
                        $toret = $strings['InsertSuccess'];
                    }else {
                        $toret = $strings['InsertError'];
                    }

                }else {

                    // seeing if the exercise had been created before
                    $sql = "SELECT * FROM ejercicios WHERE nombre = '".$this->nombre."' AND borrado='1'";
                    $result = $this->mysqli->query($sql);

                    if ($result->num_rows == 1)
                    {
                        $sql = "UPDATE ejercicios SET borrado ='0' WHERE nombre = '" . $this->nombre ."'";
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

	// delete exercise
	function delete(){

        include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{
	        $sql = "SELECT * FROM ejercicios WHERE id = '".$this->id."'";

	        // checking DB connection
	        if (!$result = $this->mysqli->query($sql))
	        {
				$toret = $strings['ConnectionDBError'];
			}else {
		
				// checking that the exercise exists
				if ($result->num_rows == 1)
				{

					$sql = "UPDATE ejercicios SET borrado ='1' WHERE id = '" . $this->id ."'";

					$this->mysqli->query($sql);

					// deleting exercise
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

	// modify exercise
	function modify()
    {

		include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{

	        $sql = "SELECT * FROM ejercicios WHERE id = '".$this->id."'";

	        // checking DB connection
			if (!$result = $this->mysqli->query($sql))
			{
				$toret = $strings['ConnectionDBError'];
			}else {
				
				// checking that the exercise exists
				if ($result->num_rows == 1)
				{
					$modify = false;
					$lastModify = $this->lastModify(); 
					$sql = "UPDATE ejercicios SET ";

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

					if($this->descripcion <> '')
					{
						$sql = $sql . "descripcion ='" . $this->descripcion . "'";
						if($lastModify <> "descripcion")
						{
							$sql = $sql . ",";
						}
						$sql = $sql . " ";
						$modify = true;
					}

					if($this->imagen <> '')
					{
						$sql = $sql . "imagen ='" . $this->imagen . "'";
						if($lastModify <> "imagen")
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

						// updating exercise
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

	// consulting exercise
	function consult()
    {

        include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{

	        $sql = "SELECT * FROM ejercicios WHERE id = '".$this->id."'";

	        // checking DB connection
			if (!$result = $this->mysqli->query($sql))
			{
				$toret = $strings['ConnectionDBError'];
			}else {
				
				// checking that the exercise exists
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

	// listing all exercises
	function toList()
    {

		include '../languages/spanish.php';

        $sql = "SELECT * FROM ejercicios WHERE borrado = '0' ORDER BY nombre";

        // checking DB connection
		if (!$result = $this->mysqli->query($sql))
		{
			$toret = $strings['connectionDBError'];
		}else {
			
			// checking that at least one exercise exists
			if ($result->num_rows != 0)
			{

				$toret=[];
				$i=0;

				// introducing all exercises into an array
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

	// search exercises
    function search($word)
    {

        include '../languages/spanish.php';

        $sql = "SELECT * FROM ejercicios WHERE borrado = '0' AND nombre LIKE '%".$word."%'";

        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            // checking that at least one exercise exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all exercises into an array
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
            case 1: $sql = "SELECT * FROM ejercicios WHERE borrado = '0' ORDER BY nombre";
                break;
            case 2: $sql = "SELECT * FROM ejercicios WHERE borrado = '0' ORDER BY nombre DESC";
                break;
        }

        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            // checking that at least one exercise exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all exercises into an array
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