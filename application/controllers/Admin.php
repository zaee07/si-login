<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property session $session
 * @property db $db
 * @property input $input
 * @property menu $menu
 * @property Menu_model $Menu_model
 */

class Admin extends CI_Controller {

    private $query;

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model', 'menu');
        $this->query= $this->db->select('menu')->get_where( 'user_menu', ['id' => 1] )->row_array();
    }

    public function index() {
        $data['sub'] = $this->menu->getSubMenuById(1);
        $data['title'] = implode('', $this->query);
        $data['user'] = $this->db->get_where( 'users', ['email' => $this->session->userdata('email')] )->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role() {
        $data['sub'] = $this->menu->getSubMenuById(2);
        $data['title'] = implode('', $this->query);
        $data['user'] = $this->db->get_where( 'users', ['email' => $this->session->userdata('email')] )->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleaccess($role_id) {
        $data['sub'] = $this->menu->getSubMenuById(2);
        $data['title'] = implode('', $this->query);
        $data['user'] = $this->db->get_where( 'users', ['email' => $this->session->userdata('email')] )->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $data['menu'] = $this->db->where('id !=', 1)->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/role_access', $data);
        $this->load->view('templates/footer', $data);
    }

    public function changeaccess() {
        $data['sub'] = $this->menu->getSubMenuById(2);
        $data['title'] = implode('', $this->query);
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'user_role_id' => $role_id,
            'user_menu_id' => $menu_id
        ];
        // var_dump($menu_id);echo "<br>";var_dump($role_id);die;
        $result = $this->db->get_where('user_access_menu', $data);

        if ( $result->num_rows() < 1 ) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil !</div>');
    }

    public function status() {
        $data['sub'] = $this->menu->getSubMenuById(1);
        $data['title'] = implode('', $this->query);
        $data['user'] = $this->db->get_where( 'users', ['email' => $this->session->userdata('email')] )->row_array();
        $data['menu'] = $this->db->where('id !=', 1)->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }
}