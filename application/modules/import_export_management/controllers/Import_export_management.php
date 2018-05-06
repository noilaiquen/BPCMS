<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Import_export_management extends MX_Controller {
	private $module = 'import_export_management';
   private $table = 'import_export';
   private $accounts_mapping = array();
   private $product_types_mapping = array();
   private $products_mapping = array();
   private $distributors_mapping = array();
   private $categories_mapping = array();
   private $data_excel = array();
   
	function __construct(){
      parent::__construct();
      
		$this->load->model($this->module.'_model','model');
		$this->load->model('admincp_modules/admincp_modules_model');
		if($this->uri->segment(1)==ADMINCP){
			if($this->uri->segment(2)!='login'){
				if(!$this->session->userdata('userInfo')){
					print '<script type="text/javascript">top.location="'.PATH_URL_ADMIN.'login"</script>';
					exit;
				}
				$get_module = $this->admincp_modules_model->check_modules($this->uri->segment(2));
				$this->session->set_userdata('ID_Module',$get_module[0]->id);
				$this->session->set_userdata('Name_Module',$get_module[0]->name);
			}
			$this->template->set_template('admin');
			$this->template->write('title','Admin Control Panel');
		}
	}
	/*------------------------------------ Admin Control Panel ------------------------------------*/
	public function admincp_index(){
      modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
		$default_func = 'created';
      $default_sort = 'DESC';

      // $this->load->model('products/products_model', 'products_model');
      // $products = $this->products_model->getList(array('status'=> 1));

      $this->load->model('product_types/product_types_model');
      $product_types = $this->product_types_model->getList(array('status' => 1));

      $this->load->model('categories/categories_model', 'categories_model');
      $categories = $this->categories_model->getList(array('status'=> 1));

		$data = array(
			'module'=>$this->module,
			'module_name'=>$this->session->userdata('Name_Module'),
			'default_func'=>$default_func,
         'default_sort'=>$default_sort,
         // 'products'=>$products, 
         'product_types'=>$product_types, 
         'categories'=>$categories, 
		);
		$this->template->write_view('content','index',$data);
		$this->template->render();
	}
	
	
	public function admincp_update($id=0){
      if($id==0){
			modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',0);
		}else{
			modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
      }

      // $this->load->model('products/products_model', 'products_model');
      // $products = $this->products_model->getList(array('status'=> 1));

      // $this->load->model('categories/categories_model', 'categories_model');
      // $categories = $this->categories_model->getList(array('status'=> 1));

      $this->load->model('product_types/product_types_model');
      $product_types = $this->product_types_model->getList(array('status' => 1));

      $product_types_colors = array();
      if($product_types){
         foreach($product_types as $product_type) {
            if($product_type->has_color == 1) {
               $product_types_colors[] = $product_type->id;
            }
         }
      }
      $result[0] = array();
		if($id!=0){
         $result = $this->model->getDetailManagement($id);
      }

      $data = array(
         'result'=>$result[0],
         // 'products'=>$products, 
         // 'categories'=>$categories, 
         'product_types'=>$product_types, 
         'product_types_colors'=> json_encode($product_types_colors), 
         'module'=>$this->module,
         'id'=>$id
      );
      $this->template->write_view('content','ajax_editContent',$data);
      $this->template->render();
   }
   
	public function admincp_save(){
      $json = array();
      $perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',1);
		if($perm=='permission-denied'){
         $json['status'] = 0;
         $json['message'] = 'permission-denied';
         $json['token'] = $this->security->get_csrf_hash();
         print json_encode($json);
         exit;
      }

		if(!empty($_POST['product_type_id']) && !empty($_POST['category_id']) && !empty($_POST['product_id']) && !empty($_POST['type']) && !empty($_POST['qty']) && !empty($_POST['date'])){

         $type = (int)$this->input->post('type');
         $product_id = (int)$this->input->post('product_id');
         $product_type_id = (int)$this->input->post('product_type_id');
         $category_id = (int)$this->input->post('category_id');
         $qty = (int)$this->input->post('qty');
         $date = trim($this->input->post('date'));
         $color_code = trim($this->input->post('color_code'));

         $customer_name =  ucwords(trim($this->input->post('customer_name')));
         $customer_address = trim($this->input->post('customer_address'));
         $customer_phone = trim($this->input->post('customer_phone'));
         $customer_email = trim($this->input->post('customer_email'));
         $customer_note = trim($this->input->post('customer_note'));

         if($type == 2 && (empty($customer_name) || empty($customer_address))) {
            $json['status'] = 0;
            $json['message'] = 'Trường gắn * ở thông tin khách hàng là bắc buộc!';
            print json_encode($json);
            exit;
         }

         $user_info = $this->session->userdata('userData');

         $this->load->model('products/products_model', 'product_model');

         $product = $this->product_model->getDetailManagement((int)$this->input->post('product_id'));
         if($product) {
            $count_stock = (int)$product[0]->count_stock;
            $insert = array(
               'product_type_id' => $product_type_id,
               'category_id' => $category_id,
               'product_id' => $product_id,
               'type' => $type,
               'qty' => $qty,
               'old_qty' => $count_stock,
               'date' => date('Y-m-d', strtotime($date)),
               'color_code' => $color_code,
               'customer_name' => $customer_name,
               'customer_address' => $customer_address,
               'customer_phone' => $customer_phone,
               'customer_email' => $customer_email,
               'customer_note' => $customer_note,
               'user_id' => $user_info['user_id'],
               'created' => date('Y-m-d H:i:s'),
            );

            if($type == 2) {
               if($count_stock < $qty){
                  $json['status'] = 0;
                  $json['message'] = 'Số lượng xuất kho lớn hơn số lượng trong kho';
               } else {
                  $new_stock = $count_stock - $qty;
                  $reduce_stock = $this->product_model->handelStock($product_id, $new_stock);
                  $insert['new_qty'] = $new_stock;
                  if($reduce_stock) {
                     if($this->model->insertData($insert)){
                        $json['status'] = 1;
                        $json['message'] = 'Success';
                     } else {
                        $json['status'] = 0;
                        $json['message'] = 'Error';
                     }
                  } else {
                     $json['status'] = 0;
                     $json['message'] = 'Error';
                  }
               }
            } else if($type == 1){
               $new_stock = $count_stock + $qty;
               $insert['new_qty'] = $new_stock;
               if($this->product_model->handelStock($product_id, $new_stock)) {
                  if($this->model->insertData($insert)){
                     $json['status'] = 1;
                     $json['message'] = 'Success';
                  } else {
                     $json['status'] = 0;
                     $json['message'] = 'Error';
                  }
               } else {
                  $json['status'] = 0;
                  $json['message'] = 'Error';
               }
            }
         } else {
            $json['status'] = 0;
            $json['message'] = 'Không tìm tìm thấy sản phẩm';
         }

         $json['token'] = $this->security->get_csrf_hash();
         print json_encode($json);
         exit;
		} else {
         $json['status'] = 0;
         $json['message'] = 'Trường gắn * là bắt buộc!';
         $json['token'] = $this->security->get_csrf_hash();
         print json_encode($json);
         exit;
      }
   }
	
	public function admincp_delete(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'d',1);
		if($perm=='permission-denied'){
			print $perm;
			exit;
		}
		if($this->input->post('id')){
			$id = $this->input->post('id');
         $result = $this->model->getDetailManagement($id);
			if($result[0]->username==$this->session->userdata('userInfo')){
				print 'permission-denied.'.$this->security->get_csrf_hash();
				exit;
			}
			modules::run('admincp/saveLog',$this->module,$id,'Delete','Delete');
			$this->db->where('id',$id);
			if($this->db->delete($this->table)){
				print 'success.'.$this->security->get_csrf_hash();
				exit;
			}
		}
	}
	
	public function admincp_ajaxLoadContent(){
		$this->load->library('AdminPagination');
		$config['total_rows'] = $this->model->getTotalsearchContent();
		$config['per_page'] = $this->input->post('per_page');
		$config['num_links'] = 3;
		$config['func_ajax'] = 'searchContent';
		$config['start'] = $this->input->post('start');
		$this->adminpagination->initialize($config);

      $this->load->model('products/products_model', 'product_model');
      $products = $this->product_model->getList(array('status'=> 1));
      $products_mapping = array();
      if($products) {
         foreach ($products as $product) {
            $products_mapping[$product->id] = $product;
         }
      }

      $this->load->model('product_types/product_types_model');
      $product_types = $this->product_types_model->getList(array('status' => 1));
      $product_types_mapping = array();
      if($product_types) {
         foreach ($product_types as $product_type) {
            $product_types_mapping[$product_type->id] = $product_type->name;
         }
      }

      $this->load->model('categories/categories_model', 'categories_model');
      $categories =$this->categories_model->getList(array('status'=> 1));
      $categories_mapping = array();
      if($categories) {
         foreach ($categories as $category) {
            $categories_mapping[$category->id] = $category->name;
         }
      }

      $list = $this->model->getsearchContent($config['per_page'],$this->input->post('start'));

      $result = array();
      if($list) {
         foreach($list as $row) {
            $result[] = array(
               'id' => $row->id,
               'product_type' => isset($product_types_mapping[$row->product_type_id]) ? $product_types_mapping[$row->product_type_id] : '',
               'category_name' => isset($categories_mapping[$row->category_id]) ? $categories_mapping[$row->category_id] : '',
               'link_category' => PATH_URL_ADMIN.'categories/update/'.$row->category_id,
               'product_name' => isset($products_mapping[$row->product_id]) ? $products_mapping[$row->product_id]->product_name : '',
               'product_code' => isset($products_mapping[$row->product_id]) ? $products_mapping[$row->product_id]->product_code : '',
               // 'color_code' => isset($products_mapping[$row->product_id]) ? $products_mapping[$row->product_id]->color_code : '',
               'color_code' => $row->color_code,
               'link_product' => PATH_URL_ADMIN.'products/update/'.$row->product_id,
               'type' => $row->type,
               'type_html' => $row->type == 1 ? '<span class="label label-sm label-danger">Nhập kho</span>' : '<span class="label label-sm label-primary">Xuất kho</span>',
               'qty' => $row->qty,
               'old_qty' => $row->old_qty,
               'new_qty' => $row->new_qty,
               'date' => date('d-m-Y', strtotime($row->date)),
               'note' => $row->note,
               'customer_name' => $row->customer_name,
               'customer_phone' => $row->customer_phone,
               'customer_email' => $row->customer_email,
               'customer_address' => $row->customer_address,
               'created' => $row->created
            );
         }
      }

		$data = array(
			'result'=>$result,
			'products'=>$products,
			'categories'=>$categories,
			'per_page'=>$this->input->post('per_page'),
			'start'=>$this->input->post('start'),
			'module'=>$this->module,
         'total'=>$config['total_rows']
		);
		$this->session->set_userdata('start',$this->input->post('start'));
		$this->load->view('ajax_loadContent',$data);
	}
	
	public function admincp_ajaxUpdateStatus(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',1);
		if($perm=='permission-denied'){
			print '<script type="text/javascript">show_perm_denied()</script>';
			$status = $this->input->post('status');
			$data = array(
				'status'=>$status
			);
			$update = array(
				'status'=>$status,
				'id'=>$this->input->post('id'),
				'module'=>$this->module
			);
			$this->load->view('ajax_updateStatus',$update);
		}else{
			if($this->input->post('status')==0){
				$status = 1;
			}else{
				$status = 0;
			}
			$data = array(
				'status'=>$status
			);
			modules::run('admincp/saveLog',$this->module,$this->input->post('id'),'status','update',$this->input->post('status'),$status);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update($this->table, $data);
			
			$update = array(
				'status'=>$status,
				'id'=>$this->input->post('id'),
				'module'=>$this->module
			);
			$this->load->view('ajax_updateStatus',$update);
		}
   }

   public function admincp_loadProductsbyCate(){
      $this->load->model('products/products_model', 'product_model');
      $products = $this->product_model->getList(array('status'=> 1, 'category_id' => (int)$this->input->post('category_id')));

      $html = '';
      if($products){
         foreach($products as $product){
            $html .= '<option value="'.$product->id.'">'.$product->product_name.' - '.$product->product_code." (".$product->count_stock.")"."</option>";
         }
      }
      echo $html;

   }


   /* --------------------------------EXPORT EXCEL ------------------------------------------- */
   function admincp_ajax_export() {
      ini_set('display_errors', 1);
      error_reporting(E_ALL);
      // set_time_limit(0);
      ini_set('memory_limit','1024M');
      $json_data = array(
         'result' => '',
         'file_name' => ''
      );

      $filters = array(
         'action_type' => (int)$this->input->post('action_type'),
         'product_type' => (int)$this->input->post('product_type'),
         'date_from' => trim($this->input->post('dateFrom')),
         'date_to' => trim($this->input->post('dateTo')),
         'category' => (int)$this->input->post('category')
      );
      if(!empty((int)$this->input->post('action_type'))) {
         $this->get_export_data_excel($filters);
         $json_data = $this->write_export_excel_data($filters);
      }
      echo json_encode($json_data);
      exit();
   }
	
	private function get_export_data_excel($filters){
      $this->load->model('categories/categories_model');
      $this->load->model('distributors/distributors_model');
      $this->load->model('admincp_accounts/admincp_accounts_model');
      $this->load->model('products/products_model');
      $this->load->model('product_types/product_types_model');

      $categories = $this->categories_model->getList(array('status'=> 1));
      $categories_mapping = array();
      if($categories){
         foreach($categories as $category) {
            $categories_mapping[$category->id] = $category;
         }
      }

      $distributors = $this->distributors_model->getList();
      $distributors_mapping = array();
      if($distributors){
         foreach($distributors as $distributor) {
            $distributors_mapping[$distributor->id] = $distributor;
         }
      }
      
      $products = $this->products_model->getList();
      $products_mapping = array();
      if($products){
         foreach($products as $product) {
            $products_mapping[$product->id] = $product;
         }
      }

      $product_types = $this->product_types_model->getList(array('status'=> 1));
      $product_types_mapping = array();
      if($products){
         foreach($product_types as $product_type) {
            $product_types_mapping[$product_type->id] = $product_type;
         }
      }

      $accounts = $this->admincp_accounts_model->list_accounts();
      $accounts_mapping = array();
      if($accounts){
         foreach($accounts as $account) {
            $accounts_mapping[$account->id] = $account;
         }
      }

      $results = $this->model->getExcelData($filters);
      $this->categories_mapping = $categories_mapping;
      $this->accounts_mapping = $accounts_mapping;
      $this->distributors_mapping = $distributors_mapping;
      $this->products_mapping = $products_mapping;
      $this->product_types_mapping = $product_types_mapping;
      $this->data_excel = $results ? $results : array();
      
	}
	
	private function write_export_excel_data($filters){
		$json_data = array();
		if(!empty($this->data_excel)){
         $product_types_mapping = $this->product_types_mapping;
         $products_mapping = $this->products_mapping;
         $categories_mapping = $this->categories_mapping;
         $distributors_mapping = $this->distributors_mapping;
         $accounts_mapping = $this->accounts_mapping;
         $data_excel = $this->data_excel;

         $file_name = ($filters['action_type'] == 1) ? 'report_nhap_kho' : 'report_xuat_kho';
         $template_file = BASEFOLDER.'static/templates/'.$file_name.'.xlsx';
         
			if(!file_exists($template_file)){
				return;
         }
			$now = date('d-m-Y-s-i-H');
			
			$export_file_name = ($filters['action_type'] == 1) ? 'Bao_cao_nhap_kho_'.$now.'.xlsx' : 'Bao_cao_xuat_kho_'.$now.'.xlsx';
         $export_file = BASEFOLDER.'static/export_files/'.$export_file_name;
         
			if (!file_exists($export_file)) {
				@unlink($export_file);
			}
			
			if (copy($template_file, $export_file)) {
				$objReader = phpexcel_get_obj_reader(false);
				$objPHPExcel = $objReader->load($export_file);
				$this->objSheet = $objPHPExcel->getActiveSheet();
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', $filters['date_from']); //từ ngày
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D2', $filters['date_to']); //đến ngày

            $this->start_row = 6;
				$this->row = $this->start_row;
            $stt=1;

				foreach($data_excel as $data) {
               $this->row_data=array();

               $distributor_ids = array();
               $distributor_names = array();

               if(isset($products_mapping[$data->product_id])) {
                  if(!empty($products_mapping[$data->product_id]->distributor_ids)){
                     $distributor_ids = explode(',', $products_mapping[$data->product_id]->distributor_ids);
                  }
               }

               if(!empty($distributor_ids)) {
                  foreach($distributor_ids as $distributor_id) {
                     if(!empty($distributors_mapping[$distributor_id])) {
                        $distributor_names[] = $distributors_mapping[$distributor_id]->name;
                     }
                  }
               }

               $this->row_data[] = $stt;
               $this->row_data[] = isset($products_mapping[$data->product_id]) ? $products_mapping[$data->product_id]->product_name : '';
               $this->row_data[] = isset($products_mapping[$data->product_id]) ? $products_mapping[$data->product_id]->product_code : '';
               // $this->row_data[] = isset($products_mapping[$data->product_id]) ? $products_mapping[$data->product_id]->color_code : '';
               if($filters['action_type'] == 2) {
                  $this->row_data[] = $data->color_code;
               }
               // $this->row_data[] = isset($products_mapping[$data->product_id]) ? $products_mapping[$data->product_id]->size : '';
               $this->row_data[] = isset($categories_mapping[$data->category_id]) ? $categories_mapping[$data->category_id]->name : '';
               $this->row_data[] = isset($product_types_mapping[$data->product_type_id]) ? $product_types_mapping[$data->product_type_id]->name : '';
               $this->row_data[] = implode(' | ', $distributor_names);
               $this->row_data[] = $data->type == 1 ? 'Nhập' : 'Xuất';
               $this->row_data[] = $data->old_qty;
               $this->row_data[] = $data->qty;
               $this->row_data[] = $data->new_qty;
               $this->row_data[] = isset($products_mapping[$data->product_id]) ? $products_mapping[$data->product_id]->unit : '';
               $this->row_data[] = isset($products_mapping[$data->product_id]) ? $products_mapping[$data->product_id]->price_input : '';
               $this->row_data[] = isset($products_mapping[$data->product_id]) ? $products_mapping[$data->product_id]->price_output : '';
               $this->row_data[] = (isset($products_mapping[$data->product_id]) && $products_mapping[$data->product_id]->is_discount == 1) ? 'Có' : 'Không';
               $this->row_data[] = isset($products_mapping[$data->product_id]) ? $products_mapping[$data->product_id]->discount_price_output : '';
               $this->row_data[] = (isset($products_mapping[$data->product_id]) && $products_mapping[$data->product_id]->price_unit_id == 1) ? 'VNĐ' : 'USD';
               $this->row_data[] = date('d-m-Y', strtotime($data->date));
               if($filters['action_type'] == 2) {
                  $this->row_data[] = $data->customer_name;
                  $this->row_data[] = $data->customer_phone;
                  $this->row_data[] = $data->customer_email;
                  $this->row_data[] = $data->customer_address;
                  $this->row_data[] = $data->customer_note;
               }
               $this->row_data[] = isset($accounts_mapping[$data->user_id]) ? $accounts_mapping[$data->user_id]->username : '';
               // $this->row_data[] = $data->note;
               $this->row_data[] =  date('d-m-Y H:i:s', strtotime($data->created));

               $this->objSheet->fromArray($this->row_data, NULL, excel_get_cell_address(0, $this->row));
               $this->row++;
               $stt++;

               unset($distributor_ids);
               unset($distributor_names);
				}

				$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
				$objWriter->save($export_file);
				
				$json_data['result'] = 'success';
				// $json_data['file_name'] = str_replace(".xlsx",'', $export_file_name);
				$json_data['file_name'] = $export_file_name;
			}
         return $json_data;
      }
   }
	/*------------------------------------ End Admin Control Panel --------------------------------*/
}