<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		$string = file_get_contents("json/settings.json");
		$json = json_decode($string, true);
		$this->load->view('login', $json);
	}
	function alert($n = 0, $p = ''){
		echo '<script>';
		echo "alert('";
		if($n == 0) echo 'Login gagal';
		if($n == 1) echo 'Pengguna tidak ditemukan';
		if($n == 2) echo 'Password salah';
		if($n == 3) echo 'Tidak bisa update tanggal';
		if($n == 4) echo 'Berhasil login, akan dialihkan';
		echo "');";
		echo "window.location = '".base_url($p)."';";
		echo '</script>';
	}
	function tryLogin(){
		$user_id = $this->input->post('user_id');
		$user_password = $this->input->post('user_password');
		$this->load->model('m_login');
		$dbget = $this->m_login->tryLogin($user_id);
		if($dbget != false){
			return $this->userNow($dbget, $user_password);
		}
		return $this->alert(1);
	}
	function userNow($dbget, $user_password){
		if(password_verify($user_password, $dbget[0]['user_password'])){
			return $this->updateLastLogin($dbget[0]['user_id'], $dbget[0]['user_role']);
		}
		return $this->alert(2);
	}
	function updateLastLogin($user_id, $user_role){
		$ndate = date("Y-m-d H-i-s");
		$dataset = array(
			'user_ll' => $ndate
		);
		$dbset = $this->m_login->updateLastLogin($user_id, $dataset);
		if($dbset != false){
			return $this->loginSuccess($user_id, $user_role);
		}
		return $this->alert(3); 
	}
	function loginSuccess($user_id, $user_role){
		$dataset = array(
			'user_id' => $user_id,
			'user_role' => $user_role
		);
		$this->session->set_userdata($dataset);
		return $this->alert(4,'admin'); 
	}
}