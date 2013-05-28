<?php
	if(isset($_GET['delete'])) {
		$mysqli = new mysqli("localhost","root","","");
	    $idDel = $_GET['delete'];
	    $idBase = $_GET['base'];

		switch ($idBase) {
		    case "tweets":
				$mysqli->query("UPDATE tweets SET del=1 WHERE id='$idDel' ");
			    echo "1";
		        break;

		    case "valid":
				$mysqli->query("UPDATE tweets SET del=0 WHERE id='$idDel' ");
			    echo "1";
		        break;

		    case "keywords":
		    case "blacklist":
			    $mysqli->query("DELETE FROM $idBase WHERE id='$idDel'");
			    echo "1";
		        break;
		}
	    $mysqli->close(); 
	} 
?>