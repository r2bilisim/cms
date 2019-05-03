<?php include 'WebRapor/class/rapor.php'; ?>
<?php $rapor = new Rapor(); ?>
<!-- TerminalBiletRapor card görünümü(grup, terminal ve bilet sayısı bilgisi) -->
<div class="col-xl-12 col-lg-12">
   <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?php echo $diller['grupServis']; ?></h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
    <div class="row">
<?php foreach ($rapor->TerminalBiletRapor() as $row) { ?>      
    <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card" >
                <div class="card-body">
                    <div class="card-block">
                        <h4 class="card-title"><?php echo $row->GRUP; ?></h4>                         
                             <p class="card-text"><?php echo $diller['terminalAdi'];?>:<?php echo ($row->TERMINAL!="")?"<span class='tag tag-primary'>".$row->TERMINAL:"</span><span class='danger'>".$diller['bilinmiyor']."</span>"; ?></p>
                        <p class="card-text"><?php echo $diller['toplamBiletSayisi'];?>: <span class="tag tag-success"><?php echo $row->TOPLAM_BILET; ?></span></p>
                        <a href="#" class="btn btn-outline-teal"><?php echo $diller['sonAlinanBilet'];?>:<strong><?php echo $row->SON_ALINAN_BILET; ?></strong></a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
</div>
</div>
<!-- TerminalBiletRapor card görünümü(grup, terminal ve bilet sayısı bilgisi) -->
<!-- TerminalBiletRapor Liste görünümü(grup, terminal ve bilet sayısı bilgisi) -->
<div class="col-xl-8 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?php echo $diller['grupServis']; ?></h4>
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
                    <p>Total paid invoices 240, unpaid 150. <span class="float-xs-right"><a href="#">Invoice Summary <i class="icon-arrow-right2"></i></a></span></p>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th><?php echo $diller['grupServis']; ?></th>
                                <th><?php echo $diller['terminalAdi']; ?></th>
                                <th><?php echo $diller['toplamBiletSayisi']; ?></th>
                                <th><?php echo $diller['sonAlinanBilet']; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rapor->TerminalBiletRapor() as $row) { 
                                ?>      
                            <tr>
                                <td class="text-truncate"><?php echo $row->GRUP; ?></td>
                                <td class="text-truncate"><?php echo ($row->TERMINAL!="")?"<span class='tag tag-default tag-primary'>".$row->TERMINAL:"</span><span class='danger'>".$diller['bilinmiyor']."</span>"; ?></td>
                                <td class="text-truncate"><span class="tag tag-success"><?php echo $row->TOPLAM_BILET; ?></span></td>
                                <td class="text-truncate"><span class="tag tag-success"><?php echo $row->SON_ALINAN_BILET; ?></span></td>
                            </tr>
                             <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- TerminalBiletRapor Liste görünümü(grup, terminal ve bilet sayısı bilgisi) -->