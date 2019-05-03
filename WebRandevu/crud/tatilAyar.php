<?php if(isset($_POST['GRPID']) || isset($_GET['GRPID']))
{			
 if(isset($_GET['tarihGuncelle'])){ $id=$_GET['tarihGuncelle']; 
$tatil = $db->query("SELECT id,tatilTarihi,tatilPeriyot,tatilAciklama,aktif FROM RANDEVU_TATIL_AYAR WHERE id=$id")->fetch();
?>

<div class="col-sm-4">
            <div class="panel panel-info">
				<div class="panel-heading">        
			<h4><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> <?php echo  $diller['randevuTatil']," ",$diller['guncelle'];?></h4>
			</div>
			<div class="panel-body table-responsive">
			<form method="post" name="tatilTarihiForm" action="WebRandevu/crud/guncelle.php?guncelle">
			<table class="table table-hover">
				<tr>
					<td><?php echo $diller['tarih']; ?>:</td>
					<td style="padding:5px"><input value="<?php echo date("d.m.Y",strtotime($tatil['tatilTarihi'])); ?>" readonly required type="text" autocomplete="off" id="tatilTarihi" name="tatilTarihi" placeholder="Tarih Seçin" class="datepicker btn btn-default" ></td>
				</tr>
				<tr>
					<td><?php echo $diller['periyot']; ?>:</td>
					<td style="padding:5px"><select class="form-control" name="tatilPeriyot" id="tatilPeriyot">
						<option value="1" <?php if($tatil['tatilPeriyot']==1){ echo "selected";} ?>><?php echo $diller['tumgun'];?></option>
						<option value="2" <?php if($tatil['tatilPeriyot']==2){ echo "selected";} ?>><?php echo $diller['ogledenOnce'];?></option>
						<option value="3" <?php if($tatil['tatilPeriyot']==3){ echo "selected";} ?>><?php echo $diller['ogledenSonra'];?></option>
					</select></td>
				</tr>
				<tr>
					<td data-toggle="tooltip" data-placement="right" title="<?php echo $diller['ornekTatil']; ?>"><?php echo $diller['tatilAdi'];?>:</td>
					<td style="padding:5px">
					<textarea required  placeholder="<?php echo $diller['tatilAciklama'];?>" class="form-control" maxlength="50" name="tatilAciklama" cols="30" rows="3"><?php echo $tatil['tatilAciklama']; ?></textarea></td>
				</tr>
				<tr><td><?php echo $diller['aktif']; ?>:</td>
				<td colspan="2"> <label class="switch" data-toggle="tooltip" title="<?php echo $diller['tatilMesaj']; ?>" >
				<input type="checkbox" name="aktif" value="1" <?php if($tatil['aktif']==1){ echo "checked"; } ?> />
				<span class="slider round"></span>
				</label></td>
				</tr>
				<tr>				
					<td colspan="2" style="padding:5px">
					<input type="hidden" name="GRPID" value="<?php echo $GRPID; ?>" />
					<input type="hidden" value="<?php echo $tatil['id']; ?>" name="id" />
					<button name="tatilDurumBtn" onclick="return tarihKontrol();" class="btn btn-primary form-control"><?php echo $diller['guncelle'];?></button>
					</td>
				</tr>
			</table>
			</form>
          </div>
		  <div class="panel-footer">
		  <?php echo $diller['tatiller'];?>
		  </div>
        </div>
		</div>
<?php }else{ ?>
<div class="col-sm-6 col-md-4">
             <div class="panel panel-warning">
				<div class="panel-heading">        
			<h4><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> <?php echo  $diller['randevuTatil']," ",$diller['ekle'];?></h4>
			</div>
			<div class="panel-body table-responsive">
			<form method="post" name="tatilTarihiForm" action="WebRandevu/crud/ekle.php?ekle">
			<table class="table table-hover">
				<tr>
					<td><?php echo $diller['tarih']; ?>:</td>
					<td style="padding:5px">
					<input required readonly type="text" autocomplete="off" id="tatilTarihi" name="tatilTarihi" placeholder="<?php echo $diller['tarih']," ",$diller['seciniz']; ?>" class="datepicker btn btn-default" ></td>
				</tr>
				<tr>
					<td><?php echo $diller['periyot']; ?>:</td>
					<td style="padding:5px"><select class="form-control" name="tatilPeriyot" id="tatilPeriyot">
						<option value="1"><?php echo $diller['tumgun'] ;?></option>
						<option value="2"><?php echo $diller['ogledenOnce'] ;?></option>
						<option value="3"><?php echo $diller['ogledenSonra'] ;?></option>
					</select></td>
				</tr>
				<tr>
					<td data-toggle="tooltip" title="<?php echo $diller['ornekTatil']; ?>"><?php echo $diller['tatilAdi']; ?>:</td>
					<td style="padding:5px">
					<textarea placeholder="<?php echo $diller['tatilAciklama'];?>" required class="form-control" maxlength="50" name="tatilAciklama" cols="30" rows="3"></textarea></td>
				</tr>
				<tr><td><?php echo $diller['aktif']; ?>:</td>
				<td colspan="2"> <label class="switch" data-toggle="tooltip" title="<?php echo $diller['tatilMesaj']; ?>" >
				<input type="checkbox" name="aktif" value="1" checked />
				<span class="slider round"></span>
				</label></td>
				</tr>
				<tr>				
					<td colspan="2" style="padding:5px">
					<input type="hidden" name="GRPID" value="<?php echo $GRPID; ?>" />
			<button name="tatilDurumBtn" onClick="return tarihKontrol();" class="btn btn-warning form-control"><?php echo $diller['ekle']; ?></button>
					</td>
				</tr>
			</table>
			</form>
          </div>
		  <div class="panel-footer">
		  <?php echo $diller['tatiller'];?>
		  </div>
        </div>
</div>
<?php } ?>

        <div class="col-sm-12">
          <div class="panel panel-info">
			<div class="panel-heading">
			<h4><strong><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong></strong><a name="git" ></a>
				 <?php if(isset($_GET['tarihGuncelle'])){?><a class="btn btn-success" href="?WebRandevu&GRPID=<?php echo $GRPID; ?>&tatil"><?php echo $diller['ekle']; ?></a><?php }?>
				<a href="WebRandevu/crud/sil.php?GRPID=<?php echo $GRPID; ?>&tumTatilSil" class="btn btn-danger" style="float:right"
				data-toggle="tooltip" title="<?php echo $diller['silMesaj']; ?>" onclick="return confirm('<?php echo $diller['silTumunuMesaj']; ?>');"><?php echo $diller['tumunuSil']; ?></a> </h4>
			</div>
			<div class="panel-body table-responsive">
		  <?php 
		  		$tatil = $db->query("SELECT id,tatilTarihi,tatilPeriyot,tatilAciklama,aktif FROM RANDEVU_TATIL_AYAR WHERE GRPID='$GRPID' ORDER BY tatilTarihi", PDO::FETCH_ASSOC);
				if ( $tatil->rowCount() ){
					?>
		    <table id="tablo" class="table table-hover">			
			<thead>
			<tr>
				<th><?php echo $diller['durum'];?></th><th><?php echo $diller['tatilAdi'];?></th><th><?php echo $diller['periyot'];?></th><th><?php echo $diller['tarih'];?></th><th><?php echo $diller['guncelle'];?></th><th><?php echo $diller['sil'];?></th>
			</tr>
			</thead>
			<tbody>
          <?php		
						foreach($tatil as $row)
						{				
					?>
			<tr>
				<td><?php if($row['aktif']){?><div class="alert alert-success"><i class="glyphicon glyphicon-ok"></i><?php echo  $diller['aktif'];?></div><?php }else{?><div class="alert alert-danger"><i class="glyphicon glyphicon-remove"></i><?php echo $diller['pasif'];?></div><?php } ?></td>
				<td><?php echo $row['tatilAciklama']; ?></td>
				<td><?php if($row['tatilPeriyot']==1){ echo $diller['tumgun']; }
					else if($row['tatilPeriyot']==2){ echo $diller['ogledenOnce']; }
					else if($row['tatilPeriyot']==3){ echo $diller['ogledenSonra']; }
					else { echo "Belirsiz periyot!"; } ?></td>
				<td><?php echo turkcetarih("d-F-Y, l", $row['tatilTarihi']); ?></td>
				<td><a href="?WebRandevu&GRPID=<?php echo $GRPID; ?>&tatil&tarihGuncelle=<?php echo $row['id']; ?>" class="btn btn-primary"><?php echo  $diller['guncelle'];?></a></td>
				<td><a href="WebRandevu/crud/sil.php?GRPID=<?php echo $GRPID; ?>&tarihSil=<?php echo $row['id']; ?>"
				data-toggle="tooltip" title="<?php echo $diller['silMesaj']; ?>" onclick="return confirm('<?php echo $diller['silmePopupMesaj'];?>');" class="btn btn-danger"><?php echo  $diller['sil'];?></a></td>
			</tr>					
				<?php
				} }else
				{ ?>

					<div class="alert alert-danger"><?php echo  $diller['listMesaj'];?> Eklemek için yukarıdaki formu kullanın.</div>
					<?php
				}
				?>
				</tbody>
			</table>
			</div>
			<div class="panel-footer">
			<?php echo $diller['tatiller'];?>
			</div>
          </div>
        </div>
<?php } ?>