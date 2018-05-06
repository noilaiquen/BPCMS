<script type="text/javascript">
$(document).ready(function(){
   $('#date').datepicker({
      format: 'dd-mm-yyyy',
   });

   $("#qty").keydown(function (e) {
      if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
         (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
         (e.keyCode >= 35 && e.keyCode <= 40)) {
            return;
         }
      if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
         e.preventDefault();
      }
   });

   loadCategoriesByType();
   showColorInput();
});

function save(){
	var options = {
		beforeSubmit:  showRequest,  
		success:       showResponse  // post-submit callback 
    };
   $('#frmManagement').ajaxSubmit(options);
}

function showRequest(formData, jqForm, options) {
	/* .... */
}

function showResponse(responseText, statusText, xhr, $form) {
   var responseJSON = JSON.parse(responseText);
	$('#csrf_token').val(responseJSON.token);
	if(responseJSON.status == 1){
		show_perm_success();
	} else {
      show_perm_denied(responseJSON.message);
		return false;
   }
}

function loadCategoriesByType() {
   showColorInput();
   $.post(root+'products'+'/loadCategories',{
      type_id: $('#product_type_id').val(),
      cate_id: 0
   }, function(response){
      $('#category_id').html(response);
      loadProductsbyCate();
   });
}

function loadProductsbyCate() {
   if($('#category_id').val() == null || $('#category_id').val() == undefined || $('#category_id').val() == '0') {
      $('#product_id').html('');
      return;
   }
   $.post(root+module+'/loadProductsbyCate',{
      category_id: $('#category_id').val()
   }, function(response){
      $('#product_id').html(response);
   });
}

function showCustomerInput() {
   showColorInput();
   if($('#type').val() == 2) {
      $('.customer-info').show();
   } else {
      $('.customer-info').hide();
   }
}

function showColorInput() {
   if($('#type').val() == 2) {
      var pt_color = JSON.parse('<?=$product_types_colors?>');
      var product_type_id = $('#product_type_id').val();
      if(pt_color.indexOf(product_type_id) >= 0) {
         $('.color-input').show();
      } else {
         $('.color-input').hide();
      }
   } else {
      $('.color-input').hide();
   }
}

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
					<i class="fa fa-globe"></i>Form Information
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
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label col-md-4">Loại sản phẩm <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-7">
                           <select name="product_type_id" id="product_type_id" class="form-control" onchange="loadCategoriesByType()">
                              <?php if($product_types) {
                              foreach($product_types as $product_type) { ?>
                              <option value="<?=$product_type->id?>"><?=$product_type->name?></option>
                              <?php } } ?>
                           </select>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="control-label col-md-4">Danh mục sản phẩm <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-7">
                           <select name="category_id" id="category_id" class="form-control" onchange="loadProductsbyCate()">
                           </select>
                        </div>
                     </div>
                     
                     <div class="form-group">
                        <label class="control-label col-md-4">Sản phẩm <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-7">
                           <select name="product_id" id="product_id" class="form-control">
                           </select>
                        </div>
                     </div>

                     <div class="form-group color-input" style="display: none">
                        <label class="control-label col-md-4">Mã màu</label>
                        <div class="col-md-7">
                           <input type="text" class="form-control" name="color_code" id="color_code" required>
                        </div>
                     </div>
                  </div>
                     
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label col-md-4">Hoạt động <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-7">
                           <select name="type" id="type" class="form-control" onchange="showCustomerInput()">
                              <option value="1">Nhập kho</option>
                              <option value="2">Xuất kho</option>
                           </select>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="control-label col-md-4">Số lượng <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-7">
                           <input type="number" class="form-control" name="qty" id="qty" required>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="control-label col-md-4">Ngày thực hiện <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-7">
                           <input type="text" class="form-control" name="date" id="date" value="<?=date('d-m-Y')?>">
                        </div>
                     </div>
                  </div>

                  <div class="customer-info" style="display: none">
                     <div class="col-md-12" style="border-bottom: 1px solid #eee">
                        <h4 class="text-danger" style="font-weight: bold">Thông tin khách hàng</h4>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="control-label col-md-4">Họ tên khách hàng <span class="required" aria-required="true">*</span></label>
                           <div class="col-md-7">
                              <input type="text" class="form-control" name="customer_name">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-4">Điện thoại</label>
                           <div class="col-md-7">
                              <input type="text" class="form-control" name="customer_phone">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-4">Email</label>
                           <div class="col-md-7">
                              <input type="text" class="form-control" name="customer_email">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="control-label col-md-4">Địa chỉ <span class="required" aria-required="true">*</span></label>
                           <div class="col-md-7">
                              <input type="text" class="form-control" name="customer_address">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-4">Ghi chú khách hàng</label>
                           <div class="col-md-7">
                              <textarea name="customer_note" id="customer_note" cols="10" rows="4"> </textarea>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

					<div>
						<div class="row">
							<div class="col-md-offset-4 col-md-9" style="height: 50px; padding-top: 10px" >
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-save"></i> Lưu</button>
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

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-body">
            <h4 class="text-danger">Xác nhận!</h4>
         </div>
         <div class="modal-footer">
            <button onclick="save()" type="button" class="btn green"  data-dismiss="modal">Ok</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
         </div>
      </div>
   </div>
</div>
    