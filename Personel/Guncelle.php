<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = $db->prepare("UPDATE PERSONELLER
  SET TID=:TID, AD=:AD, SOYAD=:SOYAD, ADRES=:ADRES, TEL=:TEL, GSM=:GSM, EMAIL=:EMAIL, 
  ACIKLAMA=:ACIKLAMA, CALISIYOR=:CALISIYOR, KAYIT_TARIHI=:KAYIT_TARIHI, KULLANICI_ADI=:KULLANICI_ADI,
  SIFRE=:SIFRE, B_YF=:B_YF WHERE PID=:PID");
                
                     $updateSQL->bindParam(':TID',$_POST['TID']);
                     $updateSQL->bindParam(':AD',$_POST['AD']);
                     $updateSQL->bindParam(':SOYAD',$_POST['SOYAD']);
                     $updateSQL->bindParam(':ADRES',$_POST['ADRES']);
                     $updateSQL->bindParam(':TEL',$_POST['TEL']);
                     $updateSQL->bindParam(':GSM',$_POST['GSM']);
                     $updateSQL->bindParam(':EMAIL',$_POST['EMAIL']);
                     $updateSQL->bindParam(':ACIKLAMA',$_POST['ACIKLAMA']);
                     $updateSQL->bindParam(':CALISIYOR',$CALISIYOR);
			if($_POST['CALISIYOR']=="on"){ $CALISIYOR=true;}else{ $CALISIYOR=false;}
                     $updateSQL->bindParam(':KAYIT_TARIHI',$_POST['KAYIT_TARIHI']);
                     $updateSQL->bindParam(':KULLANICI_ADI',$_POST['KULLANICI_ADI']);
                     $updateSQL->bindParam(':SIFRE',$_POST['SIFRE']);
					 $updateSQL->bindParam(':PID',$_POST['PID']);
					    $updateSQL->bindParam(':B_YF',$B_YF);//yonetici ise true user ise false
						if($_POST['B_YF']=="on"){ $B_YF=true;}else{ $B_YF=false;}
$updateSQL->execute();

  $updateGoTo = "?Personel&gnc=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Personel = "-1";
if (isset($_GET['PersonelGuncelle'])) {
  $colname_Personel = $_GET['PersonelGuncelle'];
}
$row_Personel = $db->query("SELECT * FROM PERSONELLER WHERE PID ='$colname_Personel'")->fetch();

$row_Terminal = $db->query("SELECT TID, TERMINAL_AD FROM TERMINALLER")->fetchAll();

?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div class="panel panel-green">
<div class="panel panel-heading"><?php echo $diller['personelAyarlari'];?> <?php echo $diller['guncelle'];?><a class="btn btn-warning" style="float:right" href="?Personel"><?php echo $diller['listele']; ?></a></div>
<div class="panel body table-responsive">
  <table class="table table-hover">
    <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['kullaniciAdi'];?>:</th>
      <td><span id="sprytextfield1">
        <input class="form-control" type="text" name="KULLANICI_ADI" value="<?php echo htmlentities($row_Personel['KULLANICI_ADI'], ENT_COMPAT, 'utf-8'); ?>" size="32">
        <span class="textfieldRequiredMsg"><?php echo $diller['bosgecilemez'];?></span></span></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['parola'];?>:</th>
      <td><span id="sprypassword1">
      <input class="form-control" type="password" name="SIFRE" value="<?php echo htmlentities($row_Personel['SIFRE'], ENT_COMPAT, 'utf-8'); ?>" size="32">
      <span class="passwordRequiredMsg"><?php echo $diller['bosgecilemez'];?></span><span class="passwordMinCharsMsg"><?php echo $diller['minKarakter'];?>(6)</span><span class="passwordMaxCharsMsg"><?php echo $diller['maxKarakter'];?>(15)</span></span></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['terminalAdi'];?>:</th>
      <td><span id="spryselect1">
        <select class="form-control" name="TID">
          <option value="-1" <?php if (!(strcmp(-1, $row_Personel['TID']))) {echo "selected=\"selected\"";} ?>><?php echo $diller['seciniz'];?></option>
          <?php
foreach($row_Terminal as $row_Terminal) {  
?>
          <option value="<?php echo $row_Terminal['TID']?>"<?php if (!(strcmp($row_Terminal['TID'], $row_Personel['TID']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Terminal['TERMINAL_AD']?></option>
          <?php
} 
?>
        </select>
        <span class="selectInvalidMsg"><?php echo $diller['gecerlibirogesec'];?></span><span class="selectRequiredMsg"><?php echo $diller['gecerlibirogesec'];?></span></span></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['ad'];?>:</th>
      <td><input name="AD" type="text" class="form-control" value="<?php echo htmlentities($row_Personel['AD'], ENT_COMPAT, 'utf-8'); ?>" size="32" maxlength="15"></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['soyad'];?>:</th>
      <td><input name="SOYAD" type="text" class="form-control" value="<?php echo htmlentities($row_Personel['SOYAD'], ENT_COMPAT, 'utf-8'); ?>" size="32" maxlength="15"></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['adres'];?>:</th>
      <td><span id="sprytextarea1">
      <textarea name="ADRES" cols="32" class="form-control"><?php echo htmlentities($row_Personel['ADRES'], ENT_COMPAT, 'utf-8'); ?></textarea>
      <span id="countsprytextarea1">&nbsp;</span><span class="textareaMaxCharsMsg"><?php echo $diller['maxKarakter'];?>.</span></span></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['tel'];?>:</th>
      <td><span id="sprytextfield2">
      <input class="form-control" type="text" name="TEL" value="<?php echo htmlentities($row_Personel['TEL'], ENT_COMPAT, 'utf-8'); ?>" size="32">
<span class="textfieldInvalidFormatMsg"><?php echo $diller['gecersizformat'];?></span></span></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['gsm'];?>:</th>
      <td><span id="sprytextfield3">
      <input class="form-control" type="text" name="GSM" value="<?php echo htmlentities($row_Personel['GSM'], ENT_COMPAT, 'utf-8'); ?>" size="32">
<span class="textfieldInvalidFormatMsg"><?php echo $diller['gecersizformat'];?></span></span></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['eposta'];?>:</th>
      <td><span id="sprytextfield4">
      <input class="form-control" type="text" name="EMAIL" value="<?php echo htmlentities($row_Personel['EMAIL'], ENT_COMPAT, 'utf-8'); ?>" size="32">
<span class="textfieldInvalidFormatMsg"><?php echo $diller['gecersizformat'];?></span></span></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['aciklama'];?>:</th>
      <td><textarea name="ACIKLAMA" cols="32" class="form-control"><?php echo htmlentities($row_Personel['ACIKLAMA'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['aktif'];?>:</th>
      <td><label class="switch"><input <?php if (!(strcmp($row_Personel['CALISIYOR'],'1'))) {echo "checked=\"checked\"";} ?> type="checkbox" name="CALISIYOR"><span class="slider round"></span></label></td>
    </tr>
	   <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['yonetici'],"/",$diller['kullanici'];?>:</th>
      <td><label class="switch">
        <input name="B_YF" type="checkbox" <?php if (!(strcmp($row_Personel['B_YF'],'1'))) {echo "checked=\"checked\"";} ?> type="checkbox">
<span class="slider round" data-toggle="tooltip" title="<?php echo $diller['yoneticiYetkiMesaj']; ?>"></span></label>
        </td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right"><?php echo $diller['kayitTarihi'];?>:</th>
      <td><?php echo substr(htmlentities($row_Personel['KAYIT_TARIHI'], ENT_COMPAT, 'utf-8'),0,19); ?><input class="form-control" type="hidden" name="KAYIT_TARIHI" value="<?php echo htmlentities($row_Personel['KAYIT_TARIHI'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap><input class="form-control btn btn-info" type="submit" value="<?php echo $diller['guncelle'];?>"></td>
    </tr>
  </table></div></div>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="PID" value="<?php echo $row_Personel['PID']; ?>">
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {validateOn:["blur", "change"], minChars:6, maxChars:15});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["change", "blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"], counterId:"countsprytextarea1", maxChars:200, counterType:"chars_remaining", isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "phone_number", {validateOn:["blur", "change"], useCharacterMasking:true, isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "phone_number", {validateOn:["blur", "change"], useCharacterMasking:true, isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email", {validateOn:["blur", "change"], isRequired:false, useCharacterMasking:true});
</script>