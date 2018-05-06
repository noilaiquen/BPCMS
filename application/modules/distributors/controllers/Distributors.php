<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Distributors extends MX_Controller {
	private $module = 'distributors';
   private $table = 'distributors';
   
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
		$data = array(
			'module'=>$this->module,
			'module_name'=>$this->session->userdata('Name_Module'),
			'default_func'=>$default_func,
         'default_sort'=>$default_sort,
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

      $result[0] = array();
		if($id!=0){
         $result = $this->model->getDetailManagement($id);
         $result[0]->production_ids = !empty($result[0]->production_ids) ? explode(',', $result[0]->production_ids) : array();
      }
      $data = array(
         'result'=>$result[0],
         'module'=>$this->module,
         'id'=>$id
      );
      $this->template->write_view('content','ajax_editContent',$data);
      $this->template->render();
   }
   
	public function admincp_save(){
      $perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',1);
		if($perm=='permission-denied'){
			print $perm.'.'.$this->security->get_csrf_hash();
			exit;
      }
      
		if($_POST){
			if($this->model->saveManagement($_POST)){
				print 'success.'.$this->security->get_csrf_hash();
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

      $distributors = $this->model->getsearchContent($config['per_page'],$this->input->post('start'));

      $result = array();
      $category_types = array(
         1 => '<span class="label label-sm label-danger">Gạch</span>',
         2 => '<span class="label label-sm label-primary">Sơn</span>'
      );

      if(!empty($distributors)) {
         foreach($distributors as $distributor){
            $productions_html = array();
            $productions = !empty($distributor->production_ids) ? explode(',', $distributor->production_ids) : array();

            if(!empty($productions)){
               foreach($productions as $production) {
                  if(isset($category_types[$production])) {
                     $productions_html[] = $category_types[$production];
                  }
                  unset($production);
               }
            }

            $result[$distributor->id] = array(
               'id' => $distributor->id,
               'name' => $distributor->name,
               'code' => $distributor->code,
               'address' => $distributor->address,
               'telephone' => $distributor->telephone,
               'email' => $distributor->email,
               'status' => $distributor->status,
               'status_html' => $distributor->status == 0 ? '<span class="label label-sm label-default">Khóa</span>' : '<span class="label label-sm label-success">Mở</span>',
               'productions_html' =>  implode(' ',$productions_html),
               'created' => $distributor->created,
            );

            unset($productions_html);
            unset($productions);
         }
      }

		$data = array(
			'result'=>$result,
			'per_page'=>$this->input->post('per_page'),
			'start'=>$this->input->post('start'),
			'module'=>$this->module,
         'total'=>$config['total_rows'],
         'category_types' => $category_types
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
	/*------------------------------------ End Admin Control Panel --------------------------------*/
}