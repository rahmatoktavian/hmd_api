<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'libraries/REST_Controller.php');

class Output extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('output_model'));
    }

    function rekap_peminjaman_perhari_get() {
        //memanggil model
        $response = $this->output_model->rekap_peminjaman_perhari();
       
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

    function rekap_buku_perkategori_get() {
        //memanggil model
        $response = $this->output_model->rekap_buku_perkategori();
       
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
}
?>