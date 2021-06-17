<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'libraries/REST_Controller.php');

class Auth extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('user_model'));
    }

    function login_post() {
        //aturan validasi
        $data = $this->post();
        $this->form_validation->set_data($data);

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        //jika validasi berhasil
        if ($this->form_validation->run() == TRUE) {

            //memanggil model untuk insert
            $username = $this->post('username');
            $password = md5($this->post('password'));
            $user_data = $this->user_model->read_single_auth($username, $password);

            //jika data ditemukan
            if ($user_data) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'Login valid',
                    'data' => $user_data,
                ], REST_Controller::HTTP_OK);

            //jika data tidak ditemukan
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Login tidak valid'
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

}
?>