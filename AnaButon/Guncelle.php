﻿<?php
	//arkaplan rengi windows için - değerli ifadeye çevrildi
	function signedint32($value) {
		$i = (int)$value;
		if (PHP_INT_SIZE > 4)   // e.g. php 64bit
        if($i & 0x80000000) // is negative
		return $i - 0x100000000;
		return $i;
	}
	function signed2hex($value, $reverseEndianness = false) //4bayt FF,FF,FF,FF şeklinde argb değerini elde etmek için
	{
		$packed = pack('N', $value);//veritabanından okurken bunu kullan
		$hex='';
		for ($i=0; $i < 4; $i++){
			$hex .= strtoupper( str_pad( dechex(ord($packed[$i])) , 2, '0', STR_PAD_LEFT) );
		}
		$tmp = str_split($hex, 2);
		$out = implode('', ($reverseEndianness ? array_reverse($tmp) : $tmp));
		return $out;
	}
	
	$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
		$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}
	/*resim önceden yüklenmişse ve yeni güncelleme yapılmayacaksa img olarak eski resmin vt de kalması gerek
	*/
	
	
	if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
		$updateSQL=-1;
		if((!empty($_FILES["RESIM"]) and $_FILES["RESIM"]["tmp_name"]!="") and ($_POST)){
			//eğer yeni resim yüklendiyse bunu çalıştır
			$updateSQL = $db->prepare("UPDATE BUTONLAR SET 
			GRP_ID=:GRP_ID, GRP1_ORAN=:GRP1_ORAN, GRP_ID2=:GRP_ID2, GRP2_ORAN=:GRP2_ORAN, 
			GRP_ID3=:GRP_ID3, GRP3_ORAN=:GRP3_ORAN, GRP_ID4=:GRP_ID4, GRP4_ORAN=:GRP4_ORAN, 
			ANA_BTNID=:ANA_BTNID, BTN_EKRAN=:BTN_EKRAN, BTN_BILET_S1=:BTN_BILET_S1, 
			BTN_BILET_S2=:BTN_BILET_S2, BTN_BILET_S3=:BTN_BILET_S3, BTN_BILET_S4=:BTN_BILET_S4, MAKS_BILET=:MAKS_BILET,
			BILET_KOPYA=:BILET_KOPYA, YUKSEKLIK=:YUKSEKLIK, GENISLIK=:GENISLIK, I_YF1=:I_YF1,
			I_YF2=:I_YF2, RENK=:RENK, YAZI_RENGI=:YAZI_RENGI, RESIM=:RESIM, RESIM_YON=:RESIM_YON,
			RESIM_AD=:RESIM_AD, ESKI_RESIM_AD=:ESKI_RESIM_AD, ACIKLAMA=:ACIKLAMA,
			AKTIF=:AKTIF, S_YF1=:S_YF1, S_YF2=:S_YF2, S_YF3=:S_YF3, I_YF3=:I_YF3, 
			B_YF=:B_YF, RandevuButonuMu=:RandevuButonuMu, FONT=:FONT, PUNTO=:PUNTO,
			Border_Style=:Border_Style, Border_Width=:Border_Width, Border_Color=:Border_Color, Border_Radius=:Border_Radius 
			WHERE BM_ADRES=:BM_ADRES and BTNID=:BTNID");
			
			$updateSQL->bindParam(':GRP_ID',$_POST['GRP_ID']);
			$updateSQL->bindParam(':GRP1_ORAN',$_POST['GRP1_ORAN']);
			$updateSQL->bindParam(':GRP_ID2',$_POST['GRP_ID2']);
			$updateSQL->bindParam(':GRP2_ORAN',$_POST['GRP2_ORAN']);
			$updateSQL->bindParam(':GRP_ID3',$_POST['GRP_ID3']);
			$updateSQL->bindParam(':GRP3_ORAN',$_POST['GRP3_ORAN']);
			$updateSQL->bindParam(':GRP_ID4',$_POST['GRP_ID4']);
			$updateSQL->bindParam(':GRP4_ORAN',$_POST['GRP4_ORAN']);
			$updateSQL->bindParam(':ANA_BTNID',$_POST['ANA_BTNID']);
			$updateSQL->bindParam(':BTN_EKRAN',$_POST['BTN_EKRAN']);
			$updateSQL->bindParam(':BTN_BILET_S1',$_POST['BTN_BILET_S1']);
			$updateSQL->bindParam(':BTN_BILET_S2',$_POST['BTN_BILET_S2']);
			$updateSQL->bindParam(':BTN_BILET_S3',$_POST['BTN_BILET_S3']);
			$updateSQL->bindParam(':BTN_BILET_S4',$_POST['BTN_BILET_S4']);
			$updateSQL->bindParam(':MAKS_BILET',$_POST['MAKS_BILET']);
			$updateSQL->bindParam(':BILET_KOPYA',$_POST['BILET_KOPYA']);
			$updateSQL->bindParam(':YUKSEKLIK',$_POST['YUKSEKLIK']);
			$updateSQL->bindParam(':GENISLIK',$_POST['GENISLIK']);
			$updateSQL->bindParam(':I_YF1',$_POST['I_YF1']);
			$updateSQL->bindParam(':I_YF2',$_POST['I_YF2']);
			$updateSQL->bindParam(':RENK',$renk);
			$renk=signedint32(hexdec('FF'.$_POST['RENK']));
			$updateSQL->bindParam(':YAZI_RENGI',$yazirengi);
			$yazirengi=(hexdec($_POST['YAZI_RENGI']));
			$updateSQL->bindParam(':RESIM', $resim, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
			$resim=file_get_contents($_FILES['RESIM']["tmp_name"]);
			$updateSQL->bindParam(':RESIM_YON',$_POST['RESIM_YON']);
			$updateSQL->bindParam(':RESIM_AD',$_POST['RESIM_AD']);
			$updateSQL->bindParam(':ESKI_RESIM_AD',$_POST['ESKI_RESIM_AD']);
			$updateSQL->bindParam(':ACIKLAMA',$_POST['ACIKLAMA']);
			$updateSQL->bindParam(':AKTIF',$AKTIF);
			if($_POST['AKTIF']=="on"){ $AKTIF=true;}else{ $AKTIF=false;}
			$updateSQL->bindParam(':S_YF1',$_POST['S_YF1']);
			$updateSQL->bindParam(':S_YF2',$_POST['S_YF2']);
			$updateSQL->bindParam(':S_YF3',$_POST['S_YF3']);
			$updateSQL->bindParam(':I_YF3',$_POST['I_YF3']);
			$updateSQL->bindParam(':B_YF',$_POST['B_YF']);
			$updateSQL->bindParam(':RandevuButonuMu',$RandevuButonuMu);
			if($_POST['RandevuButonuMu']=="on"){ $RandevuButonuMu=true;}else{ $RandevuButonuMu=false;}
			$updateSQL->bindParam(':FONT',$_POST['FONT']);
			$updateSQL->bindParam(':PUNTO',$_POST['PUNTO']);	
			$updateSQL->bindParam(':Border_Style',$_POST['Border_Style']);
			$updateSQL->bindParam(':Border_Width',$_POST['Border_Width']);	
			$updateSQL->bindParam(':Border_Color',(hexdec($_POST['Border_Color'])));					
			$updateSQL->bindParam(':Border_Radius',$_POST['Border_Radius']);
			$updateSQL->bindParam(':BM_ADRES',$_POST['BM_ADRES_TEMP']);
			$updateSQL->bindParam(':BTNID',$_POST['BTNID_TEMP']);
			
		}
		else
		{
			$updateSQL = $db->prepare("UPDATE BUTONLAR SET 
			GRP_ID=:GRP_ID, GRP1_ORAN=:GRP1_ORAN, GRP_ID2=:GRP_ID2, GRP2_ORAN=:GRP2_ORAN, 
			GRP_ID3=:GRP_ID3, GRP3_ORAN=:GRP3_ORAN, GRP_ID4=:GRP_ID4, GRP4_ORAN=:GRP4_ORAN, 
			ANA_BTNID=:ANA_BTNID, BTN_EKRAN=:BTN_EKRAN, BTN_BILET_S1=:BTN_BILET_S1, 
			BTN_BILET_S2=:BTN_BILET_S2, BTN_BILET_S3=:BTN_BILET_S3, BTN_BILET_S4=:BTN_BILET_S4, MAKS_BILET=:MAKS_BILET,
			BILET_KOPYA=:BILET_KOPYA, YUKSEKLIK=:YUKSEKLIK, GENISLIK=:GENISLIK, I_YF1=:I_YF1,
			I_YF2=:I_YF2, RENK=:RENK, YAZI_RENGI=:YAZI_RENGI, RESIM_YON=:RESIM_YON,
			RESIM_AD=:RESIM_AD, ESKI_RESIM_AD=:ESKI_RESIM_AD, ACIKLAMA=:ACIKLAMA,
			AKTIF=:AKTIF, S_YF1=:S_YF1, S_YF2=:S_YF2, S_YF3=:S_YF3,
			RandevuButonuMu=:RandevuButonuMu, FONT=:FONT, PUNTO=:PUNTO,
			Border_Style=:Border_Style, Border_Width=:Border_Width, Border_Color=:Border_Color, Border_Radius=:Border_Radius
			WHERE BM_ADRES=:BM_ADRES and BTNID=:BTNID");
			
			$updateSQL->bindParam(':GRP_ID',$_POST['GRP_ID']);
			$updateSQL->bindParam(':GRP1_ORAN',$_POST['GRP1_ORAN']);
			$updateSQL->bindParam(':GRP_ID2',$_POST['GRP_ID2']);
			$updateSQL->bindParam(':GRP2_ORAN',$_POST['GRP2_ORAN']);
			$updateSQL->bindParam(':GRP_ID3',$_POST['GRP_ID3']);
			$updateSQL->bindParam(':GRP3_ORAN',$_POST['GRP3_ORAN']);
			$updateSQL->bindParam(':GRP_ID4',$_POST['GRP_ID4']);
			$updateSQL->bindParam(':GRP4_ORAN',$_POST['GRP4_ORAN']);
			$updateSQL->bindParam(':ANA_BTNID',$_POST['ANA_BTNID']);
			$updateSQL->bindParam(':BTN_EKRAN',$_POST['BTN_EKRAN']);
			$updateSQL->bindParam(':BTN_BILET_S1',$_POST['BTN_BILET_S1']);
			$updateSQL->bindParam(':BTN_BILET_S2',$_POST['BTN_BILET_S2']);
			$updateSQL->bindParam(':BTN_BILET_S3',$_POST['BTN_BILET_S3']);
			$updateSQL->bindParam(':BTN_BILET_S4',$_POST['BTN_BILET_S4']);
			$updateSQL->bindParam(':MAKS_BILET',$_POST['MAKS_BILET']);
			$updateSQL->bindParam(':BILET_KOPYA',$_POST['BILET_KOPYA']);
			$updateSQL->bindParam(':YUKSEKLIK',$_POST['YUKSEKLIK']);
			$updateSQL->bindParam(':GENISLIK',$_POST['GENISLIK']);
			$updateSQL->bindParam(':I_YF1',$_POST['I_YF1']);
			$updateSQL->bindParam(':I_YF2',$_POST['I_YF2']);
			$updateSQL->bindParam(':RENK',$renk);
			$renk=signedint32(hexdec('FF'.$_POST['RENK']));
			$updateSQL->bindParam(':YAZI_RENGI',$yazirengi);
			$yazirengi=(hexdec($_POST['YAZI_RENGI']));
			$updateSQL->bindParam(':RESIM_YON',$_POST['RESIM_YON']);
			$updateSQL->bindParam(':RESIM_AD',$_POST['RESIM_AD']);
			$updateSQL->bindParam(':ESKI_RESIM_AD',$_POST['ESKI_RESIM_AD']);
			$updateSQL->bindParam(':ACIKLAMA',$_POST['ACIKLAMA']);
			$updateSQL->bindParam(':AKTIF',$AKTIF);
			if($_POST['AKTIF']=="on"){ $AKTIF=true;}else{ $AKTIF=false;}
			$updateSQL->bindParam(':S_YF1',$_POST['S_YF1']);
			$updateSQL->bindParam(':S_YF2',$_POST['S_YF2']);
			$updateSQL->bindParam(':S_YF3',$_POST['S_YF3']);
			//   $updateSQL->bindParam(':I_YF3',$_POST['I_YF3']);
			//   $updateSQL->bindParam(':B_YF',$_POST['B_YF']);			
			$updateSQL->bindParam(':RandevuButonuMu',$RandevuButonuMu);
			if($_POST['RandevuButonuMu']=="on"){ $RandevuButonuMu=true;}else{ $RandevuButonuMu=false;}	
			$updateSQL->bindParam(':FONT',$_POST['FONT']);
			$updateSQL->bindParam(':PUNTO',$_POST['PUNTO']);
			$updateSQL->bindParam(':Border_Style',$_POST['Border_Style']);
			$updateSQL->bindParam(':Border_Width',$_POST['Border_Width']);	
			$updateSQL->bindParam(':Border_Color',(hexdec($_POST['Border_Color'])));					
			$updateSQL->bindParam(':Border_Radius',$_POST['Border_Radius']);			
			$updateSQL->bindParam(':BM_ADRES',$_POST['BM_ADRES_TEMP']);
			$updateSQL->bindParam(':BTNID',$_POST['BTNID_TEMP']);
		}
		$updateSQL->execute();
		
		$updateGoTo = "?AnaButonGuncelle=ok&gnc=ok&";
		if (isset($_SERVER['QUERY_STRING'])) {
			$updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
			$updateGoTo .= $_SERVER['QUERY_STRING'];
		}
		header(sprintf("Location: %s", $updateGoTo));
	}
		
	$row_BiletMakinesi = $db->query("SELECT MAKINE_ADRESI, MAKINE_ADI FROM BILET_MAKINELERI")->fetchAll();
	
	$row_Grup2 = $db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR")->fetchAll();
	
	$BM_ADRES = "-1";
	$BTNID = "-1";
	if (isset($_GET['BM_ADRES']) and isset($_GET['BTNID'])) {
		$BM_ADRES = $_GET['BM_ADRES'];
		$BTNID = $_GET['BTNID'];
	}
	$row_Butonlar = $db->query("SELECT * FROM BUTONLAR WHERE BM_ADRES = '$BM_ADRES' and BTNID = '$BTNID'")->fetch();
	$row_Fontlar = $db->query("SELECT * FROM FONTLAR")->fetchAll();
?>

<?php include_once('fonksiyonlar/php/modal.php'); ?>

<form method="post" name="form1" enctype="multipart/form-data" action="<?php echo $editFormAction; ?>">
<div class="card panel panel-green">
            <div class="card-header panel-heading">
                <h4 class="card-title"><?php echo $diller['anabutonGuncelleme']; ?><a class="btn btn-success" style="margin-left:10px" href="?AnaButonListele&"><?php echo $diller['listele'];?></a></h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                     <ul class="list-inline mb-0">                        
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
             <div class="card-body">
                <div class="card-block">
			<div class="row">
				<div class="col-md-6">
					<div class="panel body table-responsive">        
						<table class="table table-hover">
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['makineAdresi']; ?></th>
								<td colspan="2"><select class="form-control btn btn-danger" name="BM_ADRES" disabled>
									<?php 
										foreach($row_BiletMakinesi as $row_BiletMakinesi) {  
										?>
										<option value="<?php echo $row_BiletMakinesi['MAKINE_ADRESI']?>" <?php if (!(strcmp($row_BiletMakinesi['MAKINE_ADRESI'], $row_Butonlar['BM_ADRES']))) {echo "SELECTED";} ?>><?php echo $row_BiletMakinesi['MAKINE_ADI']?></option>
										<?php
										}
									?>
								</select></td>
								<th><?php echo $diller['buton']; ?> ID
									<input type="hidden" name="BTNID" value="<?php echo htmlentities($row_Butonlar['BTNID'], ENT_COMPAT, 'utf-8'); ?>">
								<span class="label label-default"> <?php echo htmlentities($row_Butonlar['BTNID'], ENT_COMPAT, 'utf-8'); ?></span></td>
							</tr>
							<tr valign="baseline">
								<td nowrap align="right">&nbsp;</td>
								<td></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right">1.<?php echo $diller['grupOran']; ?></th>
								<td colspan="2"><span id="spryselect1">
									<select class="form-control" name="GRP_ID">
										<option value="-1" <?php if (!(strcmp(-1, htmlentities($row_Butonlar['GRP_ID'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>>1.<?php echo $diller['grupSec']; ?></option>
										<?php
											foreach($row_Grup2 as $row_Grup) {  
											?>
											<option value="<?php echo $row_Grup['GRPID']?>"<?php if (!(strcmp($row_Grup['GRPID'], htmlentities($row_Butonlar['GRP_ID'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
											<?php
											} 
										?>
									</select>
								<span class="selectInvalidMsg"><?php echo $diller['gecerlibirogesec']; ?></span><span class="selectRequiredMsg"><?php echo $diller['gecerlibirogesec']; ?></span></span></td>
								<td><input class="form-control" type="number" min="0" max="100" name="GRP1_ORAN" value="<?php echo htmlentities($row_Butonlar['GRP1_ORAN'], ENT_COMPAT, 'utf-8'); ?>" size="5"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right">2.<?php echo $diller['grupOran']; ?></th>
								<td colspan="2"><select class="form-control" name="GRP_ID2">
									<option value="0">2.<?php echo $diller['grupSec']; ?></option>
									<?php
										foreach($row_Grup2 as $row_Grup) { 
										?>
										<option value="<?php echo $row_Grup['GRPID']?>"<?php if (!(strcmp($row_Grup['GRPID'], $row_Butonlar['GRP_ID2']))) {echo "selected=\"selected\"";} ?>><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
										<?php
										}
									?>
								</select></td>
								<td><input class="form-control" type="number" min="0" max="100"  name="GRP2_ORAN" value="<?php echo htmlentities($row_Butonlar['GRP2_ORAN'], ENT_COMPAT, 'utf-8'); ?>" size="5"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right">3.<?php echo $diller['grupOran']; ?></th>
								<td colspan="2"><select class="form-control" name="GRP_ID3">
									<option value="0">3.<?php echo $diller['grupSec']; ?></option>
									<?php
										foreach($row_Grup2 as $row_Grup) {  
										?>
										<option value="<?php echo $row_Grup['GRPID']?>"<?php if (!(strcmp($row_Grup['GRPID'], htmlentities($row_Butonlar['GRP_ID3'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
										<?php
										}
									?>
								</select></td>
								<td><input class="form-control" type="number" min="0" max="100" name="GRP3_ORAN" value="<?php echo htmlentities($row_Butonlar['GRP3_ORAN'], ENT_COMPAT, 'utf-8'); ?>" size="5"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right">4.<?php echo $diller['grupOran']; ?></th>
								<td colspan="2"><select class="form-control" name="GRP_ID4">
									<option value="0">4.<?php echo $diller['grupSec']; ?></option>
									<?php
										foreach($row_Grup2 as $row_Grup) {
										?>
										<option value="<?php echo $row_Grup['GRPID']?>"<?php if (!(strcmp($row_Grup['GRPID'], htmlentities($row_Butonlar['GRP_ID4'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
										<?php
										}
									?>
								</select></td>
								<td><input class="form-control" type="number" min="0" max="100" name="GRP4_ORAN" value="<?php echo htmlentities($row_Butonlar['GRP4_ORAN'], ENT_COMPAT, 'utf-8'); ?>" size="5"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right" valign="top"><?php echo $diller['aciklama']; ?>:</th>
								<td colspan="3"><textarea class="form-control" name="ACIKLAMA" cols="50" rows="5"><?php echo htmlentities($row_Butonlar['ACIKLAMA'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['biletKopyaSayisi']; ?>:</th>
								<td><input type="number" min="1" max="10" class="form-control" name="BILET_KOPYA" value="<?php echo htmlentities($row_Butonlar['BILET_KOPYA'], ENT_COMPAT, 'utf-8'); ?>"></td>
								<th align="right" nowrap><?php echo $diller['yukseklik']; ?>:</th>
								<td><input type="number" min="10" max="1000" class="form-control" name="YUKSEKLIK" value="<?php echo htmlentities($row_Butonlar['YUKSEKLIK'], ENT_COMPAT, 'utf-8'); ?>" ></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['maxBilet']; ?>:</th>
								<td><input type="number" min="1" max="9999" class="form-control" name="MAKS_BILET" value="<?php echo htmlentities($row_Butonlar['MAKS_BILET'], ENT_COMPAT, 'utf-8'); ?>" ></td>
								<th align="right" nowrap><?php echo $diller['genislik']; ?>:</th>
								<td><input type="number" min="10" max="1000" class="form-control" name="GENISLIK" value="<?php echo htmlentities($row_Butonlar['GENISLIK'], ENT_COMPAT, 'utf-8'); ?>" ></td>
							</tr>
							<tr valign="baseline">
								<th align="right" nowrap><?php echo $diller['soldanKonum']; ?>:</th>
								<td><input type="number" min="5" max="1000" class="form-control" name="I_YF1" value="<?php echo htmlentities($row_Butonlar['I_YF1'], ENT_COMPAT, 'utf-8'); ?>" ></td>
								<th align="right" nowrap><?php echo $diller['yukaridanKonum']; ?>:</th>
								<td><input type="number" min="5" max="2000" class="form-control" name="I_YF2" value="<?php echo htmlentities($row_Butonlar['I_YF2'], ENT_COMPAT, 'utf-8'); ?>"></td>
							</tr>
							<tr valign="baseline">
								<th align="right" nowrap><?php echo $diller['aktif']; ?>:</th>
								<td><label class="switch"><input type="checkbox" name="AKTIF"  <?php if (!(strcmp(htmlentities($row_Butonlar['AKTIF'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label></td>
								<th align="right" nowrap><?php echo $diller['webRandevu']; ?>?:</th>
								<td><label class="switch">
									<input type="checkbox" name="RandevuButonuMu" <?php if (!(strcmp(htmlentities($row_Butonlar['RandevuButonuMu'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?>>
								<span class="slider round"></span></label></td>
							</tr>
							<tr valign="baseline">
								<th align="right" nowrap><?php echo $diller['resimOnizleme']; ?>:</th>
								<td colspan="3">
									<?php 
										$img=base64_encode($row_Butonlar['RESIM']);	
										
									?>
								<img class="img-responsive" src="data:image/jpg;charset=utf8;base64,<?php echo $img ?>"/></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="col-md-6">         
					<div class="panel body">
						<table id="tableID" class="table table-hover">
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['butonEkranMetni']; ?>:</th>
								<td><textarea class="form-control" name="BTN_EKRAN" cols="50" rows="5"><?php echo htmlentities($row_Butonlar['BTN_EKRAN'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['butonCiktiMetni']; ?> 1:</th>
								<td><input class="form-control" type="text" name="BTN_BILET_S1" value="<?php echo htmlentities($row_Butonlar['BTN_BILET_S1'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['butonCiktiMetni']; ?> 2:</th>
								<td><input class="form-control" type="text" name="BTN_BILET_S2" value="<?php echo htmlentities($row_Butonlar['BTN_BILET_S2'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['butonCiktiMetni']; ?> 3:</th>
								<td><input class="form-control" type="text" name="BTN_BILET_S3" value="<?php echo htmlentities($row_Butonlar['BTN_BILET_S3'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['butonCiktiMetni']; ?> 4:</th>
								<td><input class="form-control" type="text" name="BTN_BILET_S4" value="<?php echo htmlentities($row_Butonlar['BTN_BILET_S4'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['butonRengi']; ?>:</th>
								<td>
								<input class="jscolor form-control"  type="text" name="RENK" value="<?php echo substr(signed2hex($row_Butonlar['RENK']),2,6); ?>" size="32"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['yaziRengi']; ?>:</th>
								<td><input class="jscolor form-control" type="text" name="YAZI_RENGI" value="<?php echo dechex($row_Butonlar['YAZI_RENGI']); ?>" size="32"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['yaziTipi']; ?>(Font)</th>
								<td><select class="form-control" name="FONT">
									<?php
										foreach($row_Fontlar as $row_Fontlar) {
										?>
										<option style="font-family:<?php echo $row_Fontlar['FONT']; ?>" value="<?php echo $row_Fontlar['FONT']?>"<?php if (!(strcmp($row_Fontlar['FONT'], htmlentities($row_Butonlar['FONT'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo $row_Fontlar['FONT']?></option>
										<?php
										}
									?>
								</select></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['yaziBoyutu']; ?>(Punto)</th>
								<td><input class="form-control" type="number" name="PUNTO" min="10" max="120" value="<?php echo htmlentities($row_Butonlar['PUNTO'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['Border_Style']; ?>:</th>
								<td>
									<select class="form-control" name="Border_Style">
										<option value="dotted" <?php echo ($row_Butonlar['Border_Style']=="dotted")?"SELECTED":""; ?>>dotted</option>
										<option value="dashed" <?php echo ($row_Butonlar['Border_Style']=="dashed")?"SELECTED":""; ?>>dashed</option>
										<option value="solid" <?php echo ($row_Butonlar['Border_Style']=="solid")?"SELECTED":""; ?>>solid</option>
										<option value="double" <?php echo ($row_Butonlar['Border_Style']=="double")?"SELECTED":""; ?>>double</option>
										<option value="ridge" <?php echo ($row_Butonlar['Border_Style']=="ridge")?"SELECTED":""; ?>>ridge</option>
										<option value="inset" <?php echo ($row_Butonlar['Border_Style']=="inset")?"SELECTED":""; ?>>inset</option>
										<option value="outset" <?php echo ($row_Butonlar['Border_Style']=="outset")?"SELECTED":""; ?>>outset</option>
										<option value="none" <?php echo ($row_Butonlar['Border_Style']=="none")?"SELECTED":""; ?>>none</option>
										<option value="hidden" <?php echo ($row_Butonlar['Border_Style']=="hidden")?"SELECTED":""; ?>>hidden</option>
									</select>
								</td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['Border_Color']; ?>:</th>
								<td><input class="jscolor form-control" type="text" name="Border_Color" value="<?php echo dechex($row_Butonlar['Border_Color']); ?>"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['Border_Width']; ?>(px):</th>
								<td><input class="form-control" type="number" name="Border_Width" value="<?php echo htmlentities($row_Butonlar['Border_Width'], ENT_COMPAT, 'utf-8'); ?>"  min="0" max="10"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['Border_Radius']; ?>(px):</th>
								<td><input class="form-control" type="number" name="Border_Radius" value="<?php echo htmlentities($row_Butonlar['Border_Radius'], ENT_COMPAT, 'utf-8'); ?>" min="0" max="100"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['resimEklensinmi']; ?></th>
								<td><label class="switch">
									<input class="form-control" type="checkbox" id="checkboxID">
								<span class="slider round"></span></label></td>
							</tr>
							<tr class="rowClass" valign="baseline">
								<th nowrap align="right"><?php echo $diller['resimSec']; ?>:</th>
								<td><input type="file" name="RESIM" value="" accept="image/*" size="32" ></td>
							</tr>
							<tr class="rowClass" valign="baseline">
								<th nowrap align="right"><?php echo $diller['resimHizalamaYonu']; ?></th>
								<td valign="baseline"><table class="table table-bordered table-hover">
									<tr>
										<td><label class="switch">
											<input type="radio" name="RESIM_YON" value="1" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?>>
										<span class="slider round"></span></label></td>
										<td><label class="switch">
											<input type="radio" name="RESIM_YON" value="2" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),2))) {echo "checked=\"checked\"";} ?>>
										<span class="slider round"></span></label></td>
										<td><label class="switch">
											<input type="radio" name="RESIM_YON" value="4" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),4))) {echo "checked=\"checked\"";} ?>>
										<span class="slider round"></span></label></td>
									</tr>
									<tr>
										<td><?php echo $diller['ustSol']; ?></td>
										<td><?php echo $diller['ustOrta']; ?></td>
										<td><?php echo $diller['ustSag']; ?></td>
									</tr>
									<tr>
										<td><label class="switch">
											<input type="radio" name="RESIM_YON" value="16" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),16))) {echo "checked=\"checked\"";} ?>>
										<span class="slider round"></span></label></td>
										<td><label class="switch">
											<input type="radio" name="RESIM_YON" value="32" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),32))) {echo "checked=\"checked\"";} ?>>
										<span class="slider round"></span></label></td>
										<td><label class="switch">
											<input type="radio" name="RESIM_YON" value="64" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),64))) {echo "checked=\"checked\"";} ?>>
										<span class="slider round"></span></label></td>
									</tr>
									<tr>
										<td><?php echo $diller['ortaSol']; ?></td>
										<td><?php echo $diller['ortaOrta']; ?></td>
										<td><?php echo $diller['ortaSag']; ?></td>
									</tr>
									<tr>
										<td><label class="switch">
											<input type="radio" name="RESIM_YON" value="256" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),256))) {echo "checked=\"checked\"";} ?>>
										<span class="slider round"></span></label></td>
										<td><label class="switch">
											<input type="radio" name="RESIM_YON" value="512" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),512))) {echo "checked=\"checked\"";} ?>>
										<span class="slider round"></span></label></td>
										<td><label class="switch">
											<input type="radio" name="RESIM_YON" value="1024" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),1024))) {echo "checked=\"checked\"";} ?>>
										<span class="slider round"></span></label></td>
									</tr>
									<tr>
										<td><?php echo $diller['altSol']; ?></td>
										<td><?php echo $diller['altOrta']; ?></td>
										<td><?php echo $diller['altSag']; ?></td>
									</tr>
								</table></td>
							</tr>
							<tr valign="baseline">
								<td colspan="2" align="right" nowrap><input type="hidden" name="RESIM_AD" value="<?php echo time(); ?>" size="32">
									<input type="hidden" name="ESKI_RESIM_AD" value="<?php echo htmlentities($row_Butonlar['RESIM_AD'], ENT_COMPAT, 'utf-8'); ?>" size="32">
									<input type="hidden" name="ANA_BTNID" value="<?php echo htmlentities($row_Butonlar['ANA_BTNID'], ENT_COMPAT, 'utf-8'); ?>">
									<input type="hidden" name="S_YF1" value="<?php echo htmlentities($row_Butonlar['S_YF1'], ENT_COMPAT, 'utf-8'); ?>">
									<input type="hidden" name="S_YF2" value="<?php echo htmlentities($row_Butonlar['S_YF2'], ENT_COMPAT, 'utf-8'); ?>">
									<input type="hidden" name="S_YF3" value="<?php echo htmlentities($row_Butonlar['S_YF3'], ENT_COMPAT, 'utf-8'); ?>">
									<input type="hidden" name="I_YF3" value="<?php echo htmlentities($row_Butonlar['I_YF3'], ENT_COMPAT, 'utf-8'); ?>">
									<input type="hidden" name="B_YF" value="<?php echo htmlentities($row_Butonlar['B_YF'], ENT_COMPAT, 'utf-8'); ?>">
									<input type="hidden" name="MM_update" value="form1">
									<input type="hidden" name="BM_ADRES_TEMP" value="<?php echo $row_Butonlar['BM_ADRES']; ?>">
									<input class="btn btn-info form-control" type="submit" value="<?php echo $diller['guncelle']; ?>">
								<input type="hidden" name="BTNID_TEMP" value="<?php echo $row_Butonlar['BTNID']; ?>"></td>
							</tr>
						</table></div></div>
					</div></div>        
			</div></div>
	</div>
</form>
<script type="text/javascript">
	var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur", "change"]});
</script>
<script>	
	//<![CDATA[
	$(window).load(function(){
		$("#checkboxID").change(function(){
			var self = this;
			$("#tableID tr.rowClass").toggle(self.checked); 
		}).change();
	});//]]> 
</script>
<!--toggle checkedbox ile tablo gizlemek ve açmak için-->																