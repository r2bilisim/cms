<?php if(isset($_POST['GRPID']) || isset($_GET['GRPID']))
	{
	?>
	<div class="col-sm-8">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<h4><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> <?php echo $diller['epostaAyar']; ?></h4>
			</div>
			<div class="panel-body table-responsive">
				<form name="epostaAyarFormu" <?php if($rowEposta->rowCount()){ echo "action='WebRandevu/crud/guncelle.php?guncelle'";}else {echo "action='WebRandevu/crud/ekle.php?ekle'";} ?> method="post">	
					<table class="table table-hover">	
						<tr>
							<td><?php echo $diller['epostaSunucu']; ?>:</td>
							<td><input required type="text" class="form-control" maxlength="50" placeholder="<?php echo $diller['epostaPlaceholder_1']; ?>" name="host" value="<?php if(isset($row_EpostaAyar['host'])){ echo $row_EpostaAyar['host'];}?>"></td>
						</tr>
						<tr>
							<td><?php echo $diller['portAdresi']; ?>:</td>
							<td><input required type="text" class="form-control" maxlength="10" placeholder="<?php echo $diller['epostaPlaceholder_2']; ?>" name="port" value="<?php if(isset($row_EpostaAyar['port'])){ echo $row_EpostaAyar['port'];}?>"></td>
						</tr>
						<tr>
							<td><?php echo $diller['kullaniciAdi']; ?>:</td>
							<td><input required type="text" class="form-control" maxlength="50" placeholder="<?php echo $diller['epostaPlaceholder_3']; ?>" name="username" value="<?php if(isset($row_EpostaAyar['username'])){ echo $row_EpostaAyar['username'];}?>"></td>
						</tr>
						<tr>
							<td><?php echo $diller['parola']; ?>:</td>
							<td><input required type="text" class="form-control" maxlength="50" name="password" value="<?php if(isset($row_EpostaAyar['password'])){ echo $row_EpostaAyar['password'];}?>"></td>
						</tr>
						<tr>
							<td><?php echo $diller['gonderici']; ?>:</td>
							<td><input required type="text" class="form-control" maxlength="50" placeholder="<?php echo $diller['epostaPlaceholder_4']; ?>" name="fromMesaj" value="<?php if(isset($row_EpostaAyar['fromMesaj'])){ echo $row_EpostaAyar['fromMesaj'];}?>"></td>
						</tr>
					</tr>
					<tr>
						<td><?php echo $diller['mesajBasligi']; ?>:</td>
						<td><input required type="text" class="form-control" maxlength="50" placeholder="<?php echo $diller['epostaPlaceholder_5']; ?>" name="subject" value="<?php if(isset($row_EpostaAyar['subject'])){ echo $row_EpostaAyar['subject'];}?>"></td>
					</tr>				
					<tr><td><?php echo $diller['aktif']; ?></td>
						<td>
							<label class="switch" data-toggle="tooltip" title="<?php echo $diller['epostaPlaceholder_6']; ?>" >
								<input type="checkbox" name="Aktif" value="1" <?php if(isset($row_EpostaAyar['Aktif']) && $row_EpostaAyar['Aktif']==1){ echo "checked"; }?>>
								<span class="slider round"></span>
							</label> <?php echo $diller['epostaAyarMesaj']; ?>				
						</td>
					</tr>
					<tr><td colspan="2">
						<input type="hidden" name="GRPID" value="<?php echo $GRPID; ?>" />
						<?php if($rowEposta->rowCount()){ ?>
							<button name="epostaAyarBtn" class="btn btn-warning form-control"><?php echo $diller['guncelle']; ?></button>
							<?php }else{ ?>
							<button name="epostaAyarBtn" class="btn btn-success form-control"><?php echo $diller['kaydet']; ?></button>	
						<?php } ?>
					</td>
					</tr>
				</form>
			</table>
		</div>
		<div class="panel-footer">
			<?php echo $diller['epostaAyar']; ?>
		</div>
	</div>
</div>

<?php } ?>