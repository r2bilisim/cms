<?php if(isset($_POST['GRPID']) || isset($_GET['GRPID']))
	{
	?>
	<div class="col-sm-4">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<h4><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> <?php echo $diller['randevuKisitlama']; ?></h4>
			</div>
			<div class="panel-body table-responsive">
				<form name="haftaSonuDurumFormu" <?php if($row->rowCount()){ echo "action='WebRandevu/crud/guncelle.php?guncelle'";}else {echo "action='WebRandevu/crud/ekle.php?ekle'";} ?> method="post">	
					<table class="table table-hover">	
						<tr><td>1</td><td><?php echo $diller['sedeceHaftasonu']; ?>:</td>
							<td>
								<label class="switch" data-toggle="tooltip" title="<?php echo $diller['sedeceHaftasonuMesaj']; ?>" >
									<input type="radio" name="randevuSecimi" value="1" <?php if(isset($row_RandevuAyar['randevuSecimi']) && $row_RandevuAyar['randevuSecimi']==1){ echo "checked"; }?>
									>
									<span class="slider round"></span>
								</label>
							</td>
						</tr>
						<tr><td>2</td><td><?php echo $diller['haftaiciHaftasonu']; ?> <a class="glyphicon glyphicon-link" href="?WebRandevu&tatil=on"><strong><?php echo $diller['tatiller']; ?></strong></a>:</td>
							<td>
								<label class="switch" data-toggle="tooltip" title="<?php echo $diller['haftaiciHaftasonuMesaj']; ?>">
									<input type="radio" name="randevuSecimi" value="2" <?php if(isset($row_RandevuAyar['randevuSecimi']) && $row_RandevuAyar['randevuSecimi']==2){ echo "checked"; }?>
									>
									<span class="slider round"></span>
								</label>
							</td>
						</tr>
						<tr><td>3</td><td><?php echo $diller['sadeceSeciliGunler']; ?> <a class="glyphicon glyphicon-link" href="?WebRandevu&tatil=on"><strong><?php echo $diller['tatiller']; ?></strong></a>:</td>
							<td>
								<label class="switch" data-toggle="tooltip" title="<?php echo $diller['sadeceSeciliGunlerMesaj']; ?>" >
									<input type="radio" name="randevuSecimi" value="3" <?php if(isset($row_RandevuAyar['randevuSecimi']) && $row_RandevuAyar['randevuSecimi']==3){ echo "checked"; }?>
									>
									<span class="slider round"></span>
								</label>
							</td>
						</tr>
						<tr><td>4</td><td><?php echo $diller['kisitlamaYok']; ?>:</td> 
							<td>
								<label class="switch" data-toggle="tooltip" title="<?php echo $diller['kisitlamaYokMesaj']; ?>">
									<input type="radio" name="randevuSecimi" value="4" <?php if(isset($row_RandevuAyar['randevuSecimi']) && $row_RandevuAyar['randevuSecimi']==4){ echo "checked"; }?>
									>
									<span class="slider round"></span>
								</label>				
							</td>
						</tr>
						<tr><td colspan="2">
							<input type="hidden" name="GRPID" value="<?php echo $GRPID; ?>" />
							<?php if($row->rowCount()){ ?>
								<button name="haftaSonuDurumBtn" class="btn btn-warning form-control"><?php echo $diller['guncelle']; ?></button>
								<?php }else{ ?>
								<button name="haftaSonuDurumBtn" class="btn btn-success form-control"><?php echo $diller['ekle']; ?></button>	
							<?php } ?>
						</td>
						</tr>
					</form>
				</table>
			</div>
			<div class="panel-footer">
				<?php echo $diller['randevuKisitlama']; ?>
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h4><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> <?php echo $diller['randevuSinirlama'];?></h4>
			</div>
			<div class="panel-body">
				<p>
					<form name="biletSinirlamaDurumFormu" <?php if($row->rowCount()){ echo "action='WebRandevu/crud/guncelle.php?guncelle'";}else {echo "action='WebRandevu/crud/ekle.php?ekle'";} ?> method="post">		
						<?php echo $diller['sinirlama']; ?>:<label class="switch" data-toggle="tooltip" title="<?php echo $diller['sinirlamaMesaj_1']; ?>" >
							<input type="checkbox" name="biletSinirla" <?php if(isset($row_RandevuAyar['biletSinirla']) && $row_RandevuAyar['biletSinirla']){ echo "checked"; }?>
							>
							<span class="slider round"></span>
						</label><?php if(isset($row_RandevuAyar['biletSinirla']) && $row_RandevuAyar['biletSinirla']){ echo $diller['aktif']; }else{ echo $diller['pasif'];} ?>
						<div style="margin-bottom:5px;"><input class="form-control alert-success" type="number" min="1" max="1000" required name="biletSinirSayisi" value="<?php if(isset($row_RandevuAyar['biletSinirSayisi'])){ echo $row_RandevuAyar['biletSinirSayisi']; } ?>" data-toggle="tooltip" title="<?php echo $diller['sinirlamaMesaj_2']; ?>"></div>
						
						<div>
							<input type="hidden" name="GRPID" value="<?php echo $GRPID; ?>" />
							<?php if($row->rowCount()){ ?>
								<button name="biletSinirlamaDurumBtn" class="btn btn-info form-control"><?php echo $diller['guncelle']; ?></button>
								<?php }else{ ?>
								<button name="biletSinirlamaDurumBtn" class="btn btn-success form-control"><?php echo $diller['ekle']; ?></button>
							<?php } ?>
						</div>
					</form>
				</p>
			</div>			
			<div class="panel-footer">
				<?php echo $diller['randevuSinirlama']; ?>
			</div>
		</div>
	</div>
<?php } ?>