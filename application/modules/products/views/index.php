<input type="hidden" value="<?php ($this->session->userdata('start'))? print $this->session->userdata('start') : print 0 ?>" id="start" />
<input type="hidden" value="<?=$default_func?>" id="func_sort" />
<input type="hidden" value="<?=$default_sort?>" id="type_sort" />

<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div class="modal fade" id="portlet-alert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Alert !!!</h4>
			</div>
			<div class="modal-body">
				Are you sure delete item selected?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn blue" onclick="deleteAll()">Delete</button>
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

<!-- BEGIN SHOW LOADING EXPORT EXCEL -->
<div class="mask_loading"></div>
<div class="loading_content">
	<div class="loading_animate">
		<img src="<?=PATH_URL?>static/img/loading.gif" />
		<div class="loading_text"><!-- Text here --></div>
	</div>
</div>
<!-- END SHOW LOADING EXPORT EXCEL -->

<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"><?=$module_name?></h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?=PATH_URL_ADMIN?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><?=$module_name?></li>
	</ul>
</div>
<!-- END PAGE HEADER-->

<div class="form-body notification" style="padding-bottom:10px !important;">
	<div class="alert alert-danger" style="display:none;">
		<strong>Error!</strong> <span id="txt_error"></span>
	</div>
</div>

<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box grey-cascade">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>Danh sách sản phẩm
				</div>
				<div class="tools">
					<a href="javascript:;" onclick="searchContent(0)" class="reload"></a>
				</div>
			</div>

			<div class="portlet-action">
				<div class="table-toolbar" style="margin-bottom:0">

					<div class="row" style="margin-bottom:15px">
						<div class="col-md-10">
							<div class="btn-group">
								<a href="<?=PATH_URL_ADMIN.$module.'/update/'?>"><button class="btn btn-margin green"><i class="fa fa-edit"></i> Thêm mới</button></a>
                        <a href="javascript:void(0)" class="pull-right btn btn-margin btn-primary" onclick="ajax_export()"><i class="fa fa-file-excel-o"></i> Xuất excel</a>
								<a href="#portlet-alert" data-toggle="modal" class="pull-right"><button class="btn btn-margin red" data-toggle="modal" href="#basic"><i class="fa fa-trash"></i> Xóa</button></a>
								<button class="btn btn-margin default pull-right" onclick="hideStatusAll()"><i class="fa fa-close"></i> Khóa</button>
								<button class="btn btn-margin blue pull-right" onclick="showStatusAll()"><i class="fa fa-check"></i> Mở</button>
							</div>
						</div>
					</div>
					
					<div class="row" style="margin-bottom:15px">
						<div class="col-md-2 col-sm-12">
							<div class="dataTables_length"><label style="margin-bottom:0;">
								<select id="per_page" class="form-control input-xsmall input-inline" onchange="searchContent(0,this.value)">
									<option value="10">10</option>
									<option value="20">20</option>
									<option value="50">50</option>
									<option value="100">100</option>
								</select> records</label>
							</div>
                  </div>

						<div class="col-md-10 col-sm-12">
							<div class="dataTables_filter">
								<button onclick="searchContent(0)" class="btn btn-margin yellow" style="float:right;margin-right:0 !important;margin-left:10px"><i class="fa fa-search"></i> Tìm</button>
								<div style="float:right;" class="input-group input-large date-picker input-daterange" data-date-format="dd-mm-yyyy">
									<input onkeypress="return enterSearch(event)" id="caledar_from" type="text" class="form-control" name="from">
									<span class="input-group-addon">to</span>
									<input onkeypress="return enterSearch(event)" id="caledar_to" type="text" class="form-control" name="to" style="width:100px">
								</div>
								<label style="margin-bottom:0;margin-left:10px">Ngày tạo:&nbsp;</label>
                        <label style="margin-bottom:0;">Tìm kiếm: <input onkeypress="return enterSearch(event)" id="search_content" placeholder="Nhập tên hoặc mã sp..." type="search" class="form-control input-medium input-inline"></label>
							</div>
						</div>
					</div>

					<div class="row">
                  <div class="col-md-3 col-sm-12">
                     <label style="margin-bottom:0;">Trạng thái:
                     <select id="status" class="form-control input-inline" onchange="searchContent(0)">
                        <option value="">--Tất cả--</option>
                        <option value="0">Khóa</option>
                        <option value="1">Mở</option>
                     </select></label>
                  </div>

						<div class="col-md-3 col-sm-12">
                     <label style="margin-bottom:0;">Loại sản phẩm:
                     <select id="type" class="form-control input-inline" onchange="loadCategoriesByType(this.value)">
                        <option value="0">--Tất cả--</option>
                        <?php if($product_types) {
                           foreach($product_types as $product_type) { ?>
                           <option value="<?=$product_type->id?>"><?=$product_type->name?></option>
                        <?php } } ?>
                     </select></label>
                  </div>

						<div class="col-md-4 col-sm-12">
                     <label style="margin-bottom:0;">Danh mục sản phẩm:
                     <select id="category" class="form-control input-inline" onchange="searchContent(0)">
                        <option value="0">--Tất cả--</option>
                        <?php foreach($categories as $category){?>
                           <option value="<?=$category->id;?>"><?=$category->name;?></option>
                        <?php } ?>
                     </select></label>
                  </div>
					</div>

				</div>
			</div>

			<div class="portlet-body" style="padding-top:5px;padding-bottom:9px;"></div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
   <div class="download_file_section" style="display:none;"></div>
</div>
<!-- END PAGE CONTENT-->

<script>
$(document).ready(function() {
	$("a.fancyboxClick").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut':'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false
	});
});

function loadCategoriesByType(type_id){
   $.post(root+'categories/loadCategoriesByType',{
      type_id: type_id
   }, function(respone){
      $('#category').html(respone);
      searchContent(0);
   });
}

function ajax_export(){
	show_loading();
	var file_name = '';
   var export_url = root+module+'/ajax_export';
	$.post(export_url, {
		status: $('#status').val(), 
		product_type: $('#type').val(), 
		dateFrom: $('#caledar_from').val(), 
		dateTo: $('#caledar_to').val(), 
		category: $('#category').val(),
		search_content: $('#search_content').val(),
	}, function(data){
		if(data && data.result=='success'){
			var file_name = data.file_name;
			if(file_name){
				if(typeof file_name == 'object') {
					for(var key in file_name) {
						if(file_name.hasOwnProperty(key)) {
							$('.download_file_section').append("<iframe src='<?=PATH_URL?>static/export_files/"+file_name[key]+"' style='display: none;'></iframe>");	
						}
					}		
				}
			
				if(typeof file_name == 'string') {
					$('.download_file_section').append("<iframe src='<?=PATH_URL?>static/export_files/"+file_name+"' style='display: none;'></iframe>");
				}	
			}
		} else {
			alert('KHÔNG CÓ DỮ LIỆU!');
		}
		hide_loading();
	}, 'JSON');
}
</script>