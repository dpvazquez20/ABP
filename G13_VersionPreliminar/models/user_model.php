<?php

include '../functions/connectDB.php';

class UserModel
{
	function __construct($id, $login, $contrasenha, $nombre, $apellidos, $dni, $email, $tipo, $imagen)
    {
		$this->id = $id;
		$this->login = $login;
		$this->contrasenha = $contrasenha;
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->dni = $dni;
		$this->email = $email;
		$this->tipo = $tipo;
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
			$toret = "tipo";
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
            $sql = "SELECT * FROM usuarios WHERE dni = '".$this->dni."'";

            // checking DB connection
            if (!$result = $this->mysqli->query($sql))
            {
                $toret = $strings['ConnectionDBError'];

            }else {

                // checking that the user doesn't exist
                if ($result->num_rows == 0)
                {

                    $sql = "INSERT INTO usuarios (login,contrasenha,nombre,apellidos,dni,email,tipo,borrado,imagen) 
							VALUES('" . $this->login . "','" . $this->contrasenha . "','" . $this->nombre . "','" . $this->apellidos . "','" . $this->dni . "','" . $this->email . "','"  . $this->tipo . "','0','"  . $this->imagen . "')";

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

	// delete user
	function delete(){

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

	// search users
    function search($word)
    {

        include '../languages/spanish.php';

        $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND ( nombre LIKE '%".$word."%' OR apellidos LIKE '%".$word."%')";

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