<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'libraries/REST_Controller.php');

class Peminjaman_buku extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('peminjaman_buku_model'));
    }

    function index_get() {
        //menangkap id dari url
        $peminjaman_id = $this->get('peminjaman_id');

        //memanggil model
        $response = $this->peminjaman_buku_model->read($peminjaman_id);
       
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
        $response = $this->peminjaman_buku_model->read_single($id);

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

        $this->form_validation->set_rules('buku_id', 'Buku ID', 'required|numeric');
        $this->form_validation->set_rules('peminjaman_id', 'Peminjaman ID', 'required|numeric');

        //jika validasi berhasil
        if ($this->form_validation->run() == TRUE) {

            //memanggil model untuk insert
            $response = $this->peminjaman_buku_model->insert($data);

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

    function delete_get() {
        //menangkap id dari url
        $id = $this->get('id');
        
        //memanggil model + id yang dikirim dari url
        $response = $this->peminjaman_buku_model->delete($id);

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
        $response = $this->peminjaman_buku_model->delete($id);

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