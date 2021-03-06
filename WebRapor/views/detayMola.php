<?php include 'WebRapor/class/rapor.php'; ?>
<?php include 'WebRapor/class/sorgu.php'; ?>
<?php include 'WebRapor/class/istatistik.php'; ?>
<?php $rapor = new Rapor(); ?>
<?php $sorgu = new Sorgu(); ?>
<?php $istatistik = new Istatistik(); ?>
<?php $personelID=isset($_POST['personelID'])?$_POST['personelID']:"0"; ?>
<?php $basTarih =isset($_POST['basTarihi'])?$_POST['basTarihi']:""; ?>
<?php $bitTarih =isset($_POST['bitTarihi'])? $_POST['bitTarihi']:""; ?>
<div class="col-xl-12 col-lg-12">
	<div class="card panel-info ">
		<div class="card-header panel-heading">
			<h4 class="card-title"><?php echo $diller['detayMola']; ?></h4>
			<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
			<div class="heading-elements">
				<ul class="list-inline mb-0">
					<li><a data-action="reload"><i class="icon-reload"></i></a></li>
					<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
				</ul>
			</div>
		</div>
		<div class="card-body">
			<div class="card-block">
				<form action="?WebRapor&detayMola" method="post">
                    <div class="col-md-3">  
						<span><?php echo $diller['sorumluPersonel']; ?></span>  					
						<select id="personelID" name="personelID" onchange="this.form.submit()" class="form-control">
							<option value="0"><?php echo $diller['ad']." ".$diller['seciniz']; ?></option>
							<?php foreach ($sorgu->Cek("PERSONELLER","AD","PID!=1") as $row) { 
							?>   
							<option value="<?php echo $row->PID; ?>"<?php echo (isset($_POST['personelID']) && $_POST['personelID']==$row->PID)? "selected":"";?>><?php echo $row->AD;?></option>
							<?php 
							} ?>
						</select>   						
				</div>
				<div class="col-md-3">                       
					<div><?php echo $diller['randevuBasTarihi']; ?></div>
					<input readonly required type="text" value="<?php echo isset($basTarih)?$basTarih:"";?>" autocomplete="off" id="randevuBasTarihi" name="basTarihi" placeholder="<?php echo $diller['seciniz']; ?>" class="datepicker btn btn-default" onfocus="this.value='';">
				</div>
				<div class="col-md-3">                           	                      
					<div><?php echo $diller['randevuBitTarihi']; ?></div>
					<input readonly required type="text" value="<?php echo isset($bitTarih)?$bitTarih:"";?>" autocomplete="off" id="randevuBitTarihi" name="bitTarihi" placeholder="<?php echo $diller['seciniz']; ?>" class="datepicker btn btn-default" onfocus="this.value='';">
				</div>  
				<div class="col-md-3">                                                   
					
					<div><?php echo $diller['sSearch']; ?></div>
					<button class="btn btn-info form-control"><?php echo $diller['sSearch'];?></button>
				</div>                                      
			</form> 
		</div>
		<div class="table-responsive">
			<table id="tablo" class="table table-hover table-striped table-bordered mb-0">
				<thead>
					<tr>
						<th><?php echo $diller['sorumluPersonel']; ?></th>
						<th><?php echo $diller['terminalAdi']; ?></th>                        
						<th><?php echo $diller['molaBaslangic']; ?></th>
						<th><?php echo $diller['molaBitis']; ?></th>
						<th><?php echo $diller['molada']; ?></th>
						<th><?php echo $diller['molaSuresi']; ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($rapor->MolaDetayRapor($personelID,$basTarih,$bitTarih) as $row) { 
					?>      
					<tr>                           
						<td class="text-truncate"><?php echo $row->PERSONEL_AD; ?></td>
						<td class="text-truncate"><?php echo $row->TERMINAL_AD; ?></td>            
						<td class="text-truncate"><?php echo date("Y-m-d h:i:s", strtotime($row->BAS_TARIH)); ?></td>
						<td class="text-truncate"><?php echo ($row->BIT_TARIH)?date("Y-m-d h:i:s", strtotime($row->BIT_TARIH)):"<span class='tag tag-danger'>".$diller['molada']."</span>"; ?></td>
						<td class="text-truncate"><?php echo ($row->MOLADA==0)?$diller['hayir']:"<span class='tag tag-info'>".$diller['evet']."</span>"; ?></td>
						<td class="text-truncate"><?php echo ($row->MOLADA==0)?'<span class="tag tag-success">'.$row->MOLA_SURESI.' '.$diller['dak'].'</span>':"<span class='tag tag-danger'>".$diller['molada']."</span>"; ?> 
						</td>                              
					</tr>
					<?php } ?>
				</tbody>            
			</table>
		</div>
	</div>
	
	<div class="panel-footer">
		<?php echo $diller['detayliRapor'];?>
	</div>
</div>
</div>
					