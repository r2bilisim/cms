<?php 
$query_AnaTabloYon = "SELECT ANATABLO_YON.YID, 
	ANATABLOLAR.TABLO_ADI, 
	TERMINALLER.TERMINAL_AD,
	ANATABLO_YON.YON, 
	ANATABLO_YON.Port FROM ANATABLOLAR 
	INNER JOIN ANATABLO_YON on ANATABLOLAR.ATID=ANATABLO_YON.ATID 
	INNER JOIN TERMINALLER on TERMINALLER.TID=ANATABLO_YON.TID";
$row_AnaTabloYon = $db->query($query_AnaTabloYon, PDO::FETCH_ASSOC);
  
?>
<div class="form-group">
   <div class="card panel panel-grey">
            <div class="card-header panel-heading">
                <h4 class="card-title"><?php echo $diller['anatabloYonleri']; ?><a class="btn btn-success" style="margin-left:10px" href="?AnaTabloYonEkle&"><?php echo $diller['anatabloYonEkle'];?></a></h4>
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
<?php if ($row_AnaTabloYon -> rowCount()) {// Show if recordset not empty ?>
  <table id="tablo" class="table table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th><?php echo $diller['anatabloAdi']; ?></th>
      <th><?php echo $diller['terminalAdi']; ?></th>
      <th><?php echo $diller['yon']; ?></th>
      <th><?php echo $diller['port']; ?></th>
      <th><?php echo $diller['guncelle']; ?></th>
      <th><?php echo $diller['sil']; ?></th>
    </tr>
	</thead>
	<tbody>
    <?php foreach($row_AnaTabloYon as $row_AnaTabloYon) { ?>
      <tr>
        <td><?php echo $row_AnaTabloYon['YID']; ?></td>
        <td><?php echo $row_AnaTabloYon['TABLO_ADI']; ?></td>
        <td><?php echo $row_AnaTabloYon['TERMINAL_AD']; ?></td>
        <td><?php if($row_AnaTabloYon['YON']==1){ echo $diller['yukari'];} else if($row_AnaTabloYon['YON']==2){ echo $diller['asagi'];} else if($row_AnaTabloYon['YON']==3){ echo $diller['sag'];}else if($row_AnaTabloYon['YON']==4){ echo $diller['sol'];}else if($row_AnaTabloYon['YON']==5){ echo $diller['kapali'];}else { echo$diller['bilinmiyor']; } ?></td>
        <td><?php echo $row_AnaTabloYon['Port']; ?></td>
        <td><a class="btn btn-info" href="?AnaTabloYonGuncelle=<?php echo $row_AnaTabloYon['YID']; ?>"><?php echo $diller['guncelle']; ?></a></td>
        <td><a href="?AnaTabloYonSil=<?php echo $row_AnaTabloYon['YID']; ?>" class="btn btn-danger" id="sprytrigger1" onClick="return confirm('<?php echo $diller['silmePopupMesaj']; ?>');"><?php echo $diller['sil']; ?></a></td>
      </tr>
      <?php } ?>
	  </tbody>
  </table>
  <div class="tooltipContent" id="sprytooltip1"><?php echo $diller['silMesaj']; ?></div>
  <script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
  
<?php }else { ?>
<p>
   <?php echo $diller['listMesaj'];?> <a class="btn btn-success" href="?AnaTabloYonEkle"><?php echo $diller['olusturmakIcinTiklayin'];?>.</a>
</p>  <?php } // Show if recordset empty ?>
</div></div></div>
</div></div></div>