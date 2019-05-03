<?php include 'WebRapor/class/rapor.php'; ?>
<?php include 'WebRapor/class/sorgu.php'; ?>
<?php include 'WebRapor/class/istatistik.php'; ?>
<?php $rapor = new Rapor(); ?>
<?php $sorgu = new Sorgu(); ?>
<?php $istatistik = new Istatistik(); ?>
<?php $grupID=isset($_POST['grupServis'])?$_POST['grupServis']:""; ?>
<?php $terminalID=isset($_POST['terminal'])?$_POST['terminal']:""; ?>
<?php $biletNo=isset($_POST['biletNo'])?$_POST['biletNo']:""; ?>
<?php $basTarih =isset($_POST['basTarihi'])?$_POST['basTarihi']:""; ?>
<?php $bitTarih =isset($_POST['bitTarihi'])? $_POST['bitTarihi']:""; ?>
<?php $musteriAdi=isset($_POST['musteriAdi'])?$_POST['musteriAdi']:""; ?>
<?php $musteriNo=isset($_POST['musteriNo'])?$_POST['musteriNo']:""; ?>
<div class="col-xl-12 col-lg-12">
        <div class="card panel-info ">
            <div class="card-header panel-heading">
                <h4 class="card-title"><?php echo $diller['islemRapor']; ?></h4>
                <div class="row">
                    <div class="col-md-4">
                   <span><?php echo $diller['toplamBiletSayisi']; ?>:</span> <span class="tag tag-info"><?php echo $istatistik->BiletSayisi(); ?></span>                            
                    </div>
                    <div class="col-md-4">
                       <span><?php echo $diller['bekleyenIslem']; ?>:</span> <span class="tag tag-danger"><?php echo $istatistik->IslemSayisi(); ?></span>               
                    </div>
                    <div class="col-md-4">
                     <span><?php echo $diller['transferBilet']; ?>:</span> <span class="tag tag-warning"><?php echo $istatistik->TransferBiletSayisi(); ?></span>   
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                  <span><?php echo $diller['toplamIslemSuresi']; ?>:</span> <span class="tag tag-primary"><?php echo $istatistik->ToplamIslemSuresi()." ".$diller['dak']; ?></span>
                </div>
                    <div class="col-md-4">
                      <span><?php echo $diller['bitenIslem']; ?>:</span> <span class="tag tag-primary"><?php echo $istatistik->IslemSayisi(1); ?></span>  
                    </div>
                    <div class="col-md-4">
                  <span><?php echo $diller['webRandevu']; ?>:</span> <span class="tag tag-primary"><?php echo $istatistik->TransferBiletSayisi(1); ?></span>     
                    </div>
                </div>
                 <div class="row">
                     <div class="col-md-4">
                       <span><?php echo $diller['toplamBekleyenSuresi']; ?>:</span> <span class="tag tag-success"><?php echo $istatistik->ToplamBekleyenSuresi()." ".$diller['dak']; ?></span>    
                     </div>
                    <div class="col-md-4">
                      <span><?php echo $diller['bekleyenKisiSayisi']; ?>:</span> <span class="tag tag-success"><?php echo $istatistik->KuyrukSayisi(); ?></span>   
                    </div>
                    <div class="col-md-4">
                    <span><?php echo $diller['ozelMusteri']; ?>:</span> <span class="tag tag-danger"><?php echo $istatistik->TransferBiletSayisi(2); ?></span>    
                    </div>
                 </div>

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
                   <form action="?WebRapor&detayIslem" method="post">                                                        
                          <div class="col-md-3">  
                          	<div><?php echo $diller['grupServis']; ?></div>
                            <span id="spryselect1">
                          	<select name="grupServis" class="form-control">
                                <option value="-1"><?php echo $diller['grupServis']." ".$diller['seciniz']; ?></option>
                                <?php foreach ($sorgu->Cek("GRUPLAR","GRUP_ISMI") as $row) { 
                                ?>   
                                <option value="<?php echo $row->GRPID; ?>"<?php echo (isset($_POST['grupServis']) && $_POST['grupServis']==$row->GRPID)? " selected":"";?>><?php echo $row->GRUP_ISMI;?></option>
                                <?php 
                            } ?>
                            </select> 
                            <span class="selectInvalidMsg"><?php echo $diller['gecerlibirogesec']; ?></span><span class="selectRequiredMsg"><?php echo $diller['bosgecilemez']; ?></span></span>                        
                         <div><?php echo $diller['randevuBasTarihi']; ?></div>
                           <input readonly required type="text" value="<?php echo isset($basTarih)?$basTarih:"";?>" autocomplete="off" id="randevuBasTarihi" name="basTarihi" placeholder="<?php echo $diller['seciniz']; ?>" class="datepicker btn btn-default" onfocus="this.value='';">
                        </div>                       
                          <div class="col-md-3"> 
                          	<div><?php echo $diller['terminalAdi']; ?></div>
                            <select name="terminal" class="form-control">
                                <option value="0"><?php echo $diller['terminalAdi']." ".$diller['seciniz']; ?></option>
                                <?php foreach ($sorgu->Cek("TERMINALLER","TERMINAL_AD") as $row) { 
                                ?>   
                                <option value="<?php echo $row->TID; ?>"<?php echo (isset($_POST['terminal']) && $_POST['terminal']==$row->TID)? "selected":"";?>><?php echo $row->TERMINAL_AD;?></option>
                                <?php 
                            } ?>
                            </select>                          	
							<div><?php echo $diller['randevuBitTarihi']; ?></div>
                         <input readonly required type="text" value="<?php echo isset($bitTarih)?$bitTarih:"";?>" autocomplete="off" id="randevuBitTarihi" name="bitTarihi" placeholder="<?php echo $diller['seciniz']; ?>" class="datepicker btn btn-default" onfocus="this.value='';">
                        </div>
                        <div class="col-md-3">
							<div><?php echo $diller['musteriAdi']; ?></div>
                        	<input type="text" name="musteriAdi" value="<?php echo isset($musteriAdi)?$musteriAdi:"";?>" class="form-control" onfocus="this.value='';">
                        	<div><?php echo $diller['tckimlik']; ?></div>
                        	<input type="number" name="musteriNo" value="<?php echo isset($musteriNo)?$musteriNo:"";?>"  class="form-control" onfocus="this.value='';">
                        </div>
                              <div class="col-md-3"> 
                             <div><?php echo $diller['biletNo']; ?></div>
                        	<input type="number" name="biletNo" value="<?php echo isset($biletNo)?$biletNo:"";?>" class="form-control" onfocus="this.value='';">
                             <div><?php echo $diller['sSearch']; ?></div>
                            <button class="btn btn-info form-control"><?php echo $diller['sSearch'];?></button>
                            </div>      
                  </form> 
                </div>
                <div class="table-responsive">
                    <table id="tablo" class="table table-hover table-striped table-bordered mb-0">
                        <thead>
                            <tr>
                        
                                <th><?php echo $diller['tarih']; ?></th>
                                <th><?php echo $diller['grupServis']; ?></th>
                                <th><?php echo $diller['musteriAdi']; ?></th>
                                <th><?php echo $diller['tckimlik']; ?></th>
                                <th><?php echo $diller['biletNo']; ?></th>
                                <th><?php echo $diller['terminalAdi']; ?></th>
                                <th><?php echo $diller['basSaati']; ?></th>
                                <th><?php echo $diller['bitSaati']; ?></th>                              
                                <th><?php echo $diller['transferBilet']; ?></th>
                                <th><?php echo $diller['ozelMusteri']; ?></th>
                          
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rapor->TerminalBiletDetayRapor($grupID,$terminalID,$biletNo,$basTarih,$bitTarih,$musteriAdi,$musteriNo) as $row) { 
                                ?>      
                            <tr>
                               
                                <td class="text-truncate"><?php echo date("d.m.Y",strtotime($row->SIS_TAR)); ?></td>
                                <td class="text-truncate"><?php echo $row->GRUP; ?></td>
                                <td class="text-truncate"><?php echo $row->MUSTERI_ADI; ?></td>
                                <td class="text-truncate"><?php echo $row->MUSTERI_NO; ?></td>
                               <td class="text-truncate"><span class="tag tag-default tag-success"><?php echo $row->BILET_NO; ?></span>
                               </td>
                                <td class="text-truncate"><?php echo $row->TERMINAL; ?></td>
                                <td class="text-truncate"><?php echo $row->ISLEM_BAS_TAR; ?></td>
                                <td class="text-truncate"><?php echo $row->ISLEM_BIT_TAR; ?></td>
                                <td class="text-truncate"><?php echo ($row->TRANSFER==1)?"<span class='tag tag-default tag-danger'>".$diller['evet']."</span>":$diller['hayir']; ?></td>
                                <td class="text-truncate"><?php echo ($row->OZEL_MUSTERI==1)?"<span class='tag tag-default tag-info'>".$diller['fiktif']."</span>":$diller['hayir']; ?></td>                               
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
<script type="text/javascript">
    var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur", "change"]});
</script>