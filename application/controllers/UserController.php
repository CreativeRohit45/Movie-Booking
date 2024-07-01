<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {
    public function index() {
        $data['movies'] = $this->MovieModel->getAllMovies();
        $data['active_tab'] = 'home';
        $this->load->view('user/header',$data);
        $this->load->view('user/userDash',$data);
    }

    public function viewMovie($movie_id){
        $data['active_tab'] = 'home';
        $movie = $this->MovieModel->getMovie($movie_id);
        $data['movie'] = $movie;
        $data['time_slots'] = json_decode($movie->time, true);
        $this->load->view('user/header',$data);
        $this->load->view('user/bookMovie',$data);
    }

    public function registerUser(){
        $data['active_tab'] = 'register';
        $this->load->view('user/header',$data);
        $this->load->view('user/userRegister',$data);
    }

    public function loginUser(){
        $data['active_tab'] = 'login';
        $this->load->view('user/header',$data);
        $this->load->view('user/userLogin',$data);
    }

}