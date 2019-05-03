<?php
//kendi hata sayfamı kullanmak istersem diye bunu buraya bırakıyorum
  /*
    function error_found(){
    header("Location: oops.php");
    }
    set_error_handler('error_found');
  */
  //dil desteği için
  include("fonksiyonlar/php/dilAyar.php");
  // ** Logout the current user. **
  $logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
  if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
    $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
  }
  if(!isset($_SESSION['kAdi']))
  {
     $logoutGoTo = "login.php";
    header("Location: $logoutGoTo");
      exit;
  }
  if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
    //to fully log out a visitor we need to clear the session variables
    $_SESSION['kAdi'] = NULL;
    $_SESSION['MM_UserGroup'] = NULL;
    $_SESSION['PrevUrl'] = NULL;
    unset($_SESSION['kAdi']);
    unset($_SESSION['MM_UserGroup']);
    unset($_SESSION['PrevUrl']);
    session_destroy();
    $logoutGoTo = "login.php";
    if ($logoutGoTo) {
      header("Location: $logoutGoTo");
      exit;
    }
  }
?>
<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
            <li class="nav-item"><a href="index.php" class="navbar-brand nav-link"><img alt="branding logo" src="app-assets/images/logo/robust-logo-light.png" data-expand="app-assets/images/logo/robust-logo-light.png" data-collapse="app-assets/images/logo/robust-logo-small.png" class="brand-logo"></a></li>
            <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content container-fluid">
          <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
            <ul class="nav navbar-nav">
              <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5"></i></a></li>
              <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i class="ficon icon-expand2"></i></a></li>
             <li class="nav-item hidden-sm-down"><a href="./Kurulum" target="_blank" class="btn btn-success upgrade-to-pro"><?php echo $vt_turu; ?></a><a class="btn btn-info upgrade-to-pro"><?php echo $veritabani; ?></a></li>
            </ul>                         
            <ul class="nav navbar-nav float-xs-right">
              <?php if(isset($_SESSION['kAdi'])) { ?>
              <li class="dropdown dropdown-language nav-item">
                <a id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link"><i class="flag-icon icon-flag3"></i><span class="selected-language"><i class="flag-icon flag-icon-<?php echo isset($_COOKIE['dilSec'])? preg_replace("/.php/","",$_COOKIE['dilSec']):""; ?>"></i><?php echo $diller['diller'];?></span></a>
                <div aria-labelledby="dropdown-flag" class="dropdown-menu">
            <form action="?<?php echo $_SERVER['QUERY_STRING'];?>" method="post">
              <?php $list=list_files("dilPaketi/") ; foreach($list as $dil) { ?>
                <button class="dropdown-item" name="dilSec" value="<?php echo $dil; ?>"><i class="flag-icon flag-icon-<?php echo preg_replace("/.php/","",$dil); ?>"></i><?php echo preg_replace("/.php/","",$dil); ?></button>
              <?php } ?>  
            </form>              
                </div>
              </li>
            <?php } ?>
             
              <li class="dropdown dropdown-user nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="dist/img/avatar/favicon.ico" alt="avatar"><i></i></span><span class="user-name"><?php echo $diller['hesap']; ?>: <?php echo $_SESSION["kAdi"]; ?></span></a>
<div class="dropdown-menu dropdown-menu-right">
<a href="?Personel" class="dropdown-item"><i class="icon-head"></i> <?php echo $diller['hesapAyarlari']; ?></a>
<a href="?SistemAyarlari" class="dropdown-item"><i class="icon-cogs"></i> <?php echo $diller['sistemAyarlari']; ?></a>
                  <div class="dropdown-divider"></div>
                  <a href="<?php echo $logoutAction ?>" class="dropdown-item"><i class="icon-power3"></i><?php echo $diller['guvenliCikis']; ?></a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>