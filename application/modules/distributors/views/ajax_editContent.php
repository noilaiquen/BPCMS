<link href="<?=PATH_URL.'assets/css/admin/'?>bootstrap-multi-select.css" rel="stylesheet" type="text/css"/>
<script src="<?=PATH_URL.'assets/js/admin/'?>bootstrap-multi-select.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
   $('#production_ids').select2();
});

function save(){
	var options = {
		beforeSubmit:  showRequest,  // pre-submit callback 
		success:       showResponse  // post-submit callback 
    };
	$('#frmManagement').ajaxSubmit(options);
}

function showRequest(formData, jqForm, options) {
	var form = jqForm[0];
	if(form.name.value == '' || form.code.value == ''){
		$('#txt_error').html('Những trường gắn * là bắt buộc!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		return false;
	}
}

function showResponse(responseText, statusText, xhr, $form) {
	responseText = responseText.split(".");
	token_value  = responseText[1];
	$('#csrf_token').val(token_value);
	if(responseText[0]=='success'){
		show_perm_success();
	}

	if(responseText[0]=='permission-denied'){
		$('#txt_error').html('Permission denied.');
		show_perm_denied();
		return false;
	}
	
	if(responseText[0]=='error-distributor-name-exists'){
		$('#txt_error').html('Nhà cung cấp đã tồn tại.');
		show_perm_denied();
		$('#name').focus();
		return false;
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
					<i class="fa fa-globe"></i>Thêm nhà cung cấp
				</div>
			</div>
			
			<div class="portlet-body form">
				<div class="form-body notification" style="display:none">
					<div class="alert alert-success" style="display:none">
						<strong>Thành công!</strong> Đã lưu thông tin
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
                  <div class="form-group">
                     <label class="control-label col-md-2">Trạng thái</label>
                     <div class="col-md-9">
                        <div class="checkbox-list">
                           <label class="checkbox-inline">
                              <input <?php if(isset($result->status)){ if($result->status==1){ ?>checked="checked"<?php }}else{ ?>checked="checked"<?php } ?> type="checkbox" name="status">
                           </label>
                        </div>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="control-label col-md-2">Tên nhà cung cấp <span class="required" aria-required="true">*</span></label>
                     <div class="col-md-9">
                        <input value="<?= isset($result->name) ? $result->name : ''; ?>" type="text" name="name" id="name" class="form-control" placeholder="EX: Abc Company..."/>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="control-label col-md-2">Mã nhà cung cấp <span class="required" aria-required="true">*</span></label>
                     <div class="col-md-9">
                        <input value="<?= isset($result->code) ? $result->code : ''; ?>" type="text" name="code" id="code" class="form-control" placeholder="EX: EXP0001..."/>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="control-label col-md-2">Địa chỉ</label>
                     <div class="col-md-9">
                        <input value="<?= isset($result->address) ? $result->address : ''; ?>" type="text" name="address" id="address" class="form-control colorpicker" placeholder="EX: 123 address..."/>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="control-label col-md-2">Điện thoại</label>
                     <div class="col-md-9">
                        <input value="<?= isset($result->telephone) ? $result->telephone : ''; ?>" type="text" name="telephone" id="telephone" class="form-control colorpicker" placeholder="EX: 84212345678..."/>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="control-label col-md-2">Email</label>
                     <div class="col-md-9">
                        <input value="<?= isset($result->email) ? $result->email : ''; ?>" type="email" name="email" id="email" class="form-control colorpicker" placeholder="EX: example@mail.com..."/>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="control-label col-md-2">Sản phẩm cung cấp</label>
                     <div class="col-md-9">
                        <select class="form-control" id="production_ids" multiple="multiple" name="production_ids[]">
                           <option value="1" <?=(isset($result->production_ids) && in_array(1, $result->production_ids)) ? 'selected' : '';?>>Gạch</option>
                           <option value="2" <?=(isset($result->production_ids) && in_array(2, $result->production_ids)) ? 'selected' : '';?>>Sơn</option>
                        </select>
                     </div>
                  </div>
               </div>

					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-4 col-md-9" style="height: 50px">
								<button onclick="save()" type="button" class="btn green"><i class="fa fa-pencil"></i> Lưu</button>
								<a href="<?=PATH_URL_ADMIN.$module.'/#/back'?>"><button type="button" class="btn default">hủy</button></a>
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