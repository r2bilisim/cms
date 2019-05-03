<?php 
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = $db->prepare("INSERT INTO ANATABLO_YON (ATID, TID, YON, Port) VALUES (:ATID, :TID, :YON, :Port)");
                     
					$insertSQL->bindParam(':ATID',$_POST['ATID'],PDO::PARAM_INT);
					$insertSQL->bindParam(':TID',$_POST['TID'],PDO::PARAM_INT);
					$insertSQL->bindParam(':YON',$_POST['YON'],PDO::PARAM_INT);
					$insertSQL->bindParam(':Port',$_POST['Port'],PDO::PARAM_INT);

			$insertSQL->execute();	

  $insertGoTo = "?AnaTabloYonListele&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}


$row_AnaTablo =$db->query("SELECT ATID, TABLO_ADI FROM ANATABLOLAR")->fetchAll();


$row_Terminal = $db->query("SELECT TID, TERMINAL_AD FROM TERMINALLER")->fetchAll();

?>
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading"><?php echo $diller['anatabloYonEkle']; ?></div><div class="panel body table-responsive">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table class="table table-hover" align="center">
    <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['anatablo']; ?>:</th>
      <td><select class="form-control" name="ATID">
        <?php 
foreach($row_AnaTablo as $row_AnaTablo) {  
?>
        <option value="<?php echo $row_AnaTablo['ATID']?>" ><?php echo $row_AnaTablo['TABLO_ADI']?></option>
        <?php
}
?> 
      </select></td></tr>
    <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['terminalAdi']; ?>:</th>
      <td><select class="form-control" name="TID">
        <?php 
foreach($row_Terminal as $row_Terminal) {  
?>
        <option value="<?php echo $row_Terminal['TID']?>" ><?php echo $row_Terminal['TERMINAL_AD']?></option>
        <?php
} 
?>
      </select></td></tr>
    <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['yon']; ?>:</th>
      <td><select class="form-control" name="YON">
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>><?php echo $diller['yukari']; ?></option>
        <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>><?php echo $diller['asagi']; ?></option>
        <option value="3" <?php if (!(strcmp(3, ""))) {echo "SELECTED";} ?>><?php echo $diller['sag']; ?></option>
        <option value="4" <?php if (!(strcmp(4, ""))) {echo "SELECTED";} ?>><?php echo $diller['sol']; ?></option>
        <option value="5" <?php if (!(strcmp(5, ""))) {echo "SELECTED";} ?>><?php echo $diller['kapali']; ?></option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['port']; ?>:</th>
      <td><input class="form-control" type="number" min="0" placeholder="<?php echo $diller['birdegergiriniz'];?>" name="Port" value="0" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap><input class="btn btn-success form-control" type="submit" value="<?php echo $diller['ekle']; ?>"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
</div></div></div>
<p>
<!--
bu kısımda PhpSocket/client.php de yazdığım kodlarla 
QPU serial porta bağlanılacak ve gerekli ayarlar 
yapılarak kayıt ve güncelleme işlemleri yerine getirilecek.</p>
-->