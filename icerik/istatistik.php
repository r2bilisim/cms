<?php
if(isset($db)){
try{

@$query_GrupSayisi = "SELECT COUNT(*) AS GRUPSAYISI FROM GRUPLAR";
@$GrupSayisi = $db->query($query_GrupSayisi)->fetch();

@$query_TerminalSayisi = "SELECT COUNT(*) AS TERMINALSAYISI FROM TERMINALLER";
@$TerminalSayisi = $db->query($query_TerminalSayisi)->fetch();

@$query_BiletMakineSayisi = "SELECT COUNT(*) AS BILETMAKINESISAYISI FROM BILET_MAKINELERI";
@$BiletMakineSayisi = $db->query($query_BiletMakineSayisi)->fetch();

}catch(Exception $hata)
{
	echo $diller['dbHataMsg_1'];
}
?>
  <style>
.gauge {
    width: 250px;
    height: 250px;
    display: inline-block;
}
.row.display-flex {
  display: flex;
  flex-wrap: wrap;
}
.thumbnail {
  height: 100%;
}
/* extra positioning */
.thumbnail {
  display: flex;
  flex-direction: column;
}

.thumbnail .caption {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
}
  </style>
<div class="row display-flex">
    <div class="col-md-4">
    <div class="thumbnail" style="text-align:justify">
      <center><div id="gg1" class="gauge" data-value="<?php echo $GrupSayisi['GRUPSAYISI']; ?>"></div></center>
      <div class="caption">
        <h3><?php echo $diller['grupOlustur']; ?></h3>
        <p><?php echo $diller['grupMsg_1']; ?></p>
        <p><?php echo $diller['grupMsg_2']; ?></p>
        <p><a href="?GrupEkle" class="form-control btn btn-primary" role="button"><?php echo $diller['basla']; ?></a></p>
      </div>
    </div>
  </div>  
    <div class="col-md-4">
    <div class="thumbnail" style="text-align:justify">
      <center><div id="gg2" class="gauge" data-value="<?php echo $TerminalSayisi['TERMINALSAYISI']; ?>"></div></center>
      <div class="caption">
        <h3><?php echo $diller["terminalOlustur"]; ?></h3>
        <p><?php echo $diller['terminalMsg_1']; ?></p>
        <p><?php echo $diller['terminalMsg_2']; ?></p>
        <p><a href="?TerminalEkle" class="form-control btn btn-warning" role="button"><?php echo $diller['devam']; ?></a> </p>
      </div>
    </div>
  </div>
    <div class="col-md-4">
    <div class="thumbnail" style="text-align:justify">
    <center><div id="gg3" class="gauge" data-value="<?php echo $BiletMakineSayisi['BILETMAKINESISAYISI']; ?>"></div></center>      
      <div class="caption">
        <h3><?php echo $diller["biletmakOlustur"]; ?></h3>
        <p><?php echo $diller["biletmakMsg_1"]; ?></p>
        <p><?php echo $diller["biletmakMsg_2"]; ?></p>
        <p><a href="?BiletMakinesiEkle" class="form-control btn btn-danger" role="button"><?php echo $diller['bitir']; ?></a></p>
      </div>
    </div>
  </div>
</div>
  <script src="dist/js/raphael-2.1.4.min.js"></script>
  <script src="dist/js/justgage.js"></script>
  <script>
  document.addEventListener("DOMContentLoaded", function(event) {

    var dflt = {
      min: 0,
      max: 20,
      donut: true,
      gaugeWidthScale: 0.6,
      counter: true,
      hideInnerShadow: true,
	  startAnimationTime: 2000,
      startAnimationType: ">",
      refreshAnimationTime: 1000,
      refreshAnimationType: "bounce"

    }
    var gg1 = new JustGage({
      id: 'gg1',      
      title: '<?php echo $diller["grupSayisi"]; ?>',
      defaults: dflt
    });
    var gg2 = new JustGage({
      id: 'gg2',
      title: '<?php echo $diller["termialSayisi"]; ?>',
      defaults: dflt
    });
 	var gg3 = new JustGage({
      id: 'gg3',
      title: '<?php echo $diller["biletMakinesiSayisi"]; ?>',
      defaults: dflt
    });
  });
</script>
<?php }else{ ?><div class="alert alert-danger"><?php echo $diller['dbHataMsg_2']; ?></div><?php } ?>