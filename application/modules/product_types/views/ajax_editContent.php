<script type="text/javascript">

function save(){
	var options = {
		beforeSubmit:  showRequest,  // pre-submit callback 
		success:       showResponse  // post-submit callback 
    };
	$('#frmManagement').ajaxSubmit(options);
}

function showRequest(formData, jqForm, options) {
	var form = jqForm[0];
	if(form.name.value == ''){
		$('#txt_error').html('Trường gắn * là bắt buộc!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		return false;
	}
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
					<i class="fa fa-globe"></i>Thêm loại sản phẩm
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
						<div class="form-group">
							<label class="control-label col-md-3">Trạng thái</label>
							<div class="col-md-9">
								<div class="checkbox-list">
									<label class="checkbox-inline">
										<input <?php if(isset($result->status)){ if($result->status==1){ ?>checked="checked"<?php }}else{ ?>checked="checked"<?php } ?> type="checkbox" name="status">
									</label>
								</div>
							</div>
                  </div>

						<div class="form-group">
							<label class="control-label col-md-3">Có mã màu?</label>
							<div class="col-md-9">
								<div class="checkbox-list">
									<label class="checkbox-inline">
										<input <?php if(isset($result->has_color)){ if($result->has_color==1){ ?>checked="checked"<?php }}?> type="checkbox" name="has_color">
									</label>
								</div>
							</div>
                  </div>
                  
						<div class="form-group">
							<label class="control-label col-md-3">Tên loại sản phẩm <span class="required" aria-required="true">*</span></label>
							<div class="col-md-9">
                        <div class="col-md-9"><input value="<?php if(isset($result->name)) { print $result->name; }else{ print '';} ?>" type="text" name="name" id="name" class="form-control"/></div>
							</div>
                  </div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
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