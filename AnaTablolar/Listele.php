<?php

$query_AnaTablo = "SELECT ATID, TABLO_ADI, TABLO_TURU FROM ANATABLOLAR ORDER BY ATID ASC";
$query_AnaTablo = $db->prepare($query_AnaTablo);
$query_AnaTablo->execute();


  $all_AnaTablo = $row_AnaTablo = $query_AnaTablo->fetchAll();
  $totalRows_AnaTablo = count($all_AnaTablo); 
?>
<div class="form-group">
  <div class="card panel panel-grey">
            <div class="card-header panel-heading">
                <h4 class="card-title"><?php echo $diller['anatablolar']; ?><a class="btn btn-success" style="margin-left:10px" href="?AnaTabloEkle&"><?php echo $diller['ekle'];?></a></h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                     <ul class="list-inline mb-0">                        
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
             <div class="card-body">
                <div class="card-block">
  <div class="panel body table-responsive">
<?php if ($totalRows_AnaTablo > 0) { // Show if recordset not empty ?>

<table id="tablo" class="table table-hover">
    <thead>
	<tr>
      <th><?php echo $diller['anatablo'];?> ID</th>
      <th><?php echo $diller['anatabloAdi'];?></th>
      <th><?php echo $diller['anatabloTuru'];?></th>
      <th><?php echo $diller['guncelle'];?></th>
      <th><?php echo $diller['sil'];?></th>
    </tr>
	</thead>
	<tbody>
    <?php foreach($row_AnaTablo as $row_AnaTablo) { ?>
      <tr>
        <td><?php echo $row_AnaTablo['ATID']; ?></td>
        <td><?php echo $row_AnaTablo['TABLO_ADI']; ?></td>
        <td><?php if($row_AnaTablo['TABLO_TURU']==1){ echo "LCD";} else if($row_AnaTablo['TABLO_TURU']==2){ echo "LED";} else{ echo $diller['bilinmiyor'];}?></td>
        <td><a class="btn btn-info" href="?AnaTabloGuncelle=<?php echo $row_AnaTablo['ATID']; ?>"><?php echo $diller['guncelle'];?></a></td>
        <td><a href="?AnaTabloSil=<?php echo $row_AnaTablo['ATID']; ?>" class="btn btn-danger" id="sprytrigger1" onClick="return confirm('<?php echo $diller['silmePopupMesaj'];?>');"><?php echo $diller['sil'];?></a></td>
      </tr>
      <?php } ?>
	  </tbody>
  </table>
 <div class="tooltipContent" id="sprytooltip1"><?php echo $diller['silMesaj'];?></div>
  <script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
  <?php } // Show if recordset not empty ?>
  
<p>
  <?php if ($totalRows_AnaTablo == 0) { // Show if recordset empty ?>
   <?php echo $diller['listMesaj'];?> <a class="btn btn-success" href="?AnaTabloEkle"><?php echo $diller['olusturmakIcinTiklayin']; ?></a>
    
  <?php } // Show if recordset empty ?>
</p>
</div></div></div>
</div></div></div>