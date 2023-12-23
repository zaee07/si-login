<?php

function is_logged_in() {

    $ci = get_instance();
    if ( !$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $query = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $query['id'];

        $access = $ci->db->get_where('user_access_menu', 
        [
            'user_role_id' => $role_id, 
            'user_menu_id' => $menu_id
        ]);

        if( $access->num_rows() < 1 ) {
            redirect('auth/blocked');
        }
    }
}

function check_access($role_id, $menu_id) {
    $ci = get_instance();
    $result = $ci->db->get_where('user_access_menu',
            [
                'user_role_id' => $role_id,
                'user_menu_id' => $menu_id
            ]);
    
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function check($subMenuId) {
    $ci = get_instance();
    $result = $ci->db->get_where('user_sub_menu', ['id' => $subMenuId ])->row_array();
    if ( $result['is_active'] == 1) {
        return "checked='checked' value='1'";
    }
}