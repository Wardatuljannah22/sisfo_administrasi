<?php // helper tidak mengenal this

function is_logged_in() //cuma fungsi2 aja
{
    $ci = get_instance(); //ci = variabel
    //cek jika belum login
    if (!$ci->session->userdata('email')) { //!$this gk masuk mvc maka pake get_instance
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1); //ambil diurutan atau segment brp

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array(); //dari sini dapat semua
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where(
            'user_access_menu',
            [
                'role_id' => $role_id,
                'menu_id' => $menu_id
            ]
        );

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked'); //udah login tp gk bisa ke menu jadi ke halaman blocked
        }
    }
}
