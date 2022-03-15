<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_stok extends CI_Model{
	function ajax_index($search, $limit, $start, $order_field_data, $order_ascdesc){
		$dataset = [];

		$this->db->select('*');
		$this->db->from('stok');
		$get = $this->db->get();
		$dataset['recordsTotal'] = $get->num_rows();

		$this->db->select('*');
		$this->db->from('stok');
		$this->db->like('id', $search);
		$this->db->or_like('id_l', $search);
		$this->db->or_like('suplier', $search);
		$this->db->or_like('jenis', $search);
		$this->db->or_like('barang', $search);
		$get = $this->db->get();
		$dataset['recordsFiltered'] = $get->num_rows();

		$this->db->select('*');
		$this->db->from('stok');
		$this->db->like('id', $search);
		$this->db->or_like('id_l', $search);
		$this->db->or_like('suplier', $search);
		$this->db->or_like('jenis', $search);
		$this->db->or_like('barang', $search);
		$this->db->order_by($order_field_data, $order_ascdesc);
		$this->db->limit($limit, $start);
		$get = $this->db->get();
		$dataset['data'] = $get->result_array();

		return $dataset;
	}
	function total_barang($id_l){
		$this->db->select('total_barang');
		$this->db->from('stok');
		$this->db->where('id_l', $id_l);
		$get = $this->db->get();
		if($get->num_rows() == 1){
			return $get->result_array();
		}
		return false;
	}
	function inret($dataset){
		$this->db->insert('retur', $dataset);
		if($this->db->affected_rows() == 1){
			return true;
		}
		return false;
	}
	function get_id(){
		$r = $this->db->query("SELECT LAST_INSERT_ID() AS id");
		return $r->result_array();
	}
	function update_stok($total_barang, $id_l){
		$this->db->query("UPDATE stok SET total_barang='$total_barang' WHERE id_l='$id_l'");
		if($this->db->affected_rows() == 1){
			return true;
		}
		return false;
	}
	function delete_stok($id_l){
		$this->db->query("DELETE FROM stok WHERE id_l='$id_l'");
		if($this->db->affected_rows() == 1){
			return true;
		}
		return false;
	}
	function ajax_jenisbarang($search, $order_field_data, $order_ascdesc, $start, $limit){
		$q = "SELECT jenis, barang, SUM(total_barang) AS stok FROM
		stok GROUP BY jenis, barang";
		$recordsTotal = $this->db->query($q)->num_rows();
		$q = "SELECT jenis, barang, SUM(total_barang) AS stok FROM
		stok WHERE jenis LIKE '%$search%'
		OR barang LIKE '%$search%' GROUP BY jenis, barang";
		$recordsFiltered = $this->db->query($q)->num_rows();
		$q = "SELECT jenis, barang, SUM(total_barang) AS stok FROM
		stok WHERE jenis LIKE '%$search%'
		OR barang LIKE '%$search%' GROUP BY jenis, barang 
		ORDER BY $order_field_data $order_ascdesc
		LIMIT $start, $limit";
		$data = $this->db->query($q)->result_array();
		$dataset = array(
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsFiltered,
			'data' => $data
		);
		return $dataset;
	}
	function ajax_aturhargabarang($search, $order_field_data, $order_ascdesc, $start, $limit){
		$q = "SELECT * FROM stok_harga";
		$recordsTotal = $this->db->query($q)->num_rows();
		$q = "SELECT * FROM stok_harga WHERE jenis LIKE '%$search%'
		OR barang LIKE '%$search%'";
		$recordsFiltered = $this->db->query($q)->num_rows();
		$q = "SELECT * FROM stok_harga WHERE jenis LIKE '%$search%'
		OR barang LIKE '%$search%' 
		ORDER BY $order_field_data $order_ascdesc
		LIMIT $start, $limit";
		$data = $this->db->query($q)->result_array();
		// for($i = 0; $i < count($data); $i++){
		// 	$data[$i]['harga_jual'] = formatRupiah($data[$i]['harga_jual']);
		// }
		$dataset = array(
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsFiltered,
			'data' => $data
		);
		return $dataset;
	}
	function refresh_daftar_barang(){
		$dataset = '';
		$i = 1;
		$res = $this->db->query("SELECT jenis, barang FROM stok GROUP BY jenis, barang");
		if($res->num_rows() == 0){
			return;
		}
		$res = $res->result_array();
		foreach ( $res as $key => $value) {
			$dataset .= "('$value[jenis]','$value[barang]')";
			if($i < count($res)){
				$dataset .= ',';
			}
			$i++;
		}
		$this->db->query("ALTER TABLE stok_harga auto_increment=1");
		$this->db->query("INSERT IGNORE INTO stok_harga(`jenis`,`barang`) VALUES $dataset");
	}
	function simpan_harga_barang($id, $harga_jual){
		$this->db->query("UPDATE stok_harga SET harga_jual='$harga_jual' WHERE id='$id'");
		if($this->db->affected_rows() == 1){
			return true;
		}
		return false;
	}
	function hapus_harga_barang($id){
		$this->db->query("DELETE FROM stok_harga WHERE id='$id'");
		if($this->db->affected_rows() == 1){
			return true;
		}
		return false;
	}
}