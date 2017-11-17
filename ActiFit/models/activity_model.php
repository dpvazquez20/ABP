<?php

include '../functions/connectDB.php';

class ActivityModel
{
	function __construct($id,$nombre,$descripcion,$frecuencia,$horaInicio,$horaFin,$tipo,$numMaxParticipantes)
    {
		$this->id = $id;
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
        $this->frecuencia = $frecuencia;
        $this->horaInicio = $horaInicio;
        $this->horaFin = $horaFin;
		$this->tipo = $tipo;
		$this->numMaxParticipantes = $numMaxParticipantes;

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
        if($this->frecuencia <> '')
        {
            $toret = "frecuencia";
        }
        if($this->horaInicio <> '')
        {
            $toret = "horaInicio";
        }
        if($this->horaFin <> '')
        {
            $toret = "horaFin";
        }
		if($this->tipo <> '')
		{
			$toret = "tipo";
		}
		if($this->numMaxParticipantes <> '')
        {
            $toret = "numMaxParticipantes";
        }

		return $toret;
	}

	// insert new activity
	function insert()
    {
        include '../languages/spanish.php';

		// checking form's data

        if ($this->nombre <> '' )
        {
            $sql = "SELECT * FROM actividades WHERE nombre = '".$this->nombre."'";

            // checking DB connection
            if (!$result = $this->mysqli->query($sql))
            {
                $toret = $strings['ConnectionDBError'];

            }else {

                // checking that the activity doesn't exist
                if ($result->num_rows == 0)
                {

                    $sql = "INSERT INTO actividades (nombre,descripcion,frecuencia,horaInicio,horaFin,tipo,numMaxParticipantes,borrado)
							VALUES('" . $this->nombre . "','" . $this->descripcion . "','" . $this->frecuencia . "','" . $this->horaInicio . "',
							'" . $this->horaFin . "','"  . $this->tipo . "'," . $this->numMaxParticipantes . ",0)";

                    // inserting new activity
                    if ($result = $this->mysqli->query($sql))
                    {
                        $toret = $strings['InsertSuccess'];
                    }else {
                        $toret = $strings['InsertError'];
                    }

                }else {

                    // seeing if the activity had been created before
                    $sql = "SELECT * FROM actividades WHERE nombre = '".$this->nombre."' AND borrado='1'";
                    $result = $this->mysqli->query($sql);

                    if ($result->num_rows == 1)
                    {
                        $sql = "UPDATE actividades SET borrado ='0' WHERE nombre = '" . $this->nombre ."'";
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

	// delete activity
	function delete(){

        include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{
	        $sql = "SELECT * FROM actividades WHERE id = '".$this->id."'";

	        // checking DB connection
	        if (!$result = $this->mysqli->query($sql))
	        {
				$toret = $strings['ConnectionDBError'];
			}else {
		
				// checking that the activity exists
				if ($result->num_rows == 1)
				{

					$sql = "UPDATE actividades SET borrado ='1' WHERE id = '" . $this->id ."'";

					$this->mysqli->query($sql);

					// deleting activity
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

	// modify activity
	function modify()
    {

		include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{

	        $sql = "SELECT * FROM actividades WHERE id = '".$this->id."'";

	        // checking DB connection
			if (!$result = $this->mysqli->query($sql))
			{
				$toret = $strings['ConnectionDBError'];
			}else {
				
				// checking that the activity exists
				if ($result->num_rows == 1)
				{
					$modify = false;
					$lastModify = $this->lastModify(); 
					$sql = "UPDATE actividades SET ";

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

                    if($this->frecuencia <> '')
                    {
                        $sql = $sql . "frecuencia ='" . $this->frecuencia . "'";
                        if($lastModify <> "frecuencia")
                        {
                            $sql = $sql . ",";
                        }
                        $sql = $sql . " ";
                        $modify = true;
                    }

                    if($this->horaInicio <> '')
                    {
                        $sql = $sql . "horaInicio ='" . $this->horaInicio . "'";
                        if($lastModify <> "horaInicio")
                        {
                            $sql = $sql . ",";
                        }
                        $sql = $sql . " ";
                        $modify = true;
                    }

                    if($this->horaFin <> '')
                    {
                        $sql = $sql . "horaFin ='" . $this->horaFin . "'";
                        if($lastModify <> "horaFin")
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

                    if($this->numMaxParticipantes <> '')
                    {
                        $sql = $sql . "numMaxParticipantes ='" . $this->numMaxParticipantes . "'";
                        if($lastModify <> "numMaxParticipantes")
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

						// updating activity
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

	// consulting activity
	function consult()
    {

        include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{

	        $sql = "SELECT * FROM actividades WHERE id = '".$this->id."'";

	        // checking DB connection
			if (!$result = $this->mysqli->query($sql))
			{
				$toret = $strings['ConnectionDBError'];
			}else {
				
				// checking that the activity exists
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

	// listing all activitys
	function toList()
    {

		include '../languages/spanish.php';

        $sql = "SELECT * FROM actividades WHERE borrado = '0' ORDER BY nombre";

        // checking DB connection
		if (!$result = $this->mysqli->query($sql))
		{
			$toret = $strings['connectionDBError'];
		}else {
			
			// checking that at least one activity exists
			if ($result->num_rows != 0)
			{

				$toret=[];
				$i=0;

				// introducing all activitys into an array
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

	// search activitys
    function search($word)
    {

        include '../languages/spanish.php';

        $sql = "SELECT * FROM actividades WHERE borrado = '0' AND nombre LIKE '%".$word."%'";

        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            // checking that at least one activity exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all activitys into an array
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
            case 1: $sql = "SELECT * FROM actividades WHERE borrado = '0' ORDER BY nombre";
                break;
            case 2: $sql = "SELECT * FROM actividades WHERE borrado = '0' ORDER BY nombre DESC";
                break;
            case 3: $sql = "SELECT * FROM actividades WHERE borrado = '0' ORDER BY tipo";
                break;
        }

        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            // checking that at least one activity exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all activitys into an array
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