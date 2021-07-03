<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_model extends CI_Model {

	//function read berfungsi mengambil/read data dari table peminjaman di database
	public function read($filter=array()) {

		//sql read
		$this->db->select('peminjaman.*');
		$this->db->select('anggota.nama AS nama_anggota');
		$this->db->select('petugas.nama AS nama_petugas');
		$this->db->from('peminjaman');
		$this->db->join('anggota', 'peminjaman.nim = anggota.nim');
		$this->db->join('petugas', 'peminjaman.petugas_id = petugas.id');

		if(!empty($filter['nim'])) {
			$this->db->where('peminjaman.nim', $filter['nim']);
		}

		if(!empty($filter['petugas_id'])) {
			$this->db->where('peminjaman.petugas_id', $filter['petugas_id']);
		}

		$this->db->order_by('peminjaman.id', 'DESC');
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}

	//function read berfungsi mengambil/read data dari table peminjaman di database
	public function read_single($id) {

		//sql read
		$this->db->select('*');
		$this->db->from('peminjaman');

		//$id = id data yang dikirim dari controller (sebagai filter data yang dipilih)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id', $id);

		$query = $this->db->get();

		//query->row_array = mengirim data ke controller dalam bentuk 1 data
        return $query->row_array();
	}

	//function insert berfungsi menyimpan/create data ke table peminjaman di database
	public function insert($input) {
		//$input = data yang dikirim dari controller
		return $this->db->insert('peminjaman', $input);
	}

	//function update berfungsi merubah data ke table peminjaman di database
	public function update($input, $id) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang diubah)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id', $id);

		//$input = data yang dikirim dari controller
		return $this->db->update('peminjaman', $input);

		/*
		UPDATE peminjaman
		SET nama = 'Jakarta'
		WHERE id = 1
		*/
	}

	//function delete berfungsi menghapus data dari table peminjaman di database
	public function delete($id) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang dihapus)
		$this->db->where('id', $id);
		return $this->db->delete('peminjaman');

		//DELETE FROM peminjaman WHERE id = 1
	}
}
