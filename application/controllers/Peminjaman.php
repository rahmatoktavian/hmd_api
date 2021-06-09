<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'libraries/REST_Controller.php');

class Peminjaman extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('peminjaman_model'));
    }

    function index_get() {
        //memanggil model
        $response = $this->peminjaman_model->read();
       
        //jika data ditemukan
        if ($response) {
            $this->response([
                'status' => TRUE,
                'data' => $response
            ], REST_Controller::HTTP_OK);

        //jika data tidak ditemukan
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data tidak ditemukan'
            ], REST_Controller::HTTP_OK);
        }
    }

    function detail_get() {
        //menangkap id dari url
        $id = $this->get('id');
        
        //memanggil model + id yang dikirim dari url
        $response = $this->peminjaman_model->read_single($id);

        if ($response) {
            $this->response([
                'status' => TRUE,
                'data' => $response
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data tidak ditemukan'
            ], REST_Controller::HTTP_OK);
        }
    }

    function index_post() {
        //aturan validasi
        $data = $this->post();
        $this->form_validation->set_data($data);

        $this->form_validation->set_rules('nim', 'NIM', 'required|numeric');
        $this->form_validation->set_rules('petugas_id', 'Petugas ID', 'required|numeric');
        $this->form_validation->set_rules('tanggal_pinjam', 'Tanggal Pinjam', 'required');
        $this->form_validation->set_rules('tanggal_batas_kembali', 'Tanggal Batas Kembali', 'required|numeric');

        //jika validasi berhasil
        if ($this->form_validation->run() == TRUE) {

            //memanggil model untuk insert
            $response = $this->peminjaman_model->insert($data);

            //jika data ditemukan
            if ($response) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'Data berhasil dimasukan'
                ], REST_Controller::HTTP_OK);

            //jika data tidak ditemukan
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Gagal dimasukan'
                ], REST_Controller::HTTP_OK);
            }

        //jika validasi gagal
        } else {
            $this->response([
                'status' => FALSE,
                'message' => validation_errors(' ',','),
            ], REST_Controller::HTTP_OK);
        }
    }

    function index_put() {
        //aturan validasi
        $data = $this->put();
        $this->form_validation->set_data($data);

        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('nim', 'NIM', 'required|numeric');
        $this->form_validation->set_rules('petugas_id', 'Petugas ID', 'required|numeric');
        $this->form_validation->set_rules('tanggal_pinjam', 'Tanggal Pinjam', 'required');
        $this->form_validation->set_rules('tanggal_batas_kembali', 'Tanggal Batas Kembali', 'required|numeric');

        //jika validasi berhasil
        if ($this->form_validation->run() == TRUE) {

            //menangkap data dari form api
            $id = $this->put('id');

            //memanggil model untuk update
            $response = $this->peminjaman_model->update($data, $id);
            
            //jika data ditemukan
            if ($response) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'Data berhasil diubah'
                ], REST_Controller::HTTP_OK);

            //jika data tidak ditemukan
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Gagal diubah'
                ], REST_Controller::HTTP_OK);
            }

        //jika validasi gagal
        } else {
            $this->response([
                'status' => FALSE,
                'message' => validation_errors(' ',' '),
            ], REST_Controller::HTTP_OK);
        }
    }

    function delete_get() {
        //menangkap id dari url
        $id = $this->get('id');
        
        //memanggil model + id yang dikirim dari url
        $response = $this->peminjaman_model->delete($id);

        //jika data ditemukan
        if ($response) {
            $this->response([
                'status' => TRUE,
                'message' => 'Data berhasil dihapus'
            ], REST_Controller::HTTP_OK);

        //jika data tidak ditemukan
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Gagal dihapus'
            ], REST_Controller::HTTP_OK);
        }
    }

    /*function index_delete() {
        //menangkap id dari url
        $id = $this->delete('id');

        //memanggil model + id yang dikirim dari url
        $response = $this->peminjaman_model->delete($id);

        //jika data ditemukan
        if ($response) {
            $this->response([
                'status' => TRUE,
                'message' => 'Data berhasil dihapus'
            ], REST_Controller::HTTP_OK);

        //jika data tidak ditemukan
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Gagal dihapus'
            ], REST_Controller::HTTP_OK);
        }
    }*/
}
?>