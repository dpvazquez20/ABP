<?php

include '../functions/connectDB.php';

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
		include '../languages/spanish.php';
		require_once(__DIR__."/../mail/PHPMailerAutoload.php");

		$mail = new PHPMailer;

		$mail->isSMTP();
		$mail->Debugoutput = 'html';
		$mail->Host = gethostbyname('smtp.gmail.com');
		$mail->Port =587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		
			
		$mail->Username = "actifitmail@gmail.com";
		$mail->Password = "actifit_green";
		$mail->setFrom("actifitmail@gmail.com", 'ActiFit');
		$mail->addReplyTo("actifitmail@gmail.com", 'Gimnasio ABP');
		
		$mail->Subject = $this->subject;
		$mail->Body = $this->message;
		$mail->AltBody = $this->message;

		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
		));	
		
		$sql = "SELECT * FROM usuarios WHERE tipo = '".$this->to."'";

    	if (!$result = $this->mysqli->query($sql))
        {
            $toret = $strings['ConnectionDBError'];
        }else {
			while ($row = $result->fetch_array())
	        {
				$mail->AddAddress($row['email']);
	        }
        }
              
        if($mail->send()) {
        	$toret = $strings['NotificationSent'];
           
        }else{
        	$toret = $strings['NotificationError'];
        	$toret .= ' | Mailer Error: ' . $mail->ErrorInfo;
        }
        
        return $toret;
	}
}

?>