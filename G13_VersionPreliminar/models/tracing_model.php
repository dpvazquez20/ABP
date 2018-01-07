<?php

include '../functions/connectDB.php';

class TracingModel
{
	function __construct($id)
    {
		$this->id = $id;
		$this->mysqli = connect();
	}

	function __destruct()
    {

	}

	function headCoach($sessionId)
	{
		include '../languages/spanish.php';

			//die("id: ". $this->id);
            $sql = "SELECT * FROM sesiones WHERE id = '" . $sessionId . "'";

            if (!$result = $this->mysqli->query($sql))
			{
                $toret = $strings['ConnectionDBError'];
	        }else {
	          	if ($result->num_rows == 0)
	           	{
					//$this->createSession();
					//$result = $this->mysqli->query($sql);
				}
				$row = $result->fetch_array();
				$tableId = $row['tablas_id'];

				$sql="
				SELECT tablas.id,tablas.nombre AS nombreTabla,
						sesiones.completado,sesiones.comentario,sesiones.id AS sesionId,
						usuarios.nombre,usuarios.apellidos,usuarios.id AS userId,usuarios.dni,usuarios.imagen
                FROM tablas
                INNER JOIN sesiones
                ON tablas.id = sesiones.tablas_id AND tablas.id = $tableId AND sesiones.id = $sessionId
                	INNER JOIN usuarios
                	ON usuarios.id = sesiones.usuarios_id
                ";

                //die("die: $sql");

				if (!$result2 = $this->mysqli->query($sql))
				{
					$toret = $strings['ConnectionDBError'];
				}else {
					$toret=[];
					$row = $result2->fetch_array();
					$toret[0] = $row;
				}

			}

		return $toret;
	}

	function headSportsman()
	{
		include '../languages/spanish.php';

        if ($this->id <> '' )
        {

            $sql = "SELECT * FROM sesiones WHERE usuarios_id = '" . $this->id . "' AND completado = '0'";

            if (!$result = $this->mysqli->query($sql))
			{
                $toret = $strings['ConnectionDBError'];
	        }else {
	          	if ($result->num_rows == 0)
	           	{
					$this->createSession();
					$result = $this->mysqli->query($sql);
				}
				$row = $result->fetch_array();
				$tableId = $row['tablas_id'];

				$sql="
				SELECT tablas.id,tablas.nombre,
						sesiones.completado,sesiones.id AS sesionId,sesiones.inicio,sesiones.comentario
                FROM tablas
                INNER JOIN sesiones
                ON tablas.id = sesiones.tablas_id AND tablas.id = $tableId AND sesiones.completado = '0' AND sesiones.usuarios_id = $this->id
                ";

				
				if (!$result2 = $this->mysqli->query($sql))
				{
					$toret = $strings['ConnectionDBError'];
				}else {
					$toret=[];
				$row = $result2->fetch_array();
				$toret[0] = $row;
				}
				

			}
        }else {
            $toret = $strings['FollowErrorForm']; // ----------------------------- strings
        }

		return $toret;
	}

	function headSportsmanIdPrevious($sesionId)
	{
		include '../languages/spanish.php';

        if ($this->id <> '' )
        {

            $sql = "SELECT anterior_id FROM sesiones WHERE usuarios_id = '" . $this->id . "' AND id = '" . $sesionId . "'";

            if (!$result = $this->mysqli->query($sql))
			{
                $toret = $strings['ConnectionDBError'];
	        }else {
	        	if ($result->num_rows > 0)
	           	{
	           		$row = $result->fetch_array();
					$newSessionId = $row['anterior_id'];
					if($newSessionId == '')
					{
						$newSessionId = $sesionId;
					}

		        	$sql = "SELECT tablas_id FROM sesiones WHERE usuarios_id = '" . $this->id . "' AND id = '" . $newSessionId . "'";
		        	$result = $this->mysqli->query($sql);
					$row = $result->fetch_array();
					$tableId = $row['tablas_id'];

					$sql="
					SELECT tablas.id,tablas.nombre,
							sesiones.completado,sesiones.id AS sesionId,sesiones.inicio,sesiones.comentario
	                FROM tablas
	                INNER JOIN sesiones
	                ON tablas.id = sesiones.tablas_id AND tablas.id = $tableId AND sesiones.id = $newSessionId
	                ";
	                //die("die sql: $sql");
					$result2 = $this->mysqli->query($sql);
					
					$toret=[];
					$row = $result2->fetch_array();
					$toret[0] = $row;
	           	}else{
	           		$toret = 'null';
	           	}
	        }
        }else {
            $toret = $strings['FollowErrorForm']; // ----------------------------- strings
        }

		return $toret;
	}

	function headSportsmanIdNext($sesionId)
	{
		include '../languages/spanish.php';

        if ($this->id <> '' )
        {
            $sql = "SELECT id FROM sesiones WHERE usuarios_id = '" . $this->id . "' AND anterior_id = '" . $sesionId . "'";
            if (!$result = $this->mysqli->query($sql))
			{
                $toret = $strings['ConnectionDBError'];
	        }else {
	        	$newSessionId = '';
	        	if ($result->num_rows > 0)
	           	{
	           		$row = $result->fetch_array();
					$newSessionId = $row['id'];
				}
				if($newSessionId == '')
				{
					$newSessionId = $sesionId;
				}

	        	$sql = "SELECT tablas_id FROM sesiones WHERE usuarios_id = '" . $this->id . "' AND id = '" . $newSessionId . "'";
	        	$result = $this->mysqli->query($sql);
				$row = $result->fetch_array();
				$tableId = $row['tablas_id'];

				$sql="
				SELECT tablas.id,tablas.nombre,
						sesiones.completado,sesiones.id AS sesionId,sesiones.inicio,sesiones.comentario
                FROM tablas
                INNER JOIN sesiones
                ON tablas.id = sesiones.tablas_id AND tablas.id = $tableId AND sesiones.id = $newSessionId
                ";

				$result2 = $this->mysqli->query($sql);
				
				$toret=[];
				$row = $result2->fetch_array();
				$toret[0] = $row;
	        }
        }else {
            $toret = $strings['FollowErrorForm']; // ----------------------------- strings
        }

		return $toret;
	}

	function getIdLastSessionByNext($sesionId)
	{

		include '../languages/spanish.php';

		$sql = "SELECT id FROM sesiones WHERE usuarios_id = '" . $this->id . "' AND completado = '0' AND anterior_id = '" . $sesionId . "'";

        if (!$result = $this->mysqli->query($sql))
		{
            $toret = $strings['ConnectionDBError'];
	    }else {
	    	if ($result->num_rows == 0)
	        {
	        	$toret = true;
	        }else{
	        	$toret = false;
	        }
	    }

	    return $toret;
	}

	function follow()
    {
        include '../languages/spanish.php';
        //die("die: " . $this->id);
        if ($this->id <> '' )
        {
        	$sqlEntrenamiento = "SELECT * FROM entrenamientos_has_usuarios WHERE usuario_id = '" . $this->id . "'";
	        	
	        if ($resultEntrenamiento = $this->mysqli->query($sqlEntrenamiento))
			{
				if($resultEntrenamiento->num_rows > 0)
				{
		            $sql = "SELECT * FROM sesiones WHERE usuarios_id = '" . $this->id . "' AND completado = '0'";

		            if (!$result = $this->mysqli->query($sql))
					{
		                $toret = $strings['ConnectionDBError'];
			        }else {
			          	if ($result->num_rows == 0)
			           	{
							$this->createSession();
							$result = $this->mysqli->query($sql);
						}
						$row = $result->fetch_array();
						$tableId = $row['tablas_id'];
						$sesionId = $row['id'];

						$sql="
						SELECT lineasDeTabla.id,lineasDeTabla.repeticiones,lineasDeTabla.duracion,
								lineasDeTabla.series,lineasDeTabla.descanso,
								ejercicios.nombre,ejercicios.imagen,
								sesionDeLineaDeTabla.id AS lineaSesionesId,sesionDeLineaDeTabla.completado, sesiones.id AS sesionId
		                FROM lineasDeTabla
		                INNER JOIN ejercicios 
		                ON lineasDeTabla.ejercicio_id = ejercicios.id AND lineasDeTabla.tabla_id = $tableId
		                	INNER JOIN sesionDeLineaDeTabla
		                	ON sesionDeLineaDeTabla.lineasDeTabla_id = lineasDeTabla.id
		                		INNER JOIN sesiones
		                		ON sesiones.id = sesionDeLineaDeTabla.sesiones_id AND sesiones.id = $sesionId AND sesiones.usuarios_id = $this->id
		                ";

		                //die("die: $sql");
						$result2 = $this->mysqli->query($sql);
						
						$toret=[];
						$i=0;

						while ($row = $result2->fetch_array())
		                {
		                	//die("die: " . $row['sesionId']);
							$toret[$i] = $row;
							$i++;
						}
					}
				}else{
					$toret = $strings['NoTrainingError'];
				}
			}else{
				$toret = $strings['NoTrainingError'];
			}
        }else {
            $toret = $strings['FollowErrorForm']; // ----------------------------- strings
        }

		return $toret;
	}

	function followSession($sessionId)
    {
        include '../languages/spanish.php';


            $sql = "SELECT * FROM sesiones WHERE id = '" . $sessionId . "'";

            if (!$result = $this->mysqli->query($sql))
			{
                $toret = $strings['ConnectionDBError'];
	        }else {
	          	if ($result->num_rows == 0)
	           	{
					//$this->createSession();
					//$result = $this->mysqli->query($sql);
				}
				$row = $result->fetch_array();
				$tableId = $row['tablas_id'];
				$sesionId = $row['id'];

				$sql="
				SELECT lineasDeTabla.id,lineasDeTabla.repeticiones,lineasDeTabla.duracion,
						lineasDeTabla.series,lineasDeTabla.descanso,
						ejercicios.nombre,ejercicios.imagen,
						sesionDeLineaDeTabla.id AS lineaSesionesId,sesionDeLineaDeTabla.completado
                FROM lineasDeTabla
                INNER JOIN ejercicios 
                ON lineasDeTabla.ejercicio_id = ejercicios.id AND lineasDeTabla.tabla_id = $tableId
                	INNER JOIN sesionDeLineaDeTabla
                	ON sesionDeLineaDeTabla.lineasDeTabla_id = lineasDeTabla.id
                		INNER JOIN sesiones
                		ON sesiones.id = sesionDeLineaDeTabla.sesiones_id AND sesiones.id = $sessionId
                ";

                //die("die: $sql");
				$result2 = $this->mysqli->query($sql);
				
				$toret=[];
				$i=0;

				while ($row = $result2->fetch_array())
                {
					$toret[$i] = $row;
					$i++;
				}
			}

		return $toret;
	}

	function followId($sesionId)
    {
        include '../languages/spanish.php';

        if ($this->id <> '' )
        {

            $sql = "SELECT * FROM sesiones WHERE usuarios_id = '" . $this->id . "' AND id = $sesionId";

            if (!$result = $this->mysqli->query($sql))
			{
                $toret = $strings['ConnectionDBError'];
	        }else {

				$row = $result->fetch_array();
				$tableId = $row['tablas_id'];
				$sesionId = $row['id'];

				$sql="
				SELECT lineasDeTabla.id,lineasDeTabla.repeticiones,lineasDeTabla.duracion,
						lineasDeTabla.series,lineasDeTabla.descanso,
						ejercicios.nombre,ejercicios.imagen,
						sesionDeLineaDeTabla.id AS lineaSesionesId,sesionDeLineaDeTabla.completado,sesionDeLineaDeTabla.comentario
                FROM lineasDeTabla
                INNER JOIN ejercicios 
                ON lineasDeTabla.ejercicio_id = ejercicios.id AND lineasDeTabla.tabla_id = $tableId
                	INNER JOIN sesionDeLineaDeTabla
                	ON sesionDeLineaDeTabla.lineasDeTabla_id = lineasDeTabla.id
                		INNER JOIN sesiones
                		ON sesiones.id = sesionDeLineaDeTabla.sesiones_id AND sesiones.id = $sesionId
                ";

				$result2 = $this->mysqli->query($sql);
				
				$toret=[];
				$i=0;

				while ($row = $result2->fetch_array())
                {
					$toret[$i] = $row;
					$i++;
				}
			}
        }else {
            $toret = $strings['FollowErrorForm']; // ----------------------------- strings
        }

		return $toret;
	}

	function followPrevious($sesionId)
    {
        include '../languages/spanish.php';

        if ($this->id <> '' )
        {

            $sql = "SELECT anterior_id FROM sesiones WHERE usuarios_id = '" . $this->id . "' AND id = '" . $sesionId . "'";

            if (!$result = $this->mysqli->query($sql))
			{
                //$toret = $strings['ConnectionDBError'];
                $newSessionId = $sesionId;
	        }else {
	        	$row = $result->fetch_array();
	        	$newSessionId = $row['anterior_id'];
	        	if($newSessionId == '')
	        	{
	        		$newSessionId = $sesionId;
	        	}
	        }

        	$sql = "SELECT * FROM sesiones WHERE usuarios_id = '" . $this->id . "' AND id = '" . $newSessionId . "'";
	        $result = $this->mysqli->query($sql);
	        $row = $result->fetch_array();

			$tableId = $row['tablas_id'];
			$sesionId = $newSessionId;

			$sql="
			SELECT lineasDeTabla.id,lineasDeTabla.repeticiones,lineasDeTabla.duracion,
					lineasDeTabla.series,lineasDeTabla.descanso,
					ejercicios.nombre,ejercicios.imagen,
					sesionDeLineaDeTabla.id AS lineaSesionesId,sesionDeLineaDeTabla.completado
            FROM lineasDeTabla
            INNER JOIN ejercicios 
            ON lineasDeTabla.ejercicio_id = ejercicios.id AND lineasDeTabla.tabla_id = $tableId
            	INNER JOIN sesionDeLineaDeTabla
            	ON sesionDeLineaDeTabla.lineasDeTabla_id = lineasDeTabla.id
            		INNER JOIN sesiones
            		ON sesiones.id = sesionDeLineaDeTabla.sesiones_id AND sesiones.id = $sesionId
            ";
            //die("die sql: $sql");
			if($result2 = $this->mysqli->query($sql))
			{
				$toret=[];
				$i=0;
				$result2 = $this->mysqli->query($sql);
				while ($row = $result2->fetch_array())
                {
					$toret[$i] = $row;
					$i++;
				}
			}else{
				$toret = 'null';
			}
        }else {
            $toret = $strings['FollowErrorForm']; // ----------------------------- strings
        }
		return $toret;
	}

	function followNext($sesionId)
    {
        include '../languages/spanish.php';

        if ($this->id <> '' )
        {
        	//die("sesionId: " . $sesionId . "<br>newSessionId: " . );
            $sql = "SELECT id FROM sesiones WHERE usuarios_id = '" . $this->id . "' AND anterior_id = '" . $sesionId . "'";

            if (!$result = $this->mysqli->query($sql))
			{
                //$toret = $strings['ConnectionDBError'];
                $newSessionId = $sesionId;
                //echo "<br>Error bd";
	        }else {
	        	$row = $result->fetch_array();
	        	$newSessionId = $row['id'];
	        	//echo "<br>else";
	        	if($newSessionId == '')
	        	{
	        		$newSessionId = $sesionId;
	        		//echo "<br>if ''";
	        	}
	        }

	        //die("sesionId: " . $sesionId . "<br>newSessionId: " . $newSessionId);
	        //echo "<br>sesionId: " . $sesionId . "<br>newSessionId: " . $newSessionId;

        	$sql = "SELECT * FROM sesiones WHERE usuarios_id = '" . $this->id . "' AND id = '" . $newSessionId . "'";
	        $result = $this->mysqli->query($sql);
	        $row = $result->fetch_array();

			$tableId = $row['tablas_id'];
			$sesionId = $newSessionId;
			//echo "<br>nextId: $sesionId <br>newSessionId: " . $newSessionId . "<br>";
			//die("<br>nextId: $sesionId <br>newSessionId: " . $newSessionId);

			$sql="
			SELECT lineasDeTabla.id,lineasDeTabla.repeticiones,lineasDeTabla.duracion,
					lineasDeTabla.series,lineasDeTabla.descanso,
					ejercicios.nombre,ejercicios.imagen,
					sesionDeLineaDeTabla.id AS lineaSesionesId,sesionDeLineaDeTabla.completado
            FROM lineasDeTabla
            INNER JOIN ejercicios 
            ON lineasDeTabla.ejercicio_id = ejercicios.id AND lineasDeTabla.tabla_id = $tableId
            	INNER JOIN sesionDeLineaDeTabla
            	ON sesionDeLineaDeTabla.lineasDeTabla_id = lineasDeTabla.id
            		INNER JOIN sesiones
            		ON sesiones.id = sesionDeLineaDeTabla.sesiones_id AND sesiones.id = $sesionId
            ";
            //die($sql);
			if($result2 = $this->mysqli->query($sql))
			{
				$toret=[];
				$i=0;
				while ($row = $result2->fetch_array())
                {
					$toret[$i] = $row;
					$i++;
				}
			}else{
				$toret = 'null';
			}
        }else {
            $toret = $strings['FollowErrorForm']; // ----------------------------- strings
        }
        //echo "<br>FINAL<br>nextId: $sesionId <br>newSessionId: " . $newSessionId . "<br>";
        //die("die");
		return $toret;
	}

	function getPreviousId(){

		//$sql = "SELECT id FROM sesiones WHERE usuarios_id = '" . $this->id . "' AND anterior_id IS NOT NULL ORDER BY id DESC LIMIT 1";
		$sql = "SELECT id FROM sesiones WHERE usuarios_id = '" . $this->id . "' ORDER BY id DESC LIMIT 1";

		if (!$result = $this->mysqli->query($sql))
		{

        }else {

			if ($result->num_rows == 0)
		    {
		    	$toret = 'null';
		    }else{
		    	$row = $result->fetch_array();
		    	$toret = $row['id'];
		    }
		}

		return $toret;
	}

	function createSession()
	{
		include '../languages/spanish.php';

        if ($this->id <> '' )
        {

        	$sql = "SELECT * FROM sesiones WHERE usuarios_id = '" . $this->id . "' AND completado = '0'";

            if (!$result = $this->mysqli->query($sql))
			{
                $toret = $strings['ConnectionDBError'];
	        }else {

	        	$sqlEntrenamiento = "SELECT * FROM entrenamientos_has_usuarios WHERE usuario_id = '" . $this->id . "'";
	        	
	        	if ($resultEntrenamiento = $this->mysqli->query($sqlEntrenamiento))
				{
					if($resultEntrenamiento->num_rows > 0)
					{
			          	if ($result->num_rows == 0)
			           	{
			                $sql="
							SELECT tablas.id as tablas_id,
									entrenamientos.sesiones as orden_sesion_max,entrenamientos.id as entrenamientos_id,
									entrenamientos_has_tablas.orden_sesion
			                FROM entrenamientos_has_usuarios
			                INNER JOIN entrenamientos
			                ON entrenamientos_has_usuarios.entrenamiento_id = entrenamientos.id AND entrenamientos_has_usuarios.usuario_id = $this->id
			                	INNER JOIN entrenamientos_has_tablas
			                	ON entrenamientos.id = entrenamientos_has_tablas.entrenamiento_id 
				                	INNER JOIN tablas
				                	ON entrenamientos_has_tablas.tabla_id = tablas.id
			                ";
			                
			                $resultToSession = $this->mysqli->query($sql);

			                /*$insert = "INSERT INTO sesiones
								(completado,tablas_id,orden_sesion,orden_sesion_max,usuarios_id,entrenamientos_id,anterior_id)
								VALUES";*/

							$primero = true;
							$usuarios_id = $this->id;
							//$anterior_id = $this->getPreviousId();

							while ($row = $resultToSession->fetch_array())
			                {
			                	//$hoy = new DateTime();
			                	//$fecha = $hoy->format('Y-d-m H:i:s');
			                	$fecha = date('Y-m-d H:i:s');
			                	//$fecha = date('Y:m:d H:i:s');
			                	$tablas_id = $row['tablas_id'];
			                	$orden_sesion = $row['orden_sesion'];
			                	$orden_sesion_max = $row['orden_sesion_max'];
			                	$entrenamientos_id = $row['entrenamientos_id'];
			                	$anterior_id = $this->getPreviousId();

			                	/*if(!$primero){
									$insert = $insert . ",";
								}*/

								$insert = "
								INSERT INTO sesiones (completado,fecha,tablas_id,orden_sesion,orden_sesion_max,usuarios_id,entrenamientos_id,anterior_id)
								VALUES('0','$fecha',$tablas_id,$orden_sesion,$orden_sesion_max,$usuarios_id,$entrenamientos_id,$anterior_id)
								";
								//die("die insert: $insert");
								$result = $this->mysqli->query($insert);
								$primero = false;
								
							}

							$insert = $insert . ";";

				            $sql2 ="
							SELECT id as sesiones_id,tablas_id
							FROM sesiones
							WHERE completado = '0' AND usuarios_id = $this->id
			                ";

		                    $resultSessionId = $this->mysqli->query($sql2);

		                    $insert = "INSERT INTO sesiondelineadetabla
							(completado,sesiones_id,lineasDeTabla_id)
							VALUES ";
							$primero = true;

		                    while ($row1 = $resultSessionId->fetch_array())
				            {
				            	$tablas_id = $row1['tablas_id'];
				            	$sesiones_id = $row1['sesiones_id'];

				            	$sql3 ="
								SELECT lineasDeTabla.id as lineasDeTabla_id
				                FROM entrenamientos_has_usuarios
				                INNER JOIN entrenamientos
				                ON entrenamientos_has_usuarios.entrenamiento_id = entrenamientos.id AND entrenamientos_has_usuarios.usuario_id = $this->id
				                	INNER JOIN entrenamientos_has_tablas
				                	ON entrenamientos.id = entrenamientos_has_tablas.entrenamiento_id 
					                	INNER JOIN tablas
					                	ON entrenamientos_has_tablas.tabla_id = tablas.id
					                		INNER JOIN lineasDeTabla
					                		ON lineasDeTabla.tabla_id = tablas.id AND lineasDeTabla.tabla_id = $tablas_id
				                ";

		                        $resultTableLineId = $this->mysqli->query($sql3);

		                        while ($row2 = $resultTableLineId->fetch_array())
				            	{
				            		$lineasDeTabla_id = $row2['lineasDeTabla_id'];
				            		if(!$primero){
										$insert = $insert . ",";
									}
			                        $insert = $insert . "('0',$sesiones_id,$lineasDeTabla_id)";
			                        $primero = false;
					            }
				            }

				            $insert = $insert . ";";

							if ($result = $this->mysqli->query($insert))
		                    {
		                        $toret = $strings['InsertSuccess'];
		                    }else {
		                        $toret = $strings['InsertError'];
		                    }
						}else{
							$toret = $strings['Idontknowwhyyoucallme'];  // ----------------------------- strings
						}
					}else{
						$toret = $strings['NoTrainingError'];
					}
				}else{
					$toret = $strings['NoTrainingError'];
				}
			}
        }else {
            $toret = $strings['CreateSessionErrorForm']; // ----------------------------- strings
        }

		return $toret;
	}

	function changeComplete($lineaSesionesId)
	{
		include '../languages/spanish.php';

        $sql = "SELECT completado FROM sesionDeLineaDeTabla WHERE id = '" . $lineaSesionesId . "'";

        if (!$result = $this->mysqli->query($sql))
		{
            $toret = $strings['ConnectionDBError'];
        }else {

        	$row = $result->fetch_array();
        	$complete = $row['completado'];

        	if($complete == 0){
        		//$sql = "UPDATE usuarios SET login ='" . $this->login . "' WHERE id ='" . $this->id . "'";
        		$sql = "UPDATE sesionDeLineaDeTabla SET completado ='1' WHERE id ='" . $lineaSesionesId . "'";
        	}else{
        		$sql = "UPDATE sesionDeLineaDeTabla SET completado ='0' WHERE id ='" . $lineaSesionesId . "'";
        	}

        	if ($result = $this->mysqli->query($sql))
			{
				$toret = $strings['UpdateSuccess'];
			}else {
				$toret = $strings['UpdateError'];
			}

		}
	}

	function completeTable($sesionId)
	{
		include '../languages/spanish.php';

		$fin = date('Y-m-d H:i:s');

        $sql = "UPDATE sesiones SET completado = '1', fin = '$fin' WHERE id ='" . $sesionId . "'";

        if ($result = $this->mysqli->query($sql))
		{
			$toret = $strings['UpdateSuccess'];
		}else {
			$toret = $strings['UpdateError'];
		}
	}

	// listing all users
	function toListSportsmans()
    {

		include '../languages/spanish.php';

        $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND tipo = 'deportista' ORDER BY nombre";

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
    function searchSportsman($word)
    {

        include '../languages/spanish.php';

        $sql = "SELECT * FROM usuarios WHERE tipo = 'Deportista' AND borrado = '0' AND ( nombre LIKE '%".$word."%' OR apellidos LIKE '%".$word."%')";

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
    function orderSportsman($value)
    {

        include '../languages/spanish.php';
        $sql = '';

        // sql query depends on the value of the order by
        Switch ($value)
        {
            case 1: $sql = "SELECT * FROM usuarios WHERE tipo = 'Deportista' AND borrado = '0' ORDER BY nombre";
                break;
            case 2: $sql = "SELECT * FROM usuarios WHERE tipo = 'Deportista' AND borrado = '0' ORDER BY nombre DESC";
                break;
            case 3: $sql = "SELECT * FROM usuarios WHERE tipo = 'Deportista' AND borrado = '0' ORDER BY apellidos";
                break;
            case 4: $sql = "SELECT * FROM usuarios WHERE tipo = 'Deportista' AND borrado = '0' ORDER BY apellidos DESC";
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

    function startTime($actualId){
    	include '../languages/spanish.php';

    	$inicio = date('Y-m-d H:i:s');

        $sql = "UPDATE sesiones SET inicio ='$inicio' WHERE id ='" . $actualId . "'";

        if ($result = $this->mysqli->query($sql))
		{
			$toret = $strings['UpdateSuccess'];
		}else {
			$toret = $strings['UpdateError'];
		}
    }

    function comment($actualId,$comment){
    	include '../languages/spanish.php';

        $sql = "UPDATE sesiones SET comentario = '$comment' WHERE id ='" . $actualId . "'";

        if ($result = $this->mysqli->query($sql))
		{
			$toret = $strings['UpdateSuccess'];
		}else {
			$toret = $strings['UpdateError'];
		}
    }

    function headList()
	{
		include '../languages/spanish.php';

        if ($this->id <> '' )
        {
			//die("id: ". $this->id);
            $sql = "SELECT * FROM sesiones WHERE usuarios_id = '" . $this->id . "'";

            if (!$result = $this->mysqli->query($sql))
			{
                $toret = $strings['ConnectionDBError'];
	        }else {
	          	if ($result->num_rows == 0)
	           	{
					//$this->createSession();
					//$result = $this->mysqli->query($sql);
				}
				$row = $result->fetch_array();
				$tableId = $row['tablas_id'];

				$sql="
				SELECT tablas.id,tablas.nombre AS nombreTabla,
						sesiones.completado,
						usuarios.nombre,usuarios.apellidos,sesiones.id,usuarios.dni,usuarios.imagen AS sesionId
                FROM tablas
                INNER JOIN sesiones
                ON tablas.id = sesiones.tablas_id AND tablas.id = $tableId AND sesiones.completado = '0'
                	INNER JOIN usuarios
                	ON usuarios.id = sesiones.usuarios_id AND usuarios.id = $this->id
                ";

				if (!$result2 = $this->mysqli->query($sql))
				{
					$toret = $strings['ConnectionDBError'];
				}else {
					$toret=[];
					$row = $result2->fetch_array();
					$toret[0] = $row;
				}

			}
        }else {
            $toret = $strings['FollowErrorForm']; // ----------------------------- strings
        }

		return $toret;
	}

    function getSessions($id){

    	include '../languages/spanish.php';

    	$sqlEntrenamiento = "SELECT * FROM entrenamientos_has_usuarios WHERE usuario_id = '" . $this->id . "'";
	        	
        if ($resultEntrenamiento = $this->mysqli->query($sqlEntrenamiento))
		{
			if($resultEntrenamiento->num_rows > 0)
			{
				$sql = "SELECT id,fecha,inicio,fin,completado FROM sesiones WHERE usuarios_id = '$id' ORDER BY fecha,inicio";

		        // checking DB connection
		        if (!$result = $this->mysqli->query($sql))
		        {
		            $toret = $strings['connectionDBError'];
		        }else {

		            // checking that at least one user exists
		            if ($result->num_rows > 0)
		            {
		                $toret=[];
		                $i=0;

		                // introducing all users into an array
		                while ($row = $result->fetch_array())
		                {
		                	if($row == null || $row == 'null')
		                	{
		                		$toret[$i] = '';
		                	}else{
		                		$toret[$i] = $row;
		                	}
		                    $i++;
		                }

		            }else {
		                $toret = $strings['TracingErrorNotStarted'];
		            }
		        }
		    }else{
				$toret = $strings['NoTrainingError'];
			}
		}else{
			$toret = $strings['NoTrainingError'];
		}

        return $toret;
    }


}

?>