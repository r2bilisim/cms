<?php include 'WebRapor/class/rapor.php'; ?>
<?php include 'WebRapor/class/sorgu.php'; ?>
<?php include 'WebRapor/class/istatistik.php'; ?>
<?php $rapor = new Rapor(); ?>
<?php $sorgu = new Sorgu(); ?>
<?php $istatistik = new Istatistik(); ?>
<?php $_SESSION['GRPID']=isset($_POST['grupServis'])?$_POST['grupServis']:"0"; ?>
<div class="col-xl-12 col-lg-12">
        <div class="card panel-danger">
            <div class="card-header panel-heading">
                <h4 class="card-title"><?php echo $diller['islemRapor']; ?></h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
                <span><?php echo $diller['toplamBiletSayisi']; ?>:</span> <span class="tag tag-info"><?php echo $istatistik->BiletSayisi(); ?></span>                
                 <span><?php echo $diller['bekleyenIslem']; ?>:</span> <span class="tag tag-danger"><?php echo $istatistik->IslemSayisi(); ?></span>
                <span><?php echo $diller['bitenIslem']; ?>:</span> <span class="tag tag-primary"><?php echo $istatistik->IslemSayisi(1); ?></span>
                <span><?php echo $diller['bekleyenKisiSayisi']; ?>:</span> <span class="tag tag-success"><?php echo $istatistik->KuyrukSayisi(); ?></span>
               
            </div>
            <div class="card-body">
                <div class="card-block">
                   <form action="?WebRapor&anlikIslem" method="post" > 
                    <p class="col-md-3">  
                                         
                            <select name="grupServis" onchange="this.form.submit()" class="form-control">
                                <option value="0"><?php echo $diller['grupServis']." ".$diller['seciniz']; ?></option>
                                <?php foreach ($sorgu->Cek("GRUPLAR","GRUP_ISMI") as $row) { 
                                ?>   
                                <option value="<?php echo $row->GRPID; ?>"<?php echo (isset($_POST['grupServis']) && $_POST['grupServis']==$row->GRPID)? "selected":"";?>><?php echo $row->GRUP_ISMI;?></option>
                                <?php 
                            } ?>
                            </select> 
                                           
                </p>  </form> 
               

                </div>
                <div class="table-responsive">
                    <table id="tablo" class="table table-hover table-striped table-bordered mb-0">
                        <thead>
                            <tr>
                                <th><?php echo $diller['grupServis']; ?></th>
                                <th><?php echo $diller['terminalAdi']; ?></th>
                                <th><?php echo $diller['bekleyenIslem']; ?></th>
                                <th><?php echo $diller['bitenIslem']; ?></th>
                                <th><?php echo $diller['toplamBiletSayisi']; ?></th>
                                <th><?php echo $diller['sonAlinanBilet']; ?></th>
                                <th><?php echo $diller['sonIslemSaati']; ?></th>
                                <th><?php echo $diller['sonIslemYapilanBilet']; ?></th>
                                <th><?php echo $diller['toplamIslemSuresi']; ?></th>
                                <th><?php echo $diller['ortalamaIslemSuresi']; ?></th>
                                <th><?php echo $diller['ortalamaIslemBeklemeSuresi']; ?></th>
                                <th><?php echo $diller['maxIslemSuresi']; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rapor->TerminalBiletAnlikRapor($_SESSION['GRPID']) as $row) { 
                                ?>      
                            <tr>
                                <td class="text-truncate"><?php echo $row->GRUP; ?></td>
                                <td class="text-truncate"><?php echo $row->TERMINAL; ?></td>
                                <td class="text-truncate"><?php echo $row->BEKLEYEN_ISLEM; ?></td>
                                <td class="text-truncate"><?php echo $row->BITEN_ISLEM; ?></td>
                                <td class="text-truncate"><?php echo $row->TOPLAM_BILET; ?></td>
                               <td class="text-truncate"><span class="tag tag-default tag-success"><?php echo $row->SON_ALINAN_BILET; ?></span>
                               </td>
                                <td class="text-truncate"><?php echo $row->SON_ISLEM_SAATI; ?></td>
                                <td class="text-truncate"><?php echo $row->SON_ISLEM_YAPILAN_BILET; ?></td>
                                <td class="text-truncate"><?php echo $row->TOPLAM_ISLEM_SURESI; ?></td>
                                <td class="text-truncate"><?php echo $row->ORTALAMA_ISLEM_SURESI; ?></td>
                                <td class="text-truncate"><?php echo $row->ORTALAMA_BEKLEME_SURESI; ?></td>
                                <td class="text-truncate"><?php echo $row->MAX_ISLEM_SURESI; ?></td>
                            </tr>
                             <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
                <div class="panel-footer">
<?php echo $diller['anlikRapor'];?>
</div>
        </div>
    </div>
