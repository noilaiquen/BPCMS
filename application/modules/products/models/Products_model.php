<?php
class Products_model extends CI_Model {
	private $module = 'products';
   private $table = 'products';

	function getsearchContent($limit,$page){
      $this->db->select($this->table.'.*, (SELECT name FROM categories WHERE '.$this->table.'.category_id = categories.id) AS category_name');
      
      $this->db->limit($limit,$page);
      
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$this->db->where('(`product_name` LIKE "%'.trim($this->input->post('content')).'%") OR (`product_code` LIKE "%'.trim($this->input->post('content')).'%")');
		}
		if(!empty($this->input->post('category'))){
			$this->db->where('category_id = '.(int)$this->input->post('category'));
      }

		if(!empty($this->input->post('type'))){
			$this->db->where('product_type_id = '.(int)$this->input->post('type'));
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
			$this->db->where('(`product_name` LIKE "%'.$this->input->post('content').'%")');
      }
      if(!empty($this->input->post('category'))){
			$this->db->where('category_id = '.(int)$this->input->post('category'));
      }

		if(!empty($this->input->post('type'))){
			$this->db->where('product_type_id = '.(int)$this->input->post('type'));
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
      $status = $is_discount = 0;

      if(!empty($data['status']) && $data['status'] == 'on'){
         $status = 1;
      }

      if(!empty($data['is_discount']) && $data['is_discount'] == 'on'){
         $is_discount = 1;
      }

      $distributor_ids = ''; 
      if(!empty($data['distributor_ids'])) {
         $distributor_ids = implode(',', $data['distributor_ids']);
      }

		if($this->input->post('hiddenIdAdmincp')==0){
			//Kiểm tra đã tồn tại chưa?
			$checkData = $this->checkData($data);
			if($checkData){
            $json['status'] = 0;
            $json['message'] = 'Tên sản phẩm đã tồn tại';
            $json['token'] = $this->security->get_csrf_hash();
            echo json_encode($json);
            exit;
         }
         
         $user_info = $this->session->userdata('userData');
			
			$insert = array(
				'status'          => $status,
				'product_name'    => ucwords($data['product_name']),
				'slug'            => SEO(trim($data['product_name'])),
				'product_type_id' => (int)$data['product_type_id'],
				'unit'            => strtoupper(trim($data['unit'])),
				'product_code'    => strtoupper(trim($data['product_code'])),
				'category_id'     => (int)$data['category_id'],
				'distributor_ids' => $distributor_ids,
				// 'color_code'      => strtoupper(trim($data['color_code'])),
				'price_input'     => (int)$data['price_input'],
				'price_output'    => (int)$data['price_output'],
				'price_unit_id'   => isset($data['price_unit_id']) ? (int)$data['price_unit_id'] : 1,
				// 'size'            => ucwords($data['size']),
				'is_discount'     => $is_discount,
				'discount_price_output'    => (int)$data['discount_price_output'],
				// 'description'     => trim($data['description']),
            'count_stock'     => (int)$data['count_stock'],
            'date_production' => !empty($data['date_production']) ? date('Y-m-d', strtotime($data['date_production'])) : '0000-00-00',
				'date_expiration' => !empty($data['date_expiration']) ? date('Y-m-d', strtotime($data['date_expiration'])) : '0000-00-00',
				'user_add'        => $user_info['user_id'],
				'thumbnail'       => trim($data['thumbnail']),
				'created'         => date('Y-m-d H:i:s')
         );
         if(!empty($data['thumbnail'])) {
            $insert['thumbnail'] = $data['thumbnail'];
         }
         
			if($this->db->insert($this->table,$insert)){
				modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
				return true;
         }
         
		}else{
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));
			//Kiểm tra đã tồn tại chưa?
			if($result[0]->product_name!=$this->input->post('product_name')){
				$checkData = $this->checkData($data);
				if($checkData){
               $json['status'] = 0;
               $json['message'] = 'Tên sản phẩm đã tồn tại';
               $json['token'] = $this->security->get_csrf_hash();
               echo json_encode($json);
               exit;
				}
			}
			
			$update = array(
				'status'          => $status,
				'product_name'    => ucwords($data['product_name']),
				'slug'            => SEO(trim($data['product_name'])),
				'product_type_id' => (int)$data['product_type_id'],
				'unit'            => strtoupper(trim($data['unit'])),
				'product_code'    => strtoupper(trim($data['product_code'])),
				'category_id'     => (int)$data['category_id'],
				'distributor_ids' => $distributor_ids,
            // 'color_code'      => strtoupper(trim($data['color_code'])),
            'price_input'     => (int)$data['price_input'],
				'price_output'    => (int)$data['price_output'],
				'price_unit_id'   => (int)$data['price_unit_id'],
				// 'size'            => ucwords($data['size']),
				'is_discount'     => $is_discount,
				'discount_price_output'    => (int)$data['discount_price_output'],
				// 'description'     => trim($data['description']),
				'count_stock'     => (int)$data['count_stock'],
				'date_production' => !empty($data['date_production']) ? date('Y-m-d', strtotime($data['date_production'])) : '0000-00-00',
				'date_expiration' => !empty($data['date_expiration']) ? date('Y-m-d', strtotime($data['date_expiration'])) : '0000-00-00',
         );
         if(!empty($data['thumbnail'])) {
            $update['thumbnail'] = $data['thumbnail'];
         }
         
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
		$this->db->where('product_name',trim($data['product_name']));
		$this->db->where('product_code',strtoupper(trim($data['product_code'])));
		// $this->db->where('size',strtoupper(trim($data['size'])));
		$this->db->where('product_type_id',$data['product_type_id']);
		$this->db->where('category_id',(int)$data['category_id']);
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		if($query->result()){
			return true;
		}else{
			return false;
		}
	}
   
   function getParents($id) {
      $this->db->select('*');
      $this->db->where('status = 1 AND id != '.$id);
      $query = $this->db->get($this->table);
      
      if($query->result()){
         return $query->result();
      }else{
         return false;
      }
   }

   function loadcategoriesByType(){
      $type_id = (int)$this->input->post('type_id');

      $this->db->select('*');
      $this->db->where('status', 1);
      if(!empty($type_id)){
         $this->db->where('category_type_id', $type_id);
      }
      $query = $this->db->get('categories');
      
      if($query->result()){
         return $query->result();
      }else{
         return false;
      }
   }

   function getPriceUnit(){
      $query = $this->db->get('price_unit');
      $data = array();
      foreach($query->result() as $unit){
         $data[$unit->id] = $unit->name;
      }
      return $data;
   }

   function getList($filters = array()){
      $this->db->select('*');

      if(isset($filters['search_content']) && $filters['search_content']!='' && $filters['search_content']!='type here...'){
			$this->db->where('(`product_name` LIKE "%'.$filters['search_content'].'%") OR (`product_code` LIKE "%'.$filters['search_content'].'%")');
		}
      if(isset($filters['status']) && $filters['status'] != '') {
         $this->db->where('status', (int)$filters['status']);
      }

      if(!empty($filters['category_id'])) {
         $this->db->where('category_id', (int)$filters['category_id']);
      }

      if(!empty($filters['product_type_id'])) {
         $this->db->where('product_type_id', (int)$filters['product_type_id']);
      }

      if(isset($filters['date_from']) && $filters['date_to']){
         if($filters['date_from']!='' && $filters['date_to']==''){
            $this->db->where($this->table.'.created >= "'.date('Y-m-d',strtotime($filters['date_from'])).'"');
         }
         if($filters['date_from']=='' && $filters['date_to']!=''){
            $this->db->where($this->table.'.created <= "'.date('Y-m-d',strtotime($filters['date_to'])).'"');
         }
         if($filters['date_from']!='' && $filters['date_to']!=''){
            $this->db->where($this->table.'.created >= "'.date('Y-m-d',strtotime($filters['date_from'])).'"');
            $this->db->where($this->table.'.created <= "'.date('Y-m-d',strtotime($filters['date_to'])).'"');
         }
      }

      $this->db->order_by('id', 'ASC');
      $query = $this->db->get($this->table);

      if($query->result()){
         return $query->result();
      } else {
         return false;
      }
   }

   function handelStock($id, $qty) {
      $this->db->where('id', $id);
      if($this->db->update($this->table, array('count_stock' => $qty))){
         return true;
      } else {
         return false;
      }
   }
}