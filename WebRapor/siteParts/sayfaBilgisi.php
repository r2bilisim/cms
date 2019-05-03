<?php if(isset($_GET['tatil']) && $_GET['tatil']=="on" && empty($GRPID)){
	$col=8;
	$modalTitle=$diller['randevuTatil'];
	$modalContent=$diller['randevuTatilBilgisi'];
}
	?>
<?php if(isset($_GET['randevu']) && $_GET['randevu']=="on" && empty($GRPID)){
	$col=8;
	$modalTitle=$diller['randevuKisitlama'];
	$modalContent=$diller['randevuKisitlamaBilgisi'];
}
?>
<?php if(isset($_GET['takvim']) && $_GET['takvim']=="on" && empty($GRPID)){ 
	$col=8;
	$modalTitle=$diller['takvimAyar'];
	$modalContent=$diller['takvimAyarBilgisi'];
} ?>
<?php if(isset($_GET['oturum']) && $_GET['oturum']=="on" && empty($GRPID)){ 
	$col=8;
	$modalTitle=$diller['oturumAyar'];
	$modalContent=$diller['oturumAyarBilgisi'];
} ?>
<?php if(isset($_GET['mail']) && $_GET['mail']=="on" && empty($GRPID)){ 
	$col=8;
	$modalTitle=$diller['epostaAyar'];
	$modalContent=$diller['epostaAyarBilgisi'];
} ?>
<?php if(isset($_GET['sms']) && $_GET['sms']=="on" && empty($GRPID)){ 
	$col=8;
	$modalTitle=$diller['smsAyar']." (".$diller['sms'].")";
	$modalContent=$diller['smsAyarBilgisi'];
} ?>
<?php if(isset($_GET['sistem']) && $_GET['sistem']=="on" && empty($GRPID)){	
	$col=4;
	$modalTitle=$diller['sistemAyarlari'];
	$modalContent=$diller['sistemAyarBilgisi'];
} ?>
<?php if(isset($modalTitle)){ ?> 
		<div class="col-sm-<?php echo $col;?>">
			<div class="panel panel-info">
				<div class="panel-heading">
				<h4><i class="glyphicon glyphicon-info-sign"></i><?php echo $diller['webRandevu']," ",$modalTitle; ?></h4>           
				</div>
				<div class="panel-body">
				<?php echo $modalContent; ?>
				</div>
				<div class="panel-footer">
				<?php echo $diller['bilgiPaneli']; ?>
				</div>
			</div>
		</div>
<?php } ?>
