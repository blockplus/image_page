<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    var $session_user;

    function __construct() {
        parent::__construct();

        Utils::no_cache();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('auth/login'));
            exit;
        }
        $this->session_user = $this->session->userdata('logged_in');
    }

    /*
     * 
     */

    public function index() {
        redirect(base_url('account/change_password'));
    }
    
    public function change_password() {
        $data['title'] = 'Change password';
        $data['session_user'] = $this->session_user;
        if (count($_POST)) {
            $old_password = @$_POST['old_password'] ? $_POST['old_password'] : '';
            $new_password = @$_POST['new_password'] ? $_POST['new_password'] : '';
            $confirm_password = @$_POST['confirm_password'] ? $_POST['confirm_password'] : '';

            $data['old_password'] = $old_password;
            $data['new_password'] = $new_password ;
            $data['confirm_password'] = $confirm_password;
            
            $hash = Utils::hash('sha1', $old_password, AUTH_SALT);
            $userid = $this->session_user['users_id'];
            $this->load->model('auth_model');
            $user_row = $this->auth_model->get_row_by_id($userid);

            if (@$user_row->{'password'} && $user_row->{'password'} == $hash) {
                // Match

                $this->form_validation->set_rules('new_password', 'Password', 'trim|required');
                $this->form_validation->set_rules('confirm_password', 'Password', 'trim|required|matches[new_password]|min_length[6]|alpha_numeric|callback_password_check');
                if ($this->form_validation->run() == false) {
                    $data['notif']['message'] = validation_errors();
                    $data['notif']['type'] = 'danger';
                } 
                else {
                    $hash = Utils::hash('sha1', $new_password, AUTH_SALT);
                    $this->auth_model->change_password($userid, $hash);
                    
                    $data['notif']['message'] = 'Password changed successfully !';
                    $data['notif']['type'] = 'success';
                }                 

            } else {
                $data['notif']['message'] = 'Old password is not correct !';
                $data['notif']['type'] = 'danger';
            }
        }

        /*
         * Load view
         */
        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/includes/navbar');
        $this->load->view('profile/change_password');
        $this->load->view('admin/includes/footer');
    }


    /*
     * 
     */
    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        Utils::no_cache();
        redirect(base_url('auth/login'));
    }

    public function password_check($str)
    {
       if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
         return TRUE;
       }
       return FALSE;
    }

}
