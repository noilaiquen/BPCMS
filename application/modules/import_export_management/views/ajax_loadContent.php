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
               <!-- <th class="table-checkbox sorting_disabled" width="40"><input type="checkbox" id="selectAllItems" onclick="selectAllItems(<?=count($result)?>)"></th> -->
               <th>Tên sản phẩm</th>
               <th class="center sorting" width="60" onclick="sort('category_id')" type="category_id">Tên DM</th>
               <th class="center sorting" onclick="sort('product_type_id')" type="product_type_id">Loại sp</th>
               <th class="center sorting" onclick="sort('type')" id="type">Hoạt động</th>
               <th class="center">Số lượng</th>
               <!-- <th class="center">SL cũ</th>
               <th class="center">SL mới</th> -->
               <th class="center sorting" onclick="sort('date')">Ngày</th>
               <th class="center" width="100">Khách hàng</th>
               <!-- <th class="center" width="100">Ghi chú</th> -->
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
               <!-- <td>
                  <input type="checkbox" id="item<?=$i?>" onclick="selectItem(<?=$i?>)" value="<?=$v['id']?>">
               </td> -->
               <td>
                  <div>
                     <span>
                        <a class="text-bold" href="<?=$v['link_product']?>"><?=$v['product_name']?>
                           <?php if(!empty($v['product_code'])){ ?>
                              <?=' - '.$v['product_code']?>
                           <?php } ?>
                        </a>
                     </span><br>
                     <?php if(!empty($v['color_code'])){ ?>
                        <span class="text-blur">Mã màu: <span class="text-danger"><?=$v['color_code']?></span></span>
                     <?php } ?>
                  <div>
               </td>
               <td  class="center">
                  <a href="<?=$v['link_category']?>"><?=$v['category_name']?></a>
               </td>
               <td class="center">
                  <?=$v['product_type']?>
               </td>
               <td class="center">
                  <?=$v['type_html']?>
               </td>
               <td class="center">
                  <?=$v['qty']?>
               </td>
               <!-- <td class="center">
                  <?=$v['old_qty']?>
               </td>
               <td class="center">
                  <?=$v['new_qty']?>
               </td> -->
               <td class="center">
                  <?=$v['date']?>
               </td>
               <td style="word-wrap: break-word;" >
                  <?php if($v['type'] == 2){ ?>
                  <div>
                     <span>Tên: <span class="text-success"><?=$v['customer_name']?></span></span><br>
                     <span class="text-blur">ĐT: <?=$v['customer_phone']?></span><br>
                     <span class="text-blur">ĐC: <?=$v['customer_address']?></span>
                  </div>
                  <?php } ?>
               </td>
               <!-- <td class="center" style="word-wrap: break-word;" >
                  <?=$v['note']?>
               </td> -->
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
