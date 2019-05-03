<div class="main-menu-content">
	<ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
		<li class="nav-item"><a href="index.php"><i class="icon-home3"></i><span data-i18n="nav.dash.main" class="menu-title">INDEX</span></a>
			<!-- Grup Paneli -->         
		</li>
		<li class="nav-item"><a href="#"><i class="icon-grid2"></i><span data-i18n="nav.page_layouts.main" class="menu-title"><?php echo $diller['grupPaneli']; ?></span></a>
            <ul class="menu-content">
				<li class="<?php if(isset($_GET['GrupListele']) || isset($_GET['GrupGuncelle'])){ echo "active"; } ?>"><a href="?GrupListele"><span class="icon-list"></span> <?php echo $diller['listele_guncelleme_silme']; ?></a></li>             
				<li class="<?php if(isset($_GET['GrupEkle'])){ echo "active"; } ?>"><a href="?GrupEkle"><span class="icon-plus"></span> <?php echo $diller['grupEkle']; ?></a></li>	                   
		</ul>
	</li>
	<!-- Grup Paneli -->
	<!-- Terminal Paneli -->
	<li class="nav-item"><a href="#"><i class="icon-stack-2"></i><span data-i18n="nav.page_layouts.main" class="menu-title"><?php echo $diller['terminalPaneli']; ?></span></a>
		<ul class="menu-content">
			<li class="<?php if(isset($_GET['TerminalListele']) || isset($_GET['TerminalGuncelle']) || isset($_GET['TerminalGrupListele']) || isset($_GET['TerminalGrupGuncelle'])){ echo "active"; } ?>"><a href="?TerminalListele"><span class="icon-list"></span> <?php echo $diller['listele_guncelleme_silme']; ?></a>
			</li>    
            <li class="<?php if(isset($_GET['TerminalEkle'])){ echo "active"; } ?>"><a href="?TerminalEkle">
			<span class="icon-plus"></span>  <?php echo $diller['terminalEkle']; ?></a>
            </li>             		                    
	</ul>
</li>
<!-- Terminal Paneli -->
<!-- Bilet Makinesi -->         
<li class="nav-item"><a href="#"><i class="icon-paper"></i><span data-i18n="nav.page_layouts.main" class="menu-title"><?php echo $diller['biletMakineleri']; ?></span></a>
	<ul class="menu-content">
		<li class="<?php if(isset($_GET['BiletMakinesiEkle']) || isset($_GET['BiletMakinesiGuncelle'])){ echo "active"; } ?>"><a href="?BiletMakinesiEkle"><span class="icon-list"></span> <?php echo $diller['listele_guncelleme_silme']; ?></a>
		</li>
        <li class="<?php if(isset($_GET['AnaButonEkle']) || isset($_GET['AnaButonGuncelle']) || isset($_GET['AnaButonDetay']) || isset($_GET['AnaButonListele'])){ echo "active"; } ?>"><a href="?AnaButonEkle">
		<span class="icon-circle-up"></span> <?php echo $diller['anabutonIslem']; ?></a>
        </li>
        <li class="<?php if(isset($_GET['AltButonEkle']) || isset($_GET['AltButonGuncelle']) || isset($_GET['AltButonDetay']) || isset($_GET['AltButonListele'])){ echo "active"; } ?>"><a href="?AltButonEkle">
		<span class="icon-circle-down"></span> <?php echo $diller['altbutonIslem']; ?></a>
        </li>     
          	     
</ul>
</li>
<!-- Bilet Makinesi -->
<!-- Kioks Ekranı -->
<li class="nav-item"><a href="#"><i class="icon-ios-albums-outline"></i><span data-i18n="nav.page_layouts.main" class="menu-title"><?php echo $diller['kioskEkrani']; ?></span></a>
	<ul class="menu-content">
		<li class="<?php if(isset($_GET['KioskEkle'])){ echo "active"; } ?>"><a href="?KioskEkle"><span class="icon-newspaper"> </span> <?php echo $diller['kioskAyarlari']; ?></a></li>       
		<li class="<?php if(isset($_GET['BiletEkle'])){ echo "active"; } ?>"><a href="?BiletEkle"><span class="icon-printer"> </span> <?php echo $diller['biletYazdirmaAyarlari']; ?></a></li>       	                    
</ul>  
</li> 
<!-- Kioks Ekranı -->
<!-- Anatablo Ekranı -->
<li class="nav-item"><a href="#"><i class="icon-table2"></i><span data-i18n="nav.page_layouts.main" class="menu-title"><?php echo $diller['anatabloEkrani']; ?></span></a>
	<ul class="menu-content">
		<li class="<?php if(isset($_GET['AnaTabloListele']) || isset($_GET['AnaTabloGuncelle'])){ echo "active"; } ?>"><a href="?AnaTabloListele"> <span class="icon-menu2"></span> <?php echo $diller['anatablolar']; ?></a></li>       
		<li class="<?php if(isset($_GET['AnaTabloEkle'])){ echo "active"; } ?>"><a href="?AnaTabloEkle"><span class="icon-plus"></span> <?php echo $diller['anatabloEkle']; ?></a></li>     
		<li class="<?php if(isset($_GET['AnaTabloYonListele']) || isset($_GET['AnaTabloYonGuncelle'])){ echo "active"; } ?>"><a href="?AnaTabloYonListele"><span class="icon-enlarge"></span> <?php echo $diller['anatabloYonleri']; ?></a></li> 
		<li class="<?php if(isset($_GET['AnaTabloYonEkle'])){ echo "active"; } ?>"><a href="?AnaTabloYonEkle"><span class="icon-plus"></span><?php echo $diller['anatabloYonEkle']; ?></a></li> 
	                     
</ul> 
</li> 
<!-- Anatablo Ekranı -->
<!-- Web randevu Ekranı -->
<li class="nav-item"><a href="#"><i class="icon-whatshot danger"></i><span data-i18n="nav.page_layouts.main" class="menu-title"><?php echo $diller['webRandevu']; ?></span></a>
	<ul class="menu-content">
		<li class="<?php if(isset($_GET['WebRandevu']) && isset($_GET['ana'])){ echo "active"; } ?>"><a href="?WebRandevu&ana"><span class="icon-eye"></span> <?php echo $diller['goruntule']; ?></a></li>       
		<li class="<?php if(isset($_GET['WebRandevu']) && isset($_GET['tatil'])){ echo "active"; } ?>"><a href="?WebRandevu&tatil=on"><span class="icon-airplane"></span> <?php echo $diller['tatilAyar']; ?></a></li>  
		<li class="<?php if(isset($_GET['WebRandevu']) && isset($_GET['randevu'])){ echo "active"; } ?>"><a href="?WebRandevu&randevu=on"><span class="icon-clock"></span> <?php echo $diller['randevuAyar']; ?></a></li> 
		<li class="<?php if(isset($_GET['WebRandevu']) && isset($_GET['takvim'])){ echo "active"; } ?>"><a href="?WebRandevu&takvim=on"><span class="icon-calendar"></span> <?php echo $diller['takvimAyar']; ?></a></li>
		<li class="<?php if(isset($_GET['WebRandevu']) && isset($_GET['oturum'])){ echo "active"; } ?>"><a href="?WebRandevu&oturum=on"><span class="icon-hourglass"></span> <?php echo $diller['oturumAyar']; ?></a></li>
		<li class="<?php if(isset($_GET['WebRandevu']) && isset($_GET['mail'])){ echo "active"; } ?>"><a href="?WebRandevu&mail=on"><span class="icon-envelope"></span> <?php echo $diller['epostaAyar']; ?></a></li>
		<li class="<?php if(isset($_GET['WebRandevu']) && isset($_GET['sms'])){ echo "active"; } ?>"><a href="?WebRandevu&sms=on"><span class="icon-mobile"></span> <?php echo $diller['smsAyar']; ?></a></li>
		<li class="navigation-divider"></li>
		<li class="<?php if(isset($_GET['WebRandevu']) && isset($_GET['sistem'])){ echo "active"; } ?>"><a href="?WebRandevu&sistem=on"><span class="icon-cog"></span> <?php echo $diller['sistemAcKapa']; ?></a></li>
	                     
</ul>         
</li> 
<!-- Web randevu Ekranı -->
<!-- WebRapor Ekranı -->
          <li class=" nav-item"><a href="#"><i class="icon-stats-dots warning"></i><span data-i18n="nav.menu_levels.main" class="menu-title"><?php echo $diller['webRapor'];?></span></a>
            <ul class="menu-content">         
              <li class="<?php if(isset($_GET['WebRapor']) && isset($_GET['istatistik'])){ echo "active"; } ?>"><a href="?WebRapor&istatistik"><span class="nav.menu_levels.second_level icon-trending_up"></span> <?php echo $diller['istatistik']; ?></a>
             </li>

              <li><a href="#" data-i18n="nav.menu_levels.second_level_child.main"><span class="icon-clock"></span> <?php echo $diller['anlikRapor']; ?></a>
                <ul class="menu-content">
                  <li class="<?php if(isset($_GET['WebRapor']) && isset($_GET['anlikIslem'])){ echo "active"; } ?>"><a href="?WebRapor&anlikIslem=on" data-i18n="nav.menu_levels.second_level_child.third_level" class="menu-item"><span class="icon-repeat2"></span> <?php echo $diller['islemRapor']; ?></a>
                  </li>
                 <li class="<?php if(isset($_GET['WebRapor']) && isset($_GET['anlikMolaServis'])){ echo "active"; } ?>"><a href="?WebRapor&anlikMolaServis=on" data-i18n="nav.menu_levels.second_level_child.third_level" class="menu-item"><span class="icon-layers"></span> <?php echo $diller['molaVeServisRapor']; ?></a>
                  </li>                
                </ul>
              </li>

              <li><a href="#" data-i18n="nav.menu_levels.second_level_child.main"><span class="icon-list-alt"></span> <?php echo $diller['detayliRapor']; ?></a>
                <ul class="menu-content">
                  <li class="<?php if(isset($_GET['WebRapor']) && isset($_GET['detayIslem'])){ echo "active"; } ?>"><a href="?WebRapor&detayIslem=on" data-i18n="nav.menu_levels.second_level_child.third_level" class="menu-item"><span class="icon-cog3"></span> <?php echo $diller['islemRapor']; ?></a>
                  </li>
                 <li class="<?php if(isset($_GET['WebRapor']) && isset($_GET['detayGrup'])){ echo "active"; } ?>"><a href="?WebRapor&detayGrup=on" data-i18n="nav.menu_levels.second_level_child.third_level" class="menu-item"><span class="icon-grid2"></span> <?php echo $diller['grupRapor']; ?></a>
                  </li>
                 <li class="<?php if(isset($_GET['WebRapor']) && isset($_GET['detayTerminal'])){ echo "active"; } ?>"><a href="?WebRapor&detayTerminal=on" data-i18n="nav.menu_levels.second_level_child.third_level" class="menu-item"><span class="icon-stack-2"></span> <?php echo $diller['terminalRapor']; ?></a>
                  </li>
                    <li class="<?php if(isset($_GET['WebRapor']) && isset($_GET['detayMola'])){ echo "active"; } ?>"><a href="?WebRapor&detayMola=on" data-i18n="nav.menu_levels.second_level_child.third_level" class="menu-item"><span class="icon-pause2"></span> <?php echo $diller['detayMola']; ?></a>
                  </li>
  				<li class="<?php if(isset($_GET['WebRapor']) && isset($_GET['detayServis'])){ echo "active"; } ?>"><a href="?WebRapor&detayServis=on" data-i18n="nav.menu_levels.second_level_child.third_level" class="menu-item"><span class="icon-esc"></span> <?php echo $diller['detayServis']; ?></a>
                  </li>
                </ul>
              </li>

	<li class="<?php if(isset($_GET['WebRapor']) && isset($_GET['anket'])){ echo "active"; } ?>"><a href="?WebRapor&anket=on"><span class="icon-bar-chart"></span> <?php echo $diller['anketRapor']; ?></a></li>

            </ul>
          </li>
<!-- WebRapor Ekranı -->

<li class=" navigation-header"><span data-i18n="nav.category.support"><?php echo $diller['destek']; ?></span><i data-toggle="tooltip" data-placement="right" data-original-title="Support" class="icon-ellipsis icon-ellipsis"></i>
</li>
<li class=" nav-item"><a target="_blank" href="http://omes.net"><i class="icon-support"></i><span data-i18n="nav.support_raise_support.main" class="menu-title"><?php echo $diller['teknikDestek']; ?></span></a>
</li>
<li class=" nav-item"><a href="#"><i class="icon-document-text"></i><span data-i18n="nav.support_documentation.main" class="menu-title"><?php echo $diller['dokumantasyon']; ?></span></a>
</li>
</ul>
</div>