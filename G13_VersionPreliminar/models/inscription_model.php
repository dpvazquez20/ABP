<?php

include '../functions/connectDB.php';

class InscriptionModel
{
	function __construct($id_actividad,$fecha,$usuario_id)
    {
		$this->id_actividad = $id_actividad;
		$this->fecha = $fecha;
		$this->usuario_id = $usuario_id;
		$this->mysqli = connect();
	}

	function __destruct()
    {

	}

	function lastModify(){

		if($this->id_actividad <> '')
		{
			$toret = "id_actividad";
		}
		if($this->fecha <> '')
		{
			$toret = "fecha";
		}
		if($this->usuario_id <> '')
		{
			$toret = "usuario_id";
		}

		return $toret;
	}

	// insert new inscription
	function insert()
    {
        include '../languages/spanish.php';

		// checking form's data

        if(isset($_SESSION['sportmID'])){
            $this->usuario_id = $_SESSION['sportmID'];
        }
        if ($this->id_actividad <> '' )
        {
            $sql = "SELECT * FROM inscripciones_has_actividades WHERE inscripciones_id IN (SELECT id FROM inscripciones WHERE borrado = 0 ) AND actividades_id='" .$this->id_actividad. "'";
            $result = $this->mysqli->query($sql);
            $ins_num = $result->num_rows;
            $sql = "SELECT numMaxParticipantes FROM actividades WHERE id = '" .$this->id_actividad. "'";
            $result = $this->mysqli->query($sql);
            $max_part  =$result->fetch_assoc();
            if($ins_num < $max_part['numMaxParticipantes'])
            {
                $sql = "SELECT * FROM inscripciones WHERE id IN (SELECT inscripciones_id FROM inscripciones_has_actividades WHERE actividades_id = '" . $this->id_actividad . "') AND usuario_id= '" . $this->usuario_id . "'";

                // checking DB connection
                if (!$result = $this->mysqli->query($sql)) {
                    $toret = $strings['ConnectionDBError'];

                } else {

                    // checking that the inscription doesn't exist
                    if ($result->num_rows == 0) {

                        $sql = "INSERT INTO inscripciones (fecha,borrado,usuario_id)
							VALUES('" . $this->fecha . "','0','" . $this->usuario_id . "')";

                        // inserting new inscription
                        if ($result = $this->mysqli->query($sql)) {
                            $toret = $strings['InsertSuccess'];
                        } else {
                            $toret = $strings['InsertError'];
                        }

                        // inserting new inscription has
                        $sql = "INSERT INTO inscripciones_has_actividades (inscripciones_id, actividades_id)
							VALUES((SELECT MAX(id) FROM inscripciones),'" . $this->id_actividad . "')";

                        if ($result = $this->mysqli->query($sql)) {
                            $toret = $strings['InsertSuccess'];
                        } else {
                            $toret = $strings['InsertError'];
                        }

                    } else {

                        // seeing if the inscription had been created before
                        $sql = "SELECT * FROM inscripciones WHERE id IN (SELECT inscripciones_id FROM inscripciones_has_actividades WHERE actividades_id = '" . $this->id_actividad . "') 
                            AND borrado='1' AND usuario_id= '" . $this->usuario_id . "'";
                        $result = $this->mysqli->query($sql);

                        if ($result->num_rows == 1) {
                            $sql = "UPDATE inscripciones SET borrado ='0' WHERE id IN (SELECT inscripciones_id FROM inscripciones_has_actividades WHERE actividades_id = '" . $this->id_actividad . "') 
                            AND usuario_id= '" . $this->usuario_id . "'";
                            if ($result = $this->mysqli->query($sql)) {
                                $toret = $strings['InsertSuccess'];
                            } else {
                                $toret = $strings['InsertError'];
                            }

                        } else {
                            $toret = $strings['InsertErrorRepeat'];
                        }
                    }
                }
            } else {
                $toret = $strings['FullActivity'];
            }
            }else {
            $toret = $strings['InsertErrorForm'];
        }

		return $toret;
	}

	// delete inscription
	function delete(){
        if(isset($_SESSION['sportmID'])){
            $this->usuario_id = $_SESSION['sportmID'];
        }
        include '../languages/spanish.php';

		// checking form's data
		if ($this->id_actividad <> '' )
		{
	        $sql = "SELECT * FROM inscripciones WHERE id IN (SELECT inscripciones_id FROM inscripciones_has_actividades WHERE actividades_id = '" .$this->id_actividad. "')  AND usuario_id= '". $this->usuario_id ."'";

	        // checking DB connection
	        if (!$result = $this->mysqli->query($sql))
	        {
				$toret = $strings['ConnectionDBError'];
			}else {
		
				// checking that the inscription exists
				if ($result->num_rows == 1)
				{

					$sql = "UPDATE inscripciones SET borrado ='1' WHERE id IN (SELECT inscripciones_id FROM inscripciones_has_actividades WHERE actividades_id = '" .$this->id_actividad. "')  
					        AND usuario_id= '". $this->usuario_id ."'";

					$this->mysqli->query($sql);

					// deleting inscription
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


	// consulting inscription
	function consult()
    {
        if(isset($_SESSION['sportmID'])){
            $this->usuario_id = $_SESSION['sportmID'];
        }
        include '../languages/spanish.php';

		// checking form's data
		if ($this->id_actividad <> '' )
		{

	        $sql = "SELECT * FROM inscripciones WHERE id = '".$this->id_actividad."' AND usuario_id= '". $this->usuario_id ."'";

	        // checking DB connection
			if (!$result = $this->mysqli->query($sql))
			{
				$toret = $strings['ConnectionDBError'];
			}else {
				
				// checking that the inscription exists
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

	// listing all inscriptions
	function toList()
    {
        if(isset($_SESSION['sportmID'])){
            $this->usuario_id = $_SESSION['sportmID'];
        }
		include '../languages/spanish.php';

        $sql = "SELECT * FROM inscripciones WHERE borrado = '0' ORDER BY fecha";

        // checking DB connection
		if (!$result = $this->mysqli->query($sql))
		{
			$toret = $strings['connectionDBError'];
		}else {
			
			// checking that at least one inscription exists
			if ($result->num_rows != 0)
			{

				$toret=[];
				$i=0;

				// introducing all inscriptions into an array
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

	// search inscriptions
    function search($word,$id_sportsman, $select)
    {
        if(isset($_SESSION['sportmID'])){
            $this->usuario_id = $_SESSION['sportmID'];
        }
        include '../languages/spanish.php';

        if($select) {
            $sql = "SELECT * FROM actividades WHERE borrado = '0' AND nombre LIKE '%".$word."%' AND id IN
                (SELECT actividades_id FROM inscripciones_has_actividades where inscripciones_id IN (SELECT id FROM inscripciones WHERE usuario_id = $id_sportsman AND borrado='0')) ORDER BY nombre";
        }else{
            $sql = "SELECT * FROM actividades WHERE borrado = '0' AND nombre LIKE '%".$word."%' AND id NOT IN
                (SELECT actividades_id FROM inscripciones_has_actividades where inscripciones_id IN (SELECT id FROM inscripciones WHERE usuario_id = $id_sportsman AND borrado='0')) ORDER BY nombre";
        }
        
        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            // checking that at least one inscription exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all inscriptions into an array
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
    function order($value,$id_sportsman,$select)
    {
        if(isset($_SESSION['sportmID'])){
            $this->usuario_id = $_SESSION['sportmID'];
        }
        include '../languages/spanish.php';
        $sql = '';

        // sql query depends on the value of the order by
        Switch ($value)
        {
            case 1:
                if($select) {
                    $sql = "SELECT * FROM actividades WHERE borrado = '0' AND id IN 
                (SELECT actividades_id FROM inscripciones_has_actividades where inscripciones_id IN (SELECT id FROM inscripciones WHERE usuario_id = $id_sportsman AND borrado='0')) ORDER BY nombre";
                }else{
                    $sql = "SELECT * FROM actividades WHERE borrado = '0' AND id NOT IN 
                (SELECT actividades_id FROM inscripciones_has_actividades where inscripciones_id IN (SELECT id FROM inscripciones WHERE usuario_id = $id_sportsman AND borrado='0')) ORDER BY nombre";
                }
                break;
            case 2:
                if($select) {
                    $sql = "SELECT * FROM actividades WHERE borrado = '0' AND id IN
                (SELECT actividades_id FROM inscripciones_has_actividades where inscripciones_id IN (SELECT id FROM inscripciones WHERE usuario_id = $id_sportsman AND borrado='0')) ORDER BY nombre DESC";
                }else{
                    $sql = "SELECT * FROM actividades WHERE borrado = '0' AND id NOT IN
                (SELECT actividades_id FROM inscripciones_has_actividades where inscripciones_id IN (SELECT id FROM inscripciones WHERE usuario_id = $id_sportsman AND borrado='0')) ORDER BY nombre DESC";
                }
                break;
        }

        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            // checking that at least one inscription exists
            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

                // introducing all inscriptions into an array
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

    function getAllUsers(){
        include '../languages/spanish.php';

        $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND tipo='Deportista' ORDER BY nombre";

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
    function searchUsers($word)
    {

        include '../languages/spanish.php';

        $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND tipo='Deportista' AND ( nombre LIKE '%".$word."%' OR apellidos LIKE '%".$word."%')";

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
    function orderUsers($value)
    {

        include '../languages/spanish.php';
        $sql = '';

        // sql query depends on the value of the order by
        Switch ($value)
        {
            case 1: $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND tipo='Deportista' ORDER BY nombre";
                break;
            case 2: $sql = "SELECT * FROM usuarios WHERE borrado = '0' AND tipo='Deportista' ORDER BY nombre DESC";
                break;
            case 3: $sql = "SELECT * FROM usuarios WHERE borrado = '0'AND tipo='Deportista'  ORDER BY apellidos";
                break;
            case 4: $sql = "SELECT * FROM usuarios WHERE borrado = '0'AND tipo='Deportista'  ORDER BY apellidos DESC";
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

    function getActivities($id_sportsman,$select){
        include '../languages/spanish.php';
        // if true gets inscripted activities
        if($select) {
            $sql = "SELECT * FROM actividades WHERE borrado = '0' AND id IN 
                (SELECT actividades_id FROM inscripciones_has_actividades where inscripciones_id IN (SELECT id FROM inscripciones WHERE usuario_id = $id_sportsman AND borrado='0')) ORDER BY nombre";
        }else{
            $sql = "SELECT * FROM actividades WHERE borrado = '0' AND id NOT IN 
                (SELECT actividades_id FROM inscripciones_has_actividades where inscripciones_id IN (SELECT id FROM inscripciones WHERE usuario_id = $id_sportsman AND borrado='0')) ORDER BY nombre";
        }

        // checking DB connection
        if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['connectionDBError'];
        }else {

            if ($result->num_rows != 0)
            {

                $toret=[];
                $i=0;

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