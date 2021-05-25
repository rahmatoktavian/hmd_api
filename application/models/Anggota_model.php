<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota_model extends CI_Model {

	//function read berfungsi mengambil/read data dari table anggota di database
	public function read() {

		//sql read
		$this->db->select('*');
		$this->db->from('anggota');
		$this->db->order_by('nim', 'ASC');
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}

	//function read berfungsi mengambil/read data dari table anggota di database
	public function read_single($nim) {

		//sql read
		$this->db->select('*');
		$this->db->from('anggota');

		//$nim = nim data yang dikirim dari controller (sebagai filter data yang dipilih)
		//filter data sesuai nim yang dikirim dari controller
		$this->db->where('nim', $nim);

		$query = $this->db->get();

		//query->row_array = mengirim data ke controller dalam bentuk 1 data
        return $query->row_array();
	}

	//function insert berfungsi menyimpan/create data ke table anggota di database
	public function insert($input) {
		//$input = data yang dikirim dari controller
		$this->db->insert('anggota', $input);

		//return berhasil jika ada data berhasil diinsert
		return $this->db->affected_rows();
	}

	//function update berfungsi merubah data ke table anggota di database
	public function update($input, $nim) {
		//$nim = nim data yang dikirim dari controller (sebagai filter data yang diubah)
		//filter data sesuai nim yang dikirim dari controller
		$this->db->where('nim', $nim);

		//$input = data yang dikirim dari controller
		$this->db->update('anggota', $input);

		//return berhasil jika ada data berhasil diubah
		return $this->db->affected_rows();

		/*
		UPDATE anggota
		SET nama = 'Jakarta'
		WHERE nim = 1
		*/
	}

	//function delete berfungsi menghapus data dari table anggota di database
	public function delete($nim) {
		//$nim = nim data yang dikirim dari controller (sebagai filter data yang dihapus)
		$this->db->where('nim', $nim);
		$this->db->delete('anggota');

		//return berhasil jika ada data berhasil dihapus
		return $this->db->affected_rows();

		//DELETE FROM anggota WHERE nim = 1
	}
}
