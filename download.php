

<?php

$dir='upload/';				
$dirHandle = opendir($dir); 
$dateien = array();
$count = 0;
$tabellenspalten = 0;
$x = 50;




$Dateiformate = array(
				'Bilder' => array('jpg','bmp','image/jpg','image/bmp'),
				'Text' => array('txt','doc'),
				'Videos' => array('mp4','wav'),
				'Musik' => array('mp3')
				);	


// Funktion zum Auslesen des Ordners und der Unterordner
function verzeichnisAuslesen ($Verzeichnis,$Suche){
	
			if ($handle = opendir($Verzeichnis)) {
    			
				
				while (false !== ($file = readdir($handle))) {
					$dateiinfo = pathinfo($dir.$file);
					if($file != '.' && $file != '..'){
						
						if(is_dir($Verzeichnis . $file)){			//wenn ausgelesene Datei ein Ordner ist,dannwird der ordner durchsucht
							verzeichnisAuslesen($Verzeichnis . $file . '/', $Suche);
						}
													
							else{
								
									if($Suche == NULL){		//wenn kein suchbegriff eingegeben wurde, sollen alle dateien angezeigt werden 
										echo'<div id="datensätze"><table border="0">';					
										echo '<tr><td width="550px"><a href='. $dir . $Verzeichnis . '/' . $file  .  '>' . $dateiinfo['filename'] . "<a /></td>"; 
										echo '<td width="80px">';
										
												if(stripos($Verzeichnis,'Bilder') !== false){
												echo'<div id="typbilder">'. $dateiinfo["extension"].'</div></td></table></div>';
												}
												
												elseif(stripos($Verzeichnis,'Musik') !== false){
												echo'<div id="typmusik">'. $dateiinfo["extension"].'</div></td></table></div>';
												}
												
												elseif(stripos($Verzeichnis,'Textdateien') !== false){
												echo'<div id="typtext">'. $dateiinfo["extension"].'</div></td></table></div>';
												}
												
												elseif(stripos($Verzeichnis,'Videos') !== false){
												echo'<div id="typvideo">'. $dateiinfo["extension"].'</div></td></table></div>';
												}
												
												else{
													echo '</td></table></div>';
													
												}
										       
									}
									elseif(stripos($dateiinfo['filename'],$Suche) !== false){ // ansonsten nur deteien die den suchbegriff beinhalten
										
										echo'<div id="datensätze"><table border="0">';					
										echo '<tr><td width="550px"><a href='. $dir . $Verzeichnis . '/' . $file  .  '>' . $dateiinfo['filename'] . "<a /></td>"; 
										echo '<td width="80px">';
										
												if(stripos($Verzeichnis,'Bilder') !== false){
												echo'<div id="typbilder">'. $dateiinfo["extension"].'</div></td></table></div>';
												}
												
												elseif(stripos($Verzeichnis,'Musik') !== false){
												echo'<div id="typmusik">'. $dateiinfo["extension"].'</div></td></table></div>';
												}
												
												elseif(stripos($Verzeichnis,'Textdateien') !== false){
												echo'<div id="typtext">'. $dateiinfo["extension"].'</div></td></table></div>';
												}
												
												elseif(stripos($Verzeichnis,'Videos') !== false){
												echo'<div id="typvideo">'. $dateiinfo["extension"].'</div></td></table></div>';
												}
												
												else{
													echo '</td></table></div>';
													
												}  		
									}
							}
						
						}
					}
				}				
				closedir($handle);
			}	





	if($search == 'Suche'){
		
		
		verzeichnisAuslesen($dir,$suchbegriff);
     }
	 
	 else if($search == 'Bilder'){
?>
<div id="galerie">
<ul>
<?php
	
//Suchfunktion für Bilder

$ordner = $dir."Bilder"; //Ordner Name
 

$allebilder = scandir($ordner); // ordner Auslesen und dateien im array speichern
                              
 


foreach ($allebilder as $bild) { // array $allebilder durchlaufen
 
 
    $bildinfo = pathinfo($ordner."/".$bild);  //dateiinformationen in $bildinfo speichern 
   
 
   
    $size = ceil(filesize($ordner."/".$bild)/1024);  // Größe ermitteln für Ausgabe
    //1024 = kb | 1048576 = MB | 1073741824 = GB
 
  
    if ($bild != "." && $bild != ".."  ) { 
    
	 
	   // Ausgabe der Bilder		
	 ?>

       <li>
       		<div id="Bild">
       		<a href="<?php echo $bildinfo['dirname']."/".$bildinfo['basename'];?>">
       		<img src="<?php echo $bildinfo['dirname']."/".$bildinfo['basename'];?>"  width="625" alt="Vorschau" /></a>
        	<span class="Bildunterschrift"><?php echo $bildinfo['filename']; ?> (<?php echo $size ; ?>kb)</span>
            </div>
        </li>
        
    <?php	    

	?>    
    
<?php
    };
 };
?>
</ul></div>
<?php	
	}else if($search == 'Text'){
		verzeichnisAuslesen($dir.Textdateien,NULL);		 
	}
	else if($search == 'Musik'){
		verzeichnisAuslesen($dir.Musik,NULL);	
	}
	else if($search == 'Videos'){
		verzeichnisAuslesen($dir.Videos,NULL);	
	}
	
	else if($search == 'Alle'){		
		verzeichnisAuslesen($dir,NULL);		
	}
		      

	
?>
