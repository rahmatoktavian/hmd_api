<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'libraries/REST_Controller.php');

class Auth extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('user_model', 'anggota_model'));
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

    function reg_anggota_post() {
        //aturan validasi
        $data = $this->post();
        $this->form_validation->set_data($data);

        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('nim', 'NIM', 'required|numeric|is_unique[anggota.nim]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

        //jika validasi berhasil
        if ($this->form_validation->run() == TRUE) {

            //proses multi query
            $this->db->trans_begin();

            //data anggota untuk insert table user
            $data_user = array(
                        'type' => 'anggota',
                        'petugas_id' => null,
                        'nim' => $this->post('nim'),
                        'username' => $this->post('username'),
                        'password' => md5($this->post('password')),
                    );
            //memanggil model untuk insert
            $this->user_model->insert($data_user);

            //data anggota
            $data_anggota = array(
                        'nim' => $this->post('nim'),
                        'nama' => $this->post('nama'),
                        'jurusan'  => $this->post('jurusan'),
                    );
            //memanggil model untuk insert
            $this->anggota_model->insert($data_anggota);

            //batalkan semua query (jika ada error)
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();

                $this->response([
                    'status' => FALSE,
                    'message' => 'Gagal dimasukan'
                ], REST_Controller::HTTP_OK);

            //execute semua query (jika tidak ada error)
            } else {
                $this->db->trans_commit();

                $this->response([
                    'status' => TRUE,
                    'message' => 'Register anggota berhasil'
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
