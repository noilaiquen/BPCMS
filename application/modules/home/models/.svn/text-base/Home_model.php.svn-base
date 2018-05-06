<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends MY_Model {

	private $module = 'home';
    private $token;
	private $table = 'admin_homepage_pro';
	
    function __construct()
    {
        parent::__construct();
        $this->token = $this->session->userdata('token');
    }
    public function checkStripeByToken($params = NULL)
    {
        $api_path = 'stripe_check_user';
        $params['token'] = $this->token;
        $json_response = post_data_to_api($api_path, $params, 'json');
        if(get_result($json_response) == 1){
            return 1;
        }
        else{
            return 0;
        }
    }
    
	public function stripe_public_key(){
        $api_path = 'stripe_public_key';
        $params['token'] = $this->token;
		// pr($this->token,1);
        $json_response = post_data_to_api($api_path, $params, 'json');
		$url = get_result($json_response);
		return $url;
    }
	
	public function stripe_connect_pro_url(){
        $api_path = 'stripe_connect_pro_url';
        $params['token'] = $this->token;
        $json_response = post_data_to_api($api_path, $params, 'json');
		$url = get_result($json_response);
		return $url;
    }
	
    public function checkStripeIdOfPro(){
        $api_path = 'check_stripe_user_pro';
        $params['token'] = $this->token;
        $json_response = post_data_to_api($api_path, $params, 'json');
        if(get_result($json_response) == 1){
            return 1;
        }
        else{
            return 0;
        }
    }
    
	public function getInfoPackage(){
        $api_path = 'get_package';
        $params['token'] = $this->token;
        $result = get_result(post_data_to_api($api_path, $params, 'json'));
        return $result;
    }
	
    public function getNumOfBalanceOfSalon(){
        $api_path = 'BL002';
        $params['token'] = $this->token;
        $result = get_result(post_data_to_api($api_path, $params, 'json'));
        return $result;
    }
    public function insertStripeToken($params){
        $api_path = 'stripe_connect_user';
        $params['token'] = $this->token;
		// pr($params,1);
        $json_response = post_data_to_api($api_path, $params, 'json');
        if(is_success($json_response)) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    public function unlinkStripeCustomer($params){
        $api_path = 'unlink_stripe';
        // pr($params,1);
        $json_response = post_data_to_api($api_path, $params, 'json');
        pr($json_response, 1);
        if(is_success($json_response)) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    public function insertChargePackage($params){
        $api_path = 'stripe_user_pro_package_charge';
        $params['token'] = $this->token;
        $params['currency'] = 'usd';
        $json_response = post_data_to_api($api_path, $params, 'json');
        // pr($json_response,1);
        if(is_success($json_response)) {
            return 1;
        }
        else {
            return 0;
        }
    }
	function getDataHeader(){
		$this->db->select("*");
		$this->db->where("status",1);
		$this->db->where("type",1);
		$this->db->order_by("id","DESC");
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		if ($query->result()) {
            return $query->result();
        } else {
            return false;
        }
		
	}
	
	function getDataSlider(){
		$this->db->select("*");
		$this->db->where("status",1);
		$this->db->where("type",2);
		$this->db->order_by("id","ASC");
		$query = $this->db->get($this->table);
		if ($query->result()) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function getDataVideo(){
		$this->db->select("*");
		$this->db->where("status",1);
		$this->db->where("type",3);
		$this->db->order_by("id","DESC");
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		if ($query->result()) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function getDataPhone(){
		$this->db->select("*");
		$this->db->where("status",1);
		$this->db->where("type",4);
		$this->db->order_by("id","ASC");
		$query = $this->db->get($this->table);
		if ($query->result()) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function getDataAbout(){
		$this->db->select("*");
		$this->db->where("status",1);
		$this->db->where("type",5);
		$this->db->order_by("id","DESC");
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		if ($query->result()) {
            return $query->result();
        } else {
            return false;
        }
	}

    public function get_personal_account_id($params = NULL)
    {
        $api_path = 'U0026';
        $params['token'] = $this->token;
        $result = get_result(post_data_to_api($api_path, $params, 'json'));
        return $result;
    }
}