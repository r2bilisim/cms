<?php 
if ((isset($_GET['BiletSil'])) && ($_GET['BiletSil'] != "")) {
  $deleteSQL = $db->prepare("DELETE FROM BILET_AYAR WHERE KID=:KID");
	$deleteSQL->bindParam(':KID', $_GET['BiletSil']);	
	$deleteSQL->execute(); 
	
 $deleteGoTo = "?BiletEkle=SilOk&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
else
{
	header(sprintf("Location: %s", "?BiletEkle=SilEksik"));
}
?>

Bilet ayar tablosundan ilgili bilet ayarları silinir
