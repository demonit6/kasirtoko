<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pembelian extends CI_Model{
	function simpan_pembelian($user_id){
		$now = date('Y-m-d H:i:s');
		$q = "INSERT INTO pembelian VALUES(null,'$now','$user_id')";
		$this->db->query($q);
		$q = "SELECT LAST_INSERT_ID() AS id";
		$r = $this->db->query($q);
		return $r->result_array();
	}
	function simpan_pembelian_detail_dan_stok($dataset){
		$res = $this->db->insert_batch('pembelian_detail', $dataset);
		for($i = 0; $i < count($dataset); $i++){
			unset($dataset[$i]['harga_beli']);
			unset($dataset[$i]['total_harga_beli']);
		}
		$res = $this->db->insert_batch('stok', $dataset);
		return $res;
	}
}