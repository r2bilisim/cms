<?php 
	//include '../../Connections/baglantim.php';
	/**
		* raporlar(kayıtlar)
	*/
	class Rapor 
	{
		
		private $db,$vt_turu;
		
		function __construct()
		{
			global $db;
			global $vt_turu;
			$this->db=$db;		
			$this->vt_turu=$vt_turu;		
		}
		public function BiletListele($basTarih=null,$bitTarih=null)
		{
			if($basTarih==null && $bitTarih==null)
			{
				$row = $this->db->query("SELECT * FROM BILETLER ORDER BY BID DESC", PDO::FETCH_OBJ);
			}
			else
			{
				$basTarih =date("Y-m-d", strtotime($basTarih));
				$bitTarih =date("Y-m-d", strtotime($bitTarih));
				$row = $this->db->query("SELECT * FROM BILETLER WHERE SIS_TAR BETWEEN '$basTarih' AND '$bitTarih' ORDER BY BID DESC", PDO::FETCH_OBJ);
			}		  	
			return $row;		
		}
		public function TerminalBiletRapor()
		{ 				
			//geriye dönen: <tr><th>Grup</th><td>Terminal</td><td>Toplam Bilet</td><td>Son Bilet</td></tr>
			$row = $this->db->query("SELECT (SELECT GRUP_ISMI FROM GRUPLAR WHERE GRPID = BILETLER.GRPID) as GRUP,(SELECT TERMINAL_AD FROM TERMINALLER WHERE TID = BILETLER.TID) as TERMINAL, count(BILET_NO) as TOPLAM_BILET, MAX(BILET_NO) as SON_ALINAN_BILET FROM BILETLER GROUP BY TID, GRPID", PDO::FETCH_OBJ);
			//WHERE TID!=0 sadece terminali atanmış grupları listelemek için kullan
			return $row;		
		}
		public function TerminalBiletAnlikRapor($grupID=null)
		{ 				
			//geriye dönen: <tr><th>Grup</th><td>Terminal</td><td>Toplam Bilet</td><td>Son Bilet</td></tr>

			$string=($this->vt_turu=="Mssql")?					
			"SELECT 
			(SELECT GRUP_ISMI FROM GRUPLAR WHERE GRPID = '$grupID') as GRUP,
			(SELECT TERMINAL_AD FROM TERMINALLER WHERE TID = '$grupID') as TERMINAL, 
			(SELECT count(TID) FROM BILETLER WHERE TID=0 AND GRPID = '$grupID') as BEKLEYEN_ISLEM, 
			(SELECT count(TID) FROM BILETLER WHERE TID>0 AND GRPID ='$grupID') as BITEN_ISLEM,  
			(SELECT count(TID) FROM BILETLER WHERE GRPID = '$grupID') as TOPLAM_BILET, 
			MAX(BILET_NO) as SON_ALINAN_BILET ,
			MAX(ISLEM_BIT_TAR) as SON_ISLEM_SAATI ,
			(SELECT max(BILET_NO) FROM BILETLER WHERE GRPID='$grupID') as SON_ISLEM_YAPILAN_BILET,
			(SELECT (sum(DATEDIFF(hh, ISLEM_BAS_TAR, ISLEM_BIT_TAR)*60*60)+sum(DATEDIFF(mi, ISLEM_BAS_TAR, ISLEM_BIT_TAR)*60)+sum(DATEDIFF(n, ISLEM_BAS_TAR, ISLEM_BIT_TAR))) /(60) FROM BILETLER WHERE TID>0 AND GRPID = '$grupID') AS TOPLAM_ISLEM_SURESI,
			(SELECT (sum(DATEDIFF(hh, ISLEM_BAS_TAR, ISLEM_BIT_TAR)*60*60)+sum(DATEDIFF(mi, ISLEM_BAS_TAR, ISLEM_BIT_TAR)*60)+sum(DATEDIFF(n, ISLEM_BAS_TAR, ISLEM_BIT_TAR))) /(count(*)*60) FROM BILETLER WHERE TID>0 AND GRPID = '$grupID') AS ORTALAMA_ISLEM_SURESI,
			(SELECT coalesce(cast(Round(avg(DATEDIFF(minute,ISLEM_BAS_TAR, ISLEM_BIT_TAR)),0) as char), '- -') FROM BILETLER WHERE TID>0 AND GRPID = '$grupID') as ORTALAMA_BEKLEME_SURESI ,
			(SELECT max(DATEDIFF(minute,ISLEM_BAS_TAR, ISLEM_BIT_TAR)) FROM BILETLER WHERE TID>0 AND GRPID = '$grupID') AS MAX_ISLEM_SURESI
			FROM BILETLER 
			WHERE TID!=0 AND GRPID='$grupID'
			GROUP BY TID, GRPID":		
			"SELECT 
			(SELECT GRUP_ISMI FROM GRUPLAR WHERE GRPID = '$grupID') as GRUP,
			(SELECT TERMINAL_AD FROM TERMINALLER WHERE TID = '$grupID') as TERMINAL, 
			(SELECT count(TID) FROM BILETLER WHERE TID=0 AND GRPID = '$grupID') as BEKLEYEN_ISLEM, 
			(SELECT count(TID) FROM BILETLER WHERE TID>0 AND GRPID = '$grupID') as BITEN_ISLEM,  
			(SELECT count(TID) FROM BILETLER WHERE GRPID = '$grupID') as TOPLAM_BILET, 
			MAX(BILET_NO) as SON_ALINAN_BILET ,
			MAX(ISLEM_BIT_TAR) as SON_ISLEM_SAATI ,
			(SELECT max(BILET_NO) FROM BILETLER WHERE GRPID = '$grupID') as SON_ISLEM_YAPILAN_BILET,
			(SELECT (sum(timestampdiff(HOUR, ISLEM_BAS_TAR, ISLEM_BIT_TAR)*60*60)+sum(timestampdiff(minute, ISLEM_BAS_TAR, ISLEM_BIT_TAR)*60)+sum(timestampdiff(minute, ISLEM_BAS_TAR, ISLEM_BIT_TAR))) /(60) FROM BILETLER WHERE TID>0 AND GRPID = '$grupID') AS TOPLAM_ISLEM_SURESI,
			(SELECT (sum(timestampdiff(HOUR, ISLEM_BAS_TAR, ISLEM_BIT_TAR)*60*60)+sum(timestampdiff(minute, ISLEM_BAS_TAR, ISLEM_BIT_TAR)*60)+sum(timestampdiff(minute, ISLEM_BAS_TAR, ISLEM_BIT_TAR))) /(count(*)*60) FROM BILETLER WHERE TID>0 AND GRPID = '$grupID') AS ORTALAMA_ISLEM_SURESI,
			(SELECT coalesce(cast(Round(avg(timestampdiff(minute,ISLEM_BAS_TAR, ISLEM_BIT_TAR)),0) as char), '- -') FROM BILETLER WHERE TID>0 AND GRPID = '$grupID') as ORTALAMA_BEKLEME_SURESI ,
			(SELECT max(timestampdiff(minute,ISLEM_BAS_TAR, ISLEM_BIT_TAR)) FROM BILETLER WHERE TID>0 AND GRPID = '$grupID') AS MAX_ISLEM_SURESI
			FROM BILETLER 
			WHERE TID!=0 AND GRPID = '$grupID'
			GROUP BY TID, GRPID";
			
			$row = $this->db->query($string, PDO::FETCH_OBJ);
			return $row;		
		}
		
		public function TerminalBiletDetayRapor($grupID=null,$terminalID=null,$biletNo=null,$basTarih=null,$bitTarih=null,$musteriAdi=null,$musteriNo=null)
		{ 				
			$basTarih =date("Y-m-d", strtotime($basTarih));
			$bitTarih =date("Y-m-d", strtotime($bitTarih));
			//geriye dönen: <tr><th>Grup</th><td>Terminal</td><td>Toplam Bilet</td><td>Son Bilet</td></tr>
			$row = $this->db->query("SELECT 
			SIS_TAR,
			(SELECT GRUP_ISMI FROM GRUPLAR WHERE GRPID = BILETLER.GRPID) as GRUP,
			MusteriAdi As MUSTERI_ADI,
			MusteriNo As MUSTERI_NO,
			BILET_NO,
			(SELECT TERMINAL_AD FROM TERMINALLER WHERE TID = BILETLER.TID) as TERMINAL, 
			ISLEM_BAS_TAR,
			ISLEM_BIT_TAR,
			TRANSFER,
			OZEL_MUSTERI
			FROM BILETLER WHERE (GRPID = '$grupID') AND (BILETLER.TID = '$terminalID' OR BILETLER.BILET_NO = '$biletNo' OR (SIS_TAR BETWEEN '$basTarih' AND '$bitTarih') OR MusteriAdi LIKE '%$musteriAdi%' OR MusteriNo LIKE '$musteriNo%' )", PDO::FETCH_OBJ);
			
			return $row;		
		}
					
		public function MolaRapor($personelID=null)
		{ 				
			$string=($this->vt_turu=="Mssql")?
			"SELECT TOP 10 MID,
			PERSONELLER.AD as PERSONEL_AD,
			TERMINAL_AD,
			TERMINALLER.TID as TERMINAL_NO,
			BAS_TARIH,
			BIT_TARIH,
			MOLADA,
			cast((DATEDIFF(minute,BAS_TARIH,BIT_TARIH)) AS varchar) As MOLA_SURESI
			FROM MOLALAR,TERMINALLER,PERSONELLER 
			WHERE TERMINALLER.TID=PERSONELLER.TID and MOLALAR.PID=PERSONELLER.PID AND MOLALAR.PID='$personelID'
			ORDER BY MID DESC":
			"SELECT MID,
			PERSONELLER.AD as PERSONEL_AD,
			TERMINAL_AD,
			TERMINALLER.TID as TERMINAL_NO,
			BAS_TARIH,
			BIT_TARIH,
			MOLADA,
			cast((timestampdiff(minute,BAS_TARIH,BIT_TARIH)) AS char) As MOLA_SURESI
			FROM MOLALAR,TERMINALLER,PERSONELLER 
			WHERE TERMINALLER.TID=PERSONELLER.TID and MOLALAR.PID=PERSONELLER.PID AND MOLALAR.PID='$personelID'
			ORDER BY MID DESC LIMIT 10";
			$row = $this->db->query($string, PDO::FETCH_OBJ);
			
			return $row;		
		}
		public function MolaDetayRapor($personelID=0,$basTarih=null,$bitTarih=null)
		{ 				
			//$personelID=0,$basTarih=null,$bitTarih=null boş geçilirse tüm kayıtları getirir
			$basTarih =($basTarih!=null)?date("Y-m-d", strtotime($basTarih)):null;
			$bitTarih =($bitTarih!=null)?date("Y-m-d", strtotime($bitTarih)):null;
			$tarihString1=($basTarih!=null)?"AND BAS_TARIH >= '$basTarih' ":"";
			$tarihString2=($bitTarih!=null)?"AND BIT_TARIH <= '$bitTarih'":"";
			$pid=($personelID!=0)?"AND MOLALAR.PID=$personelID":"";
			$string=($this->vt_turu=="Mssql")?"SELECT MID,
			PERSONELLER.AD as PERSONEL_AD,
			TERMINAL_AD,
			TERMINALLER.TID as TERMINAL_NO,
			BAS_TARIH,
			BIT_TARIH,
			MOLADA,
			cast((DATEDIFF(minute,BAS_TARIH,BIT_TARIH)) AS varchar) As MOLA_SURESI
			FROM MOLALAR,TERMINALLER,PERSONELLER 
			WHERE (TERMINALLER.TID=PERSONELLER.TID and MOLALAR.PID=PERSONELLER.PID $pid) $tarihString1 $tarihString2
			ORDER BY MID DESC":
			"SELECT MID,
			PERSONELLER.AD as PERSONEL_AD,
			TERMINAL_AD,
			TERMINALLER.TID as TERMINAL_NO,
			BAS_TARIH,
			BIT_TARIH,
			MOLADA,
			cast((timestampdiff(minute,BAS_TARIH,BIT_TARIH)) AS char) As MOLA_SURESI
			FROM MOLALAR,TERMINALLER,PERSONELLER 
			WHERE (TERMINALLER.TID=PERSONELLER.TID and MOLALAR.PID=PERSONELLER.PID $pid) $tarihString1 $tarihString2
			ORDER BY MID DESC";
			$row = $this->db->query($string, PDO::FETCH_OBJ);
			
			return $row;		
		}
		public function ServisRapor($personelID=null)
		{ 				
			$string=($this->vt_turu=="Mssql")? 			
				"SELECT TOP 10 
			PERSONELLER.AD as PERSONEL_AD,
			TERMINAL_AD,
			SEBEP,
			KAP_TAR,
			AC_TAR,
			KAPALI,
			cast((DATEDIFF(minute,KAP_TAR,AC_TAR)) AS varchar) As KAPALI_KALMA_SURESI
			FROM SERVIS_HAREKET,PERSONELLER,TERMINALLER 
			WHERE TERMINALLER.TID=PERSONELLER.TID AND PERSONELLER.PID='$personelID' 
			ORDER BY SKID DESC":
			"SELECT
			PERSONELLER.AD as PERSONEL_AD,
			TERMINAL_AD,
			SEBEP,
			KAP_TAR,
			AC_TAR,
			KAPALI,
			cast((timestampdiff(minute,KAP_TAR,AC_TAR)) AS char) As KAPALI_KALMA_SURESI
			FROM SERVIS_HAREKET,PERSONELLER,TERMINALLER 
			WHERE TERMINALLER.TID=PERSONELLER.TID AND PERSONELLER.PID='$personelID' 
			ORDER BY SKID DESC LIMIT 10";

			$row = $this->db->query($string, PDO::FETCH_OBJ); 	 			  	
			return $row;		
		}
		public function ServisDetayRapor($personelID=null,$basTarih=null,$bitTarih=null)
		{ 				
			$basTarih =date("Y-m-d", strtotime($basTarih));
			$bitTarih =date("Y-m-d", strtotime($bitTarih));	
			$string=($this->vt_turu=="Mssql")?"SELECT
			PERSONELLER.AD as PERSONEL_AD,
			TERMINAL_AD,
			SEBEP,
			KAP_TAR,
			AC_TAR,
			KAPALI,
			cast((DATEDIFF(minute,KAP_TAR,AC_TAR)) AS varchar) As KAPALI_KALMA_SURESI
			FROM SERVIS_HAREKET,PERSONELLER,TERMINALLER 
			WHERE TERMINALLER.TID=PERSONELLER.TID AND PERSONELLER.PID='$personelID' 
			 AND (KAP_TAR >= '$basTarih' AND AC_TAR <= '$bitTarih')
			ORDER BY SKID DESC":
			"SELECT
			PERSONELLER.AD as PERSONEL_AD,
			TERMINAL_AD,
			SEBEP,
			KAP_TAR,
			AC_TAR,
			KAPALI,
			cast((timestampdiff(minute,KAP_TAR,AC_TAR)) AS char) As KAPALI_KALMA_SURESI
			FROM SERVIS_HAREKET,PERSONELLER,TERMINALLER 
			WHERE TERMINALLER.TID=PERSONELLER.TID AND PERSONELLER.PID='$personelID' 
			 AND (KAP_TAR >= '$basTarih' AND AC_TAR <= '$bitTarih')
			ORDER BY SKID DESC";	
			$row = $this->db->query($string, PDO::FETCH_OBJ); 	 			  	
			return $row;		
		}
	}	
?>		