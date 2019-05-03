<?php
	$query_GrupListele = "SELECT * FROM GRUPLAR ORDER BY GRPID DESC";
	$row_GrupListele = $db->query($query_GrupListele, PDO::FETCH_ASSOC);
?>
        <div class="card panel panel-grey">
            <div class="card-header panel-heading">
                <h4 class="card-title"><?php echo $diller['grupListesi']; ?><a class="btn btn-success" style="margin-left:10px" href="?GrupEkle&"><?php echo $diller['grupEkle'];?></a></h4>
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

		<div class="panel body table-responsive">
			<?php if ($row_GrupListele -> rowCount()) { // Show if recordset not empty 
			?>
			<table id="tablo" class="table table-hover">
				<thead>
					<tr class="label-info">
						<th><?php echo $diller['grupIsmi']; ?></th>
						<th><?php echo $diller['guncelle']; ?></th>
						<th><?php echo $diller['sil']; ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($row_GrupListele as $row_GrupListele){ ?>
						<tr>
							<td class="alert alert-success"><strong><?php echo $row_GrupListele['GRUP_ISMI']; ?></strong>
								<?php if($row_GrupListele['Webrandevu']){ echo $diller['randevuTuru_1'];}else{ echo $diller['randevuTuru_2']; } ?>
							</td>
							<td><a class="btn btn-primary" href="?GrupGuncelle=<?php echo $row_GrupListele['GRPID']; ?>"><?php echo $diller['guncelle']; ?></a></td>
							<td><a onClick="return confirm('<?php echo $diller["silmePopupMesaj"]; ?>');" href="?GrupSil=<?php echo $row_GrupListele['GRPID']; ?>" class="btn btn-danger" id="sprytrigger1"><?php echo $diller['sil']; ?></a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			
			<div class="tooltipContent" id="sprytooltip1"><?php echo $diller['silMesaj']; ?></div>
			<script type="text/javascript">
			var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
			</script>
			<?php }else{ ?>
			<p> 
			<?php echo $diller['listMesaj']; ?> <a href="?GrupEkle" class="btn btn-success"><?php echo $diller['grupEkle']; ?></a>  
				</p>
			<?php } // Show if recordset not empty ?>
			</div></div></div>
		</div></div>
						