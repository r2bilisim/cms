<?php require_once('Connections/baglantim.php'); ?>
<?php include("fonksiyonlar/php/dilAyar.php"); ?>
<?php
    // *** Validate request to login to this site.
    if (!isset($_SESSION)) {
        session_start();
        
    }
    if(isset($db)){ //vt bağlantı kontrolü

    if(!isset($_SESSION['MM_Username']))//kullanıcı yoksa giris'i yukle
    {
        try{

        $loginFormAction = $_SERVER['PHP_SELF'];
        if (isset($_GET['accesscheck'])) {
            $_SESSION['PrevUrl'] = $_GET['accesscheck'];
        }
        
        if (isset($_POST['uname']) and isset($_POST['psw'])) {
            $loginUsername=$_POST['uname'];
            $password=$_POST['psw'];
            $MM_fldUserAuthorization = "";
            $MM_redirectLoginSuccess = "?login=on";
            $MM_redirectLoginFailed = "?login=off";
            $MM_redirecttoReferrer = false;
            
            //sadece B_YF=1 olan yani yöneticiler oturum açabilir. 
            $LoginRS__query=$db->prepare("SELECT KULLANICI_ADI, SIFRE, AD FROM PERSONELLER WHERE KULLANICI_ADI=:kAdi AND SIFRE=:sfr AND B_YF=1");
            $LoginRS__query->bindParam(':kAdi',$loginUsername);
            $LoginRS__query->bindParam(':sfr',$password);
            $LoginRS__query->execute();
            
            
            if ( $LoginRS__query->rowCount()){
                $row=$LoginRS__query->fetch(PDO::FETCH_ASSOC);
                $_SESSION["kAdi"]=$row["AD"];
                $_SESSION['MM_Username'] = $loginUsername ;
         $cookie_name = "omes";
         $cookie_value = $loginUsername;
        if($_POST['beniHatirla']=="on")
        {                           
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");         
        }
        else
        {
            setcookie($cookie_name, $cookie_value, time() - (86400 * 30), "/");
        }

                if (isset($_SESSION['PrevUrl']) && false) {
                    $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];    
                }
                header("Location: " . $MM_redirectLoginSuccess );
            }
            else {
                header("Location: ". $MM_redirectLoginFailed );
            }
        }
    } catch(Exception $e)
    {
        header("Location: ./Kurulum/");
    }
?>
<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <?php include 'header.php'; ?>
  <head>
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/login-register.css">
  </head>    
  <body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column  blank-page blank-page">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
            <noscript>
                <p class="alert alert-danger" style="text-align: center; padding: 50px">
                    <strong>Bu siteden en iyi şekilde yararlanabilmek için lütfen tarayıcınızın JAVASCRIPT destek özelliğini aktifleştiriniz.<br> Aksi halede birçok özellik çalışmayacaktır!</strong>
                </p>
            </noscript>
        <div class="content-body"><section class="flexbox-container">
    <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
        <div class="card border-grey border-lighten-3 m-0">
            <div class="card-header no-border">
                <div class="card-title text-xs-center">
                    <div class="p-1"><img src="dist/img/logo/omes_logo.png" alt="branding logo"></div>
                </div>
                <h2 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2">
        <a href="./Kurulum"><span class="badge label-danger"><?php echo $vt_turu; ?></span></a>
        <span class="badge label-info"><?php echo $veritabani; ?></span></h2>
            </div>

            <div class="card-body collapse in">               
                <div class="card-block">
                <?php if(!isset($_SESSION['kAdi'])) { ?>                           
            <form  action="?<?php echo $_SERVER['QUERY_STRING'];?>" method="post">
                <select style="border: 1px dashed red" class="form-control" name="dilSec" onchange="this.form.submit()" required>
                    <option><?php echo $diller['diller'];?></option>
              <?php $list=list_files("dilPaketi/") ; foreach($list as $dil) { ?>
                <option class="dropdown-item" value="<?php echo $dil; ?>">
                <i class="flag-icon flag-icon-<?php echo preg_replace("/.php/","",$dil); ?>"></i><?php echo preg_replace("/.php/","",$dil); ?></option>
              <?php } ?>
              </select>  
            </form>              
            </div>
              </li>
            <?php } ?>
                    <form METHOD="POST" name="giris_formu" action="<?php echo $loginFormAction; ?>" class="form-horizontal form-simple" >
                        <fieldset class="form-group position-relative has-icon-left mb-0">
                            <input type="text" name="uname" value="<?php if(isset($_COOKIE['omes'])){ echo $_COOKIE['omes'];}?>" class="form-control form-control-lg input-lg" id="user-name" placeholder="<?php echo $diller['kullaniciAdi']; ?>" required>
                            <div class="form-control-position">
                                <i class="icon-head"></i>
                            </div>
                        </fieldset>
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="password" name="psw" class="form-control form-control-lg input-lg" id="user-password" placeholder="<?php echo $diller['parola']; ?>" required>
                            <div class="form-control-position">
                                <i class="icon-key3"></i>
                            </div>
                        </fieldset>
                        <?php if(isset($_GET['login']) && $_GET['login']="off"){ ?>
                       <div class="alert alert-danger alert-dismissible fade in mb-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                   <strong><?php echo $diller['girisBasarisiz']; ?></strong>
                                </div>
                                </div>
                        <?php } ?>
                        
                        <fieldset class="form-group row">
                            <div class="col-md-6 col-xs-12 text-xs-center text-md-left">
                                 <label for="remember-me"><?php echo $diller['beniHatirla']; ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="beniHatirla" <?php if(isset($_COOKIE['omes'])){ echo "checked";}?> >         
                                    <span class="slider round"></span>
                                </label>
                    
                            </div>                         
                        </fieldset>
                        <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="icon-unlock2"></i> <?php echo $diller['oturumAc']; ?></button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <?php include 'footer.php'; ?>

  </body>
</html>
        <?php
        }
        else
        {
             header("Location: index.php");
        }
?>          
<?php }
else{ 
?><div class="alert alert-danger"><?php echo $diller['dbHataMsg_2']; ?></div><?php } ?>