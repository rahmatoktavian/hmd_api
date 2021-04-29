<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'libraries/REST_Controller.php');

class Anggota extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('anggota_model'));
    }

    function index_get() {
        //memanggil model
        $response = $this->anggota_model->read();

        //jika data ditemukan
        if ($response) {
            $this->response([
                'status' => TRUE,
                'response' => $response
            ], REST_Controller::HTTP_OK);

        //jika data tidak ditemukan
        } else {
            $this->response([
                'status' => FALSE,
                'response' => 'Data tidak ditemukan'
            ], REST_Controller::HTTP_OK);
        }
    }

    function detail_get() {
        //menangkap nim dari url
        $nim = $this->get('nim');

        //memanggil model + nim yang dikirim dari url
        $response = $this->anggota_model->read_single($nim);

        if ($response) {
            $this->response([
                'status' => TRUE,
                'response' => $response
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'response' => 'Data tidak ditemukan'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_post() {
        //aturan validasi
        $data = $this->post();
        $this->form_validation->set_data($data);

        $this->form_validation->set_rules('nim', 'nim', 'required|numeric|is_unique[anggota.nim]');
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('jurusan', 'jurusan', 'required');

        //jika validasi berhasil
        if ($this->form_validation->run() == TRUE) {

            //memanggil model untuk insert
            $response = $this->anggota_model->insert($data);

            //jika data ditemukan
            if ($response) {
                $this->response([
                    'status' => TRUE,
                    'response' => 'Data berhasil dimasukan'
                ], REST_Controller::HTTP_OK);

            //jika data tidak ditemukan
            } else {
                $this->response([
                    'status' => FALSE,
                    'response' => 'Data tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

        //jika validasi gagal
        } else {
            $this->response([
                'status' => FALSE,
                'response' => validation_errors('-',','),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_put() {
        //aturan validasi
        $data = $this->put();
        $this->form_validation->set_data($data);

        $this->form_validation->set_rules('nim', 'nim', 'required|numeric');
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('jurusan', 'jurusan', 'required');

        //jika validasi berhasil
        if ($this->form_validation->run() == TRUE) {

            //menangkap data dari form api
            $nim = $this->put('nim');

            //memanggil model untuk update
            $response = $this->anggota_model->update($data, $nim);
            
            //jika data ditemukan
            if ($response) {
                $this->response([
                    'status' => TRUE,
                    'response' => 'Data berhasil diubah'
                ], REST_Controller::HTTP_OK);

            //jika data tidak ditemukan
            } else {
                $this->response([
                    'status' => FALSE,
                    'response' => 'Data tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

        //jika validasi gagal
        } else {
            $this->response([
                'status' => FALSE,
                'response' => validation_errors('-',','),
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_delete() {
        //menangkap nim dari url
        $nim = $this->delete('nim');
        
        //memanggil model + nim yang dikirim dari url
        $response = $this->anggota_model->delete($nim);

        //jika data ditemukan
        if ($response) {
            $this->response([
                'status' => TRUE,
                'response' => 'Data berhasil dihapus'
            ], REST_Controller::HTTP_OK);

        //jika data tidak ditemukan
        } else {
            $this->response([
                'status' => FALSE,
                'response' => 'Data tidak ditemukan'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
?>