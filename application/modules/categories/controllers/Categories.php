<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Categories extends MX_Controller {
	private $module = 'categories';
   private $table = 'categories';
   
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

      $this->load->model('product_types/product_types_model');
      $product_types = $this->product_types_model->getList();

		$data = array(
			'module'=>$this->module,
			'product_types'=>$product_types,
			'module_name'=>$this->session->userdata('Name_Module'),
			'default_func'=>$default_func,
			'default_sort'=>$default_sort
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
      
      $this->load->model('product_types/product_types_model');
      $product_types = $this->product_types_model->getList();

      $parents = $this->model->getParents($id);

      $result[0] = array();
		if($id!=0){
			$result = $this->model->getDetailManagement($id);
      }

      $data = array(
         'result'=>$result[0],
         'module'=>$this->module,
         'parents'=>$parents,
         'product_types'=>$product_types,
         'id'=>$id,
         'parent_id' => $id==0 ? 0 : $result[0]->parent_id
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

			if($this->model->saveManagement()){
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
         $count_children = $this->model->countChildren($id);
         if($count_children == 0){
            modules::run('admincp/saveLog',$this->module,$id,'Delete','Delete');
            $this->db->where('id',$id);
            if($this->db->delete($this->table)){
               print 'success.'.$this->security->get_csrf_hash();
               exit;
            }
         } else {
            print 'access-denied.'.$this->security->get_csrf_hash();
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
      
      $result = $this->model->getsearchContent($config['per_page'],$this->input->post('start'));

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
   
   function admincp_loadParent(){
      $parents = $this->model->loadParentByType();
      $html = '<option value="0">--Không--</option>';
      if(!empty($parents)){
         foreach($parents as $parent){
            $selected = ((int)$this->input->post('parent_id') == $parent->id) ? 'selected' : '';
            $html .= '<option value="'.$parent->id.'"'.$selected.'>'.$parent->name."</option>";
         }
      }
      echo $html;
   }

   function admincp_loadCategoriesByType(){
      $type_id = (int)$this->input->post('type_id');
      $categories = $this->model->loadCategoriesByType($type_id);
      $html = '<option value="0">--Không--</option>';
      if(!empty($categories)){
         foreach($categories as $category){
            $html .= '<option value="'.$category->id.'">'.$category->name."</option>";
         }
      }
      echo $html;
   }

   private function validateForm(){
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');

      $config = array(
         array(
            'field' => 'category_type',
            'label' => 'Loại sản phẩm',
            'rules' => 'required|numeric',
            'errors' => array(
               'required' => '%s thì bắt buộc.',
            ),
         ),
         array(
            'field' => 'name',
            'label' => 'Tên danh mục',
            'rules' => 'required',
            'errors' => array(
               'required' => '%s thì bắt buộc.',
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
	/*------------------------------------ End Admin Control Panel --------------------------------*/
}