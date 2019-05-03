<script>
$(function () {
    $('#tablo').DataTable({			
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
	"responsive": true,
	"processing":true,
	"language":{ 
	"sDecimal":        ",",
	"sEmptyTable":     "<?php echo $diller['listMesaj']; ?>",
	"sInfo":           "<?php echo $diller['sInfo']; ?>",
	"sInfoEmpty":      "<?php echo $diller['sInfoEmpty']; ?>",
	"sInfoFiltered":   "<?php echo $diller['sInfoFiltered']; ?>",
	"sInfoPostFix":    "",
	"sInfoThousands":  ".",
	"sLengthMenu":     "<?php echo $diller['sLengthMenu']; ?>",
	"sLoadingRecords": "<?php echo $diller['sLoadingRecords']; ?>",
	"sProcessing":     "<?php echo $diller['sProcessing']; ?>",
	"sSearch":         "<?php echo $diller['sSearch']; ?>:",
	"sZeroRecords":    "<?php echo $diller['sZeroRecords']; ?>",
	"oPaginate": {
		"sFirst":    "<?php echo $diller['sFirst']; ?>",
		"sLast":     "<?php echo $diller['sLast']; ?>",
		"sNext":     "<?php echo $diller['sNext']; ?>",
		"sPrevious": "<?php echo $diller['sPrevious']; ?>"
	},
	"oAria": {
		"sSortAscending":  ": <?php echo $diller['sSortAscending']; ?>",
		"sSortDescending": ": <?php echo $diller['sSortDescending']; ?>"
	}
, 
	buttons: {
                    copyTitle: "<?php echo $diller['copyTitle'];?>",
                    copySuccess:"<?php echo $diller['copySuccess'];?>",
                    copy: "<?php echo $diller['copy'];?>",
                    print: "<?php echo $diller['print'];?>",
					colvis:"<?php echo $diller['colvis'];?>",
					excel:"<?php echo $diller['excel'];?>",
					pdf:"<?php echo $diller['pdf'];?>",
					
                }
		
	},
	dom: 'Bfrtip',   buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ]        
    });
  });
  </script>