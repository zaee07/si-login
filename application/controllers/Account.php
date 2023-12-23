<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property form_validation $form_validation
 * @property session $session
 * @property db $db
 * @property input $input
 * @property menu $menu
 * @property Menu_model $Menu_model
 */

class Account extends CI_Controller {

    private $query;

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model', 'menu');
        $this->query=$this->db->select('menu')->get_where( 'user_menu', ['id' => 3] )->row_array();
    }

    public function index() {
        $data['sub'] = $this->menu->getSubMenuById(5);
        $data['title'] = implode('',$this->query);
        $data['user'] = $this->db->get_where( 'users', ['email' => $this->session->userdata('email')] )->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('account/index', $data);
        $this->load->view('templates/footer');
    }

    public function details() {
        $data['sub'] = $this->menu->getSubMenuById(6);
        $data['title'] = implode('',$this->query);
        $data['user'] = $this->db->get_where( 'users', ['email' => $this->session->userdata('email')] )->row_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('account/details', $data);
        $this->load->view('templates/footer');
    }

    public function edit() {
        $data['sub'] = $this->menu->getSubMenuById(7);
        $data['title'] = implode('',$this->query);
        $data['user'] = $this->db->get_where( 'users', ['email' => $this->session->userdata('email')] )->row_array();
        
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        if ( $this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('account/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('nama');
            $email = $this->input->post('email');
            $image = $_FILES['image']['name'];//var_dump($image);die;

            if ( $image ) {
                $config['allowed_types'] = 'jpg|png|PNG|JPG|gif|Jpg|svg';
                $config['upload_path'] = './assets1/img/avatars/';
                $this->load->library('upload', $config);

                if ( $this->upload->do_upload('image') ) {
                    $oldImage = $data['user']['image'];
                    if ( $oldImage != 'default.png' ) {
                        unlink(FCPATH. 'assets1/img/avatars/' . $oldImage);
                    }
                    $newImage = $this->upload->data('file_name');
                    $this->db->set('image', $newImage);
                    // var_dump($this->queries);die;
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name)->where('email', $email)->update('users');
            $this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil Diubah!</div>');
            redirect('account/details');
        }
    }

    public function ubahpassword() {
        $data['sub'] = $this->menu->getSubMenuById(8);
        $data['title'] = implode('',$this->query);
        $data['user'] = $this->db->get_where( 'users', ['email' => $this->session->userdata('email')] )->row_array();
        
        $this->form_validation->set_rules('current_password', 'password saat ini', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'password baru', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'password konfirmasi', 'required|trim|min_length[6]|matches[new_password2]');

        if ( $this->form_validation->run() == false ) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('account/ubahpassword', $data);
            $this->load->view('templates/footer');
        } else {
            $currentPassword = $this->input->post('current_password');
            $newPassword1 = $this->input->post('new_password1');
            $newPassword2 = $this->input->post('new_password2');
            if ( !password_verify($currentPassword, $data['user']['password']) ) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Password Salah!</div>');
            redirect('account/ubahpassword');
            } else {
                if ( $currentPassword == $newPassword1 || $currentPassword == $newPassword2 ) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Gunakan Password baru!</div>');
                    redirect('account/ubahpassword');
                } else {
                    $passwordHash = password_hash($newPassword1, PASSWORD_DEFAULT);

                    $this->db->set('password', $passwordHash)->where('email', $this->session->userdata('email'))->update('users');
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Password Berhasil Diubah!</div>');
                    redirect('account/ubahpassword');
                }
            }
        }
    }
}