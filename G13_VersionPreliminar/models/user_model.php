<?php

include '../functions/connectDB.php';

class UserModel
{
	function __construct($id, $login, $contrasenha, $nombre, $apellidos, $dni, $email, $tipo, $tipoOri, $clase, $entrenador_id, $imagen)
    {
		$this->id = $id;
		$this->login = $login;
		$this->contrasenha = $contrasenha;
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->dni = $dni;
		$this->email = $email;
		$this->tipo = $tipo;
		$this->tipoOri = $tipoOri;
		$this->clase = $clase;
		$this->entrenador_id = $entrenador_id;
        $this->imagen = $imagen;

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
		if($this->login <> '')
		{
			$toret = "login";
		}
		if($this->contrasenha <> '')
		{
			$toret = "contrasenha";
		}
		if($this->nombre <> '')
		{
			$toret = "nombre";
		}
		if($this->apellidos <> '')
		{
			$toret = "apellidos";
		}
		if($this->dni <> '')
		{
			$toret = "dni";
		}
		if($this->email <> '')
		{
			$toret = "email";
		}
		if($this->tipo <> '')
		{
			//$toret = "tipo";
			$toret = "clase";
		}
		if($this->clase <> '')
		{
			$toret = "clase";
		}
		if($this->entrenador_id <> '')
		{
			$toret = "entrenador_id";
		}
        if($this->imagen <> '')
        {
            $toret = "imagen";
        }

		return $toret;
	}

	// insert new user
	function insert()
    {
        include '../languages/spanish.php';

		// checking form's data

        if ($this->dni <> '' )
        {
            $sql = "SELECT * FROM usuarios WHERE dni = '$this->dni' OR email = '$this->email' OR login = '$this->login'";

            // checking DB connection
            if (!$result = $this->mysqli->query($sql))
            {
                $toret = $strings['ConnectionDBError'];

            }else {

                // checking that the user doesn't exist
                if ($result->num_rows == 0)
                {
                	$c = $strings['other'];

                	if($this->tipo == $strings['sportsman'])
                	{
                		if($this->clase == $strings['pef'])
                		{
                			$c = $strings['pef'];
                		}else{
                			$c = $strings['tdu'];
                		}
                	}

                	$i = $this->imagen;

                	if($i == '')
                	{
                		$i = "default.png";
                	}

                	if($c <> 'PEF' || $this->tipo <> 'Deportista' || !isset($this->entrenador_id)){
                		$sql = "INSERT INTO usuarios (login,contrasenha,nombre,apellidos,dni,email,tipo,clase,borrado,imagen) 
							VALUES('" . $this->login . "','" . $this->contrasenha . "','" . $this->nombre . "','" . $this->apellidos . "','" . $this->dni . "','" . $this->email . "','"  . $this->tipo . "','"  . $c . "','0','"  . $i . "')";
                	}else{

                		$coachName = $this->getCoachName($this->entrenador_id);

                		$sql = "INSERT INTO usuarios (login,contrasenha,nombre,apellidos,dni,email,tipo,clase,entrenador_id,entrenador_nombre,borrado,imagen) 
							VALUES('" . $this->login . "','" . $this->contrasenha . "','" . $this->nombre . "','" . $this->apellidos . "','" . $this->dni . "','" . $this->email . "','"  . $this->tipo . "','"  . $c . "','" . $this->entrenador_id . "','" . $coachName . "','0','"  . $i . "')";
                	}

                    

					//die("die: $sql");
                    // inserting new user
                    if ($result = $this->mysqli->query($sql))
                    {
                        $toret = $strings['InsertSuccess'];
                    }else {
                        $toret = $strings['InsertError'];
                    }

                }else {

                    // seeing if the user had been created before
                    $sql = "SELECT * FROM usuarios WHERE dni = '".$this->dni."' AND borrado='1'";
                    $result = $this->mysqli->query($sql);

                    if ($result->num_rows == 1)
                    {
                        $sql = "UPDATE usuarios SET borrado ='0' WHERE dni = '" . $this->dni ."'";
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

	function getCoachName($coachId){
		$sql = "SELECT apellidos,nombre FROM usuarios WHERE id = '$this->entrenador_id'";

		if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else{
        	while ($row2 = $result->fetch_array())
            {
				$aux[0] = $row2;
			}
			$toret = $aux[0]['apellidos'] . ", " . $aux[0]['nombre'];
        }

        return $toret;
	}

	// delete user
	function delete(){

        include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{
	        $sql = "SELECT * FROM usuarios WHERE id = '$this->id'";

	        // checking DB connection
	        if (!$result = $this->mysqli->query($sql))
	        {
				$toret = $strings['ConnectionDBError'];
			}else {
		
				// checking that the user exists
				if ($result->num_rows == 1)
				{

					$sql = "UPDATE usuarios SET borrado ='1' WHERE id = '" . $this->id ."'";

					$this->mysqli->query($sql);

					// deleting user
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

	// modify user
	function modify()
    {

		include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{

	        $sql = "SELECT * FROM usuarios WHERE id = '".$this->id."'";

	        // checking DB connection
			if (!$result = $this->mysqli->query($sql))
			{
				$toret = $strings['ConnectionDBError'];
			}else {
				
				// checking that the user exists
				if ($result->num_rows == 1)
				{
					$modify = false;
					$lastModify = $this->lastModify(); 
					$sql = "UPDATE usuarios SET ";
					
					if($this->login <> '')
					{
						$sql = $sql . "login ='" . $this->login . "'";
						if($lastModify <> "login")
						{
							$sql = $sql . ",";
						}
						$sql = $sql . " ";
						$modify = true;
					}

					if($this->contrasenha <> '')
					{
						$sql = $sql . "contrasenha ='" . $this->contrasenha . "'";
						if($lastModify <> "contrasenha")
						{
							$sql = $sql . ",";
						}
						$sql = $sql . " ";
						$modify = true;
					}

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

					if($this->apellidos <> '')
					{
						$sql = $sql . "apellidos ='" . $this->apellidos . "'";
						if($lastModify <> "apellidos")
						{
							$sql = $sql . ",";
						}
						$sql = $sql . " ";
						$modify = true;
					}

					if($this->dni <> '')
					{
						$sql = $sql . "dni ='" . $this->dni . "'";
						if($lastModify <> "dni")
						{
							$sql = $sql . ",";
						}
						$sql = $sql . " ";
						$modify = true;
					}

					if($this->email <> '')
					{
						$sql = $sql . "email ='" . $this->email . "'";
						if($lastModify <> "email")
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
						if($this->tipo == $strings['sportsman'])
						{
							if($this->clase == $strings['pef']){
								$this->clase = $strings['pef'];
							}else{
								$this->clase = $strings['tdu'];
							}
						}else{
							$this->clase = $strings['other'];
						}
					}

					if($this->clase <> '')
					{
						if($this->tipo == '')
						{
							$tip = $this->tipoOri;
						}else{
							$tip = $this->tipo;
						}
						
						if($tip == $strings['sportsman'])
						{
							if($this->clase == $strings['pef']){
								$this->clase = $strings['pef'];
							}else{
								$this->clase = $strings['tdu'];
							}
						}else{
							$this->clase = $strings['other'];
						}

						if($this->clase == $strings['tdu'])
						{
							$sql = $sql . "entrenador_id = NULL,entrenador_nombre = NULL";
	                        if($lastModify <> "entrenador_id")
	                        {
	                            $sql = $sql . ",";
	                        }
	                        $sql = $sql . " ";
	                        $this->entrenador_id = '';
						}

						$sql = $sql . "clase ='" . $this->clase . "'";
						if($lastModify <> "clase")
						{
							$sql = $sql . ",";
						}
						$sql = $sql . " ";
						
						$modify = true;
					}

					if(isset($this->entrenador_id) && $this->entrenador_id <> '')
                    {

                    	while ($row = $result->fetch_array())
		                {
							$aux[0] = $row;
						}

						if($aux[0]['clase'] == $strings['pef'] || $this->clase == $strings['pef'])
						{
							$coachName = $this->getCoachName($this->entrenador_id);
	                        $sql = $sql . "entrenador_id ='" . $this->entrenador_id . "',entrenador_nombre ='" . $coachName . "'";
	                        if($lastModify <> "entrenador_id")
	                        {
	                            $sql = $sql . ",";
	                        }
	                        $sql = $sql . " ";
	                        $modify = true;
						}
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

                    //die("die: $sql");
					$sql = $sql . "WHERE id ='" . $this->id . "'";

					// if exists modification
					if($modify)
					{
						$this->mysqli->query($sql);

						// updating user
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

	// consulting user
	function consult()
    {

        include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{

	        $sql = "SELECT * FROM usuarios WHERE id = '".$this->id."'";

	        // checking DB connection
			if (!$result = $this->mysqli->query($sql))
			{
				$toret = $strings['ConnectionDBError'];
			}else {
				
				// checking that the user exists
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

	function toListSwitch()
    {
    	include '../languages/spanish.php';

    	if($_SESSION['userType'] == $strings['coach'])
    	{
    		$toret = $this->toListUsersCoach($_SESSION['userId']);
    	}else{
    		$toret = $this->toList();
    	}

    	return $toret;
    }

	// listing all users
	function toList()
    {

		include '../languages/spanish.php';

        $sql = "SELECT * FROM usuarios WHERE borrado = '0' ORDER BY nombre";

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

	function toListCoaches()
    {

		include '../languages/spanish.php';

        $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND tipo = 'Entrenador' ORDER BY apellidos,nombre";

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

	function getCoach()
    {

		include '../languages/spanish.php';

        $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND id = '$this->entrenador_id'";

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

	function getCoachUser($userId)
    {

		include '../languages/spanish.php';

        $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND id = '$userId'";


        // checking DB connection
		if (!$result = $this->mysqli->query($sql))
		{
			$toret = $strings['connectionDBError'];
		}else {
			
			while ($row0 = $result->fetch_array())
            {
            	$aux[0] = $row0;
            }
            $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND id = '" . $aux[0]['entrenador_id'] . "'";

	        // checking DB connection
			if ($result = $this->mysqli->query($sql))
			{
				// checking that at least one user exists
				if ($result->num_rows != 0)
				{
					// introducing all users into an array
					while ($row = $result->fetch_array())
	                {
						$toret[0] = $row;
					}
				}else {
					$toret = $strings['ListErrorNotExist'];
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

        if($_SESSION['userType'] == $strings['coach'])
        {
        	$sql = "SELECT * FROM usuarios WHERE borrado = '0' AND ( nombre LIKE '%".$word."%' OR apellidos LIKE '%".$word."%') AND entrenador_id ='" . $_SESSION['userId'] . "'";
        }else{
        	$sql = "SELECT * FROM usuarios WHERE borrado = '0' AND ( nombre LIKE '%".$word."%' OR apellidos LIKE '%".$word."%')";
        }

        //die("die: $sql");
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
        if($_SESSION['userType'] == $strings['coach'])
        {
	        Switch ($value)
	        {
	            case 1: $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND entrenador_id ='" . $_SESSION['userId'] . "' ORDER BY nombre";
	                break;
	            case 2: $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND entrenador_id ='" . $_SESSION['userId'] . "' ORDER BY nombre DESC";
	                break;
	            case 3: $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND entrenador_id ='" . $_SESSION['userId'] . "' ORDER BY apellidos";
	                break;
	            case 4: $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND entrenador_id ='" . $_SESSION['userId'] . "' ORDER BY apellidos DESC";
	                break;
	        }
	    }else{
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