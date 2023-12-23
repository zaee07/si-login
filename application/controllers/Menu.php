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

class menu extends CI_Controller 
{

    private $query;

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model', 'menu');
        $this->query=$this->db->select('menu')->get_where( 'user_menu', ['id' => 2] )->row_array();
    }

    public function index() {
        $data['sub'] = $this->menu->getSubMenuById(3);
        $data['title'] = implode('', $this->query);
        $data['user'] = $this->db->get_where( 'users', ['email' => $this->session->userdata('email')] )->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if($this->form_validation->run() == false ) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')] );
            $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible" role="alert">Menu berhasil ditambahkan</div>');
            redirect('menu');
        }
    }

    public function submenu() {
        $data['sub'] = $this->menu->getSubMenuById(4);
        $data['title'] = implode('',$this->query);
        $data['user'] = $this->db->get_where( 'users', ['email' => $this->session->userdata('email')] )->row_array();
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        // $this->form_validation->set_rules('icon', 'Icon', 'required');

        if( $this->form_validation->run() == false ) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'user_menu_id'=> $this->input->post('menu_id'),
                'user_menu_id1'=> $this->input->post('menu_id'),
                'url'=>$this->input->post('url'),
                'icon'=>$this->input->post('icon'),
                'is_active'=>$this->input->post('is_active')
            ];
            
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible" role="alert">Sub Menu berhasil ditambahkan</div>');
            redirect('menu/submenu');
        }
    }

    public function hapus($id) {
        $data['sub'] = $this->menu->getSubMenuById(3);
        $data['title'] = implode('', $this->query);
        if( $this->menu->hapusMenu($id) ==  true ) {
            $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible" role="alert">Menu berhasil dihapus</div>');
            redirect('menu');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">Menu gagal dihapus</div>');
            redirect('menu');
        }
    }

    public function sub_hapus($id) {
        $data['sub'] = $this->menu->getSubMenuById(4);
        $data['title'] = implode('', $this->query);
        if( $this->menu->hapusSubMenu($id) ==  true ) {
            $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible" role="alert">Berhasil di hapus</div>');
            redirect('menu/submenu');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">Menu gagal dihapus</div>');
            redirect('menu/submenu');
        }
    }

    public function ubah($id) {
        $data['sub'] = $this->menu->getSubMenuById(3);
        $data['title'] = implode('',$this->query);
        $data['user'] = $this->db->get_where( 'users', ['email' => $this->session->userdata('email')] )->row_array();
        $data['menu'] = $this->menu->getMenuById($id);

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if( $this->form_validation->run() == false ) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('menu/ubahmenu', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->menu->ubahMenu();
            $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible" role="alert">Berhasil di edit !</div>');
            redirect('menu');
        }
    }

    public function sub_edit($id) {
        $data['sub'] = $this->menu->getSubMenuById(4);
        $data['title'] = implode('', $this->query);
        $data['user'] = $this->db->get_where( 'users', ['email' => $this->session->userdata('email')] )->row_array();
        $data['sub_menu'] = $this->menu->getSubMenuById($id);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Sub Menu', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url Sub Menu', 'required');
        // $this->form_validation->set_rules('icon', 'icon', 'required');

        if( $this->form_validation->run() == false ) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('menu/ubahsubmenu', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->menu->ubahSubMenu();
            $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible" role="alert">Berhasil di edit !</div>');
            redirect('menu/submenu');
        }
    }
}