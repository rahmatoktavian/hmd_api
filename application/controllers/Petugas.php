<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'libraries/REST_Controller.php');

class Petugas extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('petugas_model'));
    }

    function index_get() {
        //memanggil model
        $response = $this->petugas_model->read();
       
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
        $response = $this->petugas_model->read_single($id);

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

        $this->form_validation->set_rules('nama', 'Nama', 'required');

        //jika validasi berhasil
        if ($this->form_validation->run() == TRUE) {

            //memanggil model untuk insert
            $response = $this->petugas_model->insert($data);

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

        $this->form_validation->set_rules('nama', 'Nama', 'required');

        //jika validasi berhasil
        if ($this->form_validation->run() == TRUE) {

            //menangkap data dari form api
            $id = $this->put('id');

            //memanggil model untuk update
            $response = $this->petugas_model->update($data, $id);
            
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
        $response = $this->petugas_model->delete($id);

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
}
?>