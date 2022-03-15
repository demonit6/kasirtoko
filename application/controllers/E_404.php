<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class E_404 extends CI_Controller{
	function index(){
		$this->load->view('404');
	}
}