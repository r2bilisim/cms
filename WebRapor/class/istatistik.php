<?php 
	//include_once '../../Connections/baglantim.php';
	/**
		* sayısal bilgiler
	*/
	class Istatistik
	{
		private $db,$vt_turu;	
		function __construct()
		{
			global $db,$vt_turu;
			$this->db=$db;		
			$this->vt_turu=$vt_turu;		
		}
		public function PersonelSayisi($type=3)
		{ 	
			//type:0 normal kullanıcılar, type:1 adminler, type:3  hepsi
			$sorgu1="SELECT count(*) as Toplam FROM PERSONELLER"; 
			$sorgu2="SELECT count(*) as Toplam FROM PERSONELLER WHERE B_YF= $type"; 	
			$sorgu=($type==0 || $type==1)?$sorgu2:$sorgu1;			
			$row=$this->db->prepare($sorgu);  		 
			$row->execute();
			$row=$row->fetchColumn(); //satır sayısı
			return $row;
		}
		public function GrupSayisi($type=0)
		{
			//type:0 tumu, type:1 aktifler
			$sorgu1="SELECT count(*) as Toplam FROM GRUPLAR";  
			$sorgu2="SELECT count(*) as Toplam FROM GRUPLAR WHERE AKTIF= $type"; 
			$sorgu=($type==1)?$sorgu2:$sorgu1;			
			$row=$this->db->prepare($sorgu);  		 
			$row->execute();
			$row=$row->fetchColumn(); //satır sayısı
			return $row;
		}
		public function BiletSayisi($type=0)
		{
			//type:0 tumu, değilse grupid = type (gruba göre bilet sayısı)
			$sorgu1="SELECT count(*) as Toplam FROM BILETLER";  
			$sorgu2="SELECT count(*) as Toplam FROM BILETLER WHERE GRPID = $type"; 
			$sorgu=($type!=0)?$sorgu2:$sorgu1;			
			$row=$this->db->prepare($sorgu);  		 
			$row->execute();
			$row=$row->fetchColumn(); //satır sayısı
			return $row;
		}
		public function IslemSayisi($type=0)
		{
			//type:0 BEKLEYEN İŞLEMLER, type:1 BITEN İŞLEMLER
			$sorgu1="SELECT count(*) as Toplam FROM BILETLER WHERE ISLEM_BAS_TAR is NULL"; 
			$sorgu2="SELECT count(*) as Toplam FROM BILETLER WHERE ISLEM_BAS_TAR is NOT NULL"; 
			$sorgu=($type!=0)?$sorgu2:$sorgu1;			
			$row=$this->db->prepare($sorgu);  		 
			$row->execute();
			$row=$row->fetchColumn(); //satır sayısı
			return $row;
		}
		public function TransferBiletSayisi($type=0)
		{
			//type:0 transfer bilet, type:1 web randevu, type:2 özel/fiktif müsteri
			$sorgu1="SELECT count(*) as Toplam FROM BILETLER WHERE TRANSFER > 0"; 
			$sorgu2="SELECT count(*) as Toplam FROM BILETLER WHERE TRANSFER is NULL"; 
			$sorgu3="SELECT count(*) as Toplam FROM BILETLER WHERE OZEL_MUSTERI > 0"; 
			switch ($type) {
				case '0':
				$sorgu=$sorgu1;
				break;
				case '1':
				$sorgu=$sorgu2;
				break;
				case '2':
				$sorgu=$sorgu3;
				break; 				
			}		
			$row=$this->db->prepare($sorgu);  		 
			$row->execute();
			$row=$row->fetchColumn(); //satır sayısı
			return $row;
		}
		
		public function KuyrukSayisi($type=0)
		{
			//type:0 tumu, değilse grupid = type (gruba göre bilet sayısı)
			$sorgu1="SELECT count(*) as Toplam FROM KUYRUK";  
			$sorgu2="SELECT count(*) as Toplam FROM KUYRUK WHERE GRPID = $type"; 
			$sorgu=($type!=0)?$sorgu2:$sorgu1;			
			$row=$this->db->prepare($sorgu);  		 
			$row->execute();
			$row=$row->fetchColumn(); //satır sayısı
			return $row;
		}
		public function BiletMakineSayisi($type=0)
		{
			//type:0 tumu, değilse MAKINE_TURU = type (MAKINE_TURU göre biletmakine(kiosk(1)-buton(2) gibi) sayısı)
			$sorgu1="SELECT count(*) as Toplam FROM BILET_MAKINELERI";  
			$sorgu2="SELECT count(*) as Toplam FROM BILET_MAKINELERI WHERE MAKINE_TURU = $type"; 
			$sorgu=($type!=0)?$sorgu2:$sorgu1;			
			$row=$this->db->prepare($sorgu);  		 
			$row->execute();
			$row=$row->fetchColumn(); //satır sayısı
			return $row;
		}
		public function TerminalSayisi($type=0)
		{
			//type:0 tumu, type:1 aktifler
			$sorgu1="SELECT count(*) as Toplam FROM TERMINALLER";  
			$sorgu2="SELECT count(*) as Toplam FROM TERMINALLER WHERE AKTIF = $type"; 
			$sorgu=($type!=0)?$sorgu2:$sorgu1;			
			$row=$this->db->prepare($sorgu);  		 
			$row->execute();
			$row=$row->fetchColumn(); //satır sayısı
			return $row;
		}	
		public function ToplamIslemSuresi($type=0)
		{
			//type:0 tumu, type>0 grupID'ye göre
			$sorgu1=($this->vt_turu=="Mssql")?
			"SELECT (sum(DATEDIFF(hour, ISLEM_BAS_TAR, ISLEM_BIT_TAR)*60*60)+sum(DATEDIFF(minute, ISLEM_BAS_TAR, ISLEM_BIT_TAR)*60)+sum(DATEDIFF(minute, ISLEM_BAS_TAR, ISLEM_BIT_TAR))) /(60) FROM BILETLER WHERE TID>0":
			"SELECT (sum(timestampdiff(hour, ISLEM_BAS_TAR, ISLEM_BIT_TAR)*60*60)+sum(timestampdiff(minute, ISLEM_BAS_TAR, ISLEM_BIT_TAR)*60)+sum(timestampdiff(minute, ISLEM_BAS_TAR, ISLEM_BIT_TAR))) /(60) FROM BILETLER WHERE TID>0";  
			$sorgu2=($this->vt_turu=="Mssql")?
			"SELECT (sum(DATEDIFF(hour, ISLEM_BAS_TAR, ISLEM_BIT_TAR)*60*60)+sum(DATEDIFF(minute, ISLEM_BAS_TAR, ISLEM_BIT_TAR)*60)+sum(DATEDIFF(minute, ISLEM_BAS_TAR, ISLEM_BIT_TAR))) /(60) FROM BILETLER WHERE TID>0 AND GRPID = '$type'":
			"SELECT (sum(timestampdiff(hour, ISLEM_BAS_TAR, ISLEM_BIT_TAR)*60*60)+sum(timestampdiff(minute, ISLEM_BAS_TAR, ISLEM_BIT_TAR)*60)+sum(timestampdiff(minute, ISLEM_BAS_TAR, ISLEM_BIT_TAR))) /(60) FROM BILETLER WHERE TID>0 AND GRPID = '$type'";
			$sorgu=($type!=0)?$sorgu2:$sorgu1;			
			$row=$this->db->prepare($sorgu);  		 
			$row->execute();
			$row=$row->fetchColumn(); //satır sayısı
			return $row;
		}
		public function ToplamBekleyenSuresi($type=0)
		{
			//type:0 tumu, type>0 grupID'ye göre
			$sorgu1=($this->vt_turu=="Mssql")?
			"SELECT sum(datediff(minute,cast(SIS_TAR As time),ISLEM_BAS_TAR))
  			FROM BILETLER
  			WHERE  ISLEM_BAS_TAR IS NOT NULL And datediff(minute,cast(SIS_TAR As time),ISLEM_BAS_TAR) >0":
  			"SELECT sum(timestampdiff(minute,cast(SIS_TAR As time),ISLEM_BAS_TAR))
  			FROM BILETLER
  			WHERE  ISLEM_BAS_TAR IS NOT NULL And timestampdiff(minute,cast(SIS_TAR As time),ISLEM_BAS_TAR) >0";  
			$sorgu2=($this->vt_turu=="Mssql")?
			"SELECT sum(datediff(minute,cast(SIS_TAR As time),ISLEM_BAS_TAR) )
  			FROM BILETLER
  			WHERE  ISLEM_BAS_TAR IS NOT NULL And datediff(minute,cast(SIS_TAR As time),ISLEM_BAS_TAR) >0 AND GRPID = '$type'":
  			"SELECT sum(timestampdiff(minute,cast(SIS_TAR As time),ISLEM_BAS_TAR) )
  			FROM BILETLER
  			WHERE  ISLEM_BAS_TAR IS NOT NULL And timestampdiff(minute,cast(SIS_TAR As time),ISLEM_BAS_TAR) >0 AND GRPID = '$type'";
			$sorgu=($type!=0)?$sorgu2:$sorgu1;			
			$row=$this->db->prepare($sorgu);  		 
			$row->execute();
			$row=$row->fetchColumn(); //satır sayısı
			return $row;
		}
		
	}
?>