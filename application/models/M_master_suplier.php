<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_master_suplier extends CI_Model{
	function get_master_suplier(){
		$this->db->select('*');
		$this->db->from('master_suplier');
		$get = $this->db->get();
		if($get->num_rows() > 0){
			return $get->result_array();
		}
		return array(0 => array('perusahaan' => '-', 'pemilik' => '-'));
	}
	function ajax($search, $limit, $start, $order_field_data, $order_ascdesc){
		$dataset = [];

		$this->db->select('*');
		$this->db->from('master_suplier');
		$get = $this->db->get();
		$dataset['recordsTotal'] = $get->num_rows();

		$this->db->select('*');
		$this->db->from('master_suplier');
		$this->db->like('perusahaan', $search);
		$this->db->or_like('pemilik', $search);
		$this->db->or_like('alamat', $search);
		$get = $this->db->get();
		$dataset['recordsFiltered'] = $get->num_rows();

		$this->db->select('*');
		$this->db->from('master_suplier');
		$this->db->like('perusahaan', $search);
		$this->db->or_like('pemilik', $search);
		$this->db->or_like('alamat', $search);
		$this->db->order_by($order_field_data, $order_ascdesc);
		$this->db->limit($limit, $start);
		$get = $this->db->get();
		$dataset['data'] = $get->result_array();

		return $dataset;
	}
	function tambah($dataset){
		$this->db->insert('master_suplier', $dataset);
		if($this->db->affected_rows() == 1){
			return true;
		}
		return false;
	}
	function ubah($dataset, $id){
		$this->db->where('id', $id);
		$this->db->update('master_suplier', $dataset);
		if($this->db->affected_rows() == 1){
			return true;
		}
		return false;
	}
	function hapus($id){
		$this->db->where('id', $id);
		$this->db->delete('master_suplier');
		if($this->db->affected_rows() == 1){
			return true;
		}
		return false;
	}
}