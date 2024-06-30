<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {
    public function index() {
        $data['movies'] = $this->MovieModel->getAllMovies();
        $data['active_tab'] = 'home';
        $this->load->view('user/header',$data);
        $this->load->view('user/userDash',$data);
    }

}