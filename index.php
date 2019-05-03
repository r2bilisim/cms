<?php include('Connections/baglantim.php'); ?>
<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <?php include 'header.php' ?>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns fixed-navbar">
            <noscript>
                <p class="alert alert-danger" style="text-align: center; padding: 50px">
                    <strong>Bu siteden en iyi şekilde yararlanabilmek için lütfen tarayıcınızın JAVASCRIPT destek özelliğini aktifleştiriniz.<br>Aksi halede birçok özellik çalışmayacaktır!</strong>
                </p>
            </noscript>      
    <!-- navbar-fixed-top-->
    <?php include 'menu/navbar.php'; ?>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <!-- main menu-->
    <div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
      <!-- main menu header-->
      <div class="main-menu-header">
       <!-- <input type="text" placeholder="Ara.." class="menu-search form-control round"/> -->
      </div>
      <!-- / main menu header-->
      <!-- main menu content-->
      <?php include 'menu/menu.php'; ?>
      <!-- /main menu content-->

      <!-- main menu footer-->
      <!-- include includes/menu-footer-->
      <!-- main menu footer-->
    </div>
    <!-- / main menu-->

    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- stats -->
          <?php 
          if(isset($_SESSION["kAdi"]))
          {
            if(isset($_GET["SistemAyarlari"]))
            {
              include("SistemAyarlari/Guncelle.php");
            }
            else if(isset($_GET["SistemAyarSil"]))
            {
              include("SistemAyarlari/Sil.php");
            }
            else if(isset($_GET["GrupListele"]))
            {
              include("Gruplar/Listele.php");
            }
            else if(isset($_GET["GrupEkle"]))
            {
              include("Gruplar/Ekle.php");
            }
            else if(isset($_GET["GrupGuncelle"]))
            {
              include("Gruplar/Guncelle.php");
            }
            else if(isset($_GET["GrupSil"]))
            {
              include("Gruplar/Sil.php");
            }
            else if(isset($_GET["TerminalListele"]))
            {
              include("Terminaller/Listele.php");
            }
            else if(isset($_GET["TerminalEkle"]))
            {
            ?>
            <div class="row">
              <div class="col-md-6"> 
                <?php
                  include("Terminaller/Ekle.php");  
                ?>
              </div>
              <div class="col-md-6">
                <?php
                  include("TerminalGrup/Ekle.php");
                ?>
              </div></div>
              <?php
                include("Terminaller/Listele.php");
                
              }
              else if(isset($_GET["TerminalGuncelle"]))
              {
                include("Terminaller/Guncelle.php");
              }
              else if(isset($_GET["TerminalSil"]))
              {
                include("Terminaller/Sil.php");
              }
              else if(isset($_GET["TerminalGrupListele"]))
              {
                include("TerminalGrup/Listele.php");
              }
              else if(isset($_GET["TerminalGrupGuncelle"]))
              {
                include("TerminalGrup/Guncelle.php");
              }
              else if(isset($_GET["TerminalGrupEkle"]))
              {
                include("TerminalGrup/Ekle.php");
              }
              else if(isset($_GET["TerminalGrupSil"]))
              {
                include("TerminalGrup/Sil.php");
              }
              else if(isset($_GET["BiletMakinesiEkle"]))
              {
              ?>   
              <div class="row">
                <div class="col-md-6"> 
                  <?php
                    include("BiletMakinesi/Ekle.php");
                  ?></div>
                  <div class="col-md-6">
                    <?php
                      include("BiletMakinesi/Listele.php");
                    ?></div></div>
                    <?php
                    }
                    else if(isset($_GET["BiletMakinesiSil"]))
                    {
                      include("BiletMakinesi/Sil.php");
                    }
                    else if(isset($_GET["BiletMakinesiGuncelle"]))
                    {
                    ?>   
                    <div class="row">
                      <div class="col-md-6"> 
                        <?php
                          include("BiletMakinesi/Guncelle.php");
                        ?></div>
                        <div class="col-md-6">
                          <?php
                            include("BiletMakinesi/Listele.php");
                          ?></div></div>
                          <?php
                          }
                          else if(isset($_GET["AnaButonEkle"]))
                          {
                            include("AnaButon/Ekle.php");
                            include("AnaButon/Listele.php");
                          }
                          else if(isset($_GET["AnaButonListele"]))
                          {
                            include("AnaButon/Listele.php");
                          }
                          else if(isset($_GET["AnaButonGuncelle"]))
                          {
                            include("AnaButon/Guncelle.php");
                            include("AnaButon/Listele.php");
                          }
                          else if(isset($_GET["AnaButonDetay"]))
                          {
                            include("AnaButon/Detay.php");  
                          }
                          else if(isset($_GET["AnaButonSil"]))
                          {
                            //Ana Buton silinince alt butonlarında silinmesi gerekecek, bu nedenle şimdilik silme işlemi yapmadım. 09.08.2017
                            include("AnaButon/Sil.php");  
                          }
                          else if(isset($_GET["AltButonEkle"]))
                          {
                            include("AltButon/Ekle.php"); 
                            include("AltButon/Listele.php");
                          }
                          else if(isset($_GET["AltButonGuncelle"]))
                          {
                            include("AltButon/Guncelle.php"); 
                            include("AltButon/Listele.php");
                          }
                          else if(isset($_GET["AltButonListele"]))
                          {   
                            include("AltButon/Listele.php");
                          }
                          else if(isset($_GET["AltButonDetay"]))
                          {
                            include("AltButon/Detay.php");  
                          }
                          else if(isset($_GET["AltButonSil"]))
                          {
                            include("AltButon/Sil.php");  
                          }
                          else if(isset($_GET["KioskEkle"]))
                          {
                            include("Kiosk/Ekle.php");  
                          }
                          else if(isset($_GET["KioskSil"]))
                          {
                            include("Kiosk/Sil.php"); 
                          }
                          else if(isset($_GET["BiletEkle"]))
                          {
                            include("Bilet/Ekle.php");  
                          }
                          else if(isset($_GET["BiletSil"]))
                          {
                            include("Bilet/Sil.php"); 
                          }
                          else if(isset($_GET["Personel"]))
                          {
                            include("Personel/Listele.php");  
                          }
                          else if(isset($_GET["PersonelEkle"]))
                          {
                            include("Personel/Ekle.php"); 
                          }
                          else if(isset($_GET["PersonelGuncelle"]))
                          {
                            include("Personel/Guncelle.php"); 
                          }
                          else if(isset($_GET["PersonelSil"]))
                          {
                            include("Personel/Sil.php");  
                          }
                          else if(isset($_GET["AnaTabloListele"]))
                          {
                            include("AnaTablolar/Listele.php"); 
                          }
                          else if(isset($_GET["AnaTabloEkle"]))
                          {
                            include("AnaTablolar/Ekle.php");
                            include("AnaTablolar/Listele.php"); 
                          }
                          else if(isset($_GET["AnaTabloGuncelle"]))
                          {
                            include("AnaTablolar/Guncelle.php");
                            include("AnaTablolar/Listele.php"); 
                          }
                          else if(isset($_GET["AnaTabloSil"]))
                          {
                            include("AnaTablolar/Sil.php"); 
                          }
                          else if(isset($_GET["AnaTabloYonListele"]))
                          {
                            include("AnaTabloYon/Listele.php"); 
                          }
                          else if(isset($_GET["AnaTabloYonEkle"]))
                          {
                            include("AnaTabloYon/Ekle.php");
                            include("AnaTabloYon/Listele.php"); 
                          }
                          else if(isset($_GET["AnaTabloYonGuncelle"]))
                          {
                            include("AnaTabloYon/Guncelle.php");
                            include("AnaTabloYon/Listele.php"); 
                          }
                          else if(isset($_GET["AnaTabloYonSil"]))
                          {
                            include("AnaTabloYon/Sil.php");
                            include("AnaTabloYon/Listele.php"); 
                          }
                          else if(isset($_GET["WebRandevu"]))
                          {
                            include("WebRandevu/index.php");  
                          }
                          else if(isset($_GET["WebRapor"]))
                          {
                            include("WebRapor/index.php");  
                          }
                          else
                          {
                            include("icerik/istatistik.php");
                          }
          }
          else
          {
            include("icerik/istatistik.php");
          }
        ?>   
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include 'footer.php'; ?>
  </body>
</html>
