<?php
$colname_TerminalGrup = "-1";
if (isset($_GET['TerminalGrupListele'])) {
  $colname_TerminalGrup = $_GET['TerminalGrupListele'];
}
$row_TerminalGrup = $db->query("SELECT * FROM TERMINAL_GRUP WHERE TID ='$colname_TerminalGrup'")->fetchAll();

  $totalRows_TerminalGrup = count($row_TerminalGrup);
?>
<?php if ($totalRows_TerminalGrup > 0) { // Show if recordset not empty ?>
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading"><?php echo $diller['terminalGrupListesi']; ?><a class="btn btn-success" style="float:right" href="?TerminalGrupEkle" ><?php echo $diller['ekle']; ?></a></div><div class="panel body table-responsive">
  <table id="tablo" class="table table-hover">
  <thead>
    <tr class="alert alert-info">
      <th>TGID</th>
      <th>Terminal</th>
      <th><?php echo $diller['grupIsmi']; ?></th>
      <th><?php echo $diller['cagriOrani']; ?></th>
      <th><?php echo $diller['transferOrani']; ?></th>
      <th><?php echo $diller['cagrilan']; ?></th>
      <th><?php echo $diller['transferCagrilan']; ?></th>
      <th><?php echo $diller['yardimGrubu']; ?></th>
      <th><?php echo $diller['ayricalikli']; ?></th>
      <th><?php echo $diller['webRandevu']; ?></th>
      <th><?php echo $diller['oncelik']; ?></th>
      <th><?php echo $diller['guncelle']; ?></th>
      <th><?php echo $diller['sil']; ?></th>
    </tr>
	</thead>
	<tbody>
    <?php foreach($row_TerminalGrup as $row_TerminalGrup) { ?>
      <tr>
        <td><?php echo $row_TerminalGrup['TGID']; ?></td>
        <td><strong>
          <em>
          <?php 
$query_terminal = "SELECT TERMINAL_AD FROM TERMINALLER WHERE TID = '$row_TerminalGrup[TID]'";
$terminal = $db->query($query_terminal)->fetch();
$row_terminal = $terminal;
$totalRows_terminal = count($terminal);
 echo $row_terminal['TERMINAL_AD']; 
?>
        </em></strong></td>
        <td><strong>
          <em>
          <?php
$query_grup = "SELECT GRUP_ISMI FROM GRUPLAR WHERE GRPID = '$row_TerminalGrup[GRPID]'";
$grup = $db->query($query_grup)->fetch();
$row_grup = $grup;
$totalRows_grup = count($grup); echo $row_grup['GRUP_ISMI'];
 ?>
        </em></strong></td>
        <td><?php echo $row_TerminalGrup['CAGRI_ORAN']; ?></td>
        <td><?php echo $row_TerminalGrup['TRANSFER_ORAN']; ?></td>
        <td><?php echo $row_TerminalGrup['CAGRILAN']; ?></td>
        <td><?php echo $row_TerminalGrup['TRANSFER_CAGRILAN']; ?></td>
        <td><?php if($row_TerminalGrup['YARDIM_GRUBU']==1){echo $diller['evet'];}else {echo $diller['hayir'];} ?></td>
        <td><?php if($row_TerminalGrup['AYRICALIKLI']==1){ echo $diller['evet'];}else { echo $diller['hayir']; } ?></td>
        <td><?php if($row_TerminalGrup['webrandevu']==1){ echo $diller['evet'];}else { echo $diller['hayir']; } ?></td>
        <td><?php echo $row_TerminalGrup['ONCELIK']; ?></td>
        <td><a class="btn btn-info" href="?TerminalGrupGuncelle=<?php echo $row_TerminalGrup['TGID']; ?>"><?php echo $diller['guncelle']; ?></a></td>
        <td><a href="?TerminalGrupSil=<?php echo $row_TerminalGrup['TGID']; ?>" class="btn btn-danger" id="sprytrigger1" onClick="return confirm('<?php echo $diller['silmePopupMesaj']; ?>');"><?php echo $diller['sil']; ?></a></td>
      </tr>
      <?php } ?>
	  </tbody>
  </table>
</div></div></div>
  <div class="tooltipContent" id="sprytooltip1"><?php echo $diller['silMesaj']; ?></div>
  <script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
    </script>
<?php }else{ // Show if recordset not empty ?>

    <p class="alert alert-danger"><span class="btn btn-success">#<?php echo $_GET['TerminalGrupListele']."-".$_GET['TERMINAL_AD']; ?> </span><?php echo $diller['terminalGrupHatasi']; ?> <a href="?TerminalGrupEkle" class="btn btn-success" ><?php echo $diller['olusturmakIcinTiklayin']; ?></a></p>
    <?php } // Show if recordset empty ?>