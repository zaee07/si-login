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

class Home extends CI_Controller {
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

        $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('account/index', $data);
            $this->load->view('templates/footer');
    }
}