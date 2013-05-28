<?php
	if(isset($_GET['hashtag'])) {
		$mysqli = new mysqli("localhost","root","","");
	    $idhash = $_GET['hashtag'];
		$date = date('Y-m-d');


		switch ($idhash) {
		    case "neige":
				$mysqli->query("UPDATE hashtags SET hashtag='ilneige' WHERE date='$date'");
			    echo "1";
		        break;

		    case "pleut":
				$mysqli->query("UPDATE hashtags SET hashtag='ilpleut' WHERE date='$date'");
			    echo "1";
		        break;

		    case "beau":
				$mysqli->query("UPDATE hashtags SET hashtag='ilfaitbeau' WHERE date='$date'");
			    echo "1";
		        break;
		}
	    $mysqli->close(); 
	} 
?>