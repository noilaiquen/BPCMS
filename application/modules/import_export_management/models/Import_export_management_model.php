<?php
class Import_export_management_model extends CI_Model {
	private $module = 'import_export';
   private $table = 'import_export';

	function getsearchContent($limit,$page){
      $this->db->select($this->table.'.*');
      
      $this->db->limit($limit,$page);
      
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$this->db->where('(`name` LIKE "%'.$this->input->post('content').'%")');
		}
      
		if($this->input->post('type') != ''){
			$this->db->where('product_type_id = '.(int)$this->input->post('type'));
      }

		if($this->input->post('action_type') != ''){
			$this->db->where('type = '.(int)$this->input->post('action_type'));
      }

      if($this->input->post('category') != ''){
			$this->db->where('category_id = '.(int)$this->input->post('category'));
      }

      if($this->input->post('product') != ''){
			$this->db->where('product_id = '.(int)$this->input->post('product'));
      }
      
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where($this->table.'.date >= "'.date('Y-m-d',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where($this->table.'.date <= "'.date('Y-m-d',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where($this->table.'.date >= "'.date('Y-m-d',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where($this->table.'.date <= "'.date('Y-m-d',strtotime($this->input->post('dateTo'))).'"');
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
      
		if($this->input->post('type') != ''){
			$this->db->where('product_type_id = '.(int)$this->input->post('type'));
      }

		if($this->input->post('action_type') != ''){
			$this->db->where('type = '.(int)$this->input->post('action_type'));
      }

		if($this->input->post('category') != ''){
			$this->db->where('category_id = '.(int)$this->input->post('category'));
      }
      
      if($this->input->post('product') != ''){
			$this->db->where('product_id = '.(int)$this->input->post('product'));
      }

		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where($this->table.'.date >= "'.date('Y-m-d',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where($this->table.'.date <= "'.date('Y-m-d',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where($this->table.'.date >= "'.date('Y-m-d',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where($this->table.'.date <= "'.date('Y-m-d',strtotime($this->input->post('dateTo'))).'"');
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

   function insertData($data) {
      if($this->db->insert($this->table, $data)){
         return true;
      } else {
         return false;
      }
   }

   function getExcelData($filters = array()) {
      $this->db->select('*');

      if(!empty($filters['action_type'])) {
         $this->db->where('type', $filters['action_type']);
      }

      if(!empty($filters['product_type'])) {
         $this->db->where('product_type_id', $filters['product_type']);
      }

      if(!empty($filters['category'])) {
         $this->db->where('category_id', $filters['category']);
      }

      if($filters['date_from']!='' && $filters['date_to']==''){
			$this->db->where($this->table.'.date >= "'.date('Y-m-d',strtotime($filters['date_from'])).'"');
		}
		if($filters['date_from']=='' && $filters['date_to']!=''){
			$this->db->where($this->table.'.date <= "'.date('Y-m-d',strtotime($filters['date_to'])).'"');
		}
		if($filters['date_from']!='' && $filters['date_to']!=''){
			$this->db->where($this->table.'.date >= "'.date('Y-m-d',strtotime($filters['date_from'])).'"');
			$this->db->where($this->table.'.date <= "'.date('Y-m-d',strtotime($filters['date_to'])).'"');
      }
      
      $query = $this->db->get($this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
   }
}