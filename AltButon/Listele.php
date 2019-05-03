<?php 
$query_AnaButon = "SELECT * FROM BUTONLAR WHERE ANA_BTNID <>0 ORDER BY BM_ADRES, BTNID ASC";
$query_AnaButon = $db->prepare($query_AnaButon);
$query_AnaButon->execute();

  $all_biletMakinesi = $row_AnaButon = $query_AnaButon->fetchAll();
  $totalRows_AnaButon = count($all_biletMakinesi);
?>

<?php if ($totalRows_AnaButon > 0) { // Show if recordset not empty ?>
  <a name="ust"></a>
<div class="card panel panel-pink">
            <div class="card-header panel-heading">
                <h4 class="card-title"><?php echo $diller['altbuton']; ?><a class="btn btn-success" style="margin-left:10px" href="?AltButonEkle&"><?php echo $diller['ekle'];?></a></h4>
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
        <table id="tablo" class="table table-hover table-condensed ">
          <thead>
            <tr class="alert alert-info">
              <th><?php echo $diller['makineAdi']; ?></th>
              <th><?php echo $diller['anabuton']; ?> ID</th>
              <th><?php echo $diller['butonEkranMetni'] ;?></th>
              <th><?php echo $diller['altbuton']; ?> ID</th>
              <th>1.<?php echo $diller['grupOran']; ?></th>
              <th>2.<?php echo $diller['grupOran']; ?></th>
              <th>3.<?php echo $diller['grupOran']; ?></th>
              <th>4.<?php echo $diller['grupOran']; ?></th>                                    
              <th><?php echo $diller['aktif']; ?></th>
              <th><?php echo $diller['webRandevu']; ?>?</th>
              <th><?php echo $diller['guncelle']; ?></th>
              <th><?php echo $diller['sil']; ?></th>
          </tr></thead><tbody>
          <?php foreach($row_AnaButon as $row_AnaButon) { ?>
            <tr>
              <td><?php 
	
$row_BiletMakinesi =$db->query("SELECT MAKINE_ADRESI, MAKINE_ADI FROM BILET_MAKINELERI WHERE MAKINE_ADRESI = '$row_AnaButon[BM_ADRES]'")->fetch();
	  
	  echo "<span class='label label-default'>#".$row_AnaButon["BM_ADRES"]."</span></br>".$row_BiletMakinesi['MAKINE_ADI']; ?>
                
              </td>             
              <td><?php if($row_AnaButon['ANA_BTNID']==0){echo $diller['evet'];}else{ echo "<span class='label label-success'>".$row_AnaButon['ANA_BTNID']."</span>";} 
	   ?></td>
      <td><?php echo $row_AnaButon['BTN_EKRAN']; ?></td>
              <td><span class="label label-dark"><?php echo $row_AnaButon['BTNID']; ?></span></td>
              <td><?php 
$row_Grup =$db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR WHERE GRPID= '$row_AnaButon[GRP_ID]'")->fetch();
	  
	  echo "<span class='label label-default'>#".$row_AnaButon['GRP_ID']."</span></br>".$row_Grup["GRUP_ISMI"]; ?>
              <span class="badge badge-info"> <?php echo $row_AnaButon['GRP1_ORAN']; ?></span></td>
              <td><?php 
$row_Grup =$db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR WHERE GRPID= '$row_AnaButon[GRP_ID2]'")->fetch();
	  
	  echo "<span class='label label-default'>#".$row_AnaButon['GRP_ID2']."</span></br>".$row_Grup["GRUP_ISMI"]; ?>
              <span class="badge badge-success"><?php echo $row_AnaButon['GRP2_ORAN']; ?></span></td>
              <td><?php 
$row_Grup =$db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR WHERE GRPID= '$row_AnaButon[GRP_ID3]'")->fetch();
	  
	  echo "<span class='label label-default'>#".$row_AnaButon['GRP_ID3']."</span></br>".$row_Grup["GRUP_ISMI"]; ?>
              <span class="badge badge-warning"><?php echo $row_AnaButon['GRP3_ORAN']; ?></span></td>
              <td><?php 
$row_Grup =$db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR WHERE GRPID= '$row_AnaButon[GRP_ID4]'")->fetch();
	  
	  echo "<span class='label label-default'>#".$row_AnaButon['GRP_ID4']."</span></br>".$row_Grup["GRUP_ISMI"]; ?>
              <span class="badge badge-danger"><?php echo $row_AnaButon['GRP4_ORAN']; ?></span></td>  
              <td><?php if($row_AnaButon['AKTIF']==1){echo $diller['evet'];} else{ echo $diller['hayir'];} ?></td>
              <td><?php if($row_AnaButon['RandevuButonuMu']==0){echo $diller['hayir'];} else{ echo $diller['evet'];} ?></td>        
              <td><a href="?AltButonGuncelle&BTNID=<?php echo $row_AnaButon["BTNID"];?>&BM_ADRES=<?php echo $row_AnaButon["BM_ADRES"]; ?>" class="btn btn-info"><?php echo $diller['guncelle']; ?></a></td>
              <td><a href="?AltButonSil&BTNID=<?php echo $row_AnaButon["BTNID"];?>&BM_ADRES=<?php echo $row_AnaButon["BM_ADRES"]; ?>" class="btn btn-danger" id="sprytriggerSil" onClick="return confirm('<?php echo $diller['silmePopupMesaj']; ?>');"><?php echo $diller['sil']; ?></a></td>
            </tr>
            <?php } ?>
			</tbody>
        </table>
        <div class="tooltipContent" id="sprytooltipSil"><?php echo $diller['silMesaj']; ?></div>
  </div></div></div>
</div></div>
<script type="text/javascript">
var sprytooltipSil = new Spry.Widget.Tooltip("sprytooltipSil", "#sprytriggerSil");
    </script>
 <?php } else{ ?>
  <div class="btn btn-danger form-control"><?php echo $diller['listMesaj']; ?></div>
  <?php } // Show if recordset empty ?>