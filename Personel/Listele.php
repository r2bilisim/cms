<?php 
//PID =1 ise SÜPER ADMINDIR
$row_Personel = "SELECT PID, TID, AD, SOYAD, ADRES, TEL, GSM, EMAIL, ACIKLAMA, CALISIYOR, KAYIT_TARIHI, KULLANICI_ADI, SIFRE, OTURUM_DURUM FROM PERSONELLER WHERE PID <> 1";
$row_Personel = $db->query($row_Personel)->fetchAll();

  $totalRows_Personel = count($row_Personel);
?>

<div class="panel panel-primary">
<div class="panel panel-heading"><?php echo $diller['personelAyarlari']; ?> <a class="btn btn-success" href="?PersonelEkle"> <?php echo $diller['ekle']; ?></a></div>
<div class="panel body table-responsive" style="overflow:auto;">
<?php if ($totalRows_Personel > 0) { // Show if recordset not empty ?>
<table id="tablo" class="table table-hover table-condensed">
<thead>
  <tr>
    <th>#</th>
    <th><?php echo $diller['kullaniciAdi']; ?></th>
    <th><?php echo $diller['terminalAdi']; ?></th>
    <th><?php echo $diller['ad']; ?></th>
    <th><?php echo $diller['soyad']; ?></th>
    <th><?php echo $diller['adres']; ?></th>
    <th><?php echo $diller['tel']; ?></th>
    <th><?php echo $diller['gsm']; ?></th>
    <th><?php echo $diller['eposta']; ?></th>
    <th><?php echo $diller['aktif']; ?></th>
    <th><?php echo $diller['kayitTarihi']; ?></th>
    <th><?php echo $diller['guncelle']; ?></th>
    <th><?php echo $diller['sil']; ?></th>
    </tr>
	</thead>
	<tbody>
  <?php foreach($row_Personel as $row_Personel){ ?>
    <tr>
      <td><?php echo $row_Personel['PID']; ?></td>
      <td><?php echo $row_Personel['KULLANICI_ADI']; ?></td>
      <td>
	 <?php 

$row_Terminal = $db->query("SELECT TID, TERMINAL_AD FROM TERMINALLER WHERE TID ='$row_Personel[TID]'")->fetch();

	 ?> 
	  <?php echo $row_Terminal['TERMINAL_AD']; ?></td>
      <td><?php echo $row_Personel['AD']; ?></td>
      <td><?php echo $row_Personel['SOYAD']; ?></td>
      <td><?php echo $row_Personel['ADRES']; ?></td>
      <td><?php echo $row_Personel['TEL']; ?></td>
      <td><?php echo $row_Personel['GSM']; ?></td>
      <td><?php echo $row_Personel['EMAIL']; ?></td>
      <td><label class="switch"><input type="checkbox" disabled <?php if($row_Personel['CALISIYOR']==1){echo 'checked';} ?>><span class="slider round"></span></label></td>
      <td><?php echo substr($row_Personel['KAYIT_TARIHI'],0,19); ?></td>
      <td><a href="?PersonelGuncelle=<?php echo $row_Personel["PID"]; ?>" class="btn btn-info"><?php echo $diller['guncelle']; ?></a></td>
      <td><a href="?PersonelSil=<?php echo $row_Personel["PID"]; ?>" class="btn btn-danger" id="sprytrigger1"  onClick="return confirm('<?php echo $diller['silmePopupMesaj']; ?>');"><?php echo $diller['sil']; ?></a></td>
      </tr>
    <?php } ?>
	</tbody>
</table>
<div class="tooltipContent" id="sprytooltip1"><?php echo $diller['silMesaj']; ?></div>
<script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
<?php }else{ ?>
  <p><?php echo $diller['listMesaj']; ?></p>
<?php } ?>
</div></div>