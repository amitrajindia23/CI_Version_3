<?php 
class Account_Model extends CI_Model {

	public function __construct(){
		parent::__construct();
		//$CI =& get_instance();
		$this->load->library("Session");
	}

	/*
	* Model function to signin
	*/
	public function signin($data){
		$query = $this->db
				->get_where('ci_users',$data);

		if($query->num_rows() > 0){
			$data = array(
						'last_login' => date("Y-m-d H-i-s")
					);

			$this->db->update("ci_users", $data);
			$this->session->set_userdata("user_id", $query->row()->id);
			return true;
		}
		else{
			return false;
		}
	}

	/*
	* Model function to signup
	*/
	public function signup($data){
		$userData = array(
				'name' => $data['name'],
				'email' =>$data['email'],
				'password' => $data['encryptedPassword'],
				'dob' => $data['dob'],
				'gender' => $data['gender'],				
				'status' => '1',				
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			);
		$this->db->insert('ci_users',$userData);
		$last_inserted_id = $this->db->insert_id();
		return $last_inserted_id;
	}

	/*
	* Can register (Check email avaliable for signup or not)
	*/
	public function checkUserEmailAvailability($email){
		$query = $this->db
				->where('email',$email)
				->get('ci_users');

		$result = $query->num_rows();
		return $result;
	}

	/*
	* Check user loggedIn or not
	*/
	public function isLoggedIn(){
		$userId = $this->session->userdata('user_id');
		return ($userId)?true:false;
	}

	/*
	* Get User All Data
	*/
	public function get_userdata(){
		$query = $this->db
				->get_where('ci_users',array('id'=>$this->session->userdata('user_id')));

		$userData = $query->row();
		return $userData;
	}

	/*
	* Update user data
	*/
	public function updateUserDetails($data){

		$this->db->where('id',$this->session->userdata('user_id'));
		$result = $this->db->update('ci_users',$data);
		return $result;
	}

	/*
	* Update Password
	*/
	public function updatePassword($data){
		$this->db->where('id',$this->session->userdata('user_id'));
		$result = $this->db->update('ci_users',$data);
		return $result;
	}

	/*
	* Signout
	*/
	public function getSignOut(){
		$this->session->unset_userdata('user_id');
	}
}