<?php 	
	/**
		* herhangi bir tablonun SELECT sorguları
	*/
	class Sorgu 
	{	
		private $db;	
		function __construct()
		{
			global $db;
			$this->db=$db;		
		}
		
		public function Cek($tablo=null,$orderBy=null,$where=null)
		{
			$sorgu="SELECT * FROM $tablo ";
			$sorgu =($where!=null)? $sorgu." WHERE ".$where:$sorgu;
			$sorgu =($orderBy!=null)? $sorgu." Order By ".$orderBy:$sorgu;
			$row = ($tablo===null)? die("tablo adı eksik!"):
			$this->db->query($sorgu, PDO::FETCH_OBJ);
			
			return $row;
		}
	}
	
?>