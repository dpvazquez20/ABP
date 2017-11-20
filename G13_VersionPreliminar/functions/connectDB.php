<?php

    include '../languages/spanish.php';

	// connecting data base
	function connect()
	{
        $mysqli = new mysqli("localhost", "admin", "admin", "actifit");
		if ($mysqli->connect_errno) {
			echo $strings['MySQLError'] . '(' . $this->mysqli->connect_errno . ')'  . $this->mysqli->connect_error;
		}
		return $mysqli;
	}
?>