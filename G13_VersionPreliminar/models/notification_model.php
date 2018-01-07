<?php

include '../functions/connectDB.php';
//include '../PHPMailer-FE_v4.11/_lib/class.phpmailer.php';

class NotificationModel
{
	function __construct($to, $subject,$message)
    {
    	$this->to = $to;
		$this->subject = $subject;
		$this->message = $message;
		$this->mysqli = connect();
	}

	function __destruct()
    {

	}

	function sendMail()
	{
		//require 'phpmailer.php';
		//require 'smtp.php';

		//require '../PHPMailer/src/PHPMailer.php';
		//require '../PHPMailer/src/SMTP.php';
		include '../languages/spanish.php';
		require('../PHPMailer/class.phpmailer.php');

		$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = "smtp.gmail.com"; // SMTP server
		$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
		                                   // 1 = errors and messages
		                                   // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		//$mail->Host       = "smtp.gmail.com"; // sets the SMTP server
		$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
		//$mail->Port       = 587;
		$mail->Username   = "actifitmail@gmail.com"; // SMTP account username
		$mail->Password   = "actifit_green";        // SMTP account password
		$mail->SMTPSecure = 'ssl';
		//$mail->SMTPSecure = 'tls';


		$mail->From = 'actifitmail@gmail.com';
		$mail->FromName = 'Mailer';
		//$mail->addAddress('MAIL ID to whom you eant to send');               // Name is optional

		//$mail->addCC('CC EMAIL ID');
		//$mail->addBCC('BCC EMAIL ID');
		$mail->WordWrap = 70;                                 // Set word wrap to    50 characters

		$mail->Subject = 'Here is the subject';
		$mail->Body    = 'MESSAGE';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail  clients';

		/*if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		echo 'Message has been sent';
		}*/



		/*
        //Definimos la cuenta que vamos a usar. Dirección completa de la misma
        $mail->Username   = "actifitmail@gmail.com";
        //Introducimos nuestra contraseña de gmail
        $mail->Password   = "actifit_green";
        //Definimos el remitente (dirección y nombre)
        $mail->SetFrom('actifitmail@gmail.com', 'ActiFit');
        //Definimos el tema del email
        $mail->Subject = $this->subject;
        //Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
        $mail->MsgHTML($this->message);
        //Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
        
        //$mail->AltBody = 'This is a plain-text message body';
        */
        //$i = 0;
        $sql = "SELECT * FROM usuarios WHERE tipo = '".$this->to."'";

    	if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
			while ($row = $result->fetch_array())
	        {
	        	//mail($this->to, $row['email'], $this->message, $headers);
				$mail->AddAddress($row['email']); // Esta es la dirección a donde enviamos
				//die("die: " . $row['email']);
				//$i = $i + 1;
	        }
        }
        //die("die: $i");
        
        $toret = $strings['NotificationOk'];

        //Enviamos el correo                 
        if(!$mail->send()) {
            $toret = $strings['NotificationError'];
            $toret .= ' | Mailer Error: ' . $mail->ErrorInfo;
        }
        return $toret;
	}

	function sendMail0()
	{
		include '../languages/spanish.php';
		require_once('../PHPMailer/class.phpmailer.php');

		//Crear una instancia de PHPMailer
        $mail = new PHPMailer();
        //Definir que vamos a usar SMTP
        $mail->IsSMTP();
        //Esto es para activar el modo depuración en producción
        $mail->SMTPDebug  = 0;
        //Ahora definimos gmail como servidor que aloja nuestro SMTP
        $mail->Host       = 'smtp.gmail.com';
        //El puerto será el 587 ya que usamos encriptación TLS
        $mail->Port       = 587;
        //$mail->Port       = 465;
        //Definmos la seguridad como TLS
        $mail->SMTPSecure = 'tls';
        //$mail->SMTPSecure = 'ssl';
        //Tenemos que usar gmail autenticados, así que esto a TRUE
        $mail->SMTPAuth   = true;
        //Definimos la cuenta que vamos a usar. Dirección completa de la misma
        $mail->Username   = "actifitmail@gmail.com";
        //Introducimos nuestra contraseña de gmail
        $mail->Password   = "actifit_green";
        //Definimos el remitente (dirección y nombre)
        $mail->SetFrom('actifitmail@gmail.com', 'ActiFit');
        //Definimos el tema del email
        $mail->Subject = $this->subject;
        //Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
        $mail->MsgHTML($this->message);
        //Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
        
        //$mail->AltBody = 'This is a plain-text message body';
        
        $sql = "SELECT * FROM usuarios WHERE tipo = '".$this->to."'";

    	if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
			while ($row = $result->fetch_array())
	        {
	        	//mail($this->to, $row['email'], $this->message, $headers);
				$mail->AddAddress($row['email']); // Esta es la dirección a donde enviamos
				//die("die: " . $row['email']);
	        }
        }
        
        $toret = $strings['NotificationOk'];

        //Enviamos el correo                 
        if(!$mail->Send()) {
            $toret = $strings['NotificationError'];
            $toret .= ' | Mailer Error: ' . $mail->ErrorInfo;
        }
        return $toret;
	}

	function sendMail1()
	{
		include '../languages/spanish.php';
		
		//use PHPMailer\PHPMailer\PHPMailer;
		//use PHPMailer\PHPMailer\Exception;
		
		//use ..\PHPMailer\src\PHPMailer;
		//use ..\PHPMailer\src\Exception;

		require '../PHPMailer/src/Exception.php';
		require '../PHPMailer/src/PHPMailer.php';
		require '../PHPMailer/src/SMTP.php';


		//use PHPMailer\src\PHPMailer;
		//use PHPMailer\src\Exception;

		//Load composer's autoloader
		require '../vendor/autoload.php';

		$toret = $strings['NotificationOk'];

		$mail = new PHPMailer();                              // Passing `true` enables exceptions
		try {
		    //Server settings
		    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'actifitmail@gmail.com';                 // SMTP username
		    $mail->Password = 'actifit_green';                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom('actifitmail@gmail.com', 'ActiFit');
		    /*$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
		    $mail->addAddress('ellen@example.com');               // Name is optional
		    $mail->addReplyTo('info@example.com', 'Information');
		    $mail->addCC('cc@example.com');
		    $mail->addBCC('bcc@example.com');*/

		    //Attachments
		    /*$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		    */

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $this->subject;
		    $mail->Body    = $this->message;
		    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $sql = "SELECT * FROM usuarios WHERE tipo = '".$this->to."'";

	    	if (!$result = $this->mysqli->query($sql))
	        {
	            $toret = $strings['ConnectionDBError'];
	        }else {
				while ($row = $result->fetch_array())
		        {
		        	$mail->addAddress($row['email']);
		        }
		    }

		    $mail->send();
		    //echo 'Message has been sent';
		} catch (Exception $e) {
			$toret = $strings['NotificationError'];
			$toret = 'Mailer Error: ' . $mail->ErrorInfo;
		    //echo 'Message could not be sent.';
		    //echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}

	function sendMail2()
	{
		include '../languages/spanish.php';
		/*
		require '../PHPMailer/src/Exception.php';
		require '../PHPMailer/src/PHPMailer.php';
		require '../PHPMailer/src/SMTP.php';
		*/
		require_once('../PHPMailer/class.phpmailer.php');
		/*
		$headers = 'From: webmaster@example.com' . "\r\n" .
    		'Reply-To: webmaster@example.com' . "\r\n" .
    		'X-Mailer: PHP/' . phpversion();
		*/

    	//$headers = 'From: actifitmail@gmail.com';
    	//include '../PHPMailer-FE_v4.11/_lib/class.phpmailer.php';
    	//require("../PHPMailer-FE_v4.11/_lib/class.phpmailer.php");
    	$mail = new PHPMailer();

		//Luego tenemos que iniciar la validación por SMTP:
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Host = "gmail.com"; // A RELLENAR. Aquí pondremos el SMTP a utilizar. Por ej. mail.midominio.com
		$mail->Username = "actifitmail@gmail.com"; // A RELLENAR. Email de la cuenta de correo. ej.info@midominio.com La cuenta de correo debe ser creada previamente. 
		$mail->Password = "actifit_green"; // A RELLENAR. Aqui pondremos la contraseña de la cuenta de correo
		$mail->Port = 465; // Puerto de conexión al servidor de envio. 
		$mail->From = "actifitmail@gmail.com"; // A RELLENARDesde donde enviamos (Para mostrar). Puede ser el mismo que el email creado previamente.
		$mail->FromName = "ActiFit"; //A RELLENAR Nombre a mostrar del remitente. 
		
		$mail->AddAddress("correo"); // Esta es la dirección a donde enviamos 
		
		$mail->IsHTML(true); // El correo se envía como HTML 

		$mail->Subject = $this->subject; // Este es el titulo del email.

		$body = $this->message; 
		//$body .= "Aquí continuamos el mensaje";
		$mail->Body = $body; // Mensaje a enviar.

    	$sql = "SELECT * FROM usuarios WHERE tipo = '".$this->to."'";

    	if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
			while ($row = $result->fetch_array())
	        {
	        	//mail($this->to, $row['email'], $this->message, $headers);
				$mail->AddAddress($row['email']); // Esta es la dirección a donde enviamos
	        }
        }

        $exito = $mail->Send(); // Envía el correo.

		if($exito){ 
			$toret = $strings['NotificationOk'];
		}else{
			$toret = $strings['NotificationError'];
		}
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

                    $sql = "INSERT INTO tablas (nombre,tipo,borrado) 
							VALUES('" . $this->nombre . "','" . $this->tipo . "','0')";

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