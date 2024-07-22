<script>
var base_url = '<?php echo SITE_ROOT_FRONT; ?>'; 
</script>
<script src="<?php echo SITE_ROOT_FRONT;?>js/jquery.min.js"></script>
<script src="<?php echo SITE_ROOT_FRONT;?>vendors/js/vendor.bundle.base.js"></script>
<script src="<?php echo SITE_ROOT_FRONT;?>vendors/select2/select2.min.js"></script>
<script src="<?php echo SITE_ROOT_FRONT;?>vendors/chart.js/Chart.min.js"></script>
<script src="<?php echo SITE_ROOT_FRONT;?>vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?php echo SITE_ROOT_FRONT;?>vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="<?php echo SITE_ROOT_FRONT;?>js/dataTables.select.min.js"></script>
<script src="<?php echo SITE_ROOT_FRONT;?>js/off-canvas.js"></script>
<script src="<?php echo SITE_ROOT_FRONT;?>js/hoverable-collapse.js"></script>
<script src="<?php echo SITE_ROOT_FRONT;?>js/template.js"></script>
<script src="<?php echo SITE_ROOT_FRONT;?>js/settings.js"></script>
<script src="<?php echo SITE_ROOT_FRONT;?>js/todolist.js"></script>
<script src="<?php echo SITE_ROOT_FRONT;?>js/file-upload.js"></script>
<script src="<?php echo SITE_ROOT_FRONT;?>js/typeahead.js"></script>
<script src="<?php echo SITE_ROOT_FRONT;?>js/select2.js"></script>
<script src="<?php echo SITE_ROOT_FRONT;?>js/dashboard.js"></script>
<script src="<?php echo SITE_ROOT_FRONT;?>js/Chart.roundedBarCharts.js"></script>
<?php if($page_name != "Add Company" && empty($_SESSION['company_name'])){ ?>
<script>
	$(document).ready(function () {
		$(".companypopup").trigger("click");
	});
</script>
<?php } ?>
<script>
	$(document).ready(function () {
		$(document).on('click','#companypopup ul li',function(){
			var dataid = $(this).data("id");
			var dataname = $(this).data("title");
			$.ajax({
				type:'post',
				url:base_url+'ajax_data.php',
				data:"company_id="+dataid+"&company_name="+dataname+"&action=set_company",
				success:function(url){
					window.location.reload();
					return false;
				},
			});
		});
	});
</script>