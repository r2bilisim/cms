<?php
$query_biletMakinesi = "SELECT MAKINE_ADRESI, MAKINE_ADI, MAKINE_TURU FROM BILET_MAKINELERI ORDER BY MAKINE_ADRESI";
$query_biletMakinesi = $db->prepare($query_biletMakinesi);
$query_biletMakinesi->execute();

  $all_biletMakinesi = $row_biletMakinesi = $query_biletMakinesi->fetchAll();
  $totalRows_biletMakinesi = count($all_biletMakinesi);
?>
<?php if ($totalRows_biletMakinesi > 0) { // Show if recordset not empty ?>
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading"><?php echo $diller['biletMakinesiList']; ?> </div>
  <div class="panel body table-responsive">
  <table id="tablo" class="table table-hover">
  <thead>
    <tr>
      <th><?php echo $diller['makineAdresi']; ?></th>
      <th> <?php echo $diller['makineAdi']; ?></th>
      <th> <?php echo $diller['makineTuru']; ?></th>
      <th><?php echo $diller['guncelle']; ?></th>
      <th><?php echo $diller['sil']; ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($row_biletMakinesi as $row_biletMakinesi){ ?>
      <tr>
        <td>#<?php echo $row_biletMakinesi['MAKINE_ADRESI']; ?></td>
        <td><?php echo $row_biletMakinesi['MAKINE_ADI']; ?></td>
        <td><?php if($row_biletMakinesi['MAKINE_TURU']==1){echo "Kiosk"; }else if($row_biletMakinesi['MAKINE_TURU']==2){ echo $diller['buton']; }else{ echo $diller['diger'];}?></td>
        <td><a class="btn btn-info" href="?BiletMakinesiGuncelle=<?php echo $row_biletMakinesi['MAKINE_ADRESI']; ?>" ><?php echo $diller['guncelle'];?></a></td>
        <td><a href="?BiletMakinesiSil=<?php echo $row_biletMakinesi['MAKINE_ADRESI']; ?>" class="btn btn-danger" id="sprytrigger1" onClick="return confirm('<?php echo $diller['silmePopupMesaj'];?>');"><?php echo $diller['sil'];?></a></td>
      </tr>
      <?php }  ?>
	</tbody>
  </table>
  </div></div></div><div class="tooltipContent" id="sprytooltip1"><?php echo $diller['silMesaj'];?></div>
  <script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
  </script>
  <?php } // Show if recordset not empty ?>
  
<?php if ($totalRows_biletMakinesi == 0) { // Show if recordset empty ?>
  <p><?php echo $diller['listMesaj'];?></p>
  
  <?php } // Show if recordset empty ?>