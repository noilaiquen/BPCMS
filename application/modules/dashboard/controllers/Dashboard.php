<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MX_Controller {
	private $module = 'dashboard';
   
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
      $countTotalInStock = $this->model->countTotalInStock();
      // $countTotalByType = json_encode($this->model->countTotalByType());
      // pr(json_encode($countTotalInStock),1);
		$data = array(
			'module'=>$this->module,
			'module_name'=>$this->session->userdata('Name_Module'),
			'default_func'=>$default_func,
         'default_sort'=>$default_sort,
         'countTotalInStock'=> json_encode($countTotalInStock),
         // 'countTotalByType'=> $countTotalByType
		);
		$this->template->write_view('content','index',$data);
		$this->template->render();
	}
	/*------------------------------------ End Admin Control Panel --------------------------------*/
}