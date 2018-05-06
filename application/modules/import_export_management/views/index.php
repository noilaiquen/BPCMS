<input type="hidden" value="<?php ($this->session->userdata('start'))? print $this->session->userdata('start') : print 0 ?>" id="start" />
<input type="hidden" value="<?=$default_func?>" id="func_sort" />
<input type="hidden" value="<?=$default_sort?>" id="type_sort" />

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

<!-- BEGIN SHOW LOADING EXPORT EXCEL -->
<div class="mask_loading"></div>
<div class="loading_content">
	<div class="loading_animate">
		<img src="<?=PATH_URL?>static/img/loading.gif" />
		<div class="loading_text"><!-- Text here --></div>
	</div>
</div>
<!-- END SHOW LOADING EXPORT EXCEL -->

<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box grey-cascade">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>Bảng quản lý
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
								<a href="<?=PATH_URL_ADMIN.$module.'/update/'?>"><button class="btn btn-margin green"><i class="fa fa-edit"></i> Thêm hoạt động</button></a>
								<a href="javascript:void(0)" class="pull-right btn btn-margin blue" onclick="ajax_export()"><i class="fa fa-file-excel-o"></i> Xuất excel</a>
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
								<label style="margin-bottom:0;margin-left:10px">Ngày thực hiện:&nbsp;</label>
                       <!--  <label style="margin-bottom:0;">My search: <input onkeypress="return enterSearch(event)" id="search_content" placeholder="type here..." type="search" class="form-control input-medium input-inline" placeholder=""></label> -->
                        
                        
                        <label style="margin-bottom:0;  margin-left:10px">Loại sp:
                        <select id="type" class="form-control input-inline" onchange="loadCategoriesByType()">
                           <option value="">--Tất cả--</option>
                           <?php if($product_types) {
                           foreach($product_types as $product_type) { ?>
                           <option value="<?=$product_type->id?>"><?=$product_type->name?></option>
                           <?php } } ?>
                        </select></label>

                        <label style="margin-bottom:0;">Hoạt động:
                        <select id="action_type" class="form-control input-inline" onchange="searchContent(0)">
                           <option value="1" selected>Nhập kho</option>
                           <option value="2">Xuất kho</option>
                        </select></label>
							</div>
						</div>
						<div class="col-md-10 col-sm-12" style="margin-top: 10px">
                     <label style="margin-bottom:0;">Danh mục sp:
                     <select id="category" class="form-control input-inline" onchange="searchContent(0)">
                        <option value="">--Tất cả--</option>
                        <?php if($categories){ 
                           foreach($categories as $category) {  ?>
                           <option value="<?=$category->id?>"><?=$category->name?></option>
                        <?php } } ?>
                     </select></label>

                     <!-- <label style="margin-bottom:0;">Product:
                     <select id="product" class="form-control input-inline" onchange="searchContent(0)">
                        <option value="">--Select all--</option>
                        <?php if($products){ 
                           foreach($products as $product) {  ?>
                           <option value="<?=$product->id?>"><?=$product->product_name?></option>
                        <?php } } ?>
                     </select></label> -->
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
function loadCategoriesByType() {
   var type_id = $('#type').val();
   // if(type_id == '' || type_id == undefined) return;
   $.post(root+'products'+'/loadCategories',{
      type_id: type_id,
      cate_id: 0
   }, function(response){
      var html = '<option value="">--Tất cả--</option>';
      $('#category').html(html+response);
      searchContent(0);
      // loadProductsbyCate();
   });
}

/* function loadProductsbyCate() {
   searchContent();
   var category_id = $('#category').val();
   if(category_id == '' || category_id == undefined) return;

   $.post(root+module+'/loadProductsbyCate',{
      category_id: category_id
   }, function(response){
      var html = '<option value="">--Select All--</option>';
      $('#product').html(html+response);
   });
} */

function ajax_export(){
	show_loading();
	var file_name = '';
   var export_url = root+module+'/ajax_export';
	$.post(export_url, {
		action_type: $('#action_type').val(),
		product_type: $('#type').val(), 
		dateFrom: $('#caledar_from').val(), 
		dateTo: $('#caledar_to').val(), 
		category: $('#category').val()
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