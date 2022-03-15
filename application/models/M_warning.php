<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_warning extends CI_Model{
	private $day = 30;
	function checkExpired(){
		$res = $this->db->query("SELECT * FROM stok WHERE exp_s='Ya'");
		$warnex = 0;
		if($res->num_rows() > 0){
			foreach ($res->result_array() as $key => $value) {
				$date_now = date_create(date('Y-m-d'));
				$date_db = date_create(date($value['exp_d']));
				$date_diff = date_diff($date_now, $date_db);
				if($date_diff->invert !== 1){
					if($date_diff->days < $this->day){
						$warnex += 1;
					}
				}
				else{
					$warnex += 1;
				}
			}
		}
		return $warnex;
	}
	function listCheck(){
		$res = $this->db->query("SELECT * FROM stok WHERE exp_s='Ya'");
		$dataset = [];
		if($res->num_rows() > 0){
			$i = 0;
			foreach ($res->result_array() as $key => $value) {
				$date_now = date_create(date('Y-m-d'));
				$date_db = date_create(date($value['exp_d']));
				$date_diff = date_diff($date_now, $date_db);
				if($date_diff->invert !== 1){
					if($date_diff->days < $this->day){
						$tmp = array(
							'id' => $value['id'],
							'id_l' => $value['id_l'],
							'jenis' => $value['jenis'],
							'barang' => $value['barang'],
							'total_barang' => $value['total_barang'],
							'exp_d' => $value['exp_d'],
							'exp_info' => $date_diff->days.' Hari lagi barang akan kadaluarsa'
						);
						$dataset[$i] = $tmp;
					}
				}
				else{
					$tmp = array(
						'id' => $value['id'],
						'id_l' => $value['id_l'],
						'jenis' => $value['jenis'],
						'barang' => $value['barang'],
						'total_barang' => $value['total_barang'],
						'exp_d' => $value['exp_d'],
						'exp_info' => 'Barang telah kadaluarsa'
					);
					$dataset[$i] = $tmp;
				}
				$i++;
			}
		}
		return $dataset;
	}
}