<?php

include '../functions/connectDB.php';

class ResourceModel
{
	function __construct($id, $nombre, $aforo, $descripcion)
    {
		$this->id = $id;
		$this->nombre = $nombre;
		$this->aforo = $aforo;
		$this->descripcion = $descripcion;

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
		if($this->aforo <> '')
		{
			$toret = "aforo";
		}
		if($this->descripcion <> '')
		{
			$toret = "descripcion";
		}

		return $toret;
	}

	// insert new resource
	function insert()
    {
        include '../languages/spanish.php';

		// checking form's data

        if ($this->nombre <> '' )
        {
            $sql = "SELECT * FROM recursos WHERE nombre = '".$this->nombre."'";

            // checking DB connection
            if (!$result = $this->mysqli->query($sql))
            {
                $toret = $strings['ConnectionDBError'];

            }else {

                // checking that the resource doesn't exist
                if ($result->num_rows == 0)
                {

                    $sql = "INSERT INTO recursos (nombre,aforo,descripcion,borrado) 
							VALUES('" . $this->nombre . "','" . $this->aforo . "','" . $this->descripcion . "','0')";

                    // inserting new resource
                    if ($result = $this->mysqli->query($sql))
                    {
                        $toret = $strings['InsertSuccess'];
                    }else {
                        $toret = $strings['InsertError'];
                    }

                }else {

                    // seeing if the resource had been created before
                    $sql = "SELECT * FROM recursos WHERE nombre = '".$this->nombre."' AND borrado='1'";
                    $result = $this->mysqli->query($sql);

                    if ($result->num_rows == 1)
                    {
                        $sql = "UPDATE recursos SET borrado ='0' WHERE nombre = '" . $this->nombre ."'";
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

	// delete resource
	function delete(){

        include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{
	        $sql = "SELECT * FROM recursos WHERE id = '".$this->id."'";

	        // checking DB connection
	        if (!$result = $this->mysqli->query($sql))
	        {
				$toret = $strings['ConnectionDBError'];
			}else {
		
				// checking that the resource exists
				if ($result->num_rows == 1)
				{

					$sql = "UPDATE recursos SET borrado ='1' WHERE id = '" . $this->id ."'";

					$this->mysqli->query($sql);

					// deleting resource
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

	// modify resource
	function modify()
    {

		include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{

	        $sql = "SELECT * FROM recursos WHERE id = '".$this->id."'";

	        // checking DB connection
			if (!$result = $this->mysqli->query($sql))
			{
				$toret = $strings['ConnectionDBError'];
			}else {
				
				// checking that the resource exists
				if ($result->num_rows == 1)
				{
					$modify = false;
					$lastModify = $this->lastModify(); 
					$sql = "UPDATE recursos SET ";

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
					
					if($this->aforo <> '')
					{
						$sql = $sql . "aforo ='" . $this->aforo . "'";
						if($lastModify <> "aforo")
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

						// updating resource
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

	// consulting resource
	function consult()
    {

        include '../languages/spanish.php';

		// checking form's data
		if ($this->id <> '' )
		{

	        $sql = "SELECT * FROM recursos WHERE id = '".$this->id."'";

	        // checking DB connection
			if (!$result = $this->mysqli->query($sql))
			{
				$toret = $strings['ConnectionDBError'];
			}else {
				
				// checking that the resource exists
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

	// listing all resources
	function toList()
    {

		include '../languages/spanish.php';

        $sql = "SELECT * FROM recursos WHERE borrado = '0' ORDER BY nombre";

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
				$toret = $strings['ListErrorNotExist'];
			}
		}

		return $toret;

	}

	// search resources
    function search($word)
    {

        include '../languages/spanish.php';

        $sql = "SELECT * FROM recursos WHERE borrado = '0' AND nombre LIKE '%".$word."%'";

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
            case 1: $sql = "SELECT * FROM recursos WHERE borrado = '0' ORDER BY nombre";
                break;
            case 2: $sql = "SELECT * FROM recursos WHERE borrado = '0' ORDER BY nombre DESC";
                break;
        }

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
                $toret = $strings['ListErrorNotExist'];
            }
        }

        return $toret;

    }


}

?>