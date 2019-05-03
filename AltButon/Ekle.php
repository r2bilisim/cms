<?php
	function signedint32($value) {
		$i = (int)$value;
		if (PHP_INT_SIZE > 4)   // e.g. php 64bit
        if($i & 0x80000000) // is negative
		return $i - 0x100000000;
		return $i;
	}
	
	// *** Redirect if username exists
	$MM_flag="MM_insert";
	if (isset($_POST[$MM_flag])) {
		$MM_dupKeyRedirect="?AltButonEkle&hata=Bid";
		$BTNID = $_POST['BTNID'];
		$BM_ADRES = $_POST['BM_ADRES'];
		$loginFoundUser = $db->query("SELECT COUNT(BTNID) AS TOPLAMBTN FROM BUTONLAR WHERE BTNID='$BTNID' AND BM_ADRES='$BM_ADRES'")->fetch();
				
		//if there is a row in the database, the username was found - can not add the requested username
		if($loginFoundUser['TOPLAMBTN']>0){
			$MM_qsChar = "?";
			//append the username to the redirect page
			if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
			$MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."ButonID=".$BTNID;
			header ("Location: $MM_dupKeyRedirect");
			exit;
		}
	}
	
	$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
		$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}
	
	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
		$Resim=-1;	
		if((!empty($_FILES["RESIM"]) and $_FILES["RESIM"]["tmp_name"]!="") and ($_POST)){	
			$Resim=$_FILES["RESIM"]["tmp_name"];		
		}
		else
		{
			//eğer yeni resim yüklenmediyse bunu çalıştır	
			//direk bos arkaplan ekle ki kiosk.exe prog çatlamasın
			$Resim="dist/img/logo/bos.png";	
		}
		
		$row_BiletMakinesi =$db->query("SELECT BTNID FROM BUTONLAR WHERE BM_ADRES = '$_POST[BM_ADRES]'")->fetch();
		//$row_BiletMakinesi['BTNID'] alt buton olarak ANA_BTNID idi alanına eklenecek
		
		
		$insertSQL = $db->prepare("INSERT INTO BUTONLAR 
		(BM_ADRES, BTNID, GRP_ID, ANA_BTNID, BTN_EKRAN, BTN_BILET_S1, BTN_BILET_S2, BTN_BILET_S3, 
		BTN_BILET_S4, MAKS_BILET, BILET_KOPYA, YUKSEKLIK, GENISLIK, RENK, YAZI_RENGI, RESIM, 
		RESIM_YON, RESIM_AD, ESKI_RESIM_AD, ACIKLAMA, AKTIF, S_YF1, S_YF2, S_YF3, I_YF1, I_YF2, I_YF3, B_YF, 
		RandevuButonuMu, GRP_ID2, GRP1_ORAN, GRP2_ORAN, GRP_ID3, GRP3_ORAN, GRP_ID4, GRP4_ORAN, FONT, PUNTO) 
		VALUES (:BM_ADRES, :BTNID, :GRP_ID, :ANA_BTNID, :BTN_EKRAN, :BTN_BILET_S1, :BTN_BILET_S2, :BTN_BILET_S3, 
		:BTN_BILET_S4, :MAKS_BILET, :BILET_KOPYA, :YUKSEKLIK, :GENISLIK, :RENK, :YAZI_RENGI, :RESIM, 
		:RESIM_YON, :RESIM_AD, :ESKI_RESIM_AD, :ACIKLAMA, :AKTIF, :S_YF1, :S_YF2, :S_YF3, :I_YF1, :I_YF2, :I_YF3, :B_YF, 
		:RandevuButonuMu, :GRP_ID2, :GRP1_ORAN, :GRP2_ORAN, :GRP_ID3, :GRP3_ORAN, :GRP_ID4, :GRP4_ORAN, :FONT, :PUNTO,
		:Border_Style, :Border_Width, :Border_Color, :Border_Radius)");
		$insertSQL->bindParam(':BM_ADRES',$_POST['BM_ADRES']);
		$insertSQL->bindParam(':BTNID',$_POST['BTNID']);
		$insertSQL->bindParam(':GRP_ID',$_POST['GRP_ID']);
		$insertSQL->bindParam(':ANA_BTNID',$row_BiletMakinesi['BTNID']);
		$insertSQL->bindParam(':BTN_EKRAN',$_POST['BTN_EKRAN']);
		$insertSQL->bindParam(':BTN_BILET_S1',$_POST['BTN_BILET_S1']);
		$insertSQL->bindParam(':BTN_BILET_S2',$_POST['BTN_BILET_S2']);
		$insertSQL->bindParam(':BTN_BILET_S3',$_POST['BTN_BILET_S3']);
		$insertSQL->bindParam(':BTN_BILET_S4',$_POST['BTN_BILET_S4']);
		$insertSQL->bindParam(':MAKS_BILET',$_POST['MAKS_BILET']);
		$insertSQL->bindParam(':BILET_KOPYA',$_POST['BILET_KOPYA']);
		$insertSQL->bindParam(':YUKSEKLIK',$_POST['YUKSEKLIK']);
		$insertSQL->bindParam(':GENISLIK',$_POST['GENISLIK']);
		$insertSQL->bindParam(':RENK',(signedint32(hexdec('FF'.$_POST['RENK']))));
		$insertSQL->bindParam(':YAZI_RENGI',(hexdec($_POST['YAZI_RENGI'])));
		$insertSQL->bindParam(':RESIM',  $resim, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
		$resim=file_get_contents($Resim);
		$insertSQL->bindParam(':RESIM_YON',$_POST['RESIM_YON']);
		$insertSQL->bindParam(':RESIM_AD',$_POST['RESIM_AD']);
		$insertSQL->bindParam(':ESKI_RESIM_AD',$_POST['ESKI_RESIM_AD']);
		$insertSQL->bindParam(':ACIKLAMA',$_POST['ACIKLAMA']);
		$insertSQL->bindParam(':AKTIF',$AKTIF);
		if($_POST['AKTIF']=="on"){ $AKTIF=true;}else{ $AKTIF=false;}
		$insertSQL->bindParam(':S_YF1',$_POST['S_YF1']);
		$insertSQL->bindParam(':S_YF2',$_POST['S_YF2']);
		$insertSQL->bindParam(':S_YF3',$_POST['S_YF3']);
		$insertSQL->bindParam(':I_YF1',$_POST['I_YF1']);
		$insertSQL->bindParam(':I_YF2',$_POST['I_YF2']);
		$insertSQL->bindParam(':I_YF3',$_POST['I_YF3']);
		$insertSQL->bindParam(':B_YF',$_POST['B_YF']);
		$insertSQL->bindParam(':RandevuButonuMu',$RandevuButonuMu);
		if($_POST['RandevuButonuMu']=="on"){ $RandevuButonuMu=true;}else{ $RandevuButonuMu=false;}
		$insertSQL->bindParam(':GRP_ID2',$_POST['GRP_ID2']);
		$insertSQL->bindParam(':GRP1_ORAN',$_POST['GRP1_ORAN']);
		$insertSQL->bindParam(':GRP2_ORAN',$_POST['GRP2_ORAN']);
		$insertSQL->bindParam(':GRP_ID3',$_POST['GRP_ID3']);
		$insertSQL->bindParam(':GRP3_ORAN',$_POST['GRP3_ORAN']);
		$insertSQL->bindParam(':GRP_ID4',$_POST['GRP_ID4']);
		$insertSQL->bindParam(':GRP4_ORAN',$_POST['GRP4_ORAN']);
		$insertSQL->bindParam(':FONT',$_POST['FONT']);
		$insertSQL->bindParam(':PUNTO',$_POST['PUNTO']);
		$insertSQL->bindParam(':Border_Style',$_POST['Border_Style']);
		$insertSQL->bindParam(':Border_Width',$_POST['Border_Width']);	
		$insertSQL->bindParam(':Border_Color',(hexdec($_POST['Border_Color'])));					
		$insertSQL->bindParam(':Border_Radius',$_POST['Border_Radius']);
		$insertSQL->execute();
		
		$insertGoTo = "?AltButonEkle=ok&";
		if (isset($_SERVER['QUERY_STRING'])) {
			$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
			$insertGoTo .= $_SERVER['QUERY_STRING'];
		}
		header(sprintf("Location: %s", $insertGoTo));
	}
	
	
	$row_BiletMakinesi =$db->query("SELECT BTNID, BM_ADRES, BTN_EKRAN FROM BUTONLAR WHERE ANA_BTNID = 0 ORDER BY BTNID DESC")->fetchAll();
	
	$row_Grup2 = $db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR")->fetchAll();
	
	$row_Fontlar = $db->query("SELECT * FROM FONTLAR")->fetchAll();
	
?>

<?php //include_once("fonksiyonlar/php/modal.php"); ?>
<?php if(isset($_GET["hata"]) and $_GET["hata"]=="Bid" and !(isset($_GET["AltButonEkle"]) and $_GET["AltButonEkle"]=="ok"))
	{
		?>	<script><!-- Jquery ile fadein fadeout için -->
		$(document).ready(function(){
			// $("#hata").click(function(){
			$("#hata").fadeOut(6000);       
			// }); eğer açıklama satırları kaldırılsa tıklanmaya göre çalışır
		});
	</script><!-- Jquery ile fadein fadeout için -->
    <div id="hata" class="alert alert-danger"><?php echo $diller['altbutonMesaj_1']; ?> <span class="btn btn-red">(<?php echo $_GET["ButonID"]; ?>)</span><?php echo $diller['altbutonMesaj_2']; ?> </div>
	<?php
	}
	?><?php if(isset($_GET["AltButonEkle"]) and $_GET["AltButonEkle"]=="ok" )
	{
		?>	<script><!-- Jquery ile fadein fadeout için -->
		$(document).ready(function(){
			$("#eklendi").fadeOut(6000);
		});<!-- Jquery ile fadein fadeout için -->
	</script>
    <div id="eklendi" class="btn btn-success"><?php echo $diller['kayitBasariliMesaj']; ?><a class="btn btn-red" href="?AltButonListele"><?php echo $diller['altbutonMesaj_3']; ?></a> <?php echo $diller['altbutonMesaj_4']; ?> </div>
	<?php
	}
?>
<form method="post" name="form1" enctype="multipart/form-data" action="<?php echo $editFormAction; ?>">
	<div class="card panel panel-pink">
            <div class="card-header panel-heading">
                <h4 class="card-title"><?php echo $diller['altbuton']; ?><a class="btn btn-success" style="margin-left:10px" href="?AltButonListele&"><?php echo $diller['listele'];?></a></h4>
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
								<th nowrap align="right"><?php echo $diller['anabuton']; ?>:</th>
								<td colspan="2"><span id="spryselect1">
									<select class="form-control btn btn-pink" name="BM_ADRES" >
										<option value="-1" selected><?php echo $diller['seciniz']; ?></option>
										<?php 
											foreach($row_BiletMakinesi as $row_BiletMakinesi) {  
											?>
											<option value="<?php echo $row_BiletMakinesi['BM_ADRES']?>" ><?php echo "#".$row_BiletMakinesi['BTNID']."-".$row_BiletMakinesi['BTN_EKRAN']?></option>
											<?php
											}
										?>
									</select>
								<span class="selectInvalidMsg"><?php echo $diller['gecerlibirogesec']; ?></span><span class="selectRequiredMsg"><?php echo $diller['gecerlibirogesec']; ?></span></span></td>
								
								<th><?php echo $diller['altbuton']; ?> ID        <input name="BTNID" type="number" class="form-control" max="1000" min="1" value="1" size="5"></th>
							</tr>
							<tr valign="baseline">
								<td nowrap align="right">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right">1.<?php echo $diller['grupOran']; ?></th>
								<td colspan="2"><span id="spryselect2">
									<select class="form-control" name="GRP_ID">
										<option value="-1" selected>1.<?php echo $diller['grupSec']; ?></option>
										<?php
											foreach($row_Grup2 as $row_Grup) {  
											?>
											<option value="<?php echo $row_Grup['GRPID']?>"><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
											<?php
											}
										?>
									</select>
								<span class="selectInvalidMsg"><?php echo $diller['gecerlibirogesec']; ?></span><span class="selectRequiredMsg"><?php echo $diller['gecerlibirogesec']; ?></span></span></td>
								<td><input class="form-control" type="number" min="0" max="100" name="GRP1_ORAN" value="100" size="5"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right">2.<?php echo $diller['grupOran']; ?></th>
								<td colspan="2"><select class="form-control" name="GRP_ID2">
									<option value="0">2.<?php echo $diller['grupSec']; ?></option>
									<?php
										foreach($row_Grup2 as $row_Grup) {  
										?>
										<option value="<?php echo $row_Grup['GRPID']?>"><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
										<?php
										}
									?>
								</select></td>
								<td><input class="form-control" type="number" min="0" max="100" name="GRP2_ORAN" value="0" size="5"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right">3.<?php echo $diller['grupOran']; ?></th>
								<td colspan="2"><select class="form-control" name="GRP_ID3">
									<option value="0">3.<?php echo $diller['grupSec']; ?></option>
									<?php
										foreach($row_Grup2 as $row_Grup) {  
										?>
										<option value="<?php echo $row_Grup['GRPID']?>"><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
										<?php
										}
									?>
								</select></td>
								<td><input class="form-control" type="number" min="0" max="100" name="GRP3_ORAN" value="0" size="5"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right">4.<?php echo $diller['grupOran']; ?></th>
								<td colspan="2"><select class="form-control" name="GRP_ID4">
									<option value="0">4.<?php echo $diller['grupSec']; ?></option>
									<?php
										foreach($row_Grup2 as $row_Grup) {  
										?>
										<option value="<?php echo $row_Grup['GRPID']?>"><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
										<?php
										}
									?>
								</select></td>
								<td><input class="form-control" type="number" min="0" max="100" name="GRP4_ORAN" value="0" size="5"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right" valign="top"><?php echo $diller['aciklama']; ?>:</th>
								<td colspan="3"><span id="sprytextarea2">
									<textarea class="form-control" name="ACIKLAMA" cols="50" rows="5"></textarea>
								<span id="countsprytextarea2">&nbsp;</span><span class="textareaMaxCharsMsg"><?php echo $diller['maxKarakter']; ?></span></span></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['biletKopyaSayisi']; ?>:</th>
								<td><input type="number" min="1" max="10" name="BILET_KOPYA" value="1" class="form-control"></td>
								<th align="right" nowrap><?php echo $diller['yukseklik']; ?>:</th>
								<td><input type="number" min="10" max="1000" name="YUKSEKLIK" value="100" class="form-control"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['maxBilet']; ?>:</th>
								<td><input type="number" min="1" max="9999" name="MAKS_BILET" value="5000" class="form-control"></td>
								<th align="right" nowrap><?php echo $diller['genislik']; ?>:</th>
								<td><input type="number" min="10" max="1000" name="GENISLIK" value="500" class="form-control"></td>
							</tr>
							<tr valign="baseline">
								<th align="right" nowrap><?php echo $diller['soldanKonum']; ?>:</th>
								<td><input type="number" min="5" max="1000" name="I_YF1" value="100" class="form-control"></td>
								<th align="right" nowrap><?php echo $diller['yukaridanKonum']; ?>:</th>
								<td><input type="number" min="5" max="2000" name="I_YF2" value="100" class="form-control"></td>
							</tr>
							<tr valign="baseline">
								<th align="right" nowrap><?php echo $diller['aktif']; ?>:</th>
								<td><label class="switch">
									<input type="checkbox" name="AKTIF" checked>
								<span class="slider round"></span></label></td>
								<th align="right" nowrap><?php echo $diller['webRandevu']; ?>?:</th>
								<td><label class="switch">
									<input type="checkbox" name="RandevuButonuMu" >
								<span class="slider round"></span></label></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel body table-responsive">
						<table id="tableID" class="table table-hover">
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['butonEkranMetni']; ?>:</th>
								<td><span id="sprytextarea1">
									<textarea class="form-control" name="BTN_EKRAN" cols="50" rows="5"></textarea>
								<span id="countsprytextarea1">&nbsp;</span><span class="textareaMaxCharsMsg"><?php echo $diller['maxKarakter']; ?>(250)</span></span></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['butonCiktiMetni']; ?> 1:</th>
								<td><input class="form-control" type="text" name="BTN_BILET_S1" value="" size="32" maxlength="50"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['butonCiktiMetni']; ?> 2:</th>
								<td><input class="form-control" type="text" name="BTN_BILET_S2" value="" size="32" maxlength="50"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['butonCiktiMetni']; ?> 3:</th>
								<td><input class="form-control" type="text" name="BTN_BILET_S3" value="" size="32" maxlength="50"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['butonCiktiMetni']; ?> 4:</th>
								<td><input class="form-control" type="text" name="BTN_BILET_S4" value="" size="32" maxlength="50"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['butonRengi']; ?>:</th>
								<td><input class="jscolor form-control" type="text" name="RENK" value="" size="32"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['yaziRengi']; ?>:</th>
								<td><input class="jscolor form-control" type="text" name="YAZI_RENGI" value="" size="32"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['yaziTipi']; ?>(Font)</th>
								<td>
									<select class="form-control" name="FONT">
										<?php
											foreach($row_Fontlar as $row_Fontlar) {  
											?>
											<option style="font-family:<?php echo $row_Fontlar['FONT']; ?>" value="<?php echo $row_Fontlar['FONT']?>"><?php echo $row_Fontlar['FONT']?></option>
											<?php
											}
										?>
									</select></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['yaziBoyutu']; ?>(Punto)</th>
								<td><input class="form-control" type="number" name="PUNTO" value="25" min="1" max="120"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['Border_Style']; ?>:</th>
								<td>
									<select class="form-control" name="Border_Style">
										<option value="dotted ">dotted</option>
										<option value="dashed">dashed</option>
										<option value="solid">solid</option>
										<option value="double">double</option>
										<option value="ridge">ridge</option>
										<option value="inset">inset</option>
										<option value="outset">outset</option>
										<option value="none">none</option>
										<option value="hidden">hidden</option>
									</select>
								</td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['Border_Color']; ?>:</th>
								<td><input class="jscolor form-control" type="text" name="Border_Color" value=""></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['Border_Width']; ?>(px):</th>
								<td><input class="form-control" type="number" name="Border_Width" value="0" min="0" max="10"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['Border_Radius']; ?>(px):</th>
								<td><input class="form-control" type="number" name="Border_Radius" value="0" min="0" max="100"></td>
							</tr>
							<tr valign="baseline">
								<th nowrap align="right"><?php echo $diller['resimEklensinmi']; ?></th>
								<td><label class="switch"><input class="form-control" type="checkbox" id="checkboxID"><span class="slider round"></span>  </label></td>
							</tr>
							<tr class="rowClass" valign="baseline">
								<th nowrap align="right"><?php echo $diller['resimSec']; ?>:</th>
								<td><input type="file" name="RESIM">
								</td>
							</tr>
							<tr class="rowClass" valign="baseline">
								<th nowrap align="right"><?php echo $diller['resimHizalamaYonu']; ?></th>
								<td valign="baseline">
									<table class="table table-bordered table-hover">
										<tr>
											<td><label class="switch"><input type="radio" name="RESIM_YON" value="1" ><span class="slider round"></span></label></td>
											<td><label class="switch"><input type="radio" name="RESIM_YON" value="2" ><span class="slider round"></span></label></td>
											<td><label class="switch"><input type="radio" name="RESIM_YON" value="4" ><span class="slider round"></span></label></td>
										</tr>
										<tr>
											<td><?php echo $diller['ustSol']; ?></td>
											<td><?php echo $diller['ustOrta']; ?></td>
											<td><?php echo $diller['ustSag']; ?></td>
										</tr>
										<tr>
											<td><label class="switch"><input type="radio" name="RESIM_YON" value="16" ><span class="slider round"></span></label></td>
											<td><label class="switch"><input name="RESIM_YON" type="radio" value="32" checked ><span class="slider round"></span></label></td>
											<td><label class="switch"><input type="radio" name="RESIM_YON" value="64" ><span class="slider round"></span></label></td>
										</tr>
										<tr>
											<td><?php echo $diller['ortaSol']; ?></td>
											<td><?php echo $diller['ortaOrta']; ?></td>
											<td><?php echo $diller['ortaSag']; ?></td>
										</tr>
										<tr>
											<td><label class="switch"><input type="radio" name="RESIM_YON" value="256" ><span class="slider round"></span></label></td>
											<td><label class="switch"><input type="radio" name="RESIM_YON" value="512" ><span class="slider round"></span></label></td>
											<td><label class="switch"><input type="radio" name="RESIM_YON" value="1024" ><span class="slider round"></span></label></td>
										</tr>
										<tr>
											<td><?php echo $diller['altSol']; ?></td>
											<td><?php echo $diller['altOrta']; ?></td>
											<td><?php echo $diller['altSag']; ?></td>
										</tr>
									</table></td>
							</tr>
							<tr valign="baseline">
								<td nowrap align="right"><input class="form-control" type="hidden" name="RESIM_AD" value="<?php echo time(); ?>" size="32">
									<input class="form-control" type="hidden" name="ESKI_RESIM_AD" value="" size="32">
									<input type="hidden" name="B_YF" value="" size="32">
									<input type="hidden" name="I_YF3" value="" size="32">
									<input type="hidden" name="S_YF3" value="" size="32">
									<input type="hidden" name="S_YF2" value="" size="32">
								<input type="hidden" name="S_YF1" value="" size="32"></td>
								<td><input class="form-control btn btn-success" type="submit" value="<?php echo $diller['ekle']; ?>"></td>
							</tr>
						</table>
					</div>
				</div>
				
			</div>
		</div>   </div></div></div>
		<input type="hidden" name="MM_insert" value="form1">
		<script type="text/javascript">
			var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"], maxChars:250, counterId:"countsprytextarea1", counterType:"chars_remaining", hint:"<?php echo $diller['kioskAciklama']; ?>", isRequired:false});
			var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur", "change"]});
			var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {invalidValue:"-1", validateOn:["blur", "change"]});
		</script>
	</script>
	<!--toggle checkedbox ile tablo gizlemek ve açmak için-->
	<!--<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script> -->
	<!--toggle checkedbox ile tablo gizlemek ve açmak için-->
</div>
</form>
<script>
	//<![CDATA[
	$(window).load(function(){
		$("#checkboxID").change(function(){
			var self = this;
			$("#tableID tr.rowClass").toggle(self.checked); 
		}).change();
	});//]]>
	var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {counterId:"countsprytextarea2", counterType:"chars_remaining", maxChars:250, hint:"<?php echo $diller['aciklama']; ?>", isRequired:false, validateOn:["blur", "change"]});
	</script>									