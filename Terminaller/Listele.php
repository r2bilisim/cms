<?php
$query_terminal = "SELECT * FROM TERMINALLER ORDER BY TID DESC";
$row_terminalListe = $db->query($query_terminal, PDO::FETCH_ASSOC);
?>
<?php
	if(isset($_GET["TGrup"]) and $_GET["TGrup"]=="ok")
	{
	?>
<script>
    $(document).ready(function(){
$('#my-modal').modal('show');
});
</script>
        <div id="my-modal" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title alert alert-success">Omes</h4>
        </div>
        <div class="modal-body">
          <p><strong><?php echo $diller['kayitBasariliMesaj']; ?></strong></p>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-success" data-dismiss="modal"><?php echo $diller['kapat']; ?></button>
        </div>
      </div>
    </div>
</div>
<?php
	}
?>
<div class="form-group">
<div class="card panel panel-grey">
            <div class="card-header panel-heading">
                <h4 class="card-title"><?php echo $diller['terminalListesi']; ?><a class="btn btn-success" style="margin-left:10px" href="?TerminalEkle&"><?php echo $diller['ekle'];?></a></h4>
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
<?php if ($row_terminalListe -> rowCount()) { // Show if recordset not empty  ?>
  <table id="tablo" class="table table-hover">
  <thead>
    <tr>
      <th>#TID</th>
      <th><?php echo $diller['eltid']; ?></th>
      <th><?php echo $diller['terminalAdi']; ?></th>
      <th><?php echo $diller['otoCagri']; ?></th>
      <th><?php echo $diller['otoSure']; ?></th>
      <th><?php echo $diller['aktif']; ?></th>
      <th><?php echo $diller['siralamaTipi']; ?></th>
      <th><?php echo $diller['cagriTipi']; ?></th>
      <th><?php echo $diller['terminalTipi']; ?></th>
      <th><?php echo $diller['terminalGrupGoster']; ?></th>   
      <th><?php echo $diller['guncelle']; ?></th>
      <th><?php echo $diller['sil']; ?></th>
    </tr>
	</thead>
	<tbody>
  <?php foreach($row_terminalListe as $row_terminalListe){ ?>
      <tr>
        <td><?php echo $row_terminalListe['TID']; ?></td>
        <td><?php echo $row_terminalListe['ELTID']; ?></td>
        <td><?php echo $row_terminalListe['TERMINAL_AD']; ?></td>
        <td><?php if($row_terminalListe['OTO_CAGRI']==0) { echo $diller['hayir'];}else { echo $diller['evet']; } ?></td>
        <td><?php echo substr($row_terminalListe['OTO_SURE'],0,8); ?></td>
        <td><?php if($row_terminalListe['AKTIF']==0){ echo $diller['hayir'];}else { echo $diller['evet'];} ?></td>
        <td><?php if($row_terminalListe['SiralamaTipi']==0){echo $diller['siralamaTipiSec'];} else if($row_terminalListe['SiralamaTipi']==1){ echo $diller['alinmaSirasi'];}else if($row_terminalListe['SiralamaTipi']==2){ echo $diller['biletNo'];} ?></td>
        <td><?php if($row_terminalListe['CagriSiralamaTipi']==0){echo $diller['siralamaTipiSec'];} else if($row_terminalListe['CagriSiralamaTipi']==1){ echo $diller['oran'];}else if($row_terminalListe['CagriSiralamaTipi']==2){ echo $diller['kuyruk'];} ?></td>
                <td><?php echo $row_terminalListe['TerminalTipi']; ?></td>
                <td><a href="?TerminalGrupListele=<?php echo $row_terminalListe["TID"]."&TERMINAL_AD=".$row_terminalListe['TERMINAL_AD']; ?>" class="btn btn-warning"><?php echo $diller['terminalGrupGoster']; ?></a></td>
        <td><a href="?TerminalGuncelle=<?php echo $row_terminalListe["TID"]; ?>" class="btn btn-info"><?php echo $diller['guncelle']; ?></a></td>
        <td><a href="?TerminalSil=<?php echo $row_terminalListe["TID"]; ?>" class="btn btn-danger" id="sprytrigger1" onClick="return confirm('<?php echo $diller["silmePopupMesaj"]; ?>');"><?php echo $diller['sil']; ?></a></td>
      </tr>
      <?php } ?>
	  </tbody>
  </table>

  <div class="tooltipContent" id="sprytooltip1"><?php echo $diller['silMesaj']; ?></div>
<script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
<?php }else{ // Show if recordset not empty ?>
<p>
    <?php echo $diller['listMesaj']; ?> <a href="?TerminalEkle"  class="btn btn-success"><?php echo $diller['ekle']; ?></a>
  <?php } // Show if recordset empty ?>
</p></div></div></div>
</div></div></div>