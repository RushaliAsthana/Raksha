<?php

	require_once "PatientDAO.php";
	require_once "TransportDAO.php";

	(new TransportDAO())->set_status(1, 0);
	(new PatientDAO())->book(1, "Fever", 78.4878493, 17.3971932);


?>