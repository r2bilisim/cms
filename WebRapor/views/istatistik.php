<?php include 'WebRapor/class/istatistik.php'; ?>
<?php $istatistik= new Istatistik(); ?>
<div class="col-xl-12 col-lg-12">
   <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?php echo $diller['istatistik']; ?></h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-left media-middle">
                                <i class="icon-user1 deep-orange font-large-2 float-xs-left"></i>
                            </div>
                            <div class="media-body text-xs-right">
                                <h3 class="deep-orange"><?php echo $istatistik->PersonelSayisi(1); ?></h3>
                                <span><a href="?Personel"><?php echo $diller['yoneticiSayisi'];?></a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="teal"><?php echo $istatistik->PersonelSayisi(0); ?></h3>
                                <span><a href="?Personel"><?php echo $diller['personelSayisi'];?></a></span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-user1 teal font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-left media-middle">
                                <i class="icon-grid2 cyan font-large-2 float-xs-left"></i>
                            </div>
                            <div class="media-body text-xs-right">
                                <h3 class="cyan"><?php echo $istatistik->GrupSayisi();?></h3>
                                <span><a href="?GrupListele"><?php echo $diller['grupSayisi'];?></a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-left media-middle">
                                <i class="icon-paper teal font-large-2 float-xs-left"></i>
                            </div>
                            <div class="media-body text-xs-right">
                              <h3 class="teal"><?php echo $istatistik->BiletMakineSayisi(); ?></h3>
                                <span><a href="?BiletMakinesiEkle"><?php echo $diller['toplamBiletMakineSayisi'];?></a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-left media-middle">
                                <i class="icon-stack-2 teal font-large-2 float-xs-left"></i>
                            </div>
                            <div class="media-body text-xs-right">
                                <h3 class="teal"><?php echo $istatistik->TerminalSayisi(); ?></h3>
                                <span><a href="?TerminalListele"><?php echo $diller['terminalSayisi'];?></a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                 <h3 class="pink"><?php echo $istatistik->BiletSayisi(); ?></h3>
                                <span><a href="?WebRapor&BiletListele"><?php echo $diller['toplamBiletSayisi'];?></a></span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-barcode pink font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="deep-orange">64.89 %</h3>
                                <span>Conversion Rate</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-diagram deep-orange font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="cyan">423</h3>
                                <span>Support Tickets</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-ios-help-outline cyan font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="cyan">278</h3>
                                <span>New Posts</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-pencil cyan font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                        <progress class="progress progress-sm progress-cyan mt-1 mb-0" value="80" max="100"></progress>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="deep-orange">156</h3>
                                <span>New Comments</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-chat1 deep-orange font-large-2 float-xs-right"></i>
                            </div>
                            <progress class="progress progress-sm progress-deep-orange mt-1 mb-0" value="35" max="100"></progress>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="teal">64.89 %</h3>
                                <span>Bounce Rate</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-trending_up teal font-large-2 float-xs-right"></i>
                            </div>
                            <progress class="progress progress-sm progress-teal mt-1 mb-0" value="60" max="100"></progress>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="pink">423</h3>
                                <span>Total Visits</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-map1 pink font-large-2 float-xs-right"></i>
                            </div>
                            <progress class="progress progress-sm progress-pink mt-1 mb-0" value="40" max="100"></progress>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</div>
<!-- Column Chart -->
   
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $diller['islemRapor']; ?></h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            <li><a data-action="close"><i class="icon-cross2"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <canvas id="column-chart" ></canvas>
                    </div>
                </div>
            </div>
        </div>
    
    
<!--/ project charts -->

    <div class="col-xl-8 col-lg-12">
        <div class="card">
            <div class="card-body">
                <ul class="list-inline text-xs-center pt-2 m-0">
                    <li class="mr-1">
                        <h6><i class="icon-circle warning"></i> <span class="grey darken-1">Bekleyen İşlem</span></h6>
                    </li>
                    <li class="mr-1">
                        <h6><i class="icon-circle success"></i> <span class="grey darken-1">Tamamlanan</span></h6>
                    </li>
                </ul>
                <div class="chartjs">
                    <canvas id="line-stacked-area" ></canvas>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-xs-3 text-xs-center">
                        <span class="text-muted">Total Projects</span>
                        <h2 class="block font-weight-normal">18</h2>
                        <progress class="progress progress-xs mt-2 progress-success" value="70" max="100"></progress>
                    </div>
                    <div class="col-xs-3 text-xs-center">
                        <span class="text-muted">Total Task</span>
                        <h2 class="block font-weight-normal">125</h2>
                        <progress class="progress progress-xs mt-2 progress-success" value="40" max="100"></progress>
                    </div>
                    <div class="col-xs-3 text-xs-center">
                        <span class="text-muted">Completed Task</span>
                        <h2 class="block font-weight-normal">242</h2>
                        <progress class="progress progress-xs mt-2 progress-success" value="60" max="100"></progress>
                    </div>
                    <div class="col-xs-3 text-xs-center">
                        <span class="text-muted">Total Revenue</span>
                        <h2 class="block font-weight-normal">$11,582</h2>
                        <progress class="progress progress-xs mt-2 progress-success" value="90" max="100"></progress>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card card-inverse bg-info">
            <div class="card-body">
                <div class="position-relative">
                    <div class="chart-title position-absolute mt-2 ml-2 white">
                        <h1 class="display-4">84%</h1>
                        <span>Employees Satisfied</span>
                    </div>
                    <canvas id="emp-satisfaction" class="height-400 block"></canvas>
                    <div class="chart-stats position-absolute position-bottom-0 position-right-0 mb-2 mr-3 white">
                        <a href="#" class="btn bg-info bg-darken-3 mr-1 white">Statistics <i class="icon-stats-bars"></i></a> for the last year.
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--/ project charts -->
<?php include_once 'cards.php'; ?>