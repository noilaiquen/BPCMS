<?php
class Product_types_model extends CI_Model {
	private $module = 'product_types';
	private $table = 'product_types';

	function getsearchContent($limit,$page){
      $this->db->select($this->table.'.*');
      
      $this->db->limit($limit,$page);
      
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$this->db->where('(`name` LIKE "%'.$this->input->post('content').'%")');
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
	
	function saveManagement(){
		if($this->input->post('status')=='on'){
			$status = 1;
		}else{
			$status = 0;
      }

		if($this->input->post('has_color')=='on'){
			$has_color = 1;
		}else{
			$has_color = 0;
      }

		if($this->input->post('hiddenIdAdmincp')==0){
			//Kiểm tra đã tồn tại chưa?
			$checkData = $this->checkData($this->input->post('name'));
			if($checkData){
            $json['status'] = 0;
            $json['message'] = 'Loại sản phẩm đã tồn tại!';
            $json['token'] = $this->security->get_csrf_hash();
            echo json_encode($json);
            exit;
			}
			
			$data = array(
				'status'=> $status,
				'has_color'=> $has_color,
            'name'=> trim(ucwords($this->input->post('name'))),
            'slug'=> SEO(trim($this->input->post('name'))),
				'created'=> date('Y-m-d H:i:s',time()),
			);
			if($this->db->insert($this->table,$data)){
				modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
				return true;
			}
		}else{
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));
			//Kiểm tra đã tồn tại chưa?
			if($result[0]->name!=$this->input->post('name')){
				$checkData = $this->checkData($this->input->post('name'));
				if($checkData){
					$json['status'] = 0;
               $json['message'] = 'Loại sản phẩm đã tồn tại!';
               $json['token'] = $this->security->get_csrf_hash();
               echo json_encode($json);
               exit;
				}
			}
			
			$data = array(
				'name'=> trim(ucwords($this->input->post('name'))),
            'slug'=> SEO(trim($this->input->post('name'))),
            'status'=> $status,
				'has_color'=> $has_color
			);
			modules::run('admincp/saveLog',$this->module,$this->input->post('hiddenIdAdmincp'),'','Update',$result,$data);
			$this->db->where('id',$this->input->post('hiddenIdAdmincp'));
			if($this->db->update($this->table,$data)){
				return true;
			}
		}
		return false;
	}
	
	function checkData($name){
		$this->db->select('id');
		$this->db->where('name',trim(ucwords($name)));
		$this->db->limit(1);
		$query = $this->db->get($this->table);

		if($query->result()){
			return true;
		}else{
			return false;
		}
	}

   function getList($filters = array()){
      $this->db->select('*');

      if(isset($filters['status'])) {
         $this->db->where('status', (int)$filters['status']);
      }
      /* ... */

      $this->db->order_by('id', 'ASC');
      $query = $this->db->get($this->table);

      if($query->result()){
         return $query->result();
      } else {
         return false;
      }
   }
}