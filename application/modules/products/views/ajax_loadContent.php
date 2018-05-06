<style>
   .text-blur{
      color: rgb(109, 106, 106)
   }
   .text-bold{
      font-weight: bold
   }
</style>
<script type="text/javascript">token_value = '<?=$this->security->get_csrf_hash()?>';</script>
<div class="dataTables_wrapper no-footer">
   <div class="table-scrollable">
      <table class="table table-striped table-bordered table-hover dataTable no-footer">
         <thead>
            <tr role="row">
               <th class="center sorting_disabled" width="40">No.</th>
               <th class="table-checkbox sorting_disabled" width="40"><input type="checkbox" id="selectAllItems" onclick="selectAllItems(<?=count($result)?>)"></th>
               <th>Hình ảnh</th>
               <th class="sorting" onclick="sort('product_name')" id="product_name"  width="150px">Tên sp</th>
               <!-- <th class="sorting" onclick="sort('product_code')" id="product_code">Mã sp</th> -->
               <th class="center sorting" onclick="sort('product_type_id')" id="product_type_id">Loại sp</th>
               <th class="center sorting" onclick="sort('category_id')" id="category_id">Danh mục sp</th>
               <th class="center sorting" onclick="sort('price_input')" id="price_input" width="100px">Giá nhập vào</th>
               <th class="center sorting" onclick="sort('price_output')" id="price_output" width="100px">Giá bán ra</th>
               <th class="center sorting" width="60" onclick="sort('count_stock')" id="count_stock">SL kho</th>
               <th class="center sorting" width="60" onclick="sort('status')" id="status">Trạng thái</th>
               <th class="center sorting" width="80" onclick="sort('created')" id="created">Ngày tạo</th>
            </tr>
         </thead>
         <tbody>
            <?php
               if($result){
                  $i=0;
                  foreach($result as $k=>$v){
            ?>
            <tr class="item_row<?=$i?> gradeX <?php ($k%2==0) ? print 'odd' : print 'even' ?>" role="row">
               <td class="center"><?=$k+1+$start?></td>
               <td>
                  <input type="checkbox" id="item<?=$i?>" onclick="selectItem(<?=$i?>)" value="<?=$v['id']?>">
               </td>
               <td>
                  <a href="<?=$v['image']?>" class="fancyboxClick" id="fancyboxClick_<?=$v['id']?>" rel="<?=$v['product_name']?>" title="<?=$v['product_name']?>">
                     <img src="<?=$v['thumbnail']?>" alt="image" style="width: 80px">
                  </a>
               </td>
               <td>
                  <div>
                     <span><a class="text-bold" href="<?=PATH_URL_ADMIN.$module.'/update/'.$v['id']?>"><?=$v['product_name']?></a></span><br>
                     <span class="text-blur">Mã sp: <span class="text-primary"><?=$v['product_code']?></span></span><br>
                     <!-- <?php if(!empty($v['color_code'])) {?>
                     <span class="text-blur">Mã màu: <span class="text-danger"><?=$v['color_code']?></span></span>
                     <?php } ?> -->
                  </div>
               </td>
              <!--  <td class="center">
                  <?=$v['product_code']?>
               </td> -->
               <td class="center">
                  <?=$v['product_type']?>
               </td>
               <td class="center">
                  <?=$v['category_name']?>
               </td>
               <td class="center">
                  <?=$v['price_input']?>
               </td>
               <td class="center">
                  <div>
                     <span><?=$v['price_output']?></span>
                     <?php if($v['is_discount']) {?>
                        <span class="label label-sm label-danger">Sp đang giảm giá</span>
                        <span>Giá mới:<br> <?=$v['discount_price_output']?></span>
                     <?php } ?>
                  </div>
               </td>
               <td class="center">
                  <?=$v['count_stock']?>
               </td>
               <td class="center" id="loadStatusID_<?=$v['id']?>">
                  <a class="no_underline" href="javascript:void(0)" onclick="updateStatus(<?=$v['id']?>,<?=$v['status']?>,'<?=$module?>')"><?=$v['status_html']?></a>
               </td>
               <td class="center">
                  <?=date('d-m-Y H:i:s',strtotime($v['created']))?>
               </td>
            </tr>
            <?php $i++;}}else{ ?>
            <tr class="gradeX odd" role="row">
               <td class="center no-record" colspan="20">No record</td>
            </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>

   <?php if($result){ ?>
   <div class="row">
      <div class="col-md-5 col-sm-12">
         <?php if(($start+$per_page)<$total){ ?>
         <div class="dataTables_info" style="padding-left:0;margin-top:3px">Showing <?=$start+1?> to <?=$start+$per_page?> of <?=$total?> entries</div>
         <?php }else{ ?>
         <div class="dataTables_info" style="padding-left:0;margin-top:3px">Showing <?=$start+1?> to <?=$total?> of <?=$total?> entries</div>
         <?php } ?>
      </div>

      <div class="col-md-7 col-sm-12">
         <div class="dataTables_paginate paging_bootstrap_full_number" style="margin-top:3px">
            <ul class="pagination" style="visibility: visible;">
               <?=$this->adminpagination->create_links();?>
            </ul>
         </div>
      </div>
   </div>
   <?php } ?>
</div>