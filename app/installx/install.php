<?php 

//txtdbhost:txtdbhost,txtdbname:txtdbname,txtdbusername:txtdbusername,txtdbpass:txtdbpass},
	$txtdbhost=$_POST['txtdbhost'];
	$txtdbname=$_POST['txtdbname'];
	$txtdbusername=$_POST['txtdbusername'];
	$txtdbpass=$_POST['txtdbpass'];
	
	$mycon = @mysql_pconnect($txtdbhost, $txtdbusername, $txtdbpass); 
	if($mycon){
		$db=@mysql_select_db($txtdbname);
		if($db){
			
			$content="host=".$txtdbhost.",db=".$txtdbname.",username=".$txtdbusername.",password=".$txtdbpass;
			$fname="../app.config";
			$fhandle = fopen($fname,"w");
			fwrite($fhandle,$content);
			fclose($fhandle);
			
		//	$scriptcon=file_get_contents("script.sql");
			
			
			
			
							$templine = '';
				// Read in entire file
				$lines = file("script.sql");
				// Loop through each line
				foreach ($lines as $line)
				{
				// Skip it if it's a comment
					if (substr($line, 0, 2) == '--' || $line == '')
						continue;

					// Add this line to the current segment
					$templine .= $line;
					// If it has a semicolon at the end, it's the end of the query
					if (substr(trim($line), -1, 1) == ';')
					{
						// Perform the query
						mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
						// Reset temp variable to empty
						$templine = '';
					}
				}
							
			
			echo "1";
			
			
			
			
			
			
		}
		else{
			echo "Database Connection error. Check your connection values and retry";
		}
		
	}
	else{
		echo "Database Connection error. Check your connection values and retry";
	}

//echo $mycon;exit;



?>