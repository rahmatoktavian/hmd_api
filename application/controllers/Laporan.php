<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'libraries/REST_Controller.php');

class Laporan extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('laporan_model'));
    }

    function rekap_peminjaman_perhari_post() {
        //memanggil model
        $response = $this->laporan_model->rekap_peminjaman_perhari();

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

    function rekap_buku_perkategori_post() {
        //memanggil model
        $response = $this->laporan_model->rekap_buku_perkategori();

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

    function detil_peminjaman_post() {
        //parameter
        $filter = $this->post();

        //memanggil model
        $response = $this->laporan_model->detil_peminjaman($filter);

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
