<?php
class Dashboard_model extends CI_Model {

	function countTotalInStock(){
      $this->load->model('product_types/product_types_model');
      $product_types = $this->product_types_model->getList(array('status' => 1));

      $product_types_mapping = array();
      if($product_types) {
         foreach($product_types as $product_type) {
            $product_types_mapping[$product_type->id] = array(
               'name' => $product_type->name,
               'count' => 0
            );
         }
      }

      $this->db->where('status = 1');
      $query = $this->db->get('products');

      if($query->result()){
         foreach($query->result() as $row) {
            if(isset($product_types_mapping[$row->product_type_id])){
               $product_types_mapping[$row->product_type_id]['count'] += (int)$row->count_stock;
            }
         }
      }

      foreach($product_types_mapping as $v) {
         $data['labels'][] = $v['name'];
         $data['values'][] = $v['count'];
      }

      return $data;
   }

   function countTotalByType() {
      $this->db->select('products.*, (SELECT name FROM categories WHERE products.category_id = categories.id) AS category_name');
      $query = $this->db->get('products');

      $data = array(
         1 => array(),
         2 => array()
      );

      if($query->result()){
         foreach($query->result() as $row) {
            if(isset($data[$row->product_type_id])){
               if(empty($data[$row->product_type_id][$row->category_id])){
                  $data[$row->product_type_id][$row->category_id] = array(
                     'category_name' => $row->category_name,
                     'count' => 0
                  );
               }
               $data[$row->product_type_id][$row->category_id]['count'] += (int)$row->count_stock;
            }
         }
      }
      $chart_data = array(
         'brick' => array(
            'labels' => array(),
            'values' => array()
         ),
         'paint' => array(
            'labels' => array(),
            'values' => array()
         )
      );
      if(!empty($data[1])){
         foreach($data[1] as $v){
            $chart_data['brick']['labels'][] = $v['category_name'];
            $chart_data['brick']['values'][] = $v['count'];
         }
      }
      if(!empty($data[2])){
         foreach($data[2] as $v){
            $chart_data['paint']['labels'][] = $v['category_name'];
            $chart_data['paint']['values'][] = $v['count'];
         }
      }

      return $chart_data;
   }
}