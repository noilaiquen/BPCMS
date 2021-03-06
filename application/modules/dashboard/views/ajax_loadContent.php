<script type="text/javascript">token_value = '<?=$this->security->get_csrf_hash()?>';</script>
<div class="dataTables_wrapper no-footer">
   <div class="table-scrollable">
      <table class="table table-striped table-bordered table-hover dataTable no-footer">
         <thead>
            <tr role="row">
               <th class="center sorting_disabled" width="40">No.</th>
               <th class="table-checkbox sorting_disabled" width="40"><input type="checkbox" id="selectAllItems" onclick="selectAllItems(<?=count($result)?>)"></th>
               <th class="sorting" onclick="sort('name')" id="name">Distributor name</th>
               <th class="sorting" onclick="sort('code')" id="code">Distributor code</th>
               <th>Productions</th>
               <th>Address</th>
               <th class="center sorting" width="60" onclick="sort('status')" id="status">Status</th>
               <th class="center sorting" width="80" onclick="sort('created')" id="created">Created</th>
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
                  <a href="<?=PATH_URL_ADMIN.$module.'/update/'.$v['id']?>"><?=$v['name']?></a>
               </td>
               <td class="center">
                  <?=$v['code']?>
               </td>
               <td class="center">
                  <?=$v['productions_html']?>
               </td>
               <td class="center">
                  <?=$v['address']?>
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