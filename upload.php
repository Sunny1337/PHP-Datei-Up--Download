<?PHP

$max_dateigroesse = 15728640;//Maximale Dateigröße die Hochgeladen werden darf | 15728640 Byte --> 15360 kB --> 15 mB



  if(isset($_POST['send']) && $_POST['send'] == "1"){ //Prüft ob im Post array send variable vorhanden ist und ob sie eins ist.
  
    if($_FILES['userfile']['size'] > $max_dateigroesse) {	//prüft ob die dateigrößer istals die vorgegeben max-größe	
	
		echo "&#160; &#160; Datei ist zu gro&#223  " . ceil(($_FILES['userfile']['size']/1024)/1024) . "  mb statt den erlaubten  " . ceil(($max_dateigroesse/1024)/1024) . "  mb";
		
	}else{
		
		$uploaddir = 'upload/'; // uplaodpfad
		
		$filename = $_POST['dateiname']; // Vom Benutzer erwünschter Name
		
		$dateiEndung = explode(".", $_FILES['userfile']['name']);  // spaltet datei namen von dateiendung mit . als trennung
		
		$dateiEndungLänge = sizeof($dateiEndung); // Länge  der Dateiendung
		
				
		if(stripos($_FILES['userfile']['type'],'image/' ) !== false ){   // wenn dateiendung = Jpeg/jpg dann wird die Datei in upload/Bilder gespeichert
			$uploaddir = 'upload/Bilder/';
		}
		elseif(stripos($_FILES['userfile']['type'],'text/') !== false || stripos($_FILES['userfile']['type'],'application/') !== false ) {
			$uploaddir = 'upload/Textdateien/';
			
		}
		elseif(stripos($_FILES['userfile']['type'],'audio/') !== false) {
			$uploaddir = 'upload/Musik/';
			
		}
		elseif(stripos($_FILES['userfile']['type'],'video/') !== false) {
			$uploaddir = 'upload/Videos/';
			
		}
		else{
			$uploaddir = 'upload/';	  // ansonsten ganz normal und den upload ordner
		}
		
		$pathAndName = $uploaddir . $filename; 	// dateipfad mit dateinamen
	 
		
		
		if(move_uploaded_file($_FILES['userfile']['tmp_name'], $pathAndName . '.' . $dateiEndung[$dateiEndungLänge-1])){ // überprüft ob datei hochgeladen wurde. Dateiendung array an der Stelle dateiendungslänge - 1
			echo "Datei erfolgreich hochgeladen.\n";
			echo $_FILES[userfile][type];
			echo '<br>';
			print_r($Dateikategorie);
			 //echo'<script type="text/javascript"> window.location = "index.php"; </script>'; 
			}
		else{
			echo "Fehler beim Hochladen der Datei. Fehlermeldung:\n<br />";
			print_r($_FILES);
			}
	  }
	}
?>