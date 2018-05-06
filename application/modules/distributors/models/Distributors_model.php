<?php
class Distributors_model extends CI_Model {
	private $module = 'distributors';
   private $table = 'distributors';

	function getsearchContent($limit,$page){
      $this->db->select($this->table.'.*');
      
      $this->db->limit($limit,$page);
      
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$this->db->where('(`name` LIKE "%'.trim($this->input->post('content')).'%") OR (`code` LIKE "%'.trim($this->input->post('content')).'%")');
		}
      
		if($this->input->post('status') != ''){
			$this->db->where('status = '.(int)$this->input->post('status'));
      }
      
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where($this->table.'.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where($this->table.'.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where($this->table.'.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where($this->table.'.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
      $query = $this->db->get($this->table);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getTotalsearchContent(){
		$this->db->select('*');
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$this->db->where('(`name` LIKE "%'.$this->input->post('content').'%")');
      }
      
		if($this->input->post('status') != ''){
			$this->db->where('status = '.(int)$this->input->post('status'));
      }
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where($this->table.'.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where($this->table.'.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where($this->table.'.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where($this->table.'.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		$query = $this->db->count_all_results($this->table);

		if($query > 0){
			return $query;
		}else{
			return false;
		}
	}
	
	function getDetailManagement($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get($this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function saveManagement($data){
      $status = 0;

      if(!empty($data['status']) && $data['status'] == 'on'){
         $status = 1;
      }

      $production_ids = ''; 
      if(!empty($data['production_ids'])) {
         $production_ids = implode(',', $data['production_ids']);
      }

		if($this->input->post('hiddenIdAdmincp')==0){
			//Kiểm tra đã tồn tại chưa?
			$checkData = $this->checkData($data);
			if($checkData){
				print 'error-distributor-name-exists';
				exit;
         }
         
			$insert = array(
				'status'          => $status,
				'name'            => ucwords($data['name']),
				'code'            => strtoupper(trim($data['code'])),
				'address'         => trim($data['address']),
				'email'           => trim($data['email']),
				'telephone'       => trim($data['telephone']),
				'production_ids'  => $production_ids,
				'created'         => date('Y-m-d H:i:s')
         );
         
			if($this->db->insert($this->table,$insert)){
				modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
				return true;
         }
         
		}else{
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));
			//Kiểm tra đã tồn tại chưa?
			if($result[0]->name!=$this->input->post('name')){
				$checkData = $this->checkData($data);
				if($checkData){
					print 'error-distributor-name-exists';
					exit;
				}
			}
			
			$update = array(
				'status'          => $status,
				'name'            => ucwords($data['name']),
				'code'            => strtoupper(trim($data['code'])),
				'email'           => trim($data['email']),
				'telephone'       => trim($data['telephone']),
				'address'         => trim($data['address']),
				'production_ids'  => $production_ids,
         );

			modules::run('admincp/saveLog',$this->module,$this->input->post('hiddenIdAdmincp'),'','Update',$result,$update);
			$this->db->where('id',$this->input->post('hiddenIdAdmincp'));
			if($this->db->update($this->table,$update)){
				return true;
			}
		}
		return false;
	}
	
	function checkData($data){
		$this->db->select('id');
		$this->db->where('name',trim($data['name']));
		$this->db->where('code',strtoupper(trim($data['code'])));
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		if($query->result()){
			return true;
		}else{
			return false;
		}
   }

   function getList($data = array()) {
      if(isset($data['status'])) {
         $this->db->where('status', (int)$data['status']);
      }

      $query = $this->db->get($this->table);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
   }
}