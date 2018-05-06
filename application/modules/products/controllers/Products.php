<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Products extends MX_Controller {
	private $module = 'products';
   private $table = 'products';
   // private $accounts_mapping = array();
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
		$default_func = 'product_name';
		$default_sort = 'ASC';
      
      $this->load->model('product_types/product_types_model');
      $product_types = $this->product_types_model->getList();

      $this->load->model('categories/categories_model', 'categories_model');
      $categories = $this->categories_model->getParents();

		$data = array(
			'module'=>$this->module,
			'module_name'=>$this->session->userdata('Name_Module'),
			'default_func'=>$default_func,
         'default_sort'=>$default_sort,
         'product_types' => $product_types,
         'categories' => $categories
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

      $this->load->model('categories/categories_model', 'categories_model');
      $categories = $this->categories_model->getParents();

      $this->load->model('distributors/distributors_model', 'distributors_model');
      $distributors = $this->distributors_model->getList(array('status' => 1));

      $this->load->model('product_types/product_types_model');
      $product_types = $this->product_types_model->getList(array('status' => 1));

      $path_thumb = PATH_URL.'static/images/products/thumb/';
      $no_image = $path_thumb.'no-image-thumb.png';

      $result[0] = array();
		if($id!=0){
         $result = $this->model->getDetailManagement($id);
         $result[0]->thumbnail = !empty($result[0]->thumbnail) ? $path_thumb.$result[0]->thumbnail : $no_image;
         $result[0]->distributor_ids = !empty($result[0]->distributor_ids) ? explode(',', $result[0]->distributor_ids) : array();
      }
      $data = array(
         'result'=>$result[0],
         'module'=>$this->module,
         'product_types' => $product_types,
         'categories' => $categories,
         'distributors' => $distributors,
         'price_units' => $this->model->getPriceUnit(),
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
         $json['message'] = 'Permission denied';
         $json['token'] = $this->security->get_csrf_hash();
			echo json_encode($json);
			exit;
      }
      
		if($_POST){
         
         $validate = $this->validateForm();
         if(!empty($validate) && is_array($validate)){
            $json['status'] = 0;
            $json['message'] = array_values($validate);
            $json['token'] = $this->security->get_csrf_hash();
            echo json_encode($json);
            exit;
         }

         $thumbnail = '';
         if(!empty($_FILES['thumbnail']['name'])) {
            $file_upload = $this->upload();
            if($file_upload){
               $thumbnail = $file_upload['file_name'];
            }
         }
         $_POST['thumbnail'] = $thumbnail;
         
			if($this->model->saveManagement($_POST)){
            $json['status'] = 1;
            $json['message'] = 'Thành công!';
            $json['token'] = $this->security->get_csrf_hash();
            echo json_encode($json);
            exit;
			}
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
      
      $this->load->model('product_types/product_types_model');
      $product_types = $this->product_types_model->getList();
      $product_types_mapping = array();
      if($product_types) {
         foreach($product_types as $product_type) {
            $product_types_mapping[$product_type->id] = $product_type->name;
         }
      }

      $price_units = $this->model->getPriceUnit();
      $products = $this->model->getsearchContent($config['per_page'],$this->input->post('start'));
      
      $path_thumb = PATH_URL.'static/images/products/thumb/';
      $path_image = PATH_URL.'static/images/products/';
      $no_image = $path_thumb.'no-image-thumb.png';

      $result = array();

      if(!empty($products)) {
         foreach($products as $product){
            $price_unit = $price_units[$product->price_unit_id];
            $result[$product->id] = array(
               'id' => $product->id,
               'product_name' => $product->product_name,
               'product_type' => isset($product_types_mapping[$product->product_type_id]) ? $product_types_mapping[$product->product_type_id] : '',
               'color_code' => $product->color_code,
               'unit' => $product->unit,
               'count_stock' => $product->count_stock,
               'product_code' => $product->product_code,
               'category_name' => $product->category_name,
               'created' => $product->created,
               'price_input' => number_format($product->price_input).' '.$price_unit,
               'price_output' => number_format($product->price_output).' '.$price_unit,
               'discount_price_output' => number_format($product->discount_price_output).' '.$price_unit,
               'is_discount' => $product->is_discount == 1 ? true : false,
               'status' => $product->status,
               'status_html' => $product->status == 0 ? '<span class="label label-sm label-default">Khóa</span>' : '<span class="label label-sm label-success">Mở</span>',
               'distributor_ids' => !empty($product->distributor_ids) ? explode(',', $product->distributor_ids) : array(),
               'thumbnail' => !empty($product->thumbnail) ? $path_thumb.$product->thumbnail : $no_image,
               'image' => !empty($product->thumbnail) ? $path_image.$product->thumbnail : $no_image
            );
         }
      }

		$data = array(
			'result'=>$result,
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
   
   function admincp_loadCategories(){
      $categories = $this->model->loadcategoriesByType();
      $html = '';
      if(!empty($categories)){
         foreach($categories as $category){
            $selected = $this->input->post['cate_id']==$category->id ? 'selected' : '';
            $html .= '<option value="'.$category->id.'"'.$selected.'>'.$category->name."</option>";
         }
      }
      echo $html;
   }

   function upload(){
		$config['upload_path'] = './static/images/products/';
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['max_size'] = 3000000;
      // $config['max_width'] = 1920;
      // $config['max_height'] = 1200;
      $config['encrypt_name'] = TRUE;//mã hóa tên file
      $this->load->library('upload', $config);

		if($this->upload->do_upload('thumbnail')) {
         $data = $this->upload->data();
         $this->load->library("image_lib");
         $config1['image_library'] = 'gd2';
         $config1['source_image'] = './static/images/products/'.$data['file_name'];
         $config1['new_image'] = './static/images/products/thumb/'.$data['file_name'];
         // $config1['create_thumb'] = TRUE;
         $config1['maintain_ratio'] = TRUE;
         $config1['width']     = 200;
         // $config['height']   = 120;
         $this->image_lib->initialize($config1);
         $this->image_lib->resize();
         return $data;
      } else {
         return false;
      }
   }
   
   private function validateForm(){
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');

      $config = array(
         array(
            'field' => 'product_name',
            'label' => 'Tên sản phẩm',
            'rules' => 'required',
            'errors' => array(
               'required' => '%s thì bắt buộc.',
            ),
         ),
         array(
            'field' => 'product_code',
            'label' => 'Mã sản phẩm',
            'rules' => 'required',
            'errors' => array(
               'required' => '%s thì bắt buộc.',
            ),
         ),
         array(
            'field' => 'unit',
            'label' => 'Đơn vị tính',
            'rules' => 'required',
            'errors' => array(
               'required' => '%s thì bắt buộc.',
            ),
         ),
         array(
            'field' => 'price_input',
            'label' => 'Giá nhập vào',
            'rules' => 'required|numeric',
            'errors' => array(
               'required' => '%s thì bắt buộc.',
               'numeric' => '% phải là chữ số'
            ),
         ),
         array(
            'field' => 'price_output',
            'label' => 'Giá bán ra',
            'rules' => 'required|numeric',
            'errors' => array(
               'required' => '%s thì bắt buộc.',
               'numeric' => '% phải là chữ số'
            ),
         ),
         array(
            'field' => 'discout_price_input',
            'label' => 'Giá bán ra sau khi giảm',
            'rules' => 'numeric',
            'errors' => array(
               'numeric' => '% phải là chữ số'
            ),
         )
      );
      
      $this->form_validation->set_rules($config);

      if(!$this->form_validation->run()){
         $errors = $this->form_validation->error_array();
         return $errors;
      } else {
         return true;
      }
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
         'status' => $this->input->post('status'),
         'product_type_id' => (int)$this->input->post('product_type'),
         'category_id' => (int)$this->input->post('category'),
         'search_content' => trim($this->input->post('search_content')),
         'date_from' => trim($this->input->post('dateFrom')),
         'date_to' => trim($this->input->post('dateTo')),
      );

      $this->get_export_data_excel($filters);
      $json_data = $this->write_export_excel_data($filters);
      echo json_encode($json_data);
      exit();
   }
	
	private function get_export_data_excel($filters){
      $this->load->model('categories/categories_model');
      $this->load->model('distributors/distributors_model');
      $this->load->model('product_types/product_types_model');

      $categories = $this->categories_model->getList();
      $categories_mapping = array();
      if($categories){
         foreach($categories as $category) {
            $categories_mapping[$category->id] = $category;
         }
      }

      $distributors = $this->distributors_model->getList(array('status' => 1));
      $distributors_mapping = array();
      if($distributors){
         foreach($distributors as $distributor) {
            $distributors_mapping[$distributor->id] = $distributor;
         }
      }

      $product_types = $this->product_types_model->getList(array('status' => 1));
      $product_types_mapping = array();
      if($product_types){
         foreach($product_types as $product_type) {
            $product_types_mapping[$product_type->id] = $product_type;
         }
      }
      
      $products = $this->model->getList($filters);
      $this->categories_mapping = $categories_mapping;
      $this->distributors_mapping = $distributors_mapping;
      $this->product_types_mapping = $product_types_mapping;
      $this->data_excel = $products ? $products : array();
	}
	
	private function write_export_excel_data($filters){
		$json_data = array();
		if(!empty($this->data_excel)){
         $categories_mapping = $this->categories_mapping;
         $distributors_mapping = $this->distributors_mapping;
         $product_types_mapping = $this->product_types_mapping;
         $data_excel = $this->data_excel;

         $file_name = 'thong_tin_san_pham';
         $template_file = BASEFOLDER.'static/templates/'.$file_name.'.xlsx';
         
			if(!file_exists($template_file)){
				return;
         }
			$now = date('d-m-Y-s-i-H');
			
			$export_file_name = "danh_sach_san_pham_{$now}.xlsx";
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

            $this->start_row = 5;
				$this->row = $this->start_row;
            $stt=1;

				foreach($data_excel as $data) {
               $this->row_data = array();

               $distributor_ids = !empty($data->distributor_ids) ? explode(',',$data->distributor_ids) : array();
               $distributor_names = array();

               if(!empty($distributor_ids)) {
                  foreach($distributor_ids as $distributor_id) {
                     if(!empty($distributors_mapping[$distributor_id])) {
                        $distributor_names[] = $distributors_mapping[$distributor_id]->name;
                     }
                  }
               }

               $this->row_data[] = $stt;
               $this->row_data[] = $data->product_name;
               $this->row_data[] = $data->product_code;
               // $this->row_data[] = $data->color_code;
               // $this->row_data[] = $data->size;
               $this->row_data[] = isset($categories_mapping[$data->category_id]) ? $categories_mapping[$data->category_id]->name : '';
               $this->row_data[] = isset($product_types_mapping[$data->product_type_id]) ? $product_types_mapping[$data->product_type_id]->name : '';
               $this->row_data[] = implode(' | ', $distributor_names);
               $this->row_data[] = $data->count_stock;
               $this->row_data[] = $data->unit;
               $this->row_data[] = $data->price_input;
               $this->row_data[] = $data->price_output;
               $this->row_data[] = $data->is_discount == 1 ? 'Có' : 'Không';
               $this->row_data[] = $data->is_discount == 1 ? $data->discount_price_output : '';
               $this->row_data[] = $data->price_unit_id == 1 ? 'VNĐ' : 'USD';
               $this->row_data[] = date('d-m-Y', strtotime($data->date_production));
               $this->row_data[] = date('d-m-Y', strtotime($data->date_expiration));
               // $this->row_data[] = $data->description;
               $this->row_data[] = $data->status == 1 ? 'Mở' : 'Tắt';
               $this->row_data[] = date('d-m-Y H:i:s', strtotime($data->created));

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