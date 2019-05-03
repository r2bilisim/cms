<?php include '../../Connections/baglantim.php'; ?>
<?php include '../class/rapor.php'; ?>
<?php include '../class/sorgu.php'; ?>
<?php $yol="../../fonksiyonlar/php/dilAyar.php";
if(file_exists($yol)){ include($yol); } ?>
<?php $rapor = new Rapor(); ?>
<?php $sorgu = new Sorgu(); ?>
<?php $personelID=isset($_POST['personelID'])?$_POST['personelID']:"0"; ?>
<h2><?php echo $diller['servisKapama']; ?></h2>
          <table id="tablo" class="table table-hover table-striped table-bordered mb-0">
                        <thead>
                            <tr>
                                <th><?php echo $diller['sorumluPersonel']; ?></th>
                                <th><?php echo $diller['detay']; ?></th>
                                <th><?php echo $diller['terminalAdi']; ?></th>                        
                                <th><?php echo $diller['kapanisTarihi']; ?></th>
                                <th><?php echo $diller['acilisTarihi']; ?></th>
                                <th><?php echo $diller['kapali']; ?></th>
								<th><?php echo $diller['molaSuresi']; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rapor->ServisRapor($personelID) as $row) { 
                                ?>      
                            <tr>                           
                                <td class="text-truncate"><?php echo $row->PERSONEL_AD; ?></td>
                                <td class="text-truncate"><?php echo $row->SEBEP; ?></td>                  
                                <td class="text-truncate"><?php echo $row->TERMINAL_AD; ?></td>                  
                                <td class="text-truncate"><?php echo date("Y-m-d h:i:s", strtotime($row->KAP_TAR)); ?></td>                           
                                <td class="text-truncate"><?php echo ($row->AC_TAR)?date("Y-m-d h:i:s", strtotime($row->AC_TAR)):"<span class='tag tag-danger'>".$diller['kapali']."</span>"; ?></td>
                                <td class="text-truncate"><?php echo ($row->KAPALI==0)?$diller['hayir']:"<span class='tag tag-info'>".$diller['evet']."</span>"; ?></td>
                                <td class="text-truncate"><?php echo ($row->KAPALI==0)?'<span class="tag tag-success">'.$row->KAPALI_KALMA_SURESI.' '.$diller['dak'].'</span>':"<span class='tag tag-danger'>".$diller['kapali']."</span>"; ?> 
                               </td>                              
                            </tr>
                             <?php } ?>
                        </tbody>
</table>