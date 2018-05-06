<script src="<?=PATH_URL.'assets/js/admin/'?>highchart.js" type="text/javascript"></script>
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
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->


<!-- BEGIN PAGE HEADER-->
<!-- <h3 class="page-title"><?=$module_name?></h3> -->
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

<div class="row">
   <div class="col-md-12">
      <!-- BEGIN EXAMPLE TABLE PORTLET-->
      <div class="portlet box grey-cascade">
         <div class="portlet-title">
            <div class="caption">
               <i class="fa fa-globe"></i>Over view
            </div>
         </div>

         <div class="portlet-action">
            <div id="total-stock"></div>
         </div>
      </div>
      <!-- END EXAMPLE TABLE PORTLET-->
   </div>
   <!-- <div class="col-md-6">
      <div class="portlet box grey-cascade">
         <div class="portlet-title">
            <div class="caption">
               <i class="fa fa-globe"></i>Gạch
            </div>
         </div>

         <div class="portlet-action">
            <div id="total-brick"></div>
         </div>
      </div>
   </div> -->

   <!-- <div class="col-md-6">
      <div class="portlet box grey-cascade">
         <div class="portlet-title">
            <div class="caption">
               <i class="fa fa-globe"></i>Sơn
            </div>
         </div>

         <div class="portlet-action">
            <div id="total-paint"></div>
         </div>
      </div>
   </div> -->
</div>

<script>

var countTotalInStockData = JSON.parse('<?=$countTotalInStock?>');
Highcharts.chart('total-stock', {
    title: {
        text: 'Số lượng sản phẩm trong kho theo danh mục'
    },
    colors: ['#e0001d', '#00b0e4'],
    xAxis: {
        categories: countTotalInStockData.labels
    },
    yAxis: {
      min: 0,
      title: {
         text: ''
      },
      stackLabels: {
         enabled: true,
         style: {
            fontWeight: 'bold',
            color: (Highcharts.theme && Highcharts.theme.textColor) || 'green'
         }
      }
    },
    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{point.y}'
    },
    series: [{
        type: 'column',
        colorByPoint: true,
        data:  countTotalInStockData.values,
        showInLegend: false
    }]

});
// Highcharts.chart('total-brick', {
//     title: {
//         text: 'Số lượng sản phẩm gạch'
//     },
//     xAxis: {
//         categories: categoriesData.brick.labels
//     },
//     yAxis: {
//       min: 0,
//       title: {
//          text: ''
//       },
//       stackLabels: {
//          enabled: true,
//          style: {
//             fontWeight: 'bold',
//             color: (Highcharts.theme && Highcharts.theme.textColor) || 'green'
//          }
//       }
//     },
//     tooltip: {
//         headerFormat: '<b>{point.x}</b><br/>',
//         pointFormat: '{point.y}'
//     },
//     series: [{
//         type: 'column',
//         colorByPoint: true,
//         data: categoriesData.brick.values,
//         showInLegend: false
//     }]

// });

// Highcharts.chart('total-paint', {
//     title: {
//         text: 'Số lượng sản phẩm sơn'
//     },
//     xAxis: {
//         categories: categoriesData.paint.labels
//     },
//     yAxis: {
//       min: 0,
//       title: {
//          text: ''
//       },
//       stackLabels: {
//          enabled: true,
//          style: {
//             fontWeight: 'bold',
//             color: (Highcharts.theme && Highcharts.theme.textColor) || 'green'
//          }
//       }
//     },
//     tooltip: {
//         headerFormat: '<b>{point.x}</b><br/>',
//         pointFormat: '{point.y}'
//     },
//     series: [{
//         type: 'column',
//         colorByPoint: true,
//         data: categoriesData.paint.values,
//         showInLegend: false
//     }]

// });
</script>
