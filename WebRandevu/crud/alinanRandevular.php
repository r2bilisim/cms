<div class="col-md-12">
<div class="card panel panel-info">
<div class="panel-heading"><h4><?php echo $diller['alinanRandevular ']; ?></h4></div>
		<div class="panel-body table-responsive">
		<form action="?WebRandevu&ana&#git" name="randevuAraForm" method="post">
		<div class="col-md-4">
			<?php $row_Gruplar=$db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR WHERE Webrandevu=1")->fetchAll(); ?>
					
					<div><?php echo $diller['aramaBirimi ']; ?></div>
					<div>
							<select name="GRPID" class="form-control">
							<?php foreach($row_Gruplar as $row_Gruplar) { ?>
							<option value="<?php echo $row_Gruplar['GRPID']; ?>" <?php if(isset($_POST['GRPID']) && ($row_Gruplar['GRPID']==$_POST['GRPID'])){echo "selected"; } ?>><?php echo $row_Gruplar['GRUP_ISMI']; ?></option>										
							<?php } ?>
							</select>
					</div>
						<div><?php echo $diller['randevuBasTarihi']; ?>:</div>
						<div>
					<input readonly required type="text" autocomplete="off" id="randevuBasTarihi" name="randevuBasTarihi" placeholder="<?php echo $diller['seciniz']; ?>" class="datepicker btn btn-default" >
					</div>
						<div><?php echo $diller['randevuBitTarihi']; ?>:</div>
						<div>
					<input readonly required type="text" autocomplete="off" id="randevuBitTarihi" name="randevuBitTarihi" placeholder="<?php echo $diller['seciniz']; ?>" class="datepicker btn btn-default" >
					</div>
					<div>&nbsp;</div>
					<div>
					<button name="kriterAraBtn"  onclick="return checkDate();" class="btn btn-warning form-control"><?php echo $diller['tariheGoreAra']; ?></button>
					</div>
				
				</div>
				<div class="col-md-8">				
					<div><?php echo $diller['cumleyeGoreAra']; ?>:</div>				
						<input type="text" name="kelime" class="form-control" placeholder="<?php echo $diller['musteriAdi'],",",$diller['musteriSoyadi'],",",$diller['tckimlik'],",",$diller['tel'],"..."; ?>">
						<div>&nbsp;</div>						
						<button name="cumleAraBtn" class="btn btn-success form-control"><?php echo $diller['cumleyeGoreAra']; ?></button>
												
				</div>
			</form>
	</div>
</div>	
</div> 
<div class="col-md-12"><?php if(isset($_POST['GRPID']) || isset($_GET['GRPID']))	{ ?>
			<div class="card panel panel-grey">
            <div class="card-header panel-heading">
                <div class="panel-heading">
		<strong><?php $row_Gruplar=$db->query("SELECT GRUP_ISMI FROM GRUPLAR WHERE Webrandevu=1 AND GRPID='$GRPID'")->fetch(); ?>
			<?php if(isset($row_Gruplar['GRUP_ISMI'])){ echo $row_Gruplar['GRUP_ISMI']; } ?> </strong> 
			<?php echo $diller['kayitlar']; ?>
			<a href="WebRandevu/crud/sil.php?GRPID=<?php echo $GRPID; ?>&tumRandevuSil" class="btn btn-danger" style="margin-left:10px"
				onclick="return confirm('<?php echo $diller['silTumunuMesaj']; ?>');" 
				data-toggle="tooltip" title="<?php echo $diller['dikkat']; ?> <?php echo $row_Gruplar['GRUP_ISMI']; ?> <?php echo $diller['serviseAitTumKayitlarSilinir']; ?>"><?php echo $diller['tumunuSil']; ?></a><a name="git" ></a>
			</div>
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
			<div class="panel-body table table-responsive">
		  <?php 
		  if(isset($_POST['kriterAraBtn']) ){ 
		  $randevuBasTarihi =date("Y-m-d", strtotime($_POST['randevuBasTarihi']));
		  $randevuBitTarihi =date("Y-m-d", strtotime($_POST['randevuBitTarihi']));
		  
		  $randevu = $db->query("SELECT id ,TID	,GRPID,musteriAd ,musteriSoyad ,musteriTc ,musteriTel 
	,randevuTarihi, randevuSaati, biletNo, randevuKayitTarihi ,randevuTalepSayisi
	FROM RANDEVU_KAYDET WHERE (GRPID='$GRPID' AND randevuKayitTarihi BETWEEN '$randevuBasTarihi' AND '$randevuBitTarihi' ) ORDER BY id DESC", PDO::FETCH_ASSOC);
		  }
		   if(isset($_POST['cumleAraBtn']) ){ 
		   $kelime=$_POST['kelime'];
		   
		 
	$randevu = $db->query("SELECT id ,TID ,GRPID ,musteriAd ,musteriSoyad ,musteriTc ,musteriTel 
	,randevuTarihi, randevuSaati, biletNo, randevuKayitTarihi ,randevuTalepSayisi, IPTAL
	FROM RANDEVU_KAYDET WHERE (GRPID='$GRPID') AND (musteriAd LIKE '%$kelime%' OR musteriSoyad LIKE '%$kelime%' OR musteriTc LIKE '%$kelime%' OR musteriTel LIKE '%$kelime%' ) ORDER BY id DESC ", PDO::FETCH_ASSOC);
	}
				if(isset($randevu) && $randevu->rowCount()){	?>
		    <table id="tablo" class="table table-hover table-striped table-bordered mb-0">			
			<thead>
			<tr>	
				<th><?php echo $diller['guncelle']; ?></th>
				<th><?php echo $diller['sil']; ?></th>
				<th><?php echo $diller['musteriAdi']; ?></th>
				<th><?php echo $diller['musteriSoyadi']; ?></th>
				<th><?php echo $diller['tckimlik']; ?></th>
				<th><?php echo $diller['tel']; ?></th>
				<th><?php echo $diller['randevuTarihi']; ?></th>
				<th><?php echo $diller['saat']; ?></th>
				<th><?php echo $diller['biletNo']; ?></th>
				<th><?php echo $diller['tarih']; ?></th>
				<th><?php echo $diller['randevuTalepSayisi']; ?></th>			
				<th><?php echo $diller['durum']; ?></th>			
			</tr>
			</thead>
			<tbody>			
          <?php	foreach($randevu as $row)	{ if(isset($_GET['id']) && $_GET['id']==$row['id']){ $secili=true;}else{ $secili=false;}?>
			<tr>
				<td>
				<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#randevuGNC<?php echo $row['id']; ?>" ><?php echo $diller['guncelle']; ?></a>				
				</td>
				<td>
				<a type="button" class="btn btn-danger" data-toggle="modal" data-target="#randevuSIL<?php echo $row['id']; ?>" ><?php echo $diller['sil']; ?></a>
				</td>
				<td><?php echo $row['musteriAd']; ?></td>
				<td><?php echo $row['musteriSoyad'];?></td>		
				<td><?php echo $row['musteriTc']; ?></td>				
				<td><?php echo $row['musteriTel']; ?></td>				
				<td><?php echo turkcetarih("d-F-Y, l", $row['randevuTarihi']);?></td>							
				<td><?php echo substr($row['randevuSaati'],0,5);?></td>								
				<td><?php echo $row['biletNo']; ?></td>								
				<td><?php echo turkcetarih("d-F-Y, l", $row['randevuKayitTarihi']); ?></td>
				<td><?php echo $row['randevuTalepSayisi']; ?></td>								
				<td><?php if(isset($row['IPTAL']) && $row['IPTAL']==true){?><span style="color:red;"><?php echo $diller['iptalEdildi']; ?></span><?php }else{ ?><span style="color:green"><?php echo $diller['aktif'];?></span><?php } ?></td>								
					<?php include("WebRandevu/modals/randevuGuncelle.php"); ?>			
					<?php include("WebRandevu/modals/randevuSil.php"); ?>			
			</tr>			
			<?php } ?>
			</tbody>
			</table>
			</div>
			<?php    }else { ?>
			<div class="alert alert-danger"><?php echo $diller['listMesaj']; ?></div>			
			 <?php	} }?>
	</div>
</div>
</div>
</div>
</div>

