<?php 
// *** Redirect if record exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="?BiletMakinesiEkle&hata=MAD";
	 $MAD = $_POST['MAKINE_ADRESI'];
  $kayitKontrol = $db->query("SELECT COUNT(*) AS TOPLAMBILETMAK FROM BILET_MAKINELERI WHERE MAKINE_ADRESI='$MAD' ")->fetch();

  //if there is a row in the database,
  if($kayitKontrol['TOPLAMBILETMAK']>0){
    $MM_qsChar = "?";
    //append the record to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."MAD=".$MAD;
	$_SESSION['hata']=$MAD;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = $db->prepare("INSERT INTO BILET_MAKINELERI (MAKINE_ADRESI, MAKINE_ADI, MAKINE_TURU) VALUES (:MAKINE_ADRESI, :MAKINE_ADI, :MAKINE_TURU)");
                     
					$insertSQL->bindParam(':MAKINE_ADRESI', $_POST['MAKINE_ADRESI']);
					$insertSQL->bindParam(':MAKINE_ADI', $_POST['MAKINE_ADI']);
					$insertSQL->bindParam(':MAKINE_TURU', $_POST['MAKINE_TURU']);
			$insertSQL->execute();


  $insertGoTo = "?BiletMakinesiEkle&durum=ekle&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>

<!-- Jquery ile fadein fadeout için -->
<?php if(isset($_SESSION["hata"]))
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    $("#hata").click(function(){
        $("#hata").fadeOut(3000);       
    });
});
</script><!-- Jquery ile fadein fadeout için -->
    <div id="hata" class="alert alert-danger"><?php echo $diller['biletMakinesiMesaj_1']; ?> <span class="btn btn-red">(<?php echo $_SESSION["hata"]; ?>)</span> <?php echo $diller['biletMakinesiMesaj_2']; ?></div>
<?php
	unset($_SESSION["hata"]);
}
?>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-green">
  <div class="panel panel-heading"><?php echo $diller['biletMakinesiEkle']; ?></div>
  <div class="panel body table-responsive">
  <table class="table table-hover" align="center">
    <tr valign="baseline">
      <td nowrap align="right"><?php echo $diller['makineAdresi']; ?>:</td>
      <td><span id="sprytextfield2">
      <input class="form-control" type="number" min="1" max="1000" name="MAKINE_ADRESI" value="1" placeholder="1-1000 <?php echo $diller['birdegergiriniz']; ?>" size="32">                
        <span class="textfieldRequiredMsg"><?php echo $diller['bosgecilemez']; ?></span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><?php echo $diller['makineAdi']; ?>:</td>
      <td><span id="sprytextfield1">
        <input class="form-control" type="text" name="MAKINE_ADI" value="" size="32" maxlength="25" placeholder="<?php echo $diller['makineAdi']; ?>">
        <span class="textfieldRequiredMsg"><?php echo $diller['bosgecilemez']; ?></span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><?php echo $diller['makineTuru']; ?>:</td>
      <td valign="baseline"><table>
        <tr>
          <td><label class="switch"><input name="MAKINE_TURU" type="radio" value="1" checked >
            <span class="slider round"></span></label>KIOSK</td>
        </tr>
        <tr>
          <td><label class="switch"><input type="radio" name="MAKINE_TURU" value="2" >
            <span class="slider round"></span></label><?php echo $diller['buton']; ?></td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input class="form-control btn btn-success" type="submit" value="<?php echo $diller['ekle']; ?>"></td>
    </tr>
  </table></div></div></div>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
</script>