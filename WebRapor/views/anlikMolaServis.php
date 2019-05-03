<?php include 'WebRapor/class/rapor.php'; ?>
<?php include 'WebRapor/class/sorgu.php'; ?>
<?php $rapor = new Rapor(); ?>
<?php $sorgu = new Sorgu(); ?>          

	<div class="col-xl-12 col-lg-12">
        <div class="card panel-info">
            <div class="card-header panel-heading">
                <h4 class="card-title"><?php echo $diller['molaVeServisRapor']; ?></h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                     <ul class="list-inline mb-0">
                        <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
             <div class="card-body">
                <div class="card-block">
                   <form action="?WebRapor&anlikMolaServis" method="post" > 
                    <p class="col-md-3">  
                         <span><?php echo $diller['sorumluPersonel']; ?></span>     
                            <select id="personelID" name="personelID" onchange="this.form.submit()" class="form-control">
                                <option value="0"><?php echo $diller['ad']." ".$diller['seciniz']; ?></option>
                                <?php foreach ($sorgu->Cek("PERSONELLER","AD","PID!=1") as $row) { 
                                ?>   
                                <option value="<?php echo $row->PID; ?>"<?php echo (isset($_POST['personelID']) && $_POST['personelID']==$row->PID)? " selected":"";?>><?php echo $row->AD;?></option>
                                <?php 
                            } ?>
                            </select>                    
                </p>  
                <p class="col-md-3">
                	<span><?php echo $diller['servisKapama']; ?></span> 
                	<label class="switch">
					<input id="molaServisSec" type="checkbox" onchange="degistir(this.id,this.value)" name="molaServisSec" value="0">
					<span class="slider round"></span>
					</label>
					<span><?php echo $diller['molalar']; ?></span> 
                </p>
            </form> 
            </div>
        </div>
            <div id="yer_tutucu" class="table-responsive">
                    
		 	</div>
        </div>
                <div class="panel-footer">
<?php echo $diller['anlikRapor'];?>
</div>
</div>
</div>
<script type="text/javascript">
	function degistir(id,val)
	{
		var eleman=document.getElementById(id);
		if(eleman.checked)
		{
			eleman.value=1;
			eleman.setAttribute("checked","checked");
		}else
		{
			eleman.value=0;
			eleman.removeAttribute("checked");
		}
	}
function update() { 
		var values = {
			'personelID':  document.getElementById('personelID').value,					
		};
		var urls=(document.getElementById('molaServisSec').value==1)?"WebRapor/views/molalar.php":"WebRapor/views/servisler.php";
	
		$.ajax({
			type: 'POST',
			url: urls,
			timeout: 20000,
			data:values,
			success: function(data) {
				if(document.getElementById("personelID").value!=0)
				$("#yer_tutucu").html(data);
				window.setTimeout(update, 1000);
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				$("#yer_tutucu").html('Yükleniyor..');
				window.setTimeout(update, 10000);
			}
		});
		
	}

	$(document).ready(function() {		
		update();
	});

</script>