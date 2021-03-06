<div class="modalRandevu">
<div id="randevuGNC<?php echo $row['id']; ?>" class="modal fade" role="dialog">
  <!-- Modal content -->
  <div class="modal-content" style="background:white; max-width:600px;cursor:auto">
    <div class="modal-header ">
     <span class="close" data-dismiss="modal">&times;</span>
      <h1><?php echo $diller['webRandevu']; ?> <?php echo $diller['guncelle']; ?></h1>   
      <hr>
    </div>
    <div class="modal-body">
	<form method="post" action="WebRandevu/crud/guncelle.php" name="randevuGuncelleForm">
     
      <label for="musteriAd"><b><?php echo $diller['musteriAdi']; ?>:</b></label>
      <input type="text" value="<?php  echo $row['musteriAd']; ?>" maxlength="100" placeholder="<?php echo $diller['musteriAdi']; ?>" name="musteriAd" required>
	
      <label for="musteriSoyad"><b><?php echo $diller['musteriSoyadi']; ?></b></label>
      <input type="text" value="<?php  echo $row['musteriSoyad']; ?>" maxlength="100" placeholder="<?php echo $diller['musteriSoyadi']; ?>" name="musteriSoyad" required>
     
	  <label for="musteriTc"><b><?php echo $diller['tckimlik']; ?></b></label>
      <input type="number" min="10000000000" max="99999999999" value="<?php  echo $row['musteriTc']; ?>" maxlength="11" placeholder="<?php echo $diller['tckimlik']; ?>" name="musteriTc" required>
	
	  <label for="musteriTel"><b><?php echo $diller['tel']; ?></b></label>
      <input type="phone" id="phone" autocomplete="off" placeholder="(___) ___-____"  class="phone"  value="<?php  echo $row['musteriTel']; ?>"  maxlength="14" name="musteriTel" required>
	
	  <label for="randevuTarihi"><b><?php echo $diller['randevuTarihi']; ?></b></label>
      <input id="randevuTarihi<?php echo $row['id']; ?>" value="<?php  echo $row['randevuTarihi']; ?>" type="text" placeholder="Tarih seçiniz" name="randevuTarihi" class="datepicker btn btn-primary" required>
	 
	  <label for="randevuSaati"><b><?php echo $diller['saat']; ?></b></label>
      <input type="time" value="<?php echo substr($row["randevuSaati"],0,5);?>" name="randevuSaati" required>
	
	  <label for="biletNo"><b><?php echo $diller['biletNo']; ?></b></label>
      <input type="number" value="<?php echo $row['biletNo']; ?>" maxlength="10" name="biletNo" required>
	  
	  <label for="randevuTalepSayisi"><b><?php echo $diller['randevuTalepSayisi']; ?></b></label>
      <input type="number" min="1" max="1000" value="<?php echo $row['randevuTalepSayisi']; ?>" name="randevuTalepSayisi" required>	
				
      <div class="clearfix">
	  <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
	  <input type="hidden" name="GRPID" value="<?php echo $row['GRPID']; ?>" />
        <button type="button" data-dismiss="modal" class="cancelbtn button"><?php echo $diller['vazgec']; ?></button>
        <button type="submit" name="randevuGuncelleBtn" class="signupbtn button"><?php echo $diller['guncelle']; ?></button>
      </div>
	</form>
	</div>
    <div class="modal-footer">
      <h3><?php echo $diller['webRandevu']; ?></h3>
    </div>
  </div>
</div>
<script>
$('#randevuTarihi<?php echo $row['id']; ?>').datepicker({       
        dayNamesMin: [ "Paz","Pzts", "Sal", "Çar", "Per", "Cu", "Cmts"],
        monthNames: ["Ocak", "Subat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],    
        dateFormat: "dd.mm.yy",
		firstDay: 1
    });
</script>
</div>