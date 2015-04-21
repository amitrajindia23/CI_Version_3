<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	//constructor
	public function __construct(){
		parent::__construct();
		$this->load->model("account_model");
		$this->load->library("Layouts");
	}

	public function index(){		

		$this->layouts->setTitle('Welcome To MyDemoSite');
		$this->__loadJsAndCSS();	
		$this->layouts->view('index','','default');
	}

	/*
	* Function to load signin page
	*
	*/
	public function signin(){		

		if($this->account_model->isLoggedIn()){
			$this->dashboard();
		}
		else{
			$this->layouts->setTitle('Sign-In');
			$this->__loadJsAndCSS();		
			$this->layouts->view('account/signin','','signin');
		}
	}

	/*
	* Function for signin
	*/
	public function postSignin(){

		$this->form_validation->set_rules('email', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE)
		{
			$data = array(
						'email' => $this->input->post('email'),
						'password' => $this->__encryptPassword($this->input->post('password'))
					);
			$result = $this->account_model->signin($data);
			if($result){
				redirect('account/dashboard');	
			}
			else{
				$this->layouts->setError('Email or password not matched!');
				$this->signin();
			}			
		}
		else
		{
			redirect('account/signin');
		}
	}

	/*
	* Function to load dashboard page
	*/
	function dashboard(){

		if($this->account_model->isLoggedIn()){
			$userData = $this->account_model->get_userdata();
			$this->layouts->setUserData($userData);
			$this->layouts->setTitle('Dashboard');
			$this->__loadJsAndCSS();		
			$this->layouts->view('dashboard','','dashboard');
		}
		else{
			redirect('account/signin');
		}
	}

	/*
	* Function to load signup page
	*
	*/
	public function signup(){	

		if($this->account_model->isLoggedIn()){
			$this->dashboard();
		}
		else{
			$this->layouts->setTitle('Sign-Up');
			$this->__loadJsAndCSS();		
			$this->layouts->view('account/signup','','signup');
		}
	}

	/*
	* Function for signup
	*/
	public function postSignup(){
		
		$userData = $this->input->post();
		$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[35]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('dob', 'Dob', 'required');
        $email = $this->input->post('email');
        if ($this->form_validation->run() == TRUE){
			$userData['encryptedPassword'] = $this->__encryptPassword($userData['password']);

			$result = $this->account_model->checkUserEmailAvailability($email);
			if($result == 0){
				$userId = $this->account_model->signup($userData);
				if($userId){
					$this->layouts->setMessage('You are succesully registered!');
					$this->signup();
				}
			}
			else{
				$this->layouts->setError('Email already exist.');
				$this->signup();
			}
		}
		else{
			$this->layouts->setError('<strong>Oh snap!</strong> Change a few things up and try submitting again.');
			$this->signup();
		}
	}

	/*
	* Encrypt password
	*/
	public function __encryptPassword($password){
		return md5($password);
	}

	/*
	* Check User Email available or not
	*/

	public function userCheck(){

		$email = $this->input->post('userEmail');
		$result = $this->account_model->checkUserEmailAvailability($email);
		if($result){
			$userCheck = array(
							'userCheck' => $result
						);
			echo json_encode($userCheck);
		}
	}

	/*
	* Edit profile page
	*/
	public function editProfile(){
		$this->layouts->setTitle('Edit Profile');
		$this->__loadJsAndCSS();
		$userData = $this->account_model->get_userdata();
		$this->layouts->setUserData($userData);
		$this->layouts->view('account/editProfile','','dashboard');
	}

	/*
	* Update profile
	*/
	public function updateProfile(){
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('dob','Dob','required');
		$this->form_validation->set_rules('gender','Gender','required');

		if($this->form_validation->run() == true){
			$data = array(
						'name' => $this->input->post('name'), 
						'email' => $this->input->post('email'), 
						'dob' => $this->input->post('dob'), 
						'gender' => $this->input->post('gender'), 
					);

			$result = $this->account_model->updateUserDetails($data);
			if($result){
				redirect('account/dashboard');
			}
		}
		else{
			$this->layouts->setError('<strong>Oh snap!</strong> Change a few things up and try submitting again.');
			$this->editProfile();
		}
	}

	/*
	* Change password page
	*/
	public function changePassword(){
		$this->layouts->setTitle('Edit Profile');
		$this->__loadJsAndCSS();
		$userData = $this->account_model->get_userdata();
		$this->layouts->setUserData($userData);
		$this->layouts->view('account/changePassword','','dashboard');
	}

	/*
	* Update Password
	*/
	public function updatePassword(){
		$oldPassword = $this->input->post('oldPassword');
		$newPassword = $this->input->post('newPassword');
		$userData = $this->account_model->get_userdata();
		if($userData->password == $this->__encryptPassword($oldPassword)){
			$data = array(
							'password' => $this->__encryptPassword($newPassword)
						);

			$result = $this->account_model->updatePassword($data);
			if($result){
				$this->layouts->setMessage('Password Changed!');
				$this->changePassword();
			}
		}
		else{
			$this->layouts->setError('Old Password is wrong. Please try again!');
			$this->changePassword();
		}
	}

	/*
	* Signout
	*/
	public function signout(){
		$this->account_model->getSignOut();
		redirect('account');
	}

	/*
	* Function to load Js and Css files
	*/
	function __loadJsAndCSS(){

		$this->layouts->add_include('assets/css/bootstrap.min.css')
						->add_include('assets/css/bootstrap-responsive.min.css')       			  	
						->add_include('assets/css/jquery-ui.css')       			  	
						->add_include('assets/css/Login_style.css')       			  	
					  	->add_include('assets/js/jquery-1.11.2.min.js')
					  	->add_include('assets/js/jquery-migrate-1.2.1.min.js')
						->add_include('assets/js/jquery-ui.js')
						->add_include('assets/js/custom.js')
						->add_include('assets/js/bootstrap.min.js');
	}


}