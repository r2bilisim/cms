<?php
	/*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 2019-04-30 23:17:24
-- Description:	Veritabanı ve ayarlar
-- ============================================= 
 */

$vt_turu="Mysql"; //Mssql veya Mysql seçebilirsiniz.
$sunucu="EKOMURCU"; //Mssql için localhost veya EKOMURCU\SQLEXPRESS
$veritabani="QCU_DEMO2"; //sunucuda QCU
$kullanici="root";
$parola="nichtwar";
$durum=true;
if($durum){
	error_reporting(E_ALL);	
}else
{
	error_reporting(0);	
	function error_found(){
	header('Location: index.php');
	}
	set_error_handler('error_found');
}
date_default_timezone_set('Etc/GMT-3'); //Türkiye için yerel saat ayarı 
try {

    switch($vt_turu)
	{
		case "Mysql":
		$db = new PDO("mysql:host=$sunucu;charset=utf8;", "$kullanici", "$parola");
		$db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->query("CREATE DATABASE IF NOT EXISTS $veritabani");
		$db->query("use $veritabani");
		$mesaj= "Bağlantı hazır!";
		$mesajHata=false;
		break;
		case "Mssql": //Sqlserver için pdo extension yüklü olmalı!
		$db = new PDO("sqlsrv:Server=$sunucu;", "$kullanici", "$parola");
		$db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		$db->query("if not exists(select * from sys.databases where name = '$veritabani')
			create database $veritabani");
		$db->query("use $veritabani ");
		$mesaj= "Bağlantı hazır!";
		$mesajHata=false;		
		break;
		default:
		$mesaj= "Veri tabanı için bir tür seçin(Mysql veya Mssql)";
		$mesajHata=true;
		break;
	 
	}	
		$mesajHata=false;

} catch(PDOException $e ){
	$mesaj= "Sunucu bağlantı ayarlarını kontrol ediniz!<br>".$e->getMessage();
	$mesajHata=true;
}
finally
{
	ob_start();
}
?>