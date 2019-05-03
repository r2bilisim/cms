<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {


  	$guncelle = $db->prepare("UPDATE SISTEM_CONFIG SET FIRMA_ISMI = :firma_ismi, SERVER_IP = :server_ip WHERE ID = :id");
	$guncelle->bindParam(':firma_ismi', $_POST['FIRMA_ISMI']); //parametre tanımla		
	$guncelle->bindParam(':server_ip', $_POST['SERVER_IP']); //parametre tanımla		
	$guncelle->bindParam(':id', $_POST['ID']); //parametre tanımla		
	$guncelle->execute(); //sorguyu çalıştır
	

  $updateGoTo = "?SistemAyarlari=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$row_SistemAyarlari = $db->query("SELECT ID, SERVER_IP, FIRMA_ISMI FROM SISTEM_CONFIG")->fetch();


?>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">OMES <?php echo $diller['sistemAyarlari'];?><a href="?SistemAyarSil&tumu=ok" class="btn btn-danger" id="sprytrigger1" style="float:right" onClick="return confirm('<?php echo $diller['silTumunuMesaj'];?>');">
    <?php echo $diller['fabrikaAyarlari']; ?></a></div>
  <div class="panel body">
  <table class="table table-hover" align="center">
    <tr valign="baseline">
      <td nowrap align="right">QPU SERVER IP:</td>
      <td><span id="sprytextfield1">
    <input class="form-control" type="text" name="SERVER_IP" value="<?php echo $row_SistemAyarlari['SERVER_IP']; ?>">
      <span class="textfieldRequiredMsg"<?php echo $diller['bosgecilemez'];?></span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><?php echo $diller['firmaAdi'];?>:</td>
      <td><span id="sprytextfield2">
        <input class="form-control" type="text" name="FIRMA_ISMI" value="<?php echo htmlentities($row_SistemAyarlari['FIRMA_ISMI'], ENT_COMPAT, 'utf-8'); ?>" size="32">
        <span class="textfieldRequiredMsg"><?php echo $diller['bosgecilemez'];?></span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input class="form-control btn btn-info" type="submit" value="<?php echo $diller['guncelle'];?>"></td>
    </tr>
  </table></div></div></div>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="ID" value="<?php echo $row_SistemAyarlari['ID']; ?>">
</form>
<div class="tooltipContent" id="sprytooltip1"><?php echo $diller['silTumunuMesaj'];?></div>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
