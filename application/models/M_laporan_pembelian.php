<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan_pembelian extends CI_Model{
	function tanggal($tanggal_awal, $tanggal_akhir){
		return $this->db->query("
			SELECT a.pendataan_masuk AS pm, a.user_id, b.*
			FROM pembelian a
			INNER JOIN pembelian_detail b
			ON a.id = b.id
			WHERE a.pendataan_masuk
			BETWEEN '$tanggal_awal' AND '$tanggal_akhir' + INTERVAL 1 DAY
			");
	}
	function suplier($tanggal_awal, $tanggal_akhir, $suplier){
		return $this->db->query("
			SELECT a.pendataan_masuk AS pm, a.user_id, b.*
			FROM pembelian a
			INNER JOIN pembelian_detail b
			ON a.id = b.id
			WHERE a.pendataan_masuk
			BETWEEN '$tanggal_awal'
			AND '$tanggal_akhir' + INTERVAL 1 DAY
			AND b.suplier = '$suplier'
			");
	}
	function jenis_barang($tanggal_awal, $tanggal_akhir, $jenis, $barang){
		return $this->db->query("
			SELECT a.pendataan_masuk AS pm, a.user_id, b.*
			FROM pembelian a
			INNER JOIN pembelian_detail b
			ON a.id = b.id
			WHERE a.pendataan_masuk
			BETWEEN '$tanggal_awal'
			AND '$tanggal_akhir' + INTERVAL 1 DAY
			AND b.jenis = '$jenis'
			AND b.barang = '$barang'
			");
	}
}