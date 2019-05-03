<?php
	if(isset($_GET["sil"]) || isset($_GET["ekle"]) || isset($_GET["gnc"]))
	{
		@$mesaj=($_GET["sil"]=="ok")? $diller['silindiMesaj']:"";
		@$mesaj=($_GET["ekle"]=="ok")? $diller['kayitBasariliMesaj']:"";
		@$mesaj=($_GET["gnc"]=="ok")? $diller['guncellemeBasariliMesaj']:"";		
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
					<p><strong><?php echo $mesaj; ?></strong></p>
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

<?php if(isset($_GET["hata"]) and $_GET["hata"]=="Bid" )
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    $("#hata").click(function(){
        $("#hata").fadeOut();       
    });
});
</script><!-- Jquery ile fadein fadeout için -->
    <div id="hata" class="alert alert-danger"><?php echo $diller['anabutonMesaj_1']; ?> <span class="btn btn-red">(<?php echo $_GET["ButonID"]; ?>)</span>  <?php echo $diller['anabutonMesaj_2']; ?> </div>
<?php
}
?><?php if(isset($_GET["AnaButonEkle"]) and $_GET["AnaButonEkle"]=="ok" )
{
?>
<script>
<!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    $("#eklendi").fadeOut(6000);
});<!-- Jquery ile fadein fadeout için -->
</script>
    <div id="eklendi" class="btn btn-success"><?php echo $diller['kayitBasariliMesaj']; ?> <a class="btn btn-red" href="?AnaButonListele"><?php echo $diller['anabutonMesaj_3']; ?></a> <?php echo $diller['anabutonMesaj_4'];?> </div>
<?php
}
?>

<?php if(isset($_GET["AnaButonGuncelle"]) and $_GET["AnaButonGuncelle"]=="ok" )
	{
	?>
	<script>
		<!-- Jquery ile fadein fadeout için -->
		$(document).ready(function(){
			$("#eklendi").click(function(){
				$("#eklendi").fadeOut();       
			});
		});<!-- Jquery ile fadein fadeout için -->
	</script>
    <div id="eklendi"><span class="btn btn-success"><?php echo $diller['guncellemeBasariliMesaj']; ?><a class="btn btn-red" href="?AnaButonListele"><?php echo $diller['anabutonMesaj_3']; ?>.</a><a class="btn btn-info" href="?AnaButonEkle"><?php echo $diller['anabutonMesaj_4'];?></a> </span></div>
	<?php
	}
?>
