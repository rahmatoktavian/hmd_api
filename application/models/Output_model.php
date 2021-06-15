<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Output_model extends CI_Model {

	//function read berfungsi mengambil/read data dari table peminjaman di database
	public function rekap_peminjaman_perhari() {
		//sql read
		$this->db->select('tanggal_pinjam, count(id) AS total_pinjam');
		$this->db->from('peminjaman');
        $this->db->group_by('tanggal_pinjam');
		$this->db->order_by('tanggal_pinjam', 'DESC');
        $this->db->limit(7);
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}

    //function read berfungsi mengambil/read data dari table peminjaman di database
	public function rekap_buku_perkategori() {
		//sql read
		$this->db->select('kategori_buku.nama, count(buku.id) AS total_buku');
		$this->db->from('buku');
        $this->db->join('kategori_buku', 'buku.kategori_id = kategori_buku.id');
        $this->db->group_by('kategori_buku.nama');
		$this->db->order_by('kategori_buku.nama', 'ASC');
        $this->db->limit(5);
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}

}
