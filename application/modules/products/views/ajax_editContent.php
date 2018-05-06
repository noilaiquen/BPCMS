<link href="<?=PATH_URL.'assets/css/admin/'?>bootstrap-multi-select.css" rel="stylesheet" type="text/css"/>
<!-- <link href="<?=PATH_URL.'assets/css/admin/'?>color-picker.min.css" rel="stylesheet" type="text/css"/> -->
<script src="<?=PATH_URL.'assets/js/admin/'?>bootstrap-multi-select.min.js" type="text/javascript"></script>
<!-- <script src="<?=PATH_URL.'assets/js/admin/'?>color-picker.min.js"type="text/javascript"></script> -->

<script type="text/javascript">
$(document).ready(function(){
   $('.select2').select2();

   $('#date_expiration, #date_production').datepicker({
      format: 'dd-mm-yyyy',
   });

   $("#price_input, #price_output, #discount_price_output, #count_stock").keydown(function (e) {
      if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
         (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
         (e.keyCode >= 35 && e.keyCode <= 40)) {
            return;
         }
      if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
         e.preventDefault();
      }
   });

   showDiscountInput();

   loadCategories('<?=isset($result->category_id) ? $result->category_id : 0; ?>');
});

function showDiscountInput(){
   if($('input[name="is_discount"]').prop('checked') == true) {
      $('.is_discount').show();
   } else {
      $('input[name="discount_price_output"]').val(0);
      $('.is_discount').hide();
   }
}

function save(){
	var options = {
		beforeSubmit:  showRequest,  // pre-submit callback 
		success:       showResponse  // post-submit callback 
    };
	$('#frmManagement').ajaxSubmit(options);
}

function showRequest(formData, jqForm, options) {
	var form = jqForm[0];
	if(form.product_name.value == '' || form.product_code.value == '' || form.unit.value == '' || form.price_input.value == '' || form.price_output.value == '' || form.discount_price_output.value == ''){
		$('#txt_error').html('Trường gắn * là bắt buộc!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		return false;
	}
}

function loadCategories(current_cate_id = 0){
   $.post(root+module+'/loadCategories',{
      type_id: $('#product_type_id').val(),
      cate_id: current_cate_id
   }, function(response){
      $('#category_id').html(response);
   });
}

function showResponse(responseText, statusText, xhr, $form) {
   var response = JSON.parse(responseText);
	$('#csrf_token').val(response.token);

	if(response.status == 1){
		show_perm_success();
      return;
	}

	if(response.status == 0){
      if(typeof response.message == 'object') {
         var html = '';
         response.message.forEach(function(error){
            html += error + '<br>';
         });
         $('#txt_error').html(html);
      } else {
		   $('#txt_error').html(response.message);
      }
		show_perm_denied();
		return;
	}
}
var distributors = [];

</script>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"><?=$this->session->userdata('Name_Module')?></h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?=PATH_URL_ADMIN?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?=PATH_URL_ADMIN.$module?>"><?=$this->session->userdata('Name_Module')?></a><i class="fa fa-angle-right"></i></li>
		<li><?php ($this->uri->segment(4)=='') ? print 'Add new' : print 'Edit' ?></li>
	</ul>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box grey-cascade">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>Thêm sản phẩm
				</div>
			</div>
			
			<div class="portlet-body form">
				<div class="form-body notification" style="display:none">
					<div class="alert alert-success" style="display:none">
						<strong>Thành công!</strong> Đã lưu thông tin.
					</div>
					
					<div class="alert alert-danger" style="display:none">
						<strong>Lỗi!</strong> <span id="txt_error"></span>
					</div>
				</div>
				
				<!-- BEGIN FORM-->
				<form id="frmManagement" action="<?=PATH_URL_ADMIN.$module.'/save/'?>" method="post" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
					<input type="hidden" value="<?=$this->security->get_csrf_hash()?>" id="csrf_token" name="csrf_token" />
					<input type="hidden" value="<?=$id?>" name="hiddenIdAdmincp" />
					<div class="form-body">
                  <div class="col-md-12">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="control-label col-md-4">Hình ảnh</label>
                           <div class="col-md-8">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                 <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                    <?php if(isset($result->thumbnail)) {?>
                                       <img src="<?=$result->thumbnail?>" alt="thumbnail">
                                    <?php } ?>
                                 </div>
                                 <div>
                                    <span class="btn btn-default btn-file">
                                       <span class="fileinput-new">Chọn</span>
                                       <span class="fileinput-exists">Thay đổi</span>
                                       <input type="file" name="thumbnail">
                                    </span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Loại bỏ</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label col-md-4">Trạng thái</label>
                        <div class="col-md-8">
                           <div class="checkbox-list">
                              <label class="checkbox-inline">
                                 <input <?php if(isset($result->status)){ if($result->status==1){ ?>checked="checked"<?php }}else{ ?>checked="checked"<?php } ?> type="checkbox" name="status">
                              </label>
                           </div>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="control-label col-md-4">Tên sản phẩm <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-8">
                           <input value="<?= isset($result->product_name) ? $result->product_name : ''; ?>" type="text" name="product_name" id="product_name" class="form-control"/>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="control-label col-md-4">Mã sản phẩm <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-8">
                           <input value="<?= isset($result->product_code) ? $result->product_code : ''; ?>" type="text" name="product_code" id="product_code" class="form-control"/>
                        </div>
                     </div>

                     <!-- <div class="form-group">
                        <label class="control-label col-md-4">Mã màu</label>
                        <div class="col-md-8">
                           <input value="<?= isset($result->color_code) ? $result->color_code : ''; ?>" type="text" name="color_code" id="color_code" class="form-control colorpicker" placeholder="EX: #FFFFFF"/>
                        </div>
                     </div> -->

                     <div class="form-group">
                        <label class="control-label col-md-4">Số lượng</label>
                        <div class="col-md-8">
                           <input value="<?= isset($result->count_stock) ? $result->count_stock : ''; ?>" type="number" name="count_stock" id="count_stock" class="form-control" placeholder="EX: 20"/>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="control-label col-md-4">Đơn vị tính <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-8">
                           <input value="<?= isset($result->unit) ? $result->unit : ''; ?>" type="text" name="unit" id="unit" class="form-control" placeholder="EX: Thùng..."/>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="control-label col-md-4">Giá nhập vào <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-8">
                           <input value="<?= isset($result->price_input) ? $result->price_input : ''; ?>" type="number" name="price_input" id="price_input" class="form-control" placeholder="EX: 45000"/>
                           <small style="color: #DDD">Giá tiền/1 SP</small>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="control-label col-md-4">Giá bán ra <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-8">
                           <input value="<?= isset($result->price_output) ? $result->price_output : ''; ?>" type="number" name="price_output" id="price_output" class="form-control" placeholder="EX: 50000"/>
                           <small style="color: #DDD">Giá tiền/1 SP</small>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="control-label col-md-4">Loại tiền tệ</label>
                        <div class="col-md-8">
                           <?php foreach($price_units as $price_unit_id => $price_unit){?>
                              <label class="radio-inline"><input type="radio" value="<?=$price_unit_id?>" name="price_unit_id" id="price_unit_id" <?=(isset($result->price_unit_id) && $result->price_unit_id == $price_unit_id) ? 'checked' : '';?>><?=$price_unit?></label>
                           <?php } ?>
                        </div>
                     </div>
                     
                     <div class="form-group">
                        <label class="control-label col-md-4">Giảm giá?</label>
                        <div class="col-md-8">
                           <div class="checkbox-list">
                              <label class="checkbox-inline">
                                 <input <?php if(isset($result->is_discount)){ if($result->is_discount==1){ ?>checked="checked"<?php }}?> type="checkbox" name="is_discount" id="is_discount" onchange="showDiscountInput()">
                              </label>
                           </div>
                        </div>
                     </div>

                     <div class="form-group last is_discount" style="display: none">
                        <label class="control-label col-md-4">Giá mới bán ra đã giảm</label>
                        <div class="col-md-8">
                           <input value="<?= isset($result->discount_price_output) ? $result->discount_price_output : ''; ?>" type="number" name="discount_price_output" id="discount_price_output" class="form-control" placeholder="EX: 50000"/>
                           <small style="color: #DDD">Giá tiền/1 SP</small>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label col-md-4">Loại sản phẩm</label>
                        <div class="col-md-8">
                           <select class="form-control" name="product_type_id" id="product_type_id" onchange="loadCategories('<?=isset($result->product_type_id) ? $result->product_type_id : 0; ?>')">
                              <?php if($product_types) {
                              foreach($product_types as $product_type) { ?>
                              <option value="<?=$product_type->id?>" <?=(isset($result->product_type_id) && $result->product_type_id == $product_type->id) ? 'selected' : '';?>><?=$product_type->name?></option>
                              <?php } } ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-4">Danh mục sản phẩm</label>
                        <div class="col-md-8">
                           <select class="form-control" name="category_id" id="category_id">
                              <?php foreach($categories as $category){?>
                                 <option value="<?=$category->id;?>" <?=(isset($result->category_id) && $result->category_id == $category->id) ? 'selected' : '';?>><?=$category->name;?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="control-label col-md-4">Nhà cung cấp</label>
                        <div class="col-md-8">
                           <select class="form-control select2" id="distributors" multiple="multiple" name="distributor_ids[]">
                              <?php if($distributors){ 
                              foreach($distributors as $distributor) {?>
                                 <option value="<?=$distributor->id?>" <?=(isset($result->distributor_ids) && in_array((int)$distributor->id, $result->distributor_ids)) ? 'selected' : '';?>><?=$distributor->name?></option>
                              <?php } } ?>
                           </select>
                        </div>
                     </div>

                     <!-- <div class="form-group">
                        <label class="control-label col-md-4">Size</label>
                        <div class="col-md-8">
                           <input value="<?= isset($result->size) ? $result->size : ''; ?>" type="text" name="size" id="size" class="form-control" placeholder="EX: SM..."/>
                        </div>
                     </div> -->

                     <!-- <div class="form-group">
                        <label class="control-label col-md-4">Số lượng</label>
                        <div class="col-md-8">
                           <input value="<?= isset($result->count_stock) ? $result->count_stock : ''; ?>" type="number" name="count_stock" id="count_stock" class="form-control" placeholder="EX: 20"/>
                        </div>
                     </div> -->

                     <div class="form-group">
                        <label class="control-label col-md-4">Ngày sản xuất</label>
                        <div class="col-md-8">
                           <input value="<?= isset($result->date_production) ? date('d-m-Y', strtotime($result->date_production)) : ''; ?>" type="text" name="date_production" id="date_production" class="form-control"/>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="control-label col-md-4">Ngày hết hạn</label>
                        <div class="col-md-8">
                           <input value="<?=isset($result->date_expiration) ? date('d-m-Y', strtotime($result->date_expiration)) : ''; ?>" type="text" name="date_expiration" id="date_expiration" class="form-control"/>
                        </div>
                     </div>
                     <!-- <div class="form-group last">
                        <label class="control-label col-md-4">Mô tả sản phẩm</label>
                        <div class="col-md-8">
                           <textarea name="description" id="description" cols="10" rows="3" class="form-control" style="vertical-align: middle;padding:0;">
                              <?=isset($result->description) ? $result->description : ' '; ?>
                           </textarea>
                        </div>
                     </div> -->
                  </div>
               </div>

					<div>
						<div class="row">
							<div class="col-md-offset-4 col-md-8" style="height: 50px">
								<button onclick="save()" type="button" class="btn green"><i class="fa fa-pencil"></i> Lưu</button>
								<a href="<?=PATH_URL_ADMIN.$module.'/#/back'?>"><button type="button" class="btn default">Hủy</button></a>
							</div>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT-->