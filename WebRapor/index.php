<?php
/*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 11.05.2018
-- Description:	Randevu Sistemi Yönetim Paneli
-- ============================================= 
 */
// include("Connections/baglantim.php"); 
 include("fonksiyonlar/php/turkceTarih.php");
 ?>
 	<link rel="stylesheet" href="dist/plugin/datepicker/jquery-ui.css"><!--datepicker -->	
	<script
  src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"
  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
  crossorigin="anonymous"></script>
	<script type="text/javascript">
		
$(document).ready(function() {
    $('#tatilTarihi').datepicker({       
        dayNamesMin: [ "Paz","Pzts", "Sal", "Çar", "Per", "Cu", "Cmts"],
        monthNames: ["Ocak", "Subat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],    
        dateFormat: "dd.mm.yy",
        showAnim: "drop",   
		firstDay: 1
    });
	 $('#randevuBasTarihi').datepicker({       
        dayNamesMin: [ "Paz","Pzts", "Sal", "Çar", "Per", "Cu", "Cmts"],
        monthNames: ["Ocak", "Subat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],    
        dateFormat: "dd.mm.yy",
		firstDay: 1
    });
	$('#randevuBitTarihi').datepicker({       
        dayNamesMin: [ "Paz","Pzts", "Sal", "Çar", "Per", "Cu", "Cmts"],
        monthNames: ["Ocak", "Subat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],    
        dateFormat: "dd.mm.yy",
		maxDate:30,
		firstDay: 1
    });
});
</script>


  <div class="row ">
  <div class="col-sm-12">  
 <div class="row">  
	  <?php
	if(isset($_GET['istatistik'])){  include('views/istatistik.php');  }

	if(isset($_GET['anlikIslem'])){  include('views/anlikIslem.php');  }
	if(isset($_GET['anlikMolaServis'])){  include('views/anlikMolaServis.php');  }
	  
	if(isset($_GET['detayIslem'])){ include("views/detayIslem.php");  } 
	if(isset($_GET['detayGrup'])){ include("views/detayGrup.php");  } 
	if(isset($_GET['detayTerminal'])){ include("views/detayTerminal.php");  } 
	if(isset($_GET['detayMola'])){ include("views/detayMola.php");  } 
	if(isset($_GET['detayServis'])){ include("views/detayServis.php");  } 
	   
	if(isset($_GET['anket'])){ include("views/anket.php"); } 
	
	 ?>
 </div>
    </div>
	</div>
<?php  //include("siteParts/popupMesaj.php"); ?>
