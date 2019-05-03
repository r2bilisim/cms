<footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  &copy; <?php echo date("Y"); ?> <a href="http://r2bilisim.com" target="_blank" class="text-bold-800 grey darken-2"><?php echo $diller['developer']." ".base64_decode("RS5Lw5ZNw5xSQ8Oc"); ?></a>, All rights reserved. </span>
<span class="float-md-right d-xs-block d-md-inline-block">     
            <?php include("fonksiyonlar/php/getRealip.php"); ?>    
          <span class='btn-warning'><?php echo $diller['icIP']; ?>:</span>
          <span class='btn-success'><?php echo getRealIpAddr(); ?></span>
          <span class='btn-info'><?php echo $diller['disIP']; ?>:</span>
          <span class='btn-danger'><?php echo @gethostbyname(php_uname('n')); /* php 5.3 sonrası php_uname('n') yerine gethostname() kullan! */ ?></span>
         <i class="icon-android-globe"></i>
</span></p>
    </footer>

     <!-- BEGIN PAGE VENDOR JS-->
    <script src="app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app.js" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="app-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
     <!-- BEGIN PAGE LEVEL JS-->

    <?php include("app-assets/js/scripts/charts/chartjs/bar/column.php");?>

    <!-- END PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->

 <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->    
            <link rel="stylesheet" type="text/css" href="dist/plugin/datatables/datatables.min.css"/>
            
            <script type="text/javascript" src="dist/plugin/datatables/pdfmake.min.js"></script>
            <script type="text/javascript" src="dist/plugin/datatables/vfs_fonts.js"></script>
            <script type="text/javascript" src="dist/plugin/datatables/datatables.min.js"></script>
            <!-- Datatables config -->
            <?php include_once("dist/plugin/datatables/config.datatables.php");?>
            <!-- Datatables config -->
            <?php //include_once("fonksiyonlar/php/modal.php"); ?>
            
            <script>
                $(document).ready(function(){
                    $('[data-toggle="tooltip"]').tooltip();  
                });
                
            </script>
            <?php 
                //Notify (bildirim) mesajları
                if(isset($_GET['durum']))
                {
                    if($_GET['durum']=='ekle'){
                        $ptitle="Omes"; $pmesaj=$diller['kayitBasariliMesaj']; $ptype="success"; $pIcon="ok";
                    }   
                    if($_GET['durum']=='sil'){
                        $ptitle="Omes"; $pmesaj=$diller['silindiMesaj']; $ptype="danger"; $pIcon="remove";
                    }                   
                    if($_GET['durum']=='gnc'){ 
                        $ptitle="Omes"; $pmesaj=$diller['guncellemeBasariliMesaj']; $ptype="info"; $pIcon="info";
                    }       
                    if($_GET['durum']=='hata'){
                        $ptitle="Omes"; $pmesaj=$diller['islemHatasi']; $ptype="warning"; $pIcon="question";
                    }                                   
                ?>
                <script>
                    $(document).ready(function(){                   
                        $.notify({
                            // options
                            icon: 'glyphicon glyphicon-<?php echo $pIcon; ?>-sign',
                            title: "<?php echo $ptitle; ?>",
                            message: "<?php echo $pmesaj; ?>",
                            url: '#',
                            target: '_blank'
                            },{
                            // settings
                            element: 'body',
                            position: null,
                            type: "<?php echo $ptype; ?>",
                            allow_dismiss: true,
                            newest_on_top: false,
                            showProgressbar: false,
                            placement: {
                                from: "bottom",
                                align: "right"
                            },
                            offset: 10,
                            spacing: 10,
                            z_index: 1031,
                            delay: 3000,
                            timer: 1000,
                            url_target: '_blank',
                            mouse_over: null,
                            animate: {
                                enter: 'animated fadeInDown',
                                exit: 'animated fadeOutUp'
                            },
                            onShow: null,
                            onShown: null,
                            onClose: null,
                            onClosed: null,
                            icon_type: 'class',
                            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                            '<span data-notify="icon"></span> ' +
                            '<span data-notify="title"><strong>{1}</strong></span> ' +
                            '<div data-notify="message">{2}</div>' +
                            '<div class="progress" data-notify="progressbar">' +
                            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                            '</div>' +
                            '<a href="{3}" target="{4}" data-notify="url"></a>' +
                            '</div>' 
                        });
                    });
                </script>

                <?php
                }
            ?>  
            <?php ob_end_flush(); ?>