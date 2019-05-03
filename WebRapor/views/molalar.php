<?php include '../../Connections/baglantim.php'; ?>
<?php include '../class/rapor.php'; ?>
<?php include '../class/sorgu.php'; ?>
<?php $yol="".$_SERVER['DOCUMENT_ROOT']."/fonksiyonlar/php/dilAyar.php";
include("../../dilPaketi/tr.php"); ?>
<?php $rapor = new Rapor(); ?>
<?php $sorgu = new Sorgu(); ?>
<?php $personelID=isset($_POST['personelID'])?$_POST['personelID']:"0"; ?>

<h2><?php echo $diller['molalar']; ?></h2>
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
                            <?php foreach ($rapor->MolaRapor($personelID) as $row) { 
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