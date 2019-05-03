  <div class="col-sm-8">
          <div class="panel panel-warning">
			<div class="panel-heading">
				<h4><?php echo $diller['webRandevu']," ",$diller['sistemAyarlari']; ?></h4>
			</div>
			<div class="panel-body table-responsive">
		  <?php 
		  		$gruplar = $db->query("SELECT * FROM GRUPLAR WHERE Webrandevu=1 ORDER BY GRPID", PDO::FETCH_ASSOC);
				if ( $gruplar->rowCount() ){
					?>
		    <table class="table table-hover">			
			<thead>
			<tr>
				<th><?php echo $diller['durum']; ?></th><th><?php echo $diller['grupIsmi']; ?></th><th><?php echo $diller['sistemAcKapa']; ?></th><th></th>
			</tr>
			</thead>
          <?php		
						foreach($gruplar as $row)
						{				
					?>
			<tr>
				<td><?php if($row['AKTIF']){?><div class="alert alert-success"><i class="icon-checkmark2"></i><?php echo $diller['aktif'];?></div><?php }else{?><div class="alert alert-danger"><i class="icon-cross"></i><?php echo $diller['pasif'];?></div><?php } ?></td>
				<td><?php echo $row['GRUP_ISMI']; ?></td>
			<td><form action="WebRandevu/crud/guncelle.php?guncelle" name="sistemDurumFormu" method="post">		
				 <label class="switch" data-toggle="tooltip" title="<?php echo $diller['sistemAcKapa']; ?>" >
					<input type="checkbox" name="AKTIF" value="1" <?php if($row['AKTIF']){ echo "checked"; }?>>
					<span class="slider round"></span>
				</label>
				<?php if($row['AKTIF']){ echo $diller['aktif']; }else{ echo $diller['pasif'];} ?>
				</td>
				<td>
				<input type="hidden" name="GRPID" value="<?php echo $row['GRPID']; ?>" />
					<button name="sistemDurumBtn" class="btn btn-<?php if($row['AKTIF']){ echo "success"; }else{ echo "danger";} ?> form-control">
					<span class="icon-floppy-disk"></span> <?php echo $diller['kaydet']; ?></button>
				</form>
			</td>					
			</tr>					
				<?php
				} }else
				{ ?>
					<div class="alert alert-danger"><?php echo $diller['sistemAyarListMesaj'];?></div>
					<?php
				}
				?>
			</table>
			</div>
			<div class="panel-footer">
			<?php echo $diller['sistemAyarlari']; ?>
			</div>
          </div>
        </div>