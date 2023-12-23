<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property form_validation $form_validation
 * @property session $session
 * @property db $db
 * @property input $input
 */

class Menu_model extends CI_Model 
{
    public function getSubMenu() {
        $query = "SELECT user_sub_menu.*, user_menu.menu FROM user_sub_menu JOIN user_menu ON user_sub_menu.user_menu_id = user_menu.id";
        return $this->db->query($query)->result_array();
    }

    public function getMenuById($id) {
        return $this->db->where('id', $id)->get('user_menu')->row_array();
    }

    public function getSubMenuById($id) {
        return $this->db->where('id', $id)->get('user_sub_menu')->row_array();
    }

    public function hapusMenu($id) {
        return $this->db->where_in('id', $id)->delete('user_menu');
    }

    public function hapusSubMenu($id) {
        return $this->db->where_in('id', $id)->delete('user_sub_menu');
    }

    public function ubahMenu() {
        $data = ['menu' => $this->input->post('menu', true)];
        return $this->db->where('id', $this->input->post('id'))->update('user_menu', $data);
    }

    public function ubahSubMenu() {
        // tangkap value form
        $active = $this->input->post('is_active', true) == 'on' ? 1 : 0 ;
        // var_dump($active);die;
        $data = [
            'menu_id' => $this->input->post('menu_id', true),
            'title' => $this->input->post('title', true),
            'url' => $this->input->post('url', true),
            'icon' => $this->input->post('icon', true),
            'is_active' => $active
        ];
        return $this->db->where('id', $this->input->post('id'))->update('user_sub_menu', $data);
    }
}