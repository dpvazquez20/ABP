<?php

include '../functions/connectDB.php';

class ActivityModel
{
	function __construct($id,$nombre,$descripcion,$frecuencia,$resource,$act_coach,$horaInicio,$horaFin,$fechaInicio,$fechaFin,$tipo,$numMaxParticipantes)
    {
		$this->id = $id;
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
		$this->resource = $resource;
        $this->act_coach = $act_coach;
        $this->frecuencia = $frecuencia;
        $this->horaInicio = $horaInicio;
        $this->horaFin = $horaFin;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
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
		if($this->resource <> '')
		{
			$toret = "resource";
		}
        if($this->act_coach <> '')
        {
            $toret = "act_coach";
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
        if($this->fechaInicio <> '')
        {
            $toret = "fechaInicio";
        }
        if($this->fechaFin <> '')
        {
            $toret = "fechaFin";
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

                    $sql = "SELECT aforo FROM recursos WHERE id ='". $this->resource ."'";
                    $result = $this->mysqli->query($sql);
                    $resourceLimit = $result->fetch_assoc();

                    // checking that max number of participants is lower than resource's gauging ("aforo")
                    if($this->numMaxParticipantes <= $resourceLimit["aforo"]){

                    $fechaInicio = new DateTime($this->fechaInicio);
                    $fechaFin = new DateTime($this->fechaFin);

                    $correctDay = $this->checkDayName($fechaInicio,$fechaFin);
                    if($correctDay <> ''){
                        //comprobar que no hay alguna reserva ese dia a esa hora en ese recurso

                        $sql = "INSERT INTO actividades (nombre,descripcion,frecuencia,horaInicio,horaFin,tipo,numMaxParticipantes,borrado,coach_id,fechaInicio,fechaFin)
							VALUES('" . $this->nombre . "','" . $this->descripcion . "','" . $this->frecuencia . "','" . $this->horaInicio . "',
							'" . $this->horaFin . "','"  . $this->tipo . "'," . $this->numMaxParticipantes . ",0,'"  . $this->act_coach . "','"  . $this->fechaInicio . "','"  . $this->fechaFin . "')";

                        // inserting new activity
                        if ($result = $this->mysqli->query($sql))
                        {
                            $toret = $strings['InsertSuccess'];
                        }else {
                            $toret = $strings['InsertError'];
                        }

                        $exit=false;
                        while (($correctDay < $fechaFin) && !$exit) {
                            if ($this->checkResource($correctDay)) {
                                $sql = "SELECT * FROM actividades WHERE id = (SELECT MAX(id) FROM actividades)";
                                $result = $this->mysqli->query($sql);
                                $lastid = $result->fetch_assoc();
                                $date = $correctDay->format('Y-m-d');

                                $sql = "SELECT * FROM reservas WHERE fecha = '" . $date . "' AND recurso_id = '". $this->resource ."' AND borrado ='0' AND actividades_id IN (
                                            SELECT id FROM actividades WHERE (horaInicio >= '" . $this->horaInicio . "' AND horaInicio <= '" . $this->horaFin . "') OR 
                                                                             (horaInicio <= '" . $this->horaInicio . "' AND horaFin >= '" . $this->horaInicio . "'))";
                                $result = $this->mysqli->query($sql);

                                if ($result->num_rows != 0)
                                {

                                    $sql = "DELETE FROM actividades WHERE id = '" . $lastid["id"] . "'";
                                    $this->mysqli->query($sql);
                                    $sql = "DELETE FROM RESERVAS WHERE actividades_id = '" . $lastid["id"] . "'";
                                    $this->mysqli->query($sql);

                                    $exit = true;
                                    $toret = $strings['ErrorReservationTime'];

                                }else {

                                    $sql = "INSERT INTO reservas (fecha,borrado,actividades_id,recurso_id) VALUES ('" . $date . "', 0,'" . $lastid["id"] . "','" . $this->resource . "')";
                                    if ($result = $this->mysqli->query($sql))
                                    {
                                        $toret = $strings['InsertSuccess'];
                                    }else {
                                        $toret = $strings['InsertError'];
                                    }

                                    $correctDay->add(new DateInterval('P7D'));
                                }

                            } else {
                                $exit = true;
                                $toret = $strings['ErrorResourceNotReady'];
                            }
                        }

                    }else{
                        $toret = $strings['ErrorIncorrectDay'];
                    }

                    } else {
                        $toret = $strings['ErrorMaxPart'];
                    }

                }else {
                    /*
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
                    */
                }
            }
        }else {
            $toret = $strings['InsertErrorForm'];
        }

		return $toret;
	}

	function dayTraductor($day){
        include '../languages/spanish.php';

	    Switch($day){
	        case $strings['monday']:
	            return "Monday";
            case $strings['tuesday']:
                return "Tuesday";
            case $strings['wednesday']:
                return "Wednesday";
            case $strings['thursday']:
                return "Thursday";
            default:
                return "Friday";
        }

    }

    function checkDayName($fechaInicio,$fechaFin){
        while($fechaInicio < $fechaFin){

            $strFI = date_format($fechaInicio,"l");

            if($strFI == $this->dayTraductor($this->frecuencia)){
                return $fechaInicio;
            }else{
                $fechaInicio->add(new DateInterval('P1D'));
            }
        }
        return '';

    }

    function checkResource($correctDay){
        include '../languages/spanish.php';

            $sql = "SELECT * FROM reservas WHERE fecha = '".$correctDay->format('Y-m-d')."' AND recurso_id = '".$this->resource."' AND borrado ='0'";

            // checking DB connection
            if (!$result = $this->mysqli->query($sql))
            {
                $toret = $strings['ConnectionDBError'];
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
                    $toret = true;
                }
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

                    $sql = "UPDATE reservas SET borrado ='1' WHERE actividades_id = '" . $this->id ."'";

                    $this->mysqli->query($sql);

                    // deleting reservation
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

    //Get actual activity resource
    function getActualResource($id){
        include '../languages/spanish.php';

        $sql = "SELECT * FROM recursos WHERE borrado = '0' AND id IN (SELECT recurso_id FROM reservas WHERE actividades_id=". $id ." AND borrado='0')";

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

    //Get actual activity coach
    function getActualCoach($id){
        include '../languages/spanish.php';

        $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND id = (SELECT coach_id FROM actividades WHERE id=". $id .")";

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