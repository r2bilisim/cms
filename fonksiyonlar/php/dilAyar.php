<?php
//initialize the session
	if (!isset($_SESSION)) {
		session_start();
	}
	
	/*	DIL PAKETI AYARLARI 	*/
	function list_files($dir)
	{
		//dilPaketi dizinini içindeki dosyaları listeler
		if(is_dir($dir))
		{
			if($handle = opendir($dir))
			{
				while(($file = readdir($handle)) !== false)
				{
					if($file != "." && $file != ".." && $file != "Thumbs.db")
					{
						//echo '<a target="_blank" href="'.$dir.$file.'">'.$file.'</a><br>';							
						$dilDizi[]=$file;
					}
				}
				closedir($handle);
			}
		}
		
		return $dilDizi;
	}					
 $_SERVER['DOCUMENT_ROOT']="./"; //sunucuda çalışmadığı için bu şekilde yazmak zorunda kaldım.!!
	
	if(isset($_COOKIE['dilSec']))
	{ 				
		$dilDosyasi=$_SERVER['DOCUMENT_ROOT']."dilPaketi/".$_COOKIE["dilSec"];
		//if(file_exists($dilDosyasi))
		{
			include($dilDosyasi);
		}
	}
	else 
	{
		//seçili dil yoksa varsayılan Türkçedir
		setcookie("dilSec","tr.php",(time()+365*60*60*24));	
		$yol=$_SERVER['DOCUMENT_ROOT']."dilPaketi/tr.php";
		include($yol);
	}
	if(isset($_POST['dilSec']))
	{ 				
		setcookie("dilSec",$_POST['dilSec'],(time()+365*60*60*24));	
		$dilDosyasi=$_SERVER['DOCUMENT_ROOT']."dilPaketi/".$_POST["dilSec"];
		//if(file_exists($dilDosyasi))
		{
			include($dilDosyasi);
		}
	}
	/*	DIL PAKETI AYARLARI 	*/
	
?>