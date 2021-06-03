<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_buku_model extends CI_Model {

	//function read berfungsi mengambil/read data dari table kategori_buku di database
	public function read() {

		//sql read
		$this->db->select('*');
		$this->db->from('kategori_buku');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}

	//function read berfungsi mengambil/read data dari table kategori_buku di database
	public function read_single($id) {

		//sql read
		$this->db->select('*');
		$this->db->from('kategori_buku');

		//$id = id data yang dikirim dari controller (sebagai filter data yang dipilih)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id', $id);

		$query = $this->db->get();

		//query->row_array = mengirim data ke controller dalam bentuk 1 data
        return $query->row_array();
	}

	//function insert berfungsi menyimpan/create data ke table kategori_buku di database
	public function insert($input) {
		//$input = data yang dikirim dari controller
		return $this->db->insert('kategori_buku', $input);
	}

	//function update berfungsi merubah data ke table kategori_buku di database
	public function update($input, $id) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang diubah)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id', $id);

		//$input = data yang dikirim dari controller
		return $this->db->update('kategori_buku', $input);

		/*
		UPDATE kategori_buku
		SET nama = 'Jakarta'
		WHERE id = 1
		*/
	}

	//function delete berfungsi menghapus data dari table kategori_buku di database
	public function delete($id) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang dihapus)
		$this->db->where('id', $id);
		return $this->db->delete('kategori_buku');

		//DELETE FROM kategori_buku WHERE id = 1
	}
}
