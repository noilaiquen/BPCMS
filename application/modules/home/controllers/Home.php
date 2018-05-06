<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {
    
    private $module = 'home';
    private $token;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model','model');
        // if ( ! $this->session->userdata('token')) {
        //     header('Location: ' . PATH_URL . 'login');
        //     return FALSE;
        // }
    }

    public function index()
    {
        if ($this->session->userdata('token')) {
            redirect(base_url('dashboard'));//dashboard
        }
		$data['login_url'] = base_url('/login');
        $data['signup_url'] = base_url('/signup');
        $data['rs_pass_url'] = base_url('/passwordrecovery');
		$data['data_header'] = $this->model->getDataHeader();
		$data['data_slider'] = $this->model->getDataSlider();
		$data['data_video'] = $this->model->getDataVideo();
		$data['data_phone'] = $this->model->getDataPhone();
		$data['data_about'] = $this->model->getDataAbout();
        $data['api_url'] = PATH_API . 'U0002';
        $this->template->write('title','HABfit');
        $this->template->write_view('content','FRONTEND/index', $data);
        $this->template->render();
    }

    public function faqs()
    {
        $this->_check_login();
		// $api_path = 'Q0001';
        // $data['faqs'] = get_result(get_data_from_api($api_path));
        $data['faqs'] = $this->api->get_faqs();
		$this->template->set_template('admin_pro');
        $this->template->write('title','FAQs');
        $this->template->write_view('content','FRONTEND/faqs', $data);
        $this->template->render();
    }

    public function customer_support()
    {
        $this->_check_login();
        if ( ! $this->input->is_ajax_request()) {
            $data = NULL;
            $this->template->set_template('admin_pro');
            $this->template->write('title','Customer Support');
            $this->template->write_view('content','FRONTEND/customer_support', $data);
            $this->template->render();
        }
        else {
            $api_path = 'CS0001';
            
        }
    }

    public function terms_and_conditions()
    {
		
        $this->_check_login();
        $data['tandc'] = $this->api->get_term_of_service();
        $this->template->set_template('admin_pro');
        $this->template->write('title','Terms and Conditions');
        $this->template->write_view('content','FRONTEND/tandc', $data);
        $this->template->render();
    }
	
    public function privacy_policy()
    {
        $this->_check_login();
        $data['privacy_policy'] = $this->api->get_privacy_policy();
        $this->template->set_template('admin_pro');
        $this->template->write('title','Privacy Policy');
        $this->template->write_view('content','FRONTEND/privacy_policy', $data);
        $this->template->render();
    }
	 public function service_guidelines()
    {
        $this->_check_login();
        $data['service_guidelines'] = $this->api->get_service_guidelines();
		//$data = NULL;
        $this->template->set_template('admin_pro');
        $this->template->write('title','Service Guidelines');
        $this->template->write_view('content','FRONTEND/service_guidelines', $data);
        $this->template->render();
    }

    public function tutorial()
    {
        $this->_check_login();
        $data = NULL;
        $this->template->set_template('admin_pro');
        $this->template->write('title','Tutorial');
        $this->template->write_view('content','FRONTEND/setting', $data);
        $this->template->render();
    }
	
	public function how_it_works()
    {
		$this->_check_login();
		$data = null;
        $this->template->set_template('admin_pro');
        $this->template->write('title','How it works');
        $this->template->write_view('content','FRONTEND/how_it_works', $data);
        $this->template->render();
    }
	public function about()
    {
		$this->_check_login();
		$data = null;
        $this->template->set_template('admin_pro');
        $this->template->write('title','About');
        $this->template->write_view('content','FRONTEND/about', $data);
        $this->template->render();
    }
	public function career()
    {
		$this->_check_login();
		$data = null;
        $this->template->set_template('admin_pro');
        $this->template->write('title','Career');
        $this->template->write_view('content','FRONTEND/career', $data);
        $this->template->render();
    }

    public function setting()
    {
        $this->_check_login();
        $data = NULL;
        $this->template->set_template('admin_pro');
        $this->template->write('title','Setting');
        $this->template->write_view('content','FRONTEND/setting', $data);
        $this->template->render();
    }
	
	public function grow_your_clientele()
    {
        $this->_check_login();
        // $params['token'] = $this->session->userdata('token');
        $rs = $this->model->get_personal_account_id();
        if ( ! empty($rs->personal_account_id)) {
            $personal_account_id = $rs->personal_account_id;
        } else {
            $personal_account_id = null;
        }
        $data['personal_account_id'] = $personal_account_id;
        // pr($data, 1);
        // $data = NULL;
        $this->template->set_template('admin_pro');
        $this->template->write('title','Grow Your Clientele');
        $this->template->write_view('content','FRONTEND/grow', $data);
        $this->template->render();
    }
	public function page_404()
    {
        $this->_check_login();
        $data = NULL;
        $this->template->set_template('admin_pro');
        $this->template->write('title','Terms and Conditions');
        $this->template->write_view('content','FRONTEND/404', $data);
        $this->template->render();
    }
    public function payment()
    {
        $this->_check_login();
		
		// Connect Pro into Customer
        $check_stripe = $this->model->checkStripeByToken();
        $data['check_stripe'] = $check_stripe;
		if(empty($check_stripe)){
			$result = $this->model->stripe_public_key();
			if(!empty($result->stripe_public_key)){
				$stripe_public_key = $result->stripe_public_key;
				$data['stripe_public_key'] = $stripe_public_key;
			}
		}
		
		// Connect Pro into Standalone Account
        $check_stripe_ofPro = $this->model->checkStripeIdOfPro();
        /*  if(empty($check_stripe_ofPro)){
			$result = $this->model->stripe_connect_pro_url();
			if(!empty($result->url)){
				$stripe_connect_pro_url = $result->url;
				$data['stripe_connect_pro_url'] = $stripe_connect_pro_url;
			}
		} */
        $result = $this->model->stripe_connect_pro_url();
        if(!empty($result->url)){
            $stripe_connect_pro_url = $result->url;
            $data['stripe_connect_pro_url'] = $stripe_connect_pro_url;
        }
        $data['check_stripe_ofPro'] = $check_stripe_ofPro;
        $url_insert_token = base_url('insertStripe');
        $data['url_insert_token'] = $url_insert_token;
        $data['unlink_url'] = base_url('payment/unlink-stripe');

        $this->template->set_template('admin_pro');
        $this->template->write('title','Payment');
        $this->template->write_view('content','FRONTEND/payment_bank', $data);
        $this->template->render();
    }
    public function payment_more_services()
    {
        $this->_check_login();
		$check_stripe = $this->model->checkStripeByToken();
		$data['check_stripe'] = $check_stripe;
		
        $infoPackage = $this->model->getInfoPackage();
        $data['num_of_balance'] = $this->model->getNumOfBalanceOfSalon();
        $data['infoPackage'] = $infoPackage;
        $url_charge_package = base_url('insertChargePackage');
        $data['url_charge_package'] = $url_charge_package;
        $this->template->set_template('admin_pro');
        $this->template->write('title','Want To Market More Services?');
        $this->template->write_view('content','FRONTEND/payment_more_services', $data);
        $this->template->render();
    }
    public function unlink_stripe_customer() {
        $rs  = TRUE;
        $params['token'] = $this->session->userdata('token');
        $rs = $this->model->unlinkStripeCustomer($params);
        pr($rs,1);
        // echo 'aaa'; exit;
        if ($rs !== FALSE) {
            $result['status'] = STATUS_SUCCESS;
            $result['title'] = 'Unlink successful';
            $result['message'] = 'Unlink stripe successful';
        }
        else {
            $result['status'] = STATUS_FAIL;
            $result['message'] = 'Please upload file!';
        }
        return_json($result); exit;
    }
    public function chargePackage(){
        $rs  = TRUE;
        $params['package_id'] = $this->input->post('id_package');
        $rs = $this->model->insertChargePackage($params);
        // pr($rs,1);
        if ($rs !== FALSE) {
            $result['status'] = STATUS_SUCCESS;
            $result['title'] = 'Charge successful';
            $result['message'] = 'Charge successful';
        }
        else {
            $result['status'] = STATUS_FAIL;
            $result['message'] = 'Please upload file!';
        }
        return_json($result);
    }
    public function insertStripeId(){
        $rs  = TRUE;
        $params['stripeToken'] = $this->input->post('stripe_token');
        $rs = $this->model->insertStripeToken($params);
        if ($rs !== FALSE) {
            $result['status'] = STATUS_SUCCESS;
            $result['message'] = 'Connect user successful';
        }
        else {
            $result['status'] = STATUS_FAIL;
            $result['message'] = 'Connect user failed';
        }
        return_json($result);
    }
    public function func_test()
    {
        exit;
    }
    private function _check_login() 
    {
        if ( ! $this->session->userdata('token')) {
            redirect(base_url('/'));
        }
    }

    public  function pagemissing(){
    	$this->output->set_status_header('404');
    	$data = NULL;
    	$this->template->set_template('admin_pro');
    	$this->template->write('title','Terms and Conditions');
    	$this->template->write_view('content','FRONTEND/404', $data);
    	$this->template->render();
    }
    
    function loginfb(){
    	$loginUrl = __initFacebook(1, "home/facebooklogin");
    	redirect($loginUrl);
    }
    
    public  function facebooklogin(){
    	//pr($_SESSION['FBRLH_state']);
    	$fb = __initFacebook();
    	$helper = $fb->getRedirectLoginHelper();
    
    	try {
    		$accessToken = $helper->getAccessToken();
    
    	} catch(Facebook\Exceptions\FacebookResponseException $e) {
    		// When Graph returns an error
    		log_message('error', 'Graph returned an error: ' . $e->getMessage());
    		redirect("/");
    	} catch(Facebook\Exceptions\FacebookSDKException $e) {
    		// When validation fails or other local issues
    
    		log_message('error', 'Facebook SDK returned an error 1: ' . $e->getMessage() );
    		redirect("/");
    		exit;
    	}
    
    	if (! isset($accessToken)) {
    		if ($helper->getError()) {
    			log_message('error', "Error: " . $helper->getError() . "\n" );
    			log_message('error', "Error Code: " . $helper->getErrorCode() . "\n" );
    			log_message('error', "Error Reason: " . $helper->getErrorReason() . "\n" );
    			log_message('error', "Error Description: " . $helper->getErrorDescription() . "\n" );
    		} else {
    			//header('HTTP/1.0 400 Bad Request');
    			//echo 'Bad request';
    			log_message('error', 'Bad request' );
    		}
    		redirect("/");
    		exit;
    	}
    
    	// Logged in
    	//	var_dump($accessToken->getValue());
    
    	// The OAuth 2.0 client handler helps us manage access tokens
    	$oAuth2Client = $fb->getOAuth2Client();
    
    	// Get the access token metadata from /debug_token
    	$tokenMetadata = $oAuth2Client->debugToken($accessToken);
    
    	// Validation (these will throw FacebookSDKException's when they fail)
    	$tokenMetadata->validateAppId(FB_APP_ID); // Replace {app-id} with your app id
    	// If you know the user ID this access token belongs to, you can validate it here
    	//$tokenMetadata->validateUserId('1131169556928190');
    	$tokenMetadata->validateExpiration();
    
    	if (! $accessToken->isLongLived()) {
    		// Exchanges a short-lived access token for a long-lived one
    		try {
    			$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    		} catch (Facebook\Exceptions\FacebookSDKException $e) {
    			echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    
    			redirect("/");
    			exit;
    		}
    
    		redirect("/");
    		exit;
    	}
    
    	$_SESSION['fb_access_token'] = (string) $accessToken;
    
    
    	try {
    		// Returns a `Facebook\FacebookResponse` object
    		$response = $fb->get('/me?fields=id,name,first_name,last_name,email,birthday,picture,gender,link,about,cover,age_range', $accessToken);
    	} catch(Facebook\Exceptions\FacebookResponseException $e) {
    		//	echo 'Graph returned an error: ' . $e->getMessage();
    		log_message('error', 'Graph returned an error: ' . $e->getMessage() );
    		redirect("/");
    		exit;
    	} catch(Facebook\Exceptions\FacebookSDKException $e) {
    		echo 'Facebook SDK returned an error 2: ' . $e->getMessage();
    
    		log_message('error', 'Facebook SDK returned an error 2: ' . $e->getMessage() );
    		redirect("/");
    		exit;
    	}
    
    	$user = (array)$response->getGraphUser()->asArray();
    	$user['access_token'] = $accessToken->getValue();
    	// pr($user, 1);
    	$params['uuid'] = $user['id'];
    	$params['username'] = $user['name'];
    	$params['is_professional'] = IS_PRO; //DON'T REMOVE
    	$params['type'] = 'facebook';
    	$params['email'] = $user['email'];
        $params['firstname'] = $user['first_name'];
        $params['lastname'] = $user['last_name'];
    	$params['password'] = '';
    	
    	$api_path = 'U0001';
        $json_response = post_data_to_api($api_path, $params, 'json');
        if( !empty($json_response->ResultSet) ){
        	$json_response->ResultSet->avatar = 'https://graph.facebook.com/'.$user['id']."/picture?width=500";
        	$json_response->ResultSet->username = $user['name'];
        	$this->session->set_userdata((array)$json_response->ResultSet);
        	//pr($json_response->ResultSet,1);
        }
        
    	//pr($json_response,1);
    	redirect("/");
    
    }
    
}